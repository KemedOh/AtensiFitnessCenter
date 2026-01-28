<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<style>
.form-container {
    background: linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.95) 100%);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.input-field {
    transition: all 0.3s ease;
}

.input-field:focus {
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2);
}

.price-badge {
    background: linear-gradient(90deg, #dc2626, #f97316);
    color: white;
}

.upload-area {
    border: 2px dashed rgba(220, 38, 38, 0.3);
    transition: all 0.3s ease;
}

.upload-area:hover {
    border-color: #dc2626;
    background-color: rgba(220, 38, 38, 0.05);
}

.upload-area.dragover {
    border-color: #84cc16;
    background-color: rgba(132, 204, 22, 0.1);
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="min-h-screen py-12 px-4 bg-gradient-to-b from-dark to-dark-light">
    <div class="container mx-auto max-w-4xl">
        <!-- Header -->
        <div class="text-center mb-12">
            <a href="<?= base_url('/') ?>"
                class="inline-flex items-center space-x-2 text-primary hover:text-primary-light transition-colors mb-6">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Beranda</span>
            </a>

            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Daftar <span class="gradient-text">Anggota Baru</span>
            </h1>
            <?php
$admin_whatsapp = "6281290290460"; // Ganti dengan nomor WhatsApp admin
?>
            <div class="w-32 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mb-6"></div>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Bergabunglah dengan Atensi Fitness Center dan mulailah perjalanan fitness Anda hari ini!
            </p>
        </div>

        <!-- Form Container -->
        <div class="form-container rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-2 bg-gradient-to-r from-primary to-secondary"></div>

            <div class="p-8">
                <!-- Success/Error Messages -->
                <?php if(session()->getFlashdata('success')): ?>
                <div class="mb-6 p-4 bg-green-900/50 border border-green-700 text-green-300 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('errors')): ?>
                <div class="mb-6 p-4 bg-red-900/50 border border-red-700 text-red-300 rounded-lg">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.
                </div>
                <?php endif; ?>

                <form action="<?= base_url('daftar/proses') ?>" method="POST" enctype="multipart/form-data"
                    class="space-y-8">
                    <?= csrf_field() ?>
                    <div class="hidden">
                        <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
                    </div>
                    <!-- Section 1: Data Pribadi -->
                    <div>
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold">1</span>
                            </div>
                            Data Pribadi
                        </h2>

                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Nama -->
                            <div>
                                <label for="nama" class="block text-gray-300 mb-2 font-medium">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="nama" name="nama" value="<?= old('nama') ?>"
                                    class="w-full input-field bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary"
                                    placeholder="Masukkan nama lengkap" required>
                                <?php if(isset(session()->getFlashdata('errors')['nama'])): ?>
                                <p class="text-red-400 text-sm mt-1"><?= session()->getFlashdata('errors')['nama'] ?>
                                </p>
                                <?php endif; ?>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label for="tanggal_lahir" class="block text-gray-300 mb-2 font-medium">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                    value="<?= old('tanggal_lahir') ?>"
                                    class="w-full input-field bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary"
                                    required>
                                <?php if(isset(session()->getFlashdata('errors')['tanggal_lahir'])): ?>
                                <p class="text-red-400 text-sm mt-1">
                                    <?= session()->getFlashdata('errors')['tanggal_lahir'] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Kontak & Alamat -->
                    <div>
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold">2</span>
                            </div>
                            Kontak & Alamat
                        </h2>

                        <div class="space-y-6">
                            <!-- No. HP -->
                            <div>
                                <label for="no_hp" class="block text-gray-300 mb-2 font-medium">
                                    No. Handphone/WhatsApp <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="no_hp" name="no_hp" value="<?= old('no_hp') ?>"
                                    class="w-full input-field bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary"
                                    placeholder="Contoh: 081234567890" required>
                                <?php if(isset(session()->getFlashdata('errors')['no_hp'])): ?>
                                <p class="text-red-400 text-sm mt-1"><?= session()->getFlashdata('errors')['no_hp'] ?>
                                </p>
                                <?php endif; ?>
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label for="alamat" class="block text-gray-300 mb-2 font-medium">
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>
                                <textarea id="alamat" name="alamat" rows="3"
                                    class="w-full input-field bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary resize-none"
                                    placeholder="Masukkan alamat lengkap" required><?= old('alamat') ?></textarea>
                                <?php if(isset(session()->getFlashdata('errors')['alamat'])): ?>
                                <p class="text-red-400 text-sm mt-1"><?= session()->getFlashdata('errors')['alamat'] ?>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Paket Member -->
                    <div>
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold">3</span>
                            </div>
                            Pilih Paket Member
                        </h2>

                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php foreach($paket_member as $paket): ?>
                            <div class="relative">
                                <input type="radio" id="paket_<?= $paket['kode'] ?>" name="paket_member"
                                    value="<?= $paket['kode'] ?>" class="hidden peer"
                                    <?= old('paket_member') == $paket['kode'] ? 'checked' : '' ?> required>
                                <label for="paket_<?= $paket['kode'] ?>"
                                    class="block cursor-pointer bg-gray-900 border-2 border-gray-800 rounded-xl p-5 hover:border-primary transition-all duration-300 peer-checked:border-primary peer-checked:bg-primary/10">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="font-bold text-lg"><?= $paket['nama'] ?></h3>
                                        <div class="price-badge text-xs font-bold py-1 px-3 rounded-full">
                                            Rp<?= $paket['harga'] ?>
                                        </div>
                                    </div>
                                    <p class="text-gray-400 text-sm mb-2"><?= $paket['periode'] ?></p>
                                    <div class="flex items-center text-sm text-gray-300">
                                        <i class="fas fa-check-circle text-accent mr-2"></i>
                                        <span>Akses semua fasilitas</span>
                                    </div>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <?php if(isset(session()->getFlashdata('errors')['paket_member'])): ?>
                        <p class="text-red-400 text-sm mt-2"><?= session()->getFlashdata('errors')['paket_member'] ?>
                        </p>
                        <?php endif; ?>

                        <!-- Mulai Member -->
                        <div class="mt-8">
                            <label for="mulai_member" class="block text-gray-300 mb-2 font-medium">
                                Mulai Member Tanggal <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="mulai_member" name="mulai_member"
                                value="<?= old('mulai_member', date('Y-m-d')) ?>" min="<?= date('Y-m-d') ?>"
                                class="w-full md:w-auto input-field bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary"
                                required>
                            <p class="text-gray-400 text-sm mt-2">Tanggal mulai keanggotaan Anda</p>
                            <?php if(isset(session()->getFlashdata('errors')['mulai_member'])): ?>
                            <p class="text-red-400 text-sm mt-1">
                                <?= session()->getFlashdata('errors')['mulai_member'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Section 4: Upload Identitas -->
                    <!-- ===================== SECTION 4: UPLOAD IDENTITAS ===================== -->
                    <div>
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold">4</span>
                            </div>
                            Upload Identitas
                        </h2>

                        <!-- INPUT FILE TIDAK BOLEH DI DALAM innerHTML -->
                        <input type="file" id="foto_identitas" name="foto_identitas" class="hidden"
                            accept="image/jpeg,image/jpg,image/png" required onchange="handleFileSelect(this)">

                        <div class="upload-area rounded-xl p-8 text-center" id="upload-area">

                            <div id="upload-placeholder">
                                <i class="fas fa-cloud-upload-alt text-5xl text-gray-600 mb-4"></i>
                                <h3 class="text-xl font-bold mb-2">Upload Foto Identitas</h3>
                                <p class="text-gray-400 mb-4">
                                    KTP atau Kartu Pelajar (Maks. 2MB)<br>
                                    Format: JPG, JPEG, PNG
                                </p>
                                <p class="text-sm text-red-400">*</p>

                                <button type="button" onclick="document.getElementById('foto_identitas').click()"
                                    class="bg-primary text-white font-bold py-3 px-6 rounded-lg mt-4">
                                    <i class="fas fa-upload mr-2"></i> Pilih File
                                </button>
                            </div>

                            <div id="preview-area" class="hidden"></div>

                            <?php if(isset(session()->getFlashdata('errors')['foto_identitas'])): ?>
                            <p class="text-red-400 text-sm mt-2">
                                <?= session()->getFlashdata('errors')['foto_identitas'] ?>
                            </p>
                            <?php endif; ?>

                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-primary to-secondary text-white font-bold py-4 rounded-lg">
                        <i class="fas fa-paper-plane mr-2"></i> Daftar Sekarang
                    </button>

                </form>
            </div>
        </div>
    </div>
    <!-- WhatsApp Confirmation Modal -->
    <div id="waModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-gradient-to-b from-dark to-dark-light rounded-2xl max-w-md w-full p-6 border border-primary/30">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-whatsapp text-green-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Kirim Notifikasi ke Admin?</h3>
                <p class="text-gray-400 text-sm">
                    Data Anda akan disimpan dan notifikasi akan dikirim ke admin via WhatsApp untuk verifikasi.
                </p>
            </div>

            <div class="space-y-4 mb-6">
                <div class="bg-gray-900/50 p-4 rounded-lg">
                    <p class="text-sm text-gray-400 mb-2">Admin akan menerima pesan:</p>
                    <div class="text-sm text-gray-300 bg-gray-800 p-3 rounded">
                        <div id="waMessagePreview"></div>
                    </div>
                </div>

                <div class="flex items-center text-sm text-gray-400">
                    <i class="fas fa-info-circle text-primary mr-2"></i>
                    <span>Admin akan menghubungi Anda untuk konfirmasi pembayaran</span>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeWaModal()"
                    class="flex-1 bg-gray-800 hover:bg-gray-700 text-white py-3 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="button" onclick="sendWhatsAppNotification()"
                    class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg transition-colors">
                    <i class="fab fa-whatsapp mr-2"></i> Kirim WA
                </button>
            </div>
        </div>
    </div>

    <script>
    // WhatsApp number
    const adminWhatsApp = "<?= $admin_whatsapp ?>";

    // Modal functions
    function showWaModal() {
        // Generate WA message preview
        const nama = document.getElementById('nama').value;
        const noHp = document.getElementById('no_hp').value;
        const paket = document.querySelector('input[name="paket_member"]:checked')?.nextElementSibling?.querySelector(
            'h3')?.textContent || 'Belum dipilih';

        const message = `🚀 *PENDAFTARAN BARU ATENSI FITNESS* 🚀

👤 *Nama:* ${nama}
📱 *No. HP:* ${noHp}
📦 *Paket:* ${paket}
🕒 *Waktu:* ${new Date().toLocaleString('id-ID')}

📋 *Data telah masuk sistem. Silakan verifikasi di admin panel.*`;

        document.getElementById('waMessagePreview').textContent = message;
        document.getElementById('waModal').classList.remove('hidden');
    }

    function closeWaModal() {
        document.getElementById('waModal').classList.add('hidden');
    }

    function sendWhatsAppNotification() {
        // Get form data
        const formData = new FormData(document.querySelector('form'));
        const data = Object.fromEntries(formData.entries());

        // Prepare WA message
        let message = `🚀 *PENDAFTARAN BARU ATENSI FITNESS* 🚀\n\n`;
        message += `👤 *Nama:* ${data.nama}\n`;
        message += `📧 *No. HP:* ${data.no_hp}\n`;
        message += `📅 *Tanggal Lahir:* ${data.tanggal_lahir}\n`;
        message +=
            `📦 *Paket:* ${document.querySelector(`input[name="paket_member"][value="${data.paket_member}"]`)?.nextElementSibling?.querySelector('h3')?.textContent || data.paket_member}\n`;
        message += `📅 *Mulai Member:* ${data.mulai_member}\n`;
        message += `🏠 *Alamat:* ${data.alamat.substring(0, 100)}${data.alamat.length > 100 ? '...' : ''}\n\n`;
        message += `🕒 *Waktu Pendaftaran:* ${new Date().toLocaleString('id-ID')}\n\n`;
        message += `📋 *Data telah masuk ke sistem. Silakan lakukan:*\n`;
        message += `1. Verifikasi data di admin panel\n`;
        message += `2. Cek foto identitas\n`;
        message += `3. Konfirmasi pembayaran ke member`;

        // Encode message for WA URL
        const encodedMessage = encodeURIComponent(message);
        const waUrl = `https://wa.me/${adminWhatsApp}?text=${encodedMessage}`;

        // Open WhatsApp
        window.open(waUrl, '_blank');

        // Close modal and submit form
        closeWaModal();
        document.querySelector('form').submit();
    }

    // Modify form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        showWaModal();
    });

    // Close modal on background click
    document.getElementById('waModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeWaModal();
        }
    });
    </script>
</section>

<script>
function handleFileSelect(input) {
    const file = input.files[0];
    if (!file) return;

    const maxSize = 2 * 1024 * 1024;
    const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];

    if (file.size > maxSize) {
        alert('File terlalu besar! Maksimal 2MB.');
        input.value = '';
        return;
    }

    if (!validTypes.includes(file.type)) {
        alert('Format file tidak didukung!');
        input.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('upload-placeholder').classList.add('hidden');
        const preview = document.getElementById('preview-area');

        preview.innerHTML = `
            <img src="${e.target.result}" class="max-h-48 mx-auto rounded-lg mb-4">
            <p class="text-sm text-gray-300">${file.name}</p>
            <p class="text-xs text-gray-400">${(file.size/1024/1024).toFixed(2)} MB</p>
            <div class="flex justify-center gap-4 mt-4">
                <button type="button"
                    onclick="document.getElementById('foto_identitas').click()"
                    class="text-primary">
                    Ganti Foto
                </button>
                <button type="button"
                    onclick="removeFile()"
                    class="text-red-400">
                    Hapus
                </button>
            </div>
        `;
        preview.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}

function removeFile() {
    document.getElementById('foto_identitas').value = '';
    document.getElementById('preview-area').classList.add('hidden');
    document.getElementById('upload-placeholder').classList.remove('hidden');
}

// Set minimum date for mulai_member to today
document.getElementById('mulai_member').min = new Date().toISOString().split('T')[0];

// Calculate age from tanggal_lahir
document.getElementById('tanggal_lahir').addEventListener('change', function() {
    const birthDate = new Date(this.value);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    // Show age info
    const ageInfo = document.getElementById('age-info') || (() => {
        const div = document.createElement('div');
        div.id = 'age-info';
        div.className = 'text-sm mt-1';
        this.parentNode.appendChild(div);
        return div;
    })();

    if (age < 17) {
        ageInfo.innerHTML =
            `<span class="text-yellow-400"><i class="fas fa-exclamation-triangle mr-1"></i>Usia: ${age} tahun (Di bawah 17 tahun memerlukan persetujuan orang tua)</span>`;
    } else {
        ageInfo.innerHTML = `<span class="text-green-400">Usia: ${age} tahun</span>`;
    }
});
</script>
<?= $this->endSection() ?>