<?php

namespace App\Controllers;

use App\Models\MemberModel;

class AuthController extends BaseController
{
    protected $memberModel;
    protected $session;
    
    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->session = session();
        helper(['form', 'url']);
    }
    
    // Halaman Login
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->get('member_logged_in')) {
            return redirect()->to('/member/dashboard');
        }
        
        $data = [
            'title' => 'Login Member - Atensi Fitness Center',
            'validation' => \Config\Services::validation()
        ];
        
        return view('auth/login', $data);
    }
    
    // Proses Login
    public function attemptLogin()
    {
        // Validasi
        $rules = [
            'email_kode' => 'required',
            'password' => 'required|min_length[6]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $emailKode = $this->request->getPost('email_kode');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');
        
        // Attempt login
        $result = $this->memberModel->attemptLogin($emailKode, $password);
        
        if ($result === 'locked') {
            return redirect()->back()->withInput()->with('error', 'Akun terkunci. Coba lagi dalam 30 menit.');
        }
        
        if ($result === false) {
            return redirect()->back()->withInput()->with('error', 'Email/Kode Member atau password salah.');
        }
        
        // Cek status member
        if ($result['status'] !== 'active') {
            return redirect()->back()->withInput()->with('error', 'Akun Anda belum aktif atau telah expired. Hubungi admin.');
        }
        
        // Set session
        $sessionData = [
            'member_id' => $result['id'],
            'member_kode' => $result['kode_member'],
            'member_nama' => $result['nama'],
            'member_email' => $result['email'],
            'member_status' => $result['status'],
            'member_logged_in' => true
        ];
        
        $this->session->set($sessionData);
        
        // Set remember me cookie (30 hari)
        if ($remember) {
            $token = bin2hex(random_bytes(32));
            $this->response->setCookie('remember_token', $token, 30 * 24 * 3600);
            
            // Simpan token di database (opsional)
            // $this->saveRememberToken($result['id'], $token);
        }
        
        // Redirect ke dashboard
        return redirect()->to('/member/dashboard')->with('success', 'Login berhasil! Selamat datang ' . $result['nama']);
    }
    
    // Halaman Register/Daftar (update dari DaftarController)
    public function register()
    {
        $data = [
            'title' => 'Daftar Member Baru - Atensi Fitness Center',
            'paket_member' => $this->getPaketMember(),
            'validation' => \Config\Services::validation()
        ];
        
        return view('auth/register', $data);
    }
    
    // Proses Register (update dari DaftarController)
    public function processRegister()
    {
        // Validasi
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[members.email]',
            'password' => 'required|min_length[6]',
            'password_confirmation' => 'required|matches[password]',
            'tanggal_lahir' => 'required|valid_date',
            'no_hp' => 'required|min_length[10]|max_length[15]',
            'alamat' => 'required|min_length[10]',
            'paket_member' => 'required',
            'mulai_member' => 'required|valid_date',
            'foto_identitas' => [
                'rules' => 'uploaded[foto_identitas]|max_size[foto_identitas,2048]|mime_in[foto_identitas,image/jpg,image/jpeg,image/png]|is_image[foto_identitas]',
                'errors' => [
                    'uploaded' => 'Harus mengupload foto identitas',
                    'max_size' => 'Ukuran file maksimal 2MB',
                    'mime_in' => 'File harus berupa gambar (JPG, JPEG, PNG)',
                    'is_image' => 'File harus berupa gambar'
                ]
            ]
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Handle file upload
        $file = $this->request->getFile('foto_identitas');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $uploadPath = WRITEPATH . 'uploads/identitas/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            $fileName = $file->getRandomName();
            $file->move($uploadPath, $fileName);
            
            // Prepare data
            $data = [
                'kode_member' => $this->memberModel->generateKodeMember(),
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'no_hp' => $this->request->getPost('no_hp'),
                'alamat' => $this->request->getPost('alamat'),
                'paket_member' => $this->request->getPost('paket_member'),
                'mulai_member' => $this->request->getPost('mulai_member'),
                'foto_identitas' => $fileName,
                'status' => 'pending' // Awalnya pending, admin harus aktivasi
            ];
            
            try {
                $this->memberModel->save($data);
                
                // Auto login setelah registrasi (opsional)
                // $this->session->set([
                //     'member_id' => $this->memberModel->getInsertID(),
                //     'member_kode' => $data['kode_member'],
                //     'member_nama' => $data['nama'],
                //     'member_email' => $data['email'],
                //     'member_logged_in' => true
                // ]);
                
                return redirect()->to('/auth/success')->with('success', 'Pendaftaran berhasil! Kode member: ' . $data['kode_member']);
                
            } catch (\Exception $e) {
                // Hapus file jika error
                if (file_exists($uploadPath . $fileName)) {
                    unlink($uploadPath . $fileName);
                }
                return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
            }
        }
        
        return redirect()->back()->withInput()->with('error', 'Gagal upload file.');
    }
    
    // Halaman Success setelah register
    public function success()
    {
        if (!session()->has('success')) {
            return redirect()->to('/auth/register');
        }
        
        $data = [
            'title' => 'Pendaftaran Berhasil - Atensi Fitness Center'
        ];
        
        return view('auth/success', $data);
    }
    
    // Logout
    public function logout()
    {
        // Hapus session
        $sessionItems = ['member_id', 'member_kode', 'member_nama', 'member_email', 'member_status', 'member_logged_in'];
        
        foreach ($sessionItems as $item) {
            $this->session->remove($item);
        }
        
        // Hapus remember cookie
        $this->response->deleteCookie('remember_token');
        
        // Destroy session
        $this->session->destroy();
        
        return redirect()->to('/auth/login')->with('success', 'Anda telah logout.');
    }
    
    // Forgot Password
    public function forgotPassword()
    {
        $data = [
            'title' => 'Lupa Password - Atensi Fitness Center',
            'validation' => \Config\Services::validation()
        ];
        
        return view('auth/forgot_password', $data);
    }
    
    // Process Forgot Password
    public function processForgotPassword()
    {
        $rules = ['email' => 'required|valid_email'];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $email = $this->request->getPost('email');
        $member = $this->memberModel->where('email', $email)->first();
        
        if (!$member) {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }
        
        // Generate reset token (sederhana)
        $token = bin2hex(random_bytes(32));
        $resetLink = base_url('/auth/reset-password/' . $token);
        
        // Simpan token di database (opsional)
        // $this->memberModel->update($member['id'], ['reset_token' => $token]);
        
        // Kirim email (implementasi nyata butuh email server)
        // $this->sendResetEmail($member['email'], $resetLink);
        
        // Untuk testing, tampilkan link
        return redirect()->to('/auth/forgot-password')->with('success', 'Link reset password telah dikirim ke email Anda. <br>Untuk testing: <a href="' . $resetLink . '">' . $resetLink . '</a>');
    }
    
    // Reset Password
    public function resetPassword($token = null)
    {
        $data = [
            'title' => 'Reset Password - Atensi Fitness Center',
            'token' => $token,
            'validation' => \Config\Services::validation()
        ];
        
        return view('auth/reset_password', $data);
    }
    
    // Process Reset Password
    public function processResetPassword()
    {
        $rules = [
            'token' => 'required',
            'password' => 'required|min_length[6]',
            'password_confirmation' => 'required|matches[password]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Cek token (implementasi nyata butuh validasi token di database)
        // $member = $this->memberModel->where('reset_token', $this->request->getPost('token'))->first();
        
        // Untuk testing, langsung redirect
        return redirect()->to('/auth/login')->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
    }
    
    // Helper method untuk paket member
    private function getPaketMember()
    {
        return [
            [
                'kode' => 'har',
                'nama' => 'Harian',
                'harga' => '25.000',
                'periode' => '1 hari'
            ],
            [
                'kode' => 'bln',
                'nama' => 'Bulanan',
                'harga' => '200.000',
                'periode' => '1 bulan'
            ],
            [
                'kode' => 'thn',
                'nama' => 'Tahunan',
                'harga' => '2.000.000',
                'periode' => '1 tahun'
            ],
            [
                'kode' => 'thn2',
                'nama' => 'Tahunan (Berdua)',
                'harga' => '3.000.000',
                'periode' => '1 tahun untuk 2 orang'
            ],
            [
                'kode' => 'plj',
                'nama' => 'Pelajar Bulanan',
                'harga' => '175.000',
                'periode' => '1 bulan (khusus pelajar)'
            ],
            [
                'kode' => 'tw',
                'nama' => 'Tamu Wisma',
                'harga' => '15.000',
                'periode' => '1 kali kunjungan'
            ]
        ];
    }
}