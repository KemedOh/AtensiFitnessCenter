<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="min-h-screen py-20 px-4 bg-gradient-to-b from-dark to-dark-light">
    <div class="container mx-auto max-w-2xl text-center">
        <!-- Success Icon -->
        <div class="mb-8">
            <div
                class="w-32 h-32 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-white text-5xl"></i>
            </div>
        </div>

        <!-- Success Message -->
        <h1 class="text-4xl md:text-5xl font-bold mb-6">
            Pendaftaran <span class="gradient-text">Berhasil!</span>
        </h1>

        <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mb-8"></div>

        <div class="glass-effect rounded-2xl p-8 mb-8">
            <div class="mb-6">
                <i class="fas fa-user-check text-4xl text-primary mb-4"></i>
                <h2 class="text-2xl font-bold mb-4">Data Anda Telah Tersimpan</h2>
                <p class="text-gray-300 mb-6">
                    Terima kasih telah mendaftar di Atensi Fitness Center. Data Anda telah masuk ke sistem kami.
                </p>

                <!-- Member Code -->
                <div class="bg-gray-900/50 rounded-xl p-6 mb-6">
                    <h3 class="font-bold text-lg mb-3 flex items-center justify-center">
                        <i class="fas fa-id-card text-primary mr-2"></i>
                        Kode Member Anda
                    </h3>
                    <div class="text-3xl font-bold text-white font-mono bg-gray-800 py-3 px-6 rounded-lg inline-block">
                        <?= $kode_member ?>
                    </div>
                    <p class="text-sm text-gray-400 mt-3">
                        Simpan kode ini untuk keperluan administrasi dan login
                    </p>
                </div>

                <!-- WhatsApp Notification -->
                <div class="bg-green-900/20 border border-green-700/50 rounded-xl p-6 mb-6">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-12 h-12 bg-green-500/20 rounded-full flex items-center justify-center mr-3">
                            <i class="fab fa-whatsapp text-green-500 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold">Notifikasi ke Admin</h3>
                    </div>

                    <p class="text-gray-300 mb-4">
                        Admin telah menerima notifikasi pendaftaran Anda via WhatsApp.
                        Mereka akan segera menghubungi Anda untuk:
                    </p>

                    <ul class="text-left space-y-2 mb-6">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-accent mr-2 mt-1"></i>
                            <span>Verifikasi data dan foto identitas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-accent mr-2 mt-1"></i>
                            <span>Konfirmasi pembayaran</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-accent mr-2 mt-1"></i>
                            <span>Aktivasi keanggotaan</span>
                        </li>
                    </ul>

                    <!-- WhatsApp Button -->
                    <a href="<?= $whatsapp_url ?>" target="_blank"
                        class="inline-flex items-center justify-center w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-[1.02]">
                        <i class="fab fa-whatsapp text-xl mr-3"></i>
                        <span>Lihat Notifikasi ke Admin</span>
                    </a>

                    <p class="text-sm text-gray-400 mt-3">
                        Klik tombol di atas untuk melihat pesan yang dikirim ke admin
                    </p>
                </div>

                <!-- Next Steps -->
                <div class="bg-gray-900/50 rounded-xl p-6">
                    <h3 class="font-bold text-lg mb-4 flex items-center">
                        <i class="fas fa-list-check text-secondary mr-2"></i>
                        Proses Selanjutnya
                    </h3>
                    <ul class="space-y-3 text-left">
                        <li class="flex items-start">
                            <div class="w-6 h-6 bg-primary rounded-full flex items-center justify-center mr-3 mt-1">
                                <span class="text-white text-xs font-bold">1</span>
                            </div>
                            <div>
                                <span class="font-medium">Tunggu Telepon/WhatsApp dari Admin</span>
                                <p class="text-sm text-gray-400">Dalam 1x24 jam kerja</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="w-6 h-6 bg-secondary rounded-full flex items-center justify-center mr-3 mt-1">
                                <span class="text-white text-xs font-bold">2</span>
                            </div>
                            <div>
                                <span class="font-medium">Konfirmasi Pembayaran</span>
                                <p class="text-sm text-gray-400">Transfer sesuai paket yang dipilih</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="w-6 h-6 bg-accent rounded-full flex items-center justify-center mr-3 mt-1">
                                <span class="text-white text-xs font-bold">3</span>
                            </div>
                            <div>
                                <span class="font-medium">Ambil Kartu Member</span>
                                <p class="text-sm text-gray-400">Datang ke gym dengan membawa KTP asli</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="text-sm text-gray-400 border-t border-gray-800 pt-6">
                <p class="mb-2">
                    <i class="fas fa-clock mr-2"></i>
                    Proses verifikasi: Senin - Jumat, 09:00 - 17:00
                </p>
                <p>
                    <i class="fas fa-phone-alt mr-2"></i>
                    Butuh bantuan cepat? Hubungi: (021) 1234-5678
                </p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?= base_url('/') ?>"
                class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg transition-colors">
                <i class="fas fa-home mr-2"></i> Kembali ke Beranda
            </a>
            <a href="https://wa.me/<?= substr($admin_whatsapp ?? '6281290290460', 1) ?>" target="_blank"
                class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 px-8 rounded-lg transition-colors">
                <i class="fab fa-whatsapp mr-2"></i> Chat Admin Langsung
            </a>
        </div>
    </div>
</section>

<!-- WhatsApp Message Preview Modal -->
<div id="messageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-dark-light rounded-2xl max-w-2xl w-full p-6 border border-primary/30">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="fab fa-whatsapp text-green-500 mr-2"></i>
                Pesan ke Admin
            </h3>
            <button onclick="closeMessageModal()" class="text-gray-400 hover:text-white">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="bg-gray-900 p-4 rounded-lg mb-6">
            <div class="whitespace-pre-line text-gray-300 text-sm font-mono">
                <?= nl2br(htmlspecialchars($whatsapp_message ?? '')) ?>
            </div>
        </div>

        <div class="flex justify-end">
            <button onclick="closeMessageModal()"
                class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
function showMessageModal() {
    document.getElementById('messageModal').classList.remove('hidden');
}

function closeMessageModal() {
    document.getElementById('messageModal').classList.add('hidden');
}

// Close modal on background click
document.getElementById('messageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeMessageModal();
    }
});

// Press ESC to close
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeMessageModal();
    }
});
</script>
<?= $this->endSection() ?>