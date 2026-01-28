<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\MemberModel;

class AdminController extends BaseController
{
    protected $adminModel;
    protected $memberModel;
    protected $session;
    
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->memberModel = new MemberModel();
        $this->session = session();
        
        // Cek login admin
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to('/admin/auth/login');
        }
    }
    
    // Dashboard Admin
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard Admin - Atensi Fitness Center',
            'page' => 'dashboard',
            'is_superadmin' => $this->session->get('is_superadmin'),
            
            // Statistics
            'total_members' => $this->memberModel->countAll(),
            'pending_members' => $this->memberModel->where('status', 'pending')->countAllResults(),
            'active_members' => $this->memberModel->where('status', 'active')->countAllResults(),
            'total_admins' => $this->adminModel->countAll(),
            
            // Recent members
            'recent_members' => $this->memberModel->orderBy('created_at', 'DESC')->limit(10)->find(),
            
            // Recent admins (jika superadmin)
            'recent_admins' => $this->session->get('is_superadmin') ? 
                $this->adminModel->orderBy('created_at', 'DESC')->limit(5)->find() : []
        ];
        
        return view('admin/dashboard', $data);
    }
    
    // Manage Members
    public function members()
    {
        $status = $this->request->getGet('status');
        
        $builder = $this->memberModel;
        if ($status && in_array($status, ['pending', 'active', 'expired', 'cancelled'])) {
            $builder->where('status', $status);
        }
        
        $data = [
            'title' => 'Data Member - Atensi Fitness Center',
            'page' => 'members',
            'is_superadmin' => $this->session->get('is_superadmin'),
            'members' => $builder->orderBy('created_at', 'DESC')->findAll(),
            'current_status' => $status,
            'total_pending' => $this->memberModel->where('status', 'pending')->countAllResults(),
            'total_active' => $this->memberModel->where('status', 'active')->countAllResults()
        ];
        
        return view('admin/members/index', $data);
    }
    
    // View Member Detail
    public function viewMember($id)
    {
        $member = $this->memberModel->find($id);
        
        if (!$member) {
            return redirect()->to('/admin/members')->with('error', 'Member tidak ditemukan.');
        }
        
        $data = [
            'title' => 'Detail Member - Atensi Fitness Center',
            'page' => 'members',
            'is_superadmin' => $this->session->get('is_superadmin'),
            'member' => $member
        ];
        
        return view('admin/members/view', $data);
    }
    
    // Update Member Status
// Update Member Status
public function updateMemberStatus($id)
{
    // Check if it's AJAX request
    if (!$this->request->isAJAX()) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Invalid request method.'
        ]);
    }
    
    $member = $this->memberModel->find($id);
    
    if (!$member) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Member tidak ditemukan.'
        ]);
    }
    
    $status = $this->request->getPost('status');
    $validStatuses = ['pending', 'active', 'expired', 'cancelled'];
    
    if (!in_array($status, $validStatuses)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Status tidak valid.'
        ]);
    }
    
    try {
        $this->memberModel->update($id, ['status' => $status]);
        
        // Log activity
        log_message('info', "Admin {$this->session->get('admin_id')} update status member {$member['kode_member']} to {$status}");
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Status member berhasil diupdate.',
            'new_status' => $status,
            'status_label' => ucfirst($status)
        ]);
        
    } catch (\Exception $e) {
        log_message('error', 'Failed to update member status: ' . $e->getMessage());
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal update status: ' . $e->getMessage()
        ]);
    }
}
    
    // Manage Admins (hanya untuk superadmin)
    public function manageAdmins()
    {
        if (!$this->session->get('is_superadmin')) {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak. Hanya untuk superadmin.');
        }
        
        $data = [
            'title' => 'Kelola Admin - Atensi Fitness Center',
            'page' => 'admins',
            'is_superadmin' => true,
            'admins' => $this->adminModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/admins/index', $data);
    }
    
    // Create New Admin (hanya untuk superadmin)
    public function createAdmin()
    {
        if (!$this->session->get('is_superadmin')) {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak. Hanya untuk superadmin.');
        }
        
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[admins.username]',
            'email' => 'required|valid_email|is_unique[admins.email]',
            'password' => 'required|min_length[6]',
            'password_confirmation' => 'required|matches[password]',
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'role' => 'required|in_list[superadmin,admin]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role' => $this->request->getPost('role'),
            'is_active' => true
        ];
        
        try {
            $this->adminModel->save($data);
            
            // Log activity
            $this->logActivity(
                $this->session->get('admin_id'),
                'Membuat admin baru: ' . $data['username']
            );
            
            return redirect()->to('/admin/manage-admins')->with('success', 'Admin berhasil dibuat!');
            
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal membuat admin: ' . $e->getMessage());
        }
    }
    
    // Update Admin Status
    public function updateAdminStatus($id)
    {
        if (!$this->session->get('is_superadmin')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Akses ditolak.'
            ]);
        }
        
        $admin = $this->adminModel->find($id);
        
        if (!$admin) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Admin tidak ditemukan.'
            ]);
        }
        
        // Jangan izinkan non-aktifkan diri sendiri
        if ($admin['id'] == $this->session->get('admin_id')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak bisa menonaktifkan akun sendiri.'
            ]);
        }
        
        $isActive = $this->request->getPost('is_active') === 'true';
        
        try {
            $this->adminModel->update($id, ['is_active' => $isActive]);
            
            // Log activity
            $action = $isActive ? 'mengaktifkan' : 'menonaktifkan';
            $this->logActivity(
                $this->session->get('admin_id'),
                $action . ' admin: ' . $admin['username']
            );
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status admin berhasil diupdate.',
                'is_active' => $isActive
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal update status: ' . $e->getMessage()
            ]);
        }
    }
    
    // Delete Admin (hanya untuk superadmin)
    public function deleteAdmin($id)
    {
        if (!$this->session->get('is_superadmin')) {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }
        
        $admin = $this->adminModel->find($id);
        
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin tidak ditemukan.');
        }
        
        // Jangan izinkan menghapus diri sendiri
        if ($admin['id'] == $this->session->get('admin_id')) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }
        
        // Jangan izinkan menghapus superadmin lain
        if ($admin['role'] === 'superadmin') {
            return redirect()->back()->with('error', 'Tidak bisa menghapus superadmin.');
        }
        
        try {
            $this->adminModel->delete($id);
            
            // Log activity
            $this->logActivity(
                $this->session->get('admin_id'),
                'Menghapus admin: ' . $admin['username']
            );
            
            return redirect()->to('/admin/manage-admins')->with('success', 'Admin berhasil dihapus!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus admin: ' . $e->getMessage());
        }
    }
    
    // Reports
    public function reports()
    {
        $data = [
            'title' => 'Laporan - Atensi Fitness Center',
            'page' => 'reports',
            'is_superadmin' => $this->session->get('is_superadmin'),
            
            // Report data
            'members_by_status' => [
                'pending' => $this->memberModel->where('status', 'pending')->countAllResults(),
                'active' => $this->memberModel->where('status', 'active')->countAllResults(),
                'expired' => $this->memberModel->where('status', 'expired')->countAllResults(),
                'cancelled' => $this->memberModel->where('status', 'cancelled')->countAllResults()
            ],
            
            'members_by_package' => $this->getMembersByPackage(),
            'registration_trend' => $this->getRegistrationTrend(),
            'recent_activities' => $this->getRecentActivities()
        ];
        
        return view('admin/reports', $data);
    }
    
    // Settings (hanya untuk superadmin)
    public function settings()
    {
        if (!$this->session->get('is_superadmin')) {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak. Hanya untuk superadmin.');
        }
        
        $data = [
            'title' => 'Pengaturan Sistem - Atensi Fitness Center',
            'page' => 'settings',
            'is_superadmin' => true,
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/settings', $data);
    }
    
    // Profile Admin
    public function profile()
    {
        $adminId = $this->session->get('admin_id');
        $admin = $this->adminModel->find($adminId);
        
        $data = [
            'title' => 'Profile Admin - Atensi Fitness Center',
            'page' => 'profile',
            'is_superadmin' => $this->session->get('is_superadmin'),
            'admin' => $admin,
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/profile', $data);
    }
    
    // Update Admin Profile
    public function updateProfile()
    {
        $adminId = $this->session->get('admin_id');
        $admin = $this->adminModel->find($adminId);
        
        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'email' => "required|valid_email|is_unique[admins.email,id,$adminId]"
        ];
        
        // Jika password diubah
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['password_confirmation'] = 'matches[password]';
        }
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email')
        ];
        
        // Update password jika diisi
        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }
        
        try {
            $this->adminModel->update($adminId, $data);
            
            // Update session
            $this->session->set('admin_email', $data['email']);
            $this->session->set('admin_nama', $data['nama_lengkap']);
            
            // Log activity
            $this->logActivity($adminId, 'Update profile admin');
            
            return redirect()->to('/admin/profile')->with('success', 'Profile berhasil diupdate.');
            
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal update profile: ' . $e->getMessage());
        }
    }
    
    // Helper methods for reports
    private function getMembersByPackage()
    {
        $packages = [
            'har' => 'Harian',
            'bln' => 'Bulanan', 
            'thn' => 'Tahunan',
            'thn2' => 'Tahunan (Berdua)',
            'plj' => 'Pelajar Bulanan',
            'tw' => 'Tamu Wisma'
        ];
        
        $result = [];
        foreach ($packages as $code => $name) {
            $result[$name] = $this->memberModel->where('paket_member', $code)->countAllResults();
        }
        
        return $result;
    }
    
    private function getRegistrationTrend()
    {
        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $trend[$date] = $this->memberModel->where('DATE(created_at)', $date)->countAllResults();
        }
        
        return $trend;
    }
    
    private function getRecentActivities()
    {
        // Dalam implementasi nyata, ambil dari table activity_log
        return [
            ['admin' => 'Super Admin', 'activity' => 'Login ke sistem', 'time' => '10 menit lalu'],
            ['admin' => 'Admin Satu', 'activity' => 'Mengaktifkan member ATF202401001', 'time' => '1 jam lalu'],
            ['admin' => 'Admin Dua', 'activity' => 'Menerima pembayaran member baru', 'time' => '2 jam lalu'],
            ['admin' => 'Super Admin', 'activity' => 'Membuat admin baru', 'time' => '3 jam lalu']
        ];
    }
    
    private function logActivity($adminId, $activity)
    {
        // Simpan ke log
        log_message('info', "[ADMIN-$adminId] $activity");
    }
    // Show create form
public function create()
{
    $model = new MemberModel();
    
    $data = [
        'title' => 'Tambah Member Baru - Atensi Fitness Center',
        'page' => 'members',
        'is_superadmin' => $this->session->get('is_superadmin'),
        'model' => $model,
        'validation' => \Config\Services::validation()
    ];
    
    return view('admin/members/create', $data);
}

// Store new member
public function store()
{
    $model = new MemberModel();
    
    // Validation rules
    $rules = [
        'kode_member' => 'required|is_unique[members.kode_member]',
        'nama' => 'required|min_length[3]|max_length[100]',
        'tanggal_lahir' => 'required|valid_date',
        'no_hp' => 'required|min_length[10]|max_length[15]',
        'alamat' => 'required|min_length[10]',
        'paket_member' => 'required',
        'mulai_member' => 'required|valid_date',
        'email' => 'permit_empty|valid_email|is_unique[members.email]',
        'password' => 'permit_empty|min_length[6]',
        'status' => 'required|in_list[pending,active,expired,cancelled]',
        'terms' => 'required'
    ];
    
    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
    
    // Generate password if empty
    $password = $this->request->getPost('password');
    if (empty($password)) {
        $password = bin2hex(random_bytes(4)); // Generate random 8-character password
    }
    
    // Prepare data
    $data = [
        'kode_member' => $this->request->getPost('kode_member'),
        'nama' => $this->request->getPost('nama'),
        'email' => $this->request->getPost('email'),
        'no_hp' => $this->request->getPost('no_hp'),
        'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
        'alamat' => $this->request->getPost('alamat'),
        'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        'paket_member' => $this->request->getPost('paket_member'),
        'mulai_member' => $this->request->getPost('mulai_member'),
        'status' => $this->request->getPost('status'),
        'password' => $password
    ];
    
    // Handle file upload
    $fotoIdentitas = $this->request->getFile('foto_identitas');
    if ($fotoIdentitas && $fotoIdentitas->isValid() && !$fotoIdentitas->hasMoved()) {
        $newName = $fotoIdentitas->getRandomName();
        $fotoIdentitas->move(WRITEPATH . 'uploads/identitas', $newName);
        $data['foto_identitas'] = $newName;
    }
    
    try {
        $model->save($data);
        
        // Log activity
        $this->logActivity(
            $this->session->get('admin_id'),
            'Membuat member baru: ' . $data['kode_member']
        );
        
        return redirect()->to('/admin/members')->with('success', 'Member baru berhasil ditambahkan!');
        
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan member: ' . $e->getMessage());
    }
}

// Show edit form
public function edit($id)
{
    $model = new MemberModel();
    $member = $model->find($id);
    
    if (!$member) {
        return redirect()->to('/admin/members')->with('error', 'Member tidak ditemukan.');
    }
    
    $data = [
        'title' => 'Edit Member - Atensi Fitness Center',
        'page' => 'members',
        'is_superadmin' => $this->session->get('is_superadmin'),
        'member' => $member,
        'validation' => \Config\Services::validation()
    ];
    
    return view('admin/members/edit', $data);
}

// Update member
public function update($id)
{
    $model = new MemberModel();
    $member = $model->find($id);
    
    if (!$member) {
        return redirect()->to('/admin/members')->with('error', 'Member tidak ditemukan.');
    }
    
    // Validation rules
    $rules = [
        'nama' => 'required|min_length[3]|max_length[100]',
        'tanggal_lahir' => 'required|valid_date',
        'no_hp' => 'required|min_length[10]|max_length[15]',
        'alamat' => 'required|min_length[10]',
        'paket_member' => 'required',
        'mulai_member' => 'required|valid_date',
        'email' => "permit_empty|valid_email|is_unique[members.email,id,{$id}]",
        'password' => 'permit_empty|min_length[6]',
        'status' => 'required|in_list[pending,active,expired,cancelled]'
    ];
    
    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
    
    // Prepare data
    $data = [
        'nama' => $this->request->getPost('nama'),
        'email' => $this->request->getPost('email'),
        'no_hp' => $this->request->getPost('no_hp'),
        'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
        'alamat' => $this->request->getPost('alamat'),
        'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        'paket_member' => $this->request->getPost('paket_member'),
        'mulai_member' => $this->request->getPost('mulai_member'),
        'status' => $this->request->getPost('status')
    ];
    
    // Update password if provided
    if ($this->request->getPost('password')) {
        $data['password'] = $this->request->getPost('password');
    }
    
    try {
        $model->update($id, $data);
        
        // Log activity
        $this->logActivity(
            $this->session->get('admin_id'),
            'Mengupdate member: ' . $member['kode_member']
        );
        
        return redirect()->to('/admin/members/view/' . $id)->with('success', 'Data member berhasil diupdate!');
        
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Gagal update member: ' . $e->getMessage());
    }
}
}