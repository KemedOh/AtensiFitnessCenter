<?php

namespace App\Controllers;

use App\Models\AdminModel;

class AdminAuthController extends BaseController
{
    protected $adminModel;
    protected $session;
    
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->session = session();
        helper(['form', 'url']);
    }
    
    // Halaman Login Admin
    public function login()
    {
        // Jika sudah login sebagai admin, redirect ke dashboard admin
        if ($this->session->get('admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }
        
        $data = [
            'title' => 'Login Admin - Atensi Fitness Center',
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/auth/login', $data);
    }
    
    // Proses Login Admin
    public function attemptLogin()
    {
        // Validasi
        $rules = [
            'username' => 'required',
            'password' => 'required|min_length[6]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');
        
        // Attempt login
        $result = $this->adminModel->attemptLogin($username, $password);
        
        if ($result === false) {
            return redirect()->back()->withInput()->with('error', 'Username/Email atau password salah.');
        }
        
        if ($result === 'inactive') {
            return redirect()->back()->withInput()->with('error', 'Akun admin tidak aktif. Hubungi superadmin.');
        }
        
        // Set session
        $sessionData = [
            'admin_id' => $result['id'],
            'admin_username' => $result['username'],
            'admin_email' => $result['email'],
            'admin_nama' => $result['nama_lengkap'],
            'admin_role' => $result['role'],
            'admin_logged_in' => true,
            'is_superadmin' => ($result['role'] === 'superadmin')
        ];
        
        $this->session->set($sessionData);
        
        // Set remember me cookie (30 hari)
        if ($remember) {
            $token = bin2hex(random_bytes(32));
            $this->response->setCookie('admin_remember_token', $token, 30 * 24 * 3600);
        }
        
        // Log activity
        $this->logActivity($result['id'], 'Login ke sistem admin');
        
        // Redirect ke dashboard berdasarkan role
        if ($result['role'] === 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('success', 'Login berhasil! Selamat datang Super Admin.');
        } else {
            return redirect()->to('/admin/dashboard')->with('success', 'Login berhasil! Selamat datang ' . $result['nama_lengkap']);
        }
    }
    
    // Logout Admin
    public function logout()
    {
        // Log activity sebelum logout
        if ($this->session->get('admin_id')) {
            $this->logActivity($this->session->get('admin_id'), 'Logout dari sistem admin');
        }
        
        // Hapus session admin
        $sessionItems = [
            'admin_id', 'admin_username', 'admin_email', 
            'admin_nama', 'admin_role', 'admin_logged_in', 'is_superadmin'
        ];
        
        foreach ($sessionItems as $item) {
            $this->session->remove($item);
        }
        
        // Hapus remember cookie
        $this->response->deleteCookie('admin_remember_token');
        
        return redirect()->to('/admin/auth/login')->with('success', 'Anda telah logout dari sistem admin.');
    }
    
    // Forgot Password (untuk admin)
    public function forgotPassword()
    {
        $data = [
            'title' => 'Lupa Password Admin - Atensi Fitness Center',
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/auth/forgot_password', $data);
    }
    
    // Log activity (simplified)
    private function logActivity($adminId, $activity)
    {
        // Dalam implementasi nyata, simpan ke table activity_log
        $logData = [
            'admin_id' => $adminId,
            'activity' => $activity,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        // Simpan ke file log atau database
        log_message('info', 'Admin Activity: ' . json_encode($logData));
    }
    
    // Halaman pertama kali setup superadmin
    public function setupSuperadmin()
    {
        // Cek jika sudah ada superadmin
        $superadminCount = $this->adminModel->where('role', 'superadmin')->countAllResults();
        
        if ($superadminCount > 0) {
            return redirect()->to('/admin/auth/login')->with('error', 'Superadmin sudah terdaftar.');
        }
        
        $data = [
            'title' => 'Setup Superadmin - Atensi Fitness Center',
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/auth/setup_superadmin', $data);
    }
    
    // Proses setup superadmin
    public function processSetup()
    {
        // Cek jika sudah ada superadmin
        $superadminCount = $this->adminModel->where('role', 'superadmin')->countAllResults();
        
        if ($superadminCount > 0) {
            return redirect()->to('/admin/auth/login')->with('error', 'Superadmin sudah terdaftar.');
        }
        
        // Validasi
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[admins.username]',
            'email' => 'required|valid_email|is_unique[admins.email]',
            'password' => 'required|min_length[6]',
            'password_confirmation' => 'required|matches[password]',
            'nama_lengkap' => 'required|min_length[3]|max_length[100]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Simpan superadmin
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role' => 'superadmin',
            'is_active' => true
        ];
        
        try {
            $this->adminModel->save($data);
            
            return redirect()->to('/admin/auth/login')->with('success', 'Superadmin berhasil dibuat! Silakan login.');
            
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal membuat superadmin: ' . $e->getMessage());
        }
    }
    
    // Generate dummy admins (hanya untuk superadmin)
    public function generateDummy()
    {
        // Cek jika user adalah superadmin
        if (!$this->session->get('is_superadmin')) {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak. Hanya untuk superadmin.');
        }
        
        try {
            $count = 5;
            $this->adminModel->generateDummyAdmins($count);
            
            // Log activity
            $this->logActivity($this->session->get('admin_id'), 'Generate ' . $count . ' dummy admins');
            
            return redirect()->to('/admin/manage')->with('success', $count . ' admin dummy berhasil dibuat!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat dummy admins: ' . $e->getMessage());
        }
    }
}