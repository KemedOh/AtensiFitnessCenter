<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<style>
/* Dashboard Styles */
.dashboard-content {
    min-height: calc(100vh - 80px);
}

.stat-card {
    transition: all 0.3s ease;
    background: rgba(30, 41, 59, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(220, 38, 38, 0.2);
    border-color: rgba(220, 38, 38, 0.3);
}

.glass-effect {
    background: rgba(15, 23, 42, 0.7);
    backdrop-filter: blur(10px);
}

.badge-status {
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-pending {
    background: rgba(234, 179, 8, 0.2);
    color: #fde047;
}

.badge-active {
    background: rgba(34, 197, 94, 0.2);
    color: #86efac;
}

.badge-expired {
    background: rgba(239, 68, 68, 0.2);
    color: #fca5a5;
}

.badge-cancelled {
    background: rgba(107, 114, 128, 0.2);
    color: #d1d5db;
}

/* Form Container with Dashboard Style */
.form-container {
    background: linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.95) 100%);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 1rem;
    transition: all 0.3s ease;
}

.form-container:hover {
    border-color: rgba(220, 38, 38, 0.2);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

/* Input Fields - Match Dashboard */
.input-field {
    transition: all 0.3s ease;
    background: rgba(15, 23, 42, 0.8) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    color: white !important;
}

.input-field:focus {
    outline: none;
    border-color: #dc2626 !important;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2) !important;
    background: rgba(15, 23, 42, 0.9) !important;
}

/* Price Badge - Match Dashboard Colors */
.price-badge {
    background: linear-gradient(90deg, #dc2626, #991b1b);
    color: white;
    border: none;
}

/* Upload Area */
.upload-area {
    border: 2px dashed rgba(220, 38, 38, 0.3);
    transition: all 0.3s ease;
    background: rgba(15, 23, 42, 0.5);
}

.upload-area:hover {
    border-color: #dc2626;
    background-color: rgba(220, 38, 38, 0.05);
}

/* Radio Card Styling */
.paket-radio:checked+label {
    background: rgba(220, 38, 38, 0.1) !important;
    border-color: #dc2626 !important;
    box-shadow: 0 0 20px rgba(220, 38, 38, 0.2);
}

/* Button Styles - Match Dashboard */
.btn-primary {
    background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
    border: 1px solid rgba(220, 38, 38, 0.3);
    color: white;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%);
    box-shadow: 0 5px 20px rgba(220, 38, 38, 0.4);
    transform: translateY(-2px);
    border-color: rgba(220, 38, 38, 0.5);
}

.btn-secondary {
    background: rgba(30, 41, 59, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #e5e7eb;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: rgba(30, 41, 59, 1);
    border-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

.btn-danger {
    background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
    border: 1px solid rgba(220, 38, 38, 0.3);
    color: white;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-danger:hover {
    background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%);
    box-shadow: 0 5px 20px rgba(220, 38, 38, 0.4);
    transform: translateY(-2px);
}

/* Alert Styles like Dashboard */
.alert-success {
    background: rgba(21, 128, 61, 0.2);
    border: 1px solid rgba(34, 197, 94, 0.3);
    backdrop-filter: blur(10px);
    border-radius: 0.5rem;
}

.alert-error {
    background: rgba(185, 28, 28, 0.2);
    border: 1px solid rgba(248, 113, 113, 0.3);
    backdrop-filter: blur(10px);
    border-radius: 0.5rem;
}

/* Section Headers */
.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.section-number {
    width: 2rem;
    height: 2rem;
    border-radius: 9999px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
    font-weight: bold;
    color: white;
    flex-shrink: 0;
}

/* Form Labels */
.form-label {
    color: #cbd5e1;
    font-weight: 500;
    margin-bottom: 0.5rem;
    display: block;
}

/* Error Messages */
.error-text {
    color: #f87171;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* Member Info Card */
.member-info-card {
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.75rem;
    padding: 1.5rem;
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    color: #94a3b8;
    font-weight: 500;
}

.info-value {
    color: white;
    font-weight: 600;
}

/* Current Photo Preview */
.current-photo-container {
    text-align: center;
    padding: 1.5rem;
    background: rgba(15, 23, 42, 0.5);
    border-radius: 0.75rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.current-photo {
    max-width: 200px;
    max-height: 200px;
    border-radius: 0.5rem;
    border: 2px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 1rem;
}

/* Form Select */
.form-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}

/* Status Badge in Form */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 600;
}

/* Action Buttons Container */
.action-buttons {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

/* Readonly fields */
.readonly-field {
    background: rgba(30, 41, 59, 0.5) !important;
    color: #94a3b8 !important;
    cursor: not-allowed;
    border-color: rgba(255, 255, 255, 0.05) !important;
}

/* Password field actions */
.password-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.5rem;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-gradient-to-b from-slate-900 to-slate-800 py-8 px-4">
    <div class="container mx-auto max-w-6xl">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="<?= base_url('/admin/dashboard') ?>"
                            class="inline-flex items-center text-sm text-slate-400 hover:text-white transition-colors">
                            <i class="fas fa-home mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-slate-600 mx-2 text-xs"></i>
                            <a href="<?= base_url('/admin/members') ?>"
                                class="text-sm text-slate-400 hover:text-white transition-colors">Member</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-slate-600 mx-2 text-xs"></i>
                            <span class="text-sm text-white font-medium">Edit Member:
                                <?= $member['kode_member'] ?? '' ?></span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Edit Data Member</h1>
                <p class="text-slate-400">Ubah data member <?= $member['nama'] ?? '' ?></p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-3">
                <a href="<?= base_url('/admin/members/view/' . ($member['id'] ?? '')) ?>"
                    class="btn-secondary px-6 py-3 rounded-lg transition-all duration-300">
                    <i class="fas fa-eye mr-2"></i> Lihat Detail
                </a>
                <a href="<?= base_url('/admin/members') ?>"
                    class="btn-secondary px-6 py-3 rounded-lg transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if(session()->getFlashdata('success')): ?>
        <div class="alert-success p-4 mb-6">
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
        <div class="alert-error p-4 mb-6">
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Member Info -->
            <div class="lg:col-span-1">
                <!-- Member Info Card -->
                <div class="member-info-card mb-6">
                    <h3 class="text-lg font-bold text-white mb-4">Informasi Member</h3>

                    <div class="info-row">
                        <span class="info-label">Kode Member:</span>
                        <span class="info-value"><?= $member['kode_member'] ?? '-' ?></span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Tanggal Daftar:</span>
                        <span class="info-value"><?= date('d/m/Y', strtotime($member['created_at'] ?? '')) ?></span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Terakhir Update:</span>
                        <span class="info-value"><?= date('d/m/Y H:i', strtotime($member['updated_at'] ?? '')) ?></span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Status Saat Ini:</span>
                        <span class="status-badge <?= 
                            ($member['status'] ?? '') == 'active' ? 'badge-active' : 
                            (($member['status'] ?? '') == 'pending' ? 'badge-pending' : 
                            (($member['status'] ?? '') == 'expired' ? 'badge-expired' : 'badge-cancelled'))
                        ?>">
                            <?= ucfirst($member['status'] ?? 'pending') ?>
                        </span>
                    </div>
                </div>

                <!-- Current Photo -->
                <?php if(!empty($member['foto_identitas'])): ?>
                <div class="current-photo-container">
                    <h3 class="text-lg font-bold text-white mb-4">Foto Identitas Saat Ini</h3>
                    <img src="<?= base_url('uploads/identitas/' . $member['foto_identitas']) ?>" alt="Foto Identitas"
                        class="current-photo mx-auto"
                        onerror="this.src='<?= base_url('assets/images/default-identitas.jpg') ?>'">
                    <p class="text-sm text-slate-400 mt-2">
                        <?= $member['foto_identitas'] ?><br>
                        <a href="<?= base_url('uploads/identitas/' . $member['foto_identitas']) ?>" target="_blank"
                            class="text-red-400 hover:text-red-300 transition-colors">
                            <i class="fas fa-external-link-alt mr-1"></i> Lihat Full Size
                        </a>
                    </p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right Column: Edit Form -->
            <div class="lg:col-span-2">
                <div class="form-container rounded-xl">
                    <!-- Top Gradient Border -->
                    <div class="h-1 bg-gradient-to-r from-red-600 to-red-800"></div>

                    <div class="p-8">
                        <form action="<?= base_url('/admin/members/update/' . ($member['id'] ?? '')) ?>" method="POST"
                            enctype="multipart/form-data" id="editMemberForm">
                            <?= csrf_field() ?>

                            <input type="hidden" name="_method" value="PUT">

                            <!-- Section 1: Personal Data -->
                            <div class="mb-8">
                                <div class="section-header">
                                    <div class="section-number bg-red-600">1</div>
                                    <h2 class="text-xl font-bold text-white">Data Pribadi</h2>
                                </div>

                                <div class="grid md:grid-cols-2 gap-6">
                                    <!-- Kode Member (Readonly) -->
                                    <div>
                                        <label for="kode_member" class="form-label">
                                            Kode Member
                                        </label>
                                        <input type="text" id="kode_member" name="kode_member"
                                            value="<?= old('kode_member', $member['kode_member'] ?? '') ?>"
                                            class="w-full input-field readonly-field rounded-lg py-3 px-4" readonly>
                                    </div>

                                    <!-- Nama Lengkap -->
                                    <div>
                                        <label for="nama" class="form-label">
                                            Nama Lengkap <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="nama" name="nama"
                                            value="<?= old('nama', $member['nama'] ?? '') ?>"
                                            class="w-full input-field rounded-lg py-3 px-4 focus:outline-none"
                                            placeholder="Masukkan nama lengkap" required>
                                        <?php if(isset(session()->getFlashdata('errors')['nama'])): ?>
                                        <p class="error-text"><?= session()->getFlashdata('errors')['nama'] ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="form-label">
                                            Email
                                        </label>
                                        <input type="email" id="email" name="email"
                                            value="<?= old('email', $member['email'] ?? '') ?>"
                                            class="w-full input-field rounded-lg py-3 px-4 focus:outline-none"
                                            placeholder="email@example.com">
                                        <?php if(isset(session()->getFlashdata('errors')['email'])): ?>
                                        <p class="error-text"><?= session()->getFlashdata('errors')['email'] ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <!-- No. HP -->
                                    <div>
                                        <label for="no_hp" class="form-label">
                                            No. Handphone <span class="text-red-500">*</span>
                                        </label>
                                        <input type="tel" id="no_hp" name="no_hp"
                                            value="<?= old('no_hp', $member['no_hp'] ?? '') ?>"
                                            class="w-full input-field rounded-lg py-3 px-4 focus:outline-none"
                                            placeholder="081234567890" required>
                                        <?php if(isset(session()->getFlashdata('errors')['no_hp'])): ?>
                                        <p class="error-text"><?= session()->getFlashdata('errors')['no_hp'] ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Tanggal Lahir -->
                                    <div>
                                        <label for="tanggal_lahir" class="form-label">
                                            Tanggal Lahir <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                            value="<?= old('tanggal_lahir', $member['tanggal_lahir'] ?? '') ?>"
                                            class="w-full input-field rounded-lg py-3 px-4 focus:outline-none" required>
                                        <?php if(isset(session()->getFlashdata('errors')['tanggal_lahir'])): ?>
                                        <p class="error-text"><?= session()->getFlashdata('errors')['tanggal_lahir'] ?>
                                        </p>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div>
                                        <label for="jenis_kelamin" class="form-label">
                                            Jenis Kelamin
                                        </label>
                                        <select id="jenis_kelamin" name="jenis_kelamin"
                                            class="w-full input-field form-select rounded-lg py-3 px-4 focus:outline-none">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L"
                                                <?= (old('jenis_kelamin', $member['jenis_kelamin'] ?? '') == 'L') ? 'selected' : '' ?>>
                                                Laki-laki</option>
                                            <option value="P"
                                                <?= (old('jenis_kelamin', $member['jenis_kelamin'] ?? '') == 'P') ? 'selected' : '' ?>>
                                                Perempuan</option>
                                        </select>
                                    </div>

                                    <!-- Alamat -->
                                    <div class="md:col-span-2">
                                        <label for="alamat" class="form-label">
                                            Alamat Lengkap <span class="text-red-500">*</span>
                                        </label>
                                        <textarea id="alamat" name="alamat" rows="3"
                                            class="w-full input-field rounded-lg py-3 px-4 focus:outline-none resize-none"
                                            placeholder="Masukkan alamat lengkap"
                                            required><?= old('alamat', $member['alamat'] ?? '') ?></textarea>
                                        <?php if(isset(session()->getFlashdata('errors')['alamat'])): ?>
                                        <p class="error-text"><?= session()->getFlashdata('errors')['alamat'] ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Membership Details -->
                            <div class="mb-8">
                                <div class="section-header">
                                    <div class="section-number bg-slate-700">2</div>
                                    <h2 class="text-xl font-bold text-white">Detail Membership</h2>
                                </div>

                                <div class="grid md:grid-cols-2 gap-6">
                                    <!-- Paket Membership -->
                                    <div>
                                        <label for="paket_member" class="form-label">
                                            Paket Membership <span class="text-red-500">*</span>
                                        </label>
                                        <select id="paket_member" name="paket_member"
                                            class="w-full input-field form-select rounded-lg py-3 px-4 focus:outline-none"
                                            required>
                                            <option value="">Pilih Paket</option>
                                            <option value="har"
                                                <?= (old('paket_member', $member['paket_member'] ?? '') == 'har') ? 'selected' : '' ?>>
                                                Harian</option>
                                            <option value="bln"
                                                <?= (old('paket_member', $member['paket_member'] ?? '') == 'bln') ? 'selected' : '' ?>>
                                                Bulanan</option>
                                            <option value="thn"
                                                <?= (old('paket_member', $member['paket_member'] ?? '') == 'thn') ? 'selected' : '' ?>>
                                                Tahunan</option>
                                            <option value="thn2"
                                                <?= (old('paket_member', $member['paket_member'] ?? '') == 'thn2') ? 'selected' : '' ?>>
                                                Tahunan (Berdua)</option>
                                            <option value="plj"
                                                <?= (old('paket_member', $member['paket_member'] ?? '') == 'plj') ? 'selected' : '' ?>>
                                                Pelajar Bulanan</option>
                                            <option value="tw"
                                                <?= (old('paket_member', $member['paket_member'] ?? '') == 'tw') ? 'selected' : '' ?>>
                                                Tamu Wisma</option>
                                        </select>
                                        <?php if(isset(session()->getFlashdata('errors')['paket_member'])): ?>
                                        <p class="error-text"><?= session()->getFlashdata('errors')['paket_member'] ?>
                                        </p>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Mulai Membership -->
                                    <div>
                                        <label for="mulai_member" class="form-label">
                                            Mulai Membership <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" id="mulai_member" name="mulai_member"
                                            value="<?= old('mulai_member', $member['mulai_member'] ?? date('Y-m-d')) ?>"
                                            class="w-full input-field rounded-lg py-3 px-4 focus:outline-none" required>
                                        <?php if(isset(session()->getFlashdata('errors')['mulai_member'])): ?>
                                        <p class="error-text"><?= session()->getFlashdata('errors')['mulai_member'] ?>
                                        </p>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        <label for="status" class="form-label">
                                            Status <span class="text-red-500">*</span>
                                        </label>
                                        <select id="status" name="status"
                                            class="w-full input-field form-select rounded-lg py-3 px-4 focus:outline-none"
                                            required>
                                            <option value="pending"
                                                <?= (old('status', $member['status'] ?? '') == 'pending') ? 'selected' : '' ?>>
                                                Pending</option>
                                            <option value="active"
                                                <?= (old('status', $member['status'] ?? '') == 'active') ? 'selected' : '' ?>>
                                                Aktif</option>
                                            <option value="expired"
                                                <?= (old('status', $member['status'] ?? '') == 'expired') ? 'selected' : '' ?>>
                                                Expired</option>
                                            <option value="cancelled"
                                                <?= (old('status', $member['status'] ?? '') == 'cancelled') ? 'selected' : '' ?>>
                                                Dibatalkan</option>
                                        </select>
                                    </div>

                                    <!-- Password Reset -->
                                    <div>
                                        <label for="password" class="form-label">
                                            Reset Password
                                        </label>
                                        <div class="relative">
                                            <input type="password" id="password" name="password"
                                                class="w-full input-field rounded-lg py-3 px-4 focus:outline-none"
                                                placeholder="Kosongkan jika tidak diubah">
                                            <button type="button" onclick="togglePassword()"
                                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-white">
                                                <i class="fas fa-eye" id="passwordToggle"></i>
                                            </button>
                                        </div>
                                        <div class="password-actions">
                                            <button type="button" onclick="generatePassword()"
                                                class="text-xs text-red-400 hover:text-red-300">
                                                <i class="fas fa-key mr-1"></i> Generate Password
                                            </button>
                                            <button type="button" onclick="clearPassword()"
                                                class="text-xs text-slate-400 hover:text-slate-300">
                                                <i class="fas fa-times mr-1"></i> Kosongkan
                                            </button>
                                        </div>
                                        <?php if(isset(session()->getFlashdata('errors')['password'])): ?>
                                        <p class="error-text"><?= session()->getFlashdata('errors')['password'] ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 3: Update Identity Photo -->
                            <div class="mb-8">
                                <div class="section-header">
                                    <div class="section-number bg-purple-600">3</div>
                                    <h2 class="text-xl font-bold text-white">Update Foto Identitas</h2>
                                </div>

                                <div class="space-y-4">
                                    <p class="text-slate-400 text-sm">
                                        Kosongkan jika tidak ingin mengubah foto identitas. Foto saat ini masih akan
                                        digunakan.
                                    </p>

                                    <!-- Hidden File Input -->
                                    <input type="file" id="foto_identitas" name="foto_identitas" class="hidden"
                                        accept="image/jpeg,image/jpg,image/png" onchange="handleFileSelect(this)">

                                    <div class="upload-area rounded-xl p-8 text-center" id="upload-area">
                                        <div id="upload-placeholder">
                                            <i class="fas fa-cloud-upload-alt text-5xl text-slate-600 mb-4"></i>
                                            <h3 class="text-xl font-bold text-white mb-2">Upload Foto Baru</h3>
                                            <p class="text-slate-400 mb-4">
                                                KTP atau Kartu Pelajar (Maks. 2MB)<br>
                                                Format: JPG, JPEG, PNG
                                            </p>
                                            <p class="text-sm text-slate-500">* Kosongkan jika tidak diubah</p>

                                            <button type="button"
                                                onclick="document.getElementById('foto_identitas').click()"
                                                class="btn-primary font-bold py-3 px-6 rounded-lg mt-4">
                                                <i class="fas fa-upload mr-2"></i> Pilih File Baru
                                            </button>
                                        </div>

                                        <div id="preview-area" class="hidden"></div>
                                    </div>

                                    <?php if(isset(session()->getFlashdata('errors')['foto_identitas'])): ?>
                                    <p class="error-text"><?= session()->getFlashdata('errors')['foto_identitas'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <button type="submit"
                                    class="btn-primary flex-1 py-3 px-6 rounded-lg text-lg transition-all duration-300">
                                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                </button>

                                <a href="<?= base_url('/admin/members/view/' . ($member['id'] ?? '')) ?>"
                                    class="btn-secondary flex-1 py-3 px-6 rounded-lg text-lg text-center transition-all duration-300">
                                    <i class="fas fa-times mr-2"></i> Batal
                                </a>

                                <button type="button" onclick="confirmDelete()"
                                    class="btn-danger flex-1 py-3 px-6 rounded-lg text-lg transition-all duration-300">
                                    <i class="fas fa-trash-alt mr-2"></i> Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-gradient-to-b from-slate-900 to-slate-800 rounded-2xl max-w-md w-full p-6 border border-red-600/30">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Hapus Data Member?</h3>
            <p class="text-slate-400 text-sm">
                Anda akan menghapus data member:<br>
                <span class="font-bold text-white"><?= $member['nama'] ?? '' ?>
                    (<?= $member['kode_member'] ?? '' ?>)</span>
            </p>
            <p class="text-red-400 text-sm mt-2">
                <i class="fas fa-exclamation-circle mr-1"></i> Tindakan ini tidak dapat dibatalkan!
            </p>
        </div>

        <div class="space-y-4 mb-6">
            <div class="bg-slate-900/50 p-4 rounded-lg">
                <p class="text-sm text-slate-400 mb-2">Data yang akan dihapus:</p>
                <ul class="text-sm text-slate-300 space-y-1">
                    <li><i class="fas fa-user mr-2"></i> Data pribadi member</li>
                    <li><i class="fas fa-history mr-2"></i> Riwayat keanggotaan</li>
                    <li><i class="fas fa-id-card mr-2"></i> Foto identitas</li>
                </ul>
            </div>

            <div class="flex items-start text-sm text-slate-400">
                <i class="fas fa-info-circle text-red-500 mr-2 mt-0.5"></i>
                <span>Pastikan data ini tidak lagi diperlukan sebelum menghapus.</span>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="button" onclick="closeDeleteModal()"
                class="flex-1 btn-secondary py-3 rounded-lg transition-colors">
                Batal
            </button>
            <form action="<?= base_url('/admin/members/delete/' . ($member['id'] ?? '')) ?>" method="POST"
                class="flex-1">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="w-full btn-danger py-3 rounded-lg transition-colors">
                    <i class="fas fa-trash-alt mr-2"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
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

// Generate random password
function generatePassword() {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
    let password = '';
    for (let i = 0; i < 12; i++) {
        password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    document.getElementById('password').value = password;

    // Show notification
    showNotification('Password baru telah digenerate', 'success');
}

// Clear password field
function clearPassword() {
    document.getElementById('password').value = '';
    showNotification('Field password dikosongkan', 'info');
}

// File upload handling
function handleFileSelect(input) {
    const file = input.files[0];
    if (!file) return;

    const maxSize = 2 * 1024 * 1024; // 2MB
    const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];

    // Validation
    if (file.size > maxSize) {
        alert('Ukuran file terlalu besar! Maksimal 2MB.');
        input.value = '';
        return;
    }

    if (!validTypes.includes(file.type)) {
        alert('Format file tidak didukung! Hanya JPG, JPEG, dan PNG yang diperbolehkan.');
        input.value = '';
        return;
    }

    // Preview file
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('upload-placeholder').classList.add('hidden');
        const preview = document.getElementById('preview-area');

        preview.innerHTML = `
            <img src="${e.target.result}" class="max-h-48 mx-auto rounded-lg mb-4 border border-slate-700">
            <p class="text-sm text-slate-300 font-medium">${file.name}</p>
            <p class="text-xs text-slate-400">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
            <div class="flex justify-center gap-4 mt-4">
                <button type="button" onclick="document.getElementById('foto_identitas').click()" 
                        class="text-red-400 hover:text-red-300 transition-colors">
                    <i class="fas fa-sync-alt mr-1"></i> Ganti Foto
                </button>
                <button type="button" onclick="removeFile()" 
                        class="text-slate-400 hover:text-slate-300 transition-colors">
                    <i class="fas fa-trash-alt mr-1"></i> Hapus
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

// Delete modal functions
function confirmDelete() {
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Close delete modal on background click
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Notification system
function showNotification(message, type = 'success') {
    // Remove existing notifications
    document.querySelectorAll('.custom-notification').forEach(n => n.remove());

    // Create notification
    const notification = document.createElement('div');
    notification.className = `custom-notification fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-xl ${
        type === 'success' ? 'bg-green-900/90 border border-green-700 text-green-300' :
        type === 'error' ? 'bg-red-900/90 border border-red-700 text-red-300' :
        'bg-blue-900/90 border border-blue-700 text-blue-300'
    }`;

    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} mr-3"></i>
            <span class="font-medium">${message}</span>
        </div>
    `;

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

// Calculate age from birth date
document.getElementById('tanggal_lahir').addEventListener('change', function() {
    const birthDate = new Date(this.value);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    // Show age info if element exists
    const ageInfo = document.getElementById('age-info');
    if (ageInfo) {
        if (age < 17) {
            ageInfo.innerHTML = `<span class="text-amber-400 font-medium">
                <i class="fas fa-exclamation-triangle mr-1"></i>Usia: ${age} tahun (Di bawah 17 tahun)
            </span>`;
        } else {
            ageInfo.innerHTML = `<span class="text-green-400 font-medium">
                <i class="fas fa-check-circle mr-1"></i>Usia: ${age} tahun
            </span>`;
        }
    }
});

// Format phone number input
document.getElementById('no_hp').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 0) {
        if (value.startsWith('0')) {
            value = '62' + value.substring(1);
        }
        e.target.value = value;
    }
});

// Form validation before submit
document.getElementById('editMemberForm').addEventListener('submit', function(e) {
    // Validate required fields
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('border-red-500');
            isValid = false;
        } else {
            field.classList.remove('border-red-500');
        }
    });

    if (!isValid) {
        e.preventDefault();
        showNotification('Harap lengkapi semua field yang wajib diisi', 'error');
    }
});

// Initialize form
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date for mulai_member to today
    const mulaiMemberInput = document.getElementById('mulai_member');
    if (mulaiMemberInput && !mulaiMemberInput.value) {
        mulaiMemberInput.min = new Date().toISOString().split('T')[0];
    }

    // Initialize date display for age
    const tanggalLahirInput = document.getElementById('tanggal_lahir');
    if (tanggalLahirInput && tanggalLahirInput.value) {
        tanggalLahirInput.dispatchEvent(new Event('change'));
    }

    // Add animation to form container
    const formContainer = document.querySelector('.form-container');
    setTimeout(() => {
        formContainer.style.opacity = '1';
        formContainer.style.transform = 'translateY(0)';
    }, 100);
});

// Add CSS for notifications
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
`;
document.head.appendChild(style);
</script>
<?= $this->endSection() ?>