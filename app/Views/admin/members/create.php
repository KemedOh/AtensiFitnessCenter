<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<style>
.form-container {
    background: rgba(30, 41, 59, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.75rem;
}

.form-label {
    color: #9ca3af;
    font-weight: 500;
    margin-bottom: 0.5rem;
    display: block;
}

.form-input {
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.5rem;
    color: white;
    padding: 0.75rem 1rem;
    width: 100%;
    transition: all 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2);
}

.form-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
}

.error-message {
    color: #f87171;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.step-indicator {
    display: flex;
    justify-content: space-between;
    margin-bottom: 2rem;
    position: relative;
}

.step-indicator::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 2px;
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-50%);
    z-index: 1;
}

.step {
    position: relative;
    z-index: 2;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 9999px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    background: rgba(30, 41, 59, 0.8);
    border: 2px solid rgba(255, 255, 255, 0.1);
}

.step.active {
    background: #dc2626;
    border-color: #dc2626;
    color: white;
}

.step.completed {
    background: #16a34a;
    border-color: #16a34a;
    color: white;
}

.step-label {
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    margin-top: 0.5rem;
    font-size: 0.75rem;
    color: #9ca3af;
    white-space: nowrap;
}

.form-section {
    display: none;
}

.form-section.active {
    display: block;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-gradient-to-b from-dark to-dark-light">
    <!-- Admin Navigation -->
    <nav class="glass-effect sticky top-0 z-50 border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <a href="<?= base_url('/admin/dashboard') ?>" class="flex items-center space-x-2">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-lg flex items-center justify-center">
                            <i class="fas fa-dumbbell text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-white">Admin<span class="text-primary">Panel</span></h1>
                            <p class="text-xs text-gray-400">Atensi Fitness Center</p>
                        </div>
                    </a>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <a href="<?= base_url('/admin/dashboard') ?>" class="text-gray-300 hover:text-white">
                        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                    </a>
                    <a href="<?= base_url('/admin/auth/logout') ?>" class="text-red-400 hover:text-red-300">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                </div>
            </div>

            <!-- Secondary Navigation -->
            <div class="flex space-x-6 pb-4 overflow-x-auto">
                <a href="<?= base_url('/admin/dashboard') ?>"
                    class="flex items-center px-3 py-2 text-sm font-medium <?= current_url() == base_url('/admin/dashboard') ? 'text-gray-300' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="<?= base_url('/admin/members') ?>"
                    class="flex items-center px-3 py-2 text-sm font-medium <?= strpos(current_url(), '/admin/members') !== false ? 'text-primary border-b-2 border-primary' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fas fa-users mr-2"></i> Member
                </a>
                <a href="<?= base_url('/admin/members/create') ?>"
                    class="flex items-center px-3 py-2 text-sm font-medium <?= current_url() == base_url('/admin/members/create') ? 'text-primary border-b-2 border-primary' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Member
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="<?= base_url('/admin/dashboard') ?>"
                            class="inline-flex items-center text-sm text-gray-400 hover:text-white">
                            <i class="fas fa-home mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-600 mx-2"></i>
                            <a href="<?= base_url('/admin/members') ?>"
                                class="text-sm text-gray-400 hover:text-white">Member</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-600 mx-2"></i>
                            <span class="text-sm text-white">Tambah Member Baru</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Tambah Member Baru</h1>
                <p class="text-gray-400">Isi formulir untuk menambahkan member baru ke sistem</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-3">
                <a href="<?= base_url('/admin/members') ?>"
                    class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if(session()->getFlashdata('success')): ?>
        <div class="mb-6 p-4 bg-green-900/30 border border-green-700/50 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-300"><?= session()->getFlashdata('success') ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
        <div class="mb-6 p-4 bg-red-900/30 border border-red-700/50 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-300"><?= session()->getFlashdata('error') ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Multi-step Form -->
        <div class="form-container p-6 mb-6">
            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step active" id="step1">
                    <span>1</span>
                    <div class="step-label">Data Pribadi</div>
                </div>
                <div class="step" id="step2">
                    <span>2</span>
                    <div class="step-label">Paket & Status</div>
                </div>
                <div class="step" id="step3">
                    <span>3</span>
                    <div class="step-label">Konfirmasi</div>
                </div>
            </div>

            <form action="<?= base_url('/admin/members/store') ?>" method="POST" id="memberForm"
                enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Step 1: Personal Data -->
                <div class="form-section active" id="section1">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-user-circle mr-3 text-primary"></i> Data Pribadi Member
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kode Member (Auto-generated) -->
                        <div>
                            <label class="form-label">Kode Member <span class="text-red-500">*</span></label>
                            <input type="text" name="kode_member" value="<?= $model->generateKodeMember() ?>"
                                class="form-input bg-gray-800 cursor-not-allowed" readonly>
                            <p class="text-sm text-gray-400 mt-1">Kode member otomatis di-generate</p>
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="<?= old('nama') ?>"
                                class="form-input <?= session()->getFlashdata('errors.nama') ? 'border-red-500' : '' ?>"
                                placeholder="Masukkan nama lengkap" required>
                            <?php if(session()->getFlashdata('errors.nama')): ?>
                            <p class="error-message"><?= session()->getFlashdata('errors.nama') ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="<?= old('email') ?>"
                                class="form-input <?= session()->getFlashdata('errors.email') ? 'border-red-500' : '' ?>"
                                placeholder="email@example.com">
                            <?php if(session()->getFlashdata('errors.email')): ?>
                            <p class="error-message"><?= session()->getFlashdata('errors.email') ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- No. HP -->
                        <div>
                            <label class="form-label">No. Handphone <span class="text-red-500">*</span></label>
                            <input type="tel" name="no_hp" value="<?= old('no_hp') ?>"
                                class="form-input <?= session()->getFlashdata('errors.no_hp') ? 'border-red-500' : '' ?>"
                                placeholder="0812-3456-7890" required>
                            <?php if(session()->getFlashdata('errors.no_hp')): ?>
                            <p class="error-message"><?= session()->getFlashdata('errors.no_hp') ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label class="form-label">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" value="<?= old('tanggal_lahir') ?>"
                                class="form-input <?= session()->getFlashdata('errors.tanggal_lahir') ? 'border-red-500' : '' ?>"
                                required>
                            <?php if(session()->getFlashdata('errors.tanggal_lahir')): ?>
                            <p class="error-message"><?= session()->getFlashdata('errors.tanggal_lahir') ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-input form-select">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki-laki
                                </option>
                                <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan
                                </option>
                            </select>
                        </div>

                        <!-- Alamat -->
                        <div class="md:col-span-2">
                            <label class="form-label">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="alamat" rows="3"
                                class="form-input <?= session()->getFlashdata('errors.alamat') ? 'border-red-500' : '' ?>"
                                placeholder="Masukkan alamat lengkap" required><?= old('alamat') ?></textarea>
                            <?php if(session()->getFlashdata('errors.alamat')): ?>
                            <p class="error-message"><?= session()->getFlashdata('errors.alamat') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8">
                        <div></div> <!-- Empty div for spacing -->
                        <button type="button" onclick="nextStep(2)"
                            class="bg-gradient-to-r from-primary to-secondary hover:from-primary-dark hover:to-secondary-dark text-white font-medium px-8 py-3 rounded-lg transition-colors">
                            Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Package & Status -->
                <div class="form-section" id="section2">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-dumbbell mr-3 text-secondary"></i> Paket Membership & Status
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Paket Membership -->
                        <div>
                            <label class="form-label">Paket Membership <span class="text-red-500">*</span></label>
                            <select name="paket_member"
                                class="form-input form-select <?= session()->getFlashdata('errors.paket_member') ? 'border-red-500' : '' ?>"
                                required>
                                <option value="">Pilih Paket</option>
                                <option value="har" <?= old('paket_member') == 'har' ? 'selected' : '' ?>>Harian
                                </option>
                                <option value="bln" <?= old('paket_member') == 'bln' ? 'selected' : '' ?>>Bulanan
                                </option>
                                <option value="thn" <?= old('paket_member') == 'thn' ? 'selected' : '' ?>>Tahunan
                                </option>
                                <option value="thn2" <?= old('paket_member') == 'thn2' ? 'selected' : '' ?>>Tahunan
                                    (Berdua)</option>
                                <option value="plj" <?= old('paket_member') == 'plj' ? 'selected' : '' ?>>Pelajar
                                    Bulanan</option>
                                <option value="tw" <?= old('paket_member') == 'tw' ? 'selected' : '' ?>>Tamu Wisma
                                </option>
                            </select>
                            <?php if(session()->getFlashdata('errors.paket_member')): ?>
                            <p class="error-message"><?= session()->getFlashdata('errors.paket_member') ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Mulai Membership -->
                        <div>
                            <label class="form-label">Mulai Membership <span class="text-red-500">*</span></label>
                            <input type="date" name="mulai_member" value="<?= old('mulai_member', date('Y-m-d')) ?>"
                                class="form-input <?= session()->getFlashdata('errors.mulai_member') ? 'border-red-500' : '' ?>"
                                required>
                            <?php if(session()->getFlashdata('errors.mulai_member')): ?>
                            <p class="error-message"><?= session()->getFlashdata('errors.mulai_member') ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="form-label">Status <span class="text-red-500">*</span></label>
                            <select name="status" class="form-input form-select" required>
                                <option value="pending" <?= old('status') == 'pending' ? 'selected' : 'selected' ?>>
                                    Pending</option>
                                <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Aktif</option>
                                <option value="expired" <?= old('status') == 'expired' ? 'selected' : '' ?>>Expired
                                </option>
                                <option value="cancelled" <?= old('status') == 'cancelled' ? 'selected' : '' ?>>
                                    Dibatalkan</option>
                            </select>
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="form-label">Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    class="form-input <?= session()->getFlashdata('errors.password') ? 'border-red-500' : '' ?>"
                                    placeholder="Kosongkan untuk auto-generate">
                                <button type="button" onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white">
                                    <i class="fas fa-eye" id="passwordToggle"></i>
                                </button>
                            </div>
                            <p class="text-sm text-gray-400 mt-1">Kosongkan untuk generate password otomatis</p>
                            <?php if(session()->getFlashdata('errors.password')): ?>
                            <p class="error-message"><?= session()->getFlashdata('errors.password') ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Foto Identitas -->
                        <div class="md:col-span-2">
                            <label class="form-label">Foto Identitas (KTP/SIM)</label>
                            <div class="mt-1 flex items-center">
                                <label for="foto_identitas" class="cursor-pointer">
                                    <div
                                        class="border-2 border-dashed border-gray-700 rounded-lg p-6 text-center hover:border-primary transition-colors">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-400">Klik untuk upload foto identitas</p>
                                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Max: 2MB)</p>
                                    </div>
                                    <input type="file" name="foto_identitas" id="foto_identitas" class="hidden"
                                        accept="image/*" onchange="previewImage(event)">
                                </label>
                            </div>
                            <div id="imagePreview" class="mt-4 hidden">
                                <p class="text-sm text-gray-400 mb-2">Preview:</p>
                                <img id="preview" class="max-w-xs rounded-lg border border-gray-700">
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8">
                        <button type="button" onclick="prevStep(1)"
                            class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-8 py-3 rounded-lg transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                        </button>
                        <button type="button" onclick="nextStep(3)"
                            class="bg-gradient-to-r from-primary to-secondary hover:from-primary-dark hover:to-secondary-dark text-white font-medium px-8 py-3 rounded-lg transition-colors">
                            Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Confirmation -->
                <div class="form-section" id="section3">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-check-circle mr-3 text-green-500"></i> Konfirmasi Data
                    </h3>

                    <div class="bg-gray-900/50 rounded-lg p-6 mb-6">
                        <h4 class="text-lg font-bold text-white mb-4">Review Data Member</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Data yang akan ditampilkan dari form -->
                            <div class="text-sm">
                                <span class="text-gray-400">Kode Member:</span>
                                <span class="text-white ml-2" id="reviewKodeMember"></span>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-400">Nama:</span>
                                <span class="text-white ml-2" id="reviewNama"></span>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-400">Email:</span>
                                <span class="text-white ml-2" id="reviewEmail"></span>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-400">No. HP:</span>
                                <span class="text-white ml-2" id="reviewNoHp"></span>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-400">Tanggal Lahir:</span>
                                <span class="text-white ml-2" id="reviewTanggalLahir"></span>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-400">Alamat:</span>
                                <span class="text-white ml-2" id="reviewAlamat"></span>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-400">Paket:</span>
                                <span class="text-white ml-2" id="reviewPaket"></span>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-400">Mulai Member:</span>
                                <span class="text-white ml-2" id="reviewMulaiMember"></span>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-400">Status:</span>
                                <span class="text-white ml-2" id="reviewStatus"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="mb-6">
                        <div class="flex items-start">
                            <input type="checkbox" id="terms" name="terms" required class="mt-1 mr-3">
                            <label for="terms" class="text-sm text-gray-300">
                                Saya menyatakan bahwa data yang diisi adalah benar dan valid. Member setuju dengan
                                <a href="#" class="text-primary hover:text-primary-light">syarat dan ketentuan</a>
                                yang berlaku di Atensi Fitness Center.
                            </label>
                        </div>
                        <?php if(session()->getFlashdata('errors.terms')): ?>
                        <p class="error-message mt-2"><?= session()->getFlashdata('errors.terms') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8">
                        <button type="button" onclick="prevStep(2)"
                            class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-8 py-3 rounded-lg transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                        </button>
                        <button type="submit"
                            class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-medium px-8 py-3 rounded-lg transition-colors">
                            <i class="fas fa-save mr-2"></i> Simpan Member
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Help Text -->
        <div class="bg-blue-900/20 border border-blue-700/30 rounded-lg p-4">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-blue-400 mr-3"></i>
                <div>
                    <p class="text-sm text-blue-300">
                        <strong>Tips:</strong> Pastikan data yang dimasukkan valid. Member akan menerima email
                        konfirmasi
                        dengan detail login jika email diisi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Multi-step form navigation
let currentStep = 1;

function nextStep(step) {
    // Validate current step before proceeding
    if (!validateStep(currentStep)) {
        return;
    }

    // Hide current section
    document.getElementById(`section${currentStep}`).classList.remove('active');
    document.getElementById(`step${currentStep}`).classList.remove('active');

    // Show next section
    document.getElementById(`section${step}`).classList.add('active');
    document.getElementById(`step${step}`).classList.add('active');
    document.getElementById(`step${step}`).classList.add('completed');

    currentStep = step;

    // Update review data on step 3
    if (step === 3) {
        updateReviewData();
    }
}

function prevStep(step) {
    // Hide current section
    document.getElementById(`section${currentStep}`).classList.remove('active');
    document.getElementById(`step${currentStep}`).classList.remove('active');
    document.getElementById(`step${currentStep}`).classList.remove('completed');

    // Show previous section
    document.getElementById(`section${step}`).classList.add('active');
    document.getElementById(`step${step}`).classList.add('active');

    currentStep = step;
}

function validateStep(step) {
    let isValid = true;

    if (step === 1) {
        const requiredFields = ['nama', 'no_hp', 'tanggal_lahir', 'alamat'];
        requiredFields.forEach(field => {
            const input = document.querySelector(`[name="${field}"]`);
            if (!input.value.trim()) {
                input.classList.add('border-red-500');
                isValid = false;
            } else {
                input.classList.remove('border-red-500');
            }
        });

        // Email validation if provided
        const emailInput = document.querySelector('[name="email"]');
        if (emailInput.value.trim() && !isValidEmail(emailInput.value)) {
            emailInput.classList.add('border-red-500');
            isValid = false;
        } else {
            emailInput.classList.remove('border-red-500');
        }
    }

    if (step === 2) {
        const requiredFields = ['paket_member', 'mulai_member'];
        requiredFields.forEach(field => {
            const input = document.querySelector(`[name="${field}"]`);
            if (!input.value.trim()) {
                input.classList.add('border-red-500');
                isValid = false;
            } else {
                input.classList.remove('border-red-500');
            }
        });
    }

    if (!isValid) {
        showNotification('Harap lengkapi semua field yang wajib diisi', 'warning');
    }

    return isValid;
}

function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Password toggle
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('passwordToggle');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Image preview
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// Update review data
function updateReviewData() {
    // Map package values to labels
    const packageMap = {
        'har': 'Harian',
        'bln': 'Bulanan',
        'thn': 'Tahunan',
        'thn2': 'Tahunan (Berdua)',
        'plj': 'Pelajar Bulanan',
        'tw': 'Tamu Wisma'
    };

    // Map status values to labels
    const statusMap = {
        'pending': 'Pending',
        'active': 'Aktif',
        'expired': 'Expired',
        'cancelled': 'Dibatalkan'
    };

    // Get form values
    const form = document.getElementById('memberForm');
    const formData = new FormData(form);

    // Update review elements
    document.getElementById('reviewKodeMember').textContent = formData.get('kode_member') || '-';
    document.getElementById('reviewNama').textContent = formData.get('nama') || '-';
    document.getElementById('reviewEmail').textContent = formData.get('email') || '-';
    document.getElementById('reviewNoHp').textContent = formData.get('no_hp') || '-';
    document.getElementById('reviewTanggalLahir').textContent = formatDate(formData.get('tanggal_lahir')) || '-';
    document.getElementById('reviewAlamat').textContent = formData.get('alamat') || '-';
    document.getElementById('reviewPaket').textContent = packageMap[formData.get('paket_member')] || '-';
    document.getElementById('reviewMulaiMember').textContent = formatDate(formData.get('mulai_member')) || '-';
    document.getElementById('reviewStatus').textContent = statusMap[formData.get('status')] || '-';
}

function formatDate(dateString) {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
}

// Notification system
function showNotification(message, type = 'success') {
    // Remove existing notifications
    document.querySelectorAll('.custom-notification').forEach(n => n.remove());

    // Create notification
    const notification = document.createElement('div');
    notification.className = `custom-notification fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-xl ${
        type === 'success' ? 'bg-green-900/90 border border-green-700 text-green-300' :
        type === 'error' ? 'bg-red-900/90 border border-red-700 text-red-300' :
        type === 'warning' ? 'bg-yellow-900/90 border border-yellow-700 text-yellow-300' :
        'bg-blue-900/90 border border-blue-700 text-blue-300'
    }`;

    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'exclamation-triangle'} mr-3"></i>
            <span class="font-medium">${message}</span>
        </div>
    `;

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

// Auto-format phone number
document.querySelector('[name="no_hp"]').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 0) {
        value = value.match(/.{1,4}/g).join('-');
    }
    e.target.value = value;
});

// Add CSS for notification
const style = document.createElement('style');
style.textContent = `
.custom-notification {
    backdrop-filter: blur(10px);
    animation: slideIn 0.3s ease-out;
    min-width: 300px;
    max-width: 400px;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.form-section {
    animation-duration: 0.3s;
}
`;
document.head.appendChild(style);

// Initialize form
document.addEventListener('DOMContentLoaded', function() {
    console.log('Create member form loaded');
    // Set today as default for mulai_member if not set
    const mulaiMemberInput = document.querySelector('[name="mulai_member"]');
    if (!mulaiMemberInput.value) {
        mulaiMemberInput.value = new Date().toISOString().split('T')[0];
    }
});
</script>
<?= $this->endSection() ?>