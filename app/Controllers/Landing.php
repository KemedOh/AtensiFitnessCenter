<?php

namespace App\Controllers;

class Landing extends BaseController
{
    public function index()
    {
        $data = [
            'paket_member' => [
                ['nama' => 'Bulanan', 'harga' => '350.000', 'periode' => '/bulan', 'fitur' => ['Akses semua alat gym', 'Konsultasi gratis 1x', 'Group class reguler'], 'populer' => false],
                ['nama' => '3 Bulan', 'harga' => '900.000', 'periode' => '/3 bulan', 'fitur' => ['Akses semua alat gym', 'Konsultasi gratis 2x', 'Group class reguler', 'Free locker'], 'populer' => true],
                ['nama' => '6 Bulan', 'harga' => '1.650.000', 'periode' => '/6 bulan', 'fitur' => ['Akses semua alat gym', 'Konsultasi gratis 4x', 'Semua group class', 'Free locker', '1x body analysis'], 'populer' => false],
                ['nama' => 'Tahunan', 'harga' => '3.000.000', 'periode' => '/tahun', 'fitur' => ['Akses semua alat gym', 'Konsultasi gratis 12x', 'Semua group class', 'Free locker permanen', '4x body analysis', 'Guest pass 2x'], 'populer' => false]
            ],
            'testimoni' => [
                ['nama' => 'Rizky Pratama', 'role' => 'Member 2 tahun', 'hasil' => 'Turun 15kg, lebih percaya diri', 'kutipan' => 'Trainer di Atensi sangat perhatian dan alatnya lengkap.', 'gambar' => 'avatar1'],
                ['nama' => 'Sarah Wijaya', 'role' => 'Member 1 tahun', 'hasil' => 'Bentuk tubuh ideal, lebih sehat', 'kutipan' => 'Suasana gym sangat nyaman dan komunitasnya supportive.', 'gambar' => 'avatar2'],
                ['nama' => 'Budi Santoso', 'role' => 'Member 6 bulan', 'hasil' => 'Naik 5kg muscle mass', 'kutipan' => 'Programnya terstruktur dan trainer profesional.', 'gambar' => 'avatar3']
            ],
            'fasilitas' => [
                ['icon' => '💪', 'judul' => 'Alat Gym Modern', 'deskripsi' => 'Equipment terbaru dari brand ternama'],
                ['icon' => '👨‍🏫', 'judul' => 'Personal Trainer', 'deskripsi' => 'Trainer bersertifikat'],
                ['icon' => '✨', 'judul' => 'Ruang Bersih', 'deskripsi' => 'Lingkungan higienis'],
                ['icon' => '🚿', 'judul' => 'Locker & Shower', 'deskripsi' => 'Fasilitas locker pribadi'],
                ['icon' => '📈', 'judul' => 'Program Variatif', 'deskripsi' => 'Dari pemula hingga advanced'],
                ['icon' => '👥', 'judul' => 'Komunitas', 'deskripsi' => 'Dukungan untuk konsistensi']
            ],
            'keunggulan' => [
                ['icon' => '✅', 'judul' => 'Cocok untuk Pemula', 'deskripsi' => 'Program khusus pemula'],
                ['icon' => '🏆', 'judul' => 'Trainer Ramah', 'deskripsi' => 'Tim berpengalaman'],
                ['icon' => '💰', 'judul' => 'Harga Terjangkau', 'deskripsi' => 'Paket fleksibel'],
                ['icon' => '❤️', 'judul' => 'Lingkungan Positif', 'deskripsi' => 'Fokus pada progress']
            ]
        ];

        return view('landing/index', $data);
    }
}