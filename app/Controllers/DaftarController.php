<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\PaketModel; // Jika pakai model paket

class DaftarController extends BaseController
{
    protected $memberModel;
    protected $paketModel;
    protected $adminWhatsApp = "6281290290460"; // Ganti dengan nomor WhatsApp admin
    
    public function __construct()
    {
        $this->memberModel = new MemberModel();
        // $this->paketModel = new PaketModel(); // Jika pakai model paket
    }
    
    public function index()
    {
        $data = [
            'title' => 'Daftar Anggota Baru - Atensi Fitness Center',
            'paket_member' => $this->getPaketMember(), // atau $this->paketModel->findAll() jika pakai model
            'validation' => \Config\Services::validation(),
            'admin_whatsapp' => $this->adminWhatsApp // Tambahkan ini
        ];
        
        return view('daftar/index', $data);
    }
    
    public function proses()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'tanggal_lahir' => 'required|valid_date',
            'no_hp' => 'required|min_length[10]|max_length[15]',
            'alamat' => 'required|min_length[10]',
            'paket_member' => 'required',
            'mulai_member' => 'required|valid_date',

            // VALIDASI FILE CI4
            'foto_identitas' => [
                'rules' => 'uploaded[foto_identitas]'
                    . '|max_size[foto_identitas,2048]'
                    . '|is_image[foto_identitas]'
                    . '|mime_in[foto_identitas,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Harus mengupload foto identitas',
                    'max_size' => 'Ukuran file maksimal 2MB',
                    'is_image' => 'File harus berupa gambar',
                    'mime_in' => 'Format harus JPG, JPEG, atau PNG'
                ]
            ]
        ];

        // Jalankan validasi
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // ======================
        // PROSES UPLOAD FILE
        // ======================
        $file = $this->request->getFile('foto_identitas');

        if (!$file->isValid()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $file->getErrorString());
        }

        if ($file->hasMoved()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'File sudah pernah dipindahkan');
        }

        // Simpan ke public/uploads/identitas
        $uploadPath = FCPATH . 'uploads/identitas/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $fileName = $file->getRandomName();

        if (!$file->move($uploadPath, $fileName)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupload file');
        }

        // ======================
        // SIMPAN DATA KE DB
        // ======================
        $data = [
            'kode_member'    => $this->memberModel->generateKodeMember(),
            'nama'           => $this->request->getPost('nama'),
            'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
            'no_hp'          => $this->request->getPost('no_hp'),
            'alamat'         => $this->request->getPost('alamat'),
            'paket_member'   => $this->request->getPost('paket_member'),
            'mulai_member'   => $this->request->getPost('mulai_member'),
            'foto_identitas' => $fileName,
            'status'         => 'pending',
            'created_at'     => date('Y-m-d H:i:s')
        ];

        try {
            $this->memberModel->save($data);
            $memberId = $this->memberModel->getInsertID();
            
            // Generate WhatsApp message untuk admin
            $whatsappMessage = $this->generateWhatsAppMessage($data);
            
            // Simpan data untuk halaman sukses
            session()->setFlashdata(
                'success',
                'Pendaftaran berhasil! Kode member Anda: ' . $data['kode_member']
            );
            session()->setFlashdata('kode_member', $data['kode_member']);
            session()->setFlashdata('whatsapp_message', $whatsappMessage);
            session()->setFlashdata('whatsapp_url', $this->generateWhatsAppUrl($whatsappMessage));
            session()->setFlashdata('member_data', $data);

            return redirect()->to('/daftar/sukses');

        } catch (\Exception $e) {

            // Hapus file kalau DB gagal
            if (file_exists($uploadPath . $fileName)) {
                unlink($uploadPath . $fileName);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    public function sukses()
    {
        if (!session()->has('success')) {
            return redirect()->to('/daftar');
        }
        
        $data = [
            'title' => 'Pendaftaran Berhasil - Atensi Fitness Center',
            'kode_member' => session()->getFlashdata('kode_member'),
            'whatsapp_url' => session()->getFlashdata('whatsapp_url'),
            'whatsapp_message' => session()->getFlashdata('whatsapp_message'),
            'member_data' => session()->getFlashdata('member_data')
        ];
        
        return view('daftar/sukses', $data);
    }
    
    // Method untuk menampilkan data member (admin)
    public function list()
    {
        $data = [
            'title' => 'Data Member - Atensi Fitness Center',
            'members' => $this->memberModel->findAll()
        ];
        
        return view('admin/member_list', $data);
    }
    
    // Method untuk mendapatkan paket member
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
    
    // ==========================================
    // METHOD BARU UNTUK WHATSAPP NOTIFICATION
    // ==========================================
    
    /**
     * Generate WhatsApp message untuk admin
     */
    private function generateWhatsAppMessage($data)
    {
        // Dapatkan nama paket
        $paketNama = '';
        $paketList = $this->getPaketMember();
        foreach ($paketList as $paket) {
            if ($paket['kode'] === $data['paket_member']) {
                $paketNama = $paket['nama'];
                break;
            }
        }
        
        $message = "🚀 *PENDAFTARAN BARU ATENSI FITNESS CENTER* 🚀\n\n";
        $message .= "📋 *DATA CALON MEMBER*\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "🆔 *Kode Member:* {$data['kode_member']}\n";
        $message .= "👤 *Nama Lengkap:* {$data['nama']}\n";
        $message .= "📱 *No. Handphone:* {$data['no_hp']}\n";
        $message .= "📅 *Tanggal Lahir:* " . date('d/m/Y', strtotime($data['tanggal_lahir'])) . "\n";
        $message .= "📦 *Paket Dipilih:* {$paketNama}\n";
        $message .= "📅 *Mulai Member:* " . date('d/m/Y', strtotime($data['mulai_member'])) . "\n";
        $message .= "📍 *Alamat:* " . (strlen($data['alamat']) > 100 ? substr($data['alamat'], 0, 100) . '...' : $data['alamat']) . "\n\n";
        
        $message .= "📋 *TINDAKAN YANG DIPERLUKAN*\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "1. ✅ *Verifikasi Data*\n";
        $message .= "   • Cek kelengkapan data\n";
        $message .= "   • Pastikan semua field terisi\n\n";
        
        $message .= "2. 📸 *Cek Foto Identitas*\n";
        $message .= "   • File: {$data['foto_identitas']}\n";
        $message .= "   • Lokasi: " . base_url('uploads/identitas/' . $data['foto_identitas']) . "\n";
        $message .= "   • Pastikan foto jelas dan terbaca\n\n";
        
        $message .= "3. 💳 *Proses Pembayaran*\n";
        $message .= "   • Hubungi member via WA\n";
        $message .= "   • Konfirmasi metode pembayaran\n";
        $message .= "   • Verifikasi bukti transfer\n\n";
        
        $message .= "4. 🎯 *Aktivasi Member*\n";
        $message .= "   • Update status menjadi 'active'\n";
        $message .= "   • Buat kartu member fisik\n";
        $message .= "   • Informasikan ke member\n\n";
        
        $message .= "📊 *INFO ADMIN*\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "⏰ *Waktu Pendaftaran:* " . date('d/m/Y H:i:s') . "\n";
        $message .= "🔗 *Login Admin:* " . base_url('admin') . "\n";
        $message .= "📞 *Admin Contact:* " . $this->adminWhatsApp . "\n\n";
        
        $message .= "⚠️ *Segera proses dalam 24 jam kerja!*";
        
        return $message;
    }
    
    /**
     * Generate WhatsApp URL
     */
    private function generateWhatsAppUrl($message)
    {
        $encodedMessage = urlencode($message);
        return "https://wa.me/{$this->adminWhatsApp}?text={$encodedMessage}";
    }
    
    /**
     * API untuk mengirim WhatsApp (jika perlu endpoint khusus)
     */
    public function sendWhatsApp()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }
        
        $memberId = $this->request->getPost('member_id');
        $member = $this->memberModel->find($memberId);
        
        if (!$member) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Member tidak ditemukan'
            ]);
        }
        
        $message = $this->generateWhatsAppMessage($member);
        $whatsappUrl = $this->generateWhatsAppUrl($message);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'WhatsApp URL generated',
            'whatsapp_url' => $whatsappUrl,
            'preview' => $message
        ]);
    }
}