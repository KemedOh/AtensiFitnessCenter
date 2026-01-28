<?php

namespace App\Controllers;

use App\Models\MemberModel;

class MemberController extends BaseController
{
    protected $memberModel;
    protected $session;
    
    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->session = session();
        
        // Cek login member
        if (!$this->session->get('member_logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }
    
    // Dashboard Member
    public function dashboard()
    {
        $memberId = $this->session->get('member_id');
        $member = $this->memberModel->find($memberId);
        
        if (!$member) {
            $this->logout();
        }
        
        $data = [
            'title' => 'Dashboard Member - Atensi Fitness Center',
            'member' => $member,
            
            // Member stats (contoh, bisa disesuaikan dengan kebutuhan)
            'attendance_count' => $this->getAttendanceCount($memberId),
            'booking_count' => $this->getBookingCount($memberId),
            'next_payment_date' => $this->getNextPaymentDate($member['mulai_member']),
            'days_remaining' => $this->getDaysRemaining($member['mulai_member'])
        ];
        
        return view('member/dashboard', $data);
    }
    
    // Profile Member
    public function profile()
    {
        $memberId = $this->session->get('member_id');
        $member = $this->memberModel->find($memberId);
        
        $data = [
            'title' => 'Profile Member - Atensi Fitness Center',
            'member' => $member,
            'validation' => \Config\Services::validation()
        ];
        
        return view('member/profile', $data);
    }
    
    // Update Profile
    public function updateProfile()
    {
        $memberId = $this->session->get('member_id');
        $member = $this->memberModel->find($memberId);
        
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'no_hp' => 'required|min_length[10]|max_length[15]',
            'alamat' => 'required|min_length[10]',
            'tanggal_lahir' => 'required|valid_date'
        ];
        
        if ($this->request->getPost('email') && $this->request->getPost('email') !== $member['email']) {
            $rules['email'] = 'valid_email|is_unique[members.email]';
        }
        
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['password_confirmation'] = 'matches[password]';
        }
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'nama' => $this->request->getPost('nama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat' => $this->request->getPost('alamat'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir')
        ];
        
        // Update email jika diisi dan berbeda
        if ($this->request->getPost('email') && $this->request->getPost('email') !== $member['email']) {
            $data['email'] = $this->request->getPost('email');
        }
        
        // Update password jika diisi
        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }
        
        try {
            $this->memberModel->update($memberId, $data);
            
            // Update session
            $this->session->set('member_nama', $data['nama']);
            if (isset($data['email'])) {
                $this->session->set('member_email', $data['email']);
            }
            
            return redirect()->to('/member/profile')->with('success', 'Profile berhasil diperbarui!');
            
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal update profile: ' . $e->getMessage());
        }
    }
    
    // Attendance History
    public function attendance()
    {
        $memberId = $this->session->get('member_id');
        
        $data = [
            'title' => 'Riwayat Presensi - Atensi Fitness Center',
            'attendance_history' => $this->getAttendanceHistory($memberId)
        ];
        
        return view('member/attendance', $data);
    }
    
    // Booking (jika ada fitur booking)
    public function booking()
    {
        $data = [
            'title' => 'Booking - Atensi Fitness Center',
            'available_sessions' => $this->getAvailableSessions(),
            'my_bookings' => $this->getMyBookings($this->session->get('member_id'))
        ];
        
        return view('member/booking', $data);
    }
    
    // Payment History
    public function payment()
    {
        $memberId = $this->session->get('member_id');
        
        $data = [
            'title' => 'Riwayat Pembayaran - Atensi Fitness Center',
            'payment_history' => $this->getPaymentHistory($memberId)
        ];
        
        return view('member/payment', $data);
    }
    
    // Logout Member
    public function logout()
    {
        $sessionItems = [
            'member_id', 'member_kode', 'member_nama', 
            'member_email', 'member_logged_in'
        ];
        
        foreach ($sessionItems as $item) {
            $this->session->remove($item);
        }
        
        return redirect()->to('/auth/login')->with('success', 'Anda telah logout.');
    }
    
    // Helper methods (contoh, bisa disesuaikan)
    private function getAttendanceCount($memberId)
    {
        // Dalam implementasi nyata, query ke table attendance
        return 12; // contoh
    }
    
    private function getBookingCount($memberId)
    {
        // Dalam implementasi nyata, query ke table bookings
        return 3; // contoh
    }
    
    private function getNextPaymentDate($startDate)
    {
        $paketDurasi = [
            'har' => '+1 day',
            'bln' => '+1 month',
            'thn' => '+1 year',
            'thn2' => '+1 year',
            'plj' => '+1 month',
            'tw' => '+1 day'
        ];
        
        $start = new \DateTime($startDate);
        $duration = $paketDurasi['bln'] ?? '+1 month'; // default bulanan
        return $start->modify($duration)->format('d F Y');
    }
    
    private function getDaysRemaining($startDate)
    {
        $paketDurasi = [
            'har' => '1',
            'bln' => '30',
            'thn' => '365',
            'thn2' => '365',
            'plj' => '30',
            'tw' => '1'
        ];
        
        $days = $paketDurasi['bln'] ?? 30;
        $endDate = date('Y-m-d', strtotime($startDate . " + $days days"));
        $today = date('Y-m-d');
        
        $diff = strtotime($endDate) - strtotime($today);
        return max(0, floor($diff / (60 * 60 * 24)));
    }
    
    private function getAttendanceHistory($memberId)
    {
        // Contoh data dummy
        return [
            ['date' => '2024-01-20', 'time_in' => '08:30', 'time_out' => '10:30'],
            ['date' => '2024-01-19', 'time_in' => '09:15', 'time_out' => '11:45'],
            ['date' => '2024-01-18', 'time_in' => '10:00', 'time_out' => '12:00']
        ];
    }
    
    private function getAvailableSessions()
    {
        // Contoh data dummy
        return [
            ['trainer' => 'John Doe', 'time' => '08:00-09:00', 'date' => '2024-01-22'],
            ['trainer' => 'Jane Smith', 'time' => '10:00-11:00', 'date' => '2024-01-22'],
            ['trainer' => 'Mike Johnson', 'time' => '14:00-15:00', 'date' => '2024-01-23']
        ];
    }
    
    private function getMyBookings($memberId)
    {
        // Contoh data dummy
        return [
            ['session' => 'Personal Training', 'trainer' => 'John Doe', 'date' => '2024-01-22', 'status' => 'confirmed'],
            ['session' => 'Yoga Class', 'trainer' => 'Jane Smith', 'date' => '2024-01-23', 'status' => 'pending']
        ];
    }
    
    private function getPaymentHistory($memberId)
    {
        // Contoh data dummy
        return [
            ['date' => '2024-01-01', 'amount' => 'Rp 500,000', 'method' => 'Transfer Bank', 'status' => 'paid'],
            ['date' => '2023-12-01', 'amount' => 'Rp 500,000', 'method' => 'Cash', 'status' => 'paid']
        ];
    }
}