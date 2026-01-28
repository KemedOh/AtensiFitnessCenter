<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'username', 'email', 'password', 'nama_lengkap', 
        'role', 'foto_profil', 'last_login', 'is_active'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[admins.username]',
        'email' => 'required|valid_email|is_unique[admins.email]',
        'password' => 'required|min_length[6]',
        'nama_lengkap' => 'required|min_length[3]|max_length[100]',
        'role' => 'required|in_list[superadmin,admin]'
    ];
    
    protected $validationMessages = [
        'username' => [
            'is_unique' => 'Username sudah digunakan.'
        ],
        'email' => [
            'is_unique' => 'Email sudah terdaftar.'
        ]
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
    
    // Method untuk login admin
    public function attemptLogin($usernameOrEmail, $password)
    {
        // Cari admin by username atau email
        $admin = $this->where('username', $usernameOrEmail)
                      ->orWhere('email', $usernameOrEmail)
                      ->first();
        
        if (!$admin) {
            return false;
        }
        
        // Cek jika admin tidak aktif
        if (!$admin['is_active']) {
            return 'inactive';
        }
        
        // Verifikasi password
        if (password_verify($password, $admin['password'])) {
            // Update last login
            $this->update($admin['id'], ['last_login' => date('Y-m-d H:i:s')]);
            return $admin;
        }
        
        return false;
    }
    
    // Method untuk mendapatkan semua admin (kecuali superadmin tertentu)
    public function getAdmins($excludeSuperadmin = false)
    {
        if ($excludeSuperadmin) {
            return $this->where('role !=', 'superadmin')->findAll();
        }
        return $this->findAll();
    }
    
    // Method untuk mendapatkan admin by role
    public function getByRole($role)
    {
        return $this->where('role', $role)->findAll();
    }
    
    // Method untuk cek jika username/email sudah ada
    public function isUnique($field, $value, $excludeId = null)
    {
        $builder = $this->where($field, $value);
        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }
        return $builder->countAllResults() === 0;
    }
    
    // Method untuk generate data dummy admin
    public function generateDummyAdmins($count = 5)
    {
        $dummyData = [];
        $faker = \Faker\Factory::create('id_ID');
        
        for ($i = 1; $i <= $count; $i++) {
            $dummyData[] = [
                'username' => 'admin' . ($i + 2), // karena sudah ada admin1, admin2
                'email' => 'admin' . ($i + 2) . '@atensifitness.com',
                'password' => 'password', // akan dihash oleh beforeInsert
                'nama_lengkap' => $faker->name(),
                'role' => 'admin',
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        
        return $this->insertBatch($dummyData);
    }
}