<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'kode_member', 'nama', 'tanggal_lahir', 'no_hp', 'alamat', 
        'paket_member', 'mulai_member', 'foto_identitas', 'status',
        'email', 'password', 'last_login', 'login_attempts', 'is_locked', 'lock_until'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    protected $validationRules = [
        'kode_member' => 'required|is_unique[members.kode_member]',
        'nama' => 'required|min_length[3]|max_length[100]',
        'tanggal_lahir' => 'required|valid_date',
        'no_hp' => 'required|min_length[10]|max_length[15]',
        'alamat' => 'required|min_length[10]',
        'paket_member' => 'required',
        'mulai_member' => 'required|valid_date',
        'email' => 'permit_empty|valid_email|is_unique[members.email]',
        'password' => 'permit_empty|min_length[6]',
        'status' => 'required|in_list[pending,active,expired,cancelled]'
    ];
    
    protected $validationMessages = [
        'kode_member' => ['is_unique' => 'Kode member sudah digunakan.'],
        'email' => [
            'valid_email' => 'Email tidak valid.',
            'is_unique' => 'Email sudah terdaftar.'
        ],
        'password' => ['min_length' => 'Password minimal 6 karakter.']
    ];
    
    protected $skipValidation = false;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    
    // Hash password sebelum insert/update
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['data']['password']);
        }
        return $data;
    }
    
    // Method untuk generate kode member
    public function generateKodeMember()
    {
        $prefix = 'ATF';
        $year = date('Y');
        $month = date('m');
        $random = rand(1000, 9999);
        
        return $prefix . $year . $month . $random;
    }
    
    // Method untuk login
    public function attemptLogin($emailOrKode, $password)
    {
        // Cari member by email atau kode member
        $member = $this->where('email', $emailOrKode)
                      ->orWhere('kode_member', $emailOrKode)
                      ->first();
        
        if (!$member) {
            return false;
        }
        
        // Cek jika akun terkunci
        if ($member['is_locked'] && $member['lock_until'] > date('Y-m-d H:i:s')) {
            return 'locked';
        }
        
        // Verifikasi password
        if (password_verify($password, $member['password'])) {
            // Reset login attempts
            $this->update($member['id'], [
                'login_attempts' => 0,
                'is_locked' => false,
                'lock_until' => null,
                'last_login' => date('Y-m-d H:i:s')
            ]);
            
            return $member;
        } else {
            // Increment login attempts
            $attempts = $member['login_attempts'] + 1;
            $updateData = ['login_attempts' => $attempts];
            
            // Lock account after 5 failed attempts for 30 minutes
            if ($attempts >= 5) {
                $updateData['is_locked'] = true;
                $updateData['lock_until'] = date('Y-m-d H:i:s', strtotime('+30 minutes'));
            }
            
            $this->update($member['id'], $updateData);
            
            return false;
        }
    }
    
    // Method untuk mendapatkan data member
    public function getMembers($status = null)
    {
        if ($status) {
            return $this->where('status', $status)->findAll();
        }
        return $this->findAll();
    }
    
    // Method untuk cek jika member aktif
    public function isActive($memberId)
    {
        $member = $this->find($memberId);
        return $member && $member['status'] === 'active';
    }
}