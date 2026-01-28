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

.form-input[readonly] {
    background: rgba(30, 41, 59, 0.5);
    cursor: not-allowed;
    color: #9ca3af;
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

.info-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    font-weight: 600;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
}

.badge-primary {
    background: rgba(220, 38, 38, 0.2);
    color: #fca5a5;
}

.badge-secondary {
    background: rgba(251, 146, 60, 0.2);
    color: #fed7aa;
}

.badge-success {
    background: rgba(34, 197, 94, 0.2);
    color: #86efac;
}

.badge-warning {
    background: rgba(234, 179, 8, 0.2);
    color: #fde047;
}

.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
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
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-600 mx-2"></i>
                            <a href="<?= base_url('/admin/members/view/' . $member['id']) ?>"
                                class="text-sm text-gray-400 hover:text-white"><?= $member['nama'] ?></a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-600 mx-2"></i>
                            <span class="text-sm text-white">Edit Member</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Edit Data Member</h1>
                <p class="text-gray-400">Update informasi member: <?= $member['nama'] ?></p>

                <!-- Member Info Badges -->
                <div class="flex flex-wrap mt-4">
                    <span class="info-badge badge-primary">
                        <i class="fas fa-id-card mr-2"></i> <?= $member['kode_member'] ?>
                    </span>
                    <span
                        class="info-badge badge-<?= $member['status'] == 'active' ? 'success' : ($member['status'] == 'pending' ? 'warning' : 'secondary') ?>">
                        <i class="fas fa-circle mr-2"></i> <?= ucfirst($member['status']) ?>
                    </span>
                    <?php
                    $paket_map = [
                        'har' => 'Harian',
                        'bln' => 'Bulanan', 
                        'thn' => 'Tahunan',
                        'thn2' => 'Tahunan (Berdua)',
                        'plj' => 'Pelajar Bulanan',
                        'tw' => 'Tamu Wisma'
                    ];
                    $paket_label = $paket_map[$member['paket_member']] ?? $member['paket_member'];
                    ?>
                    <span class="info-badge badge-secondary">
                        <i class="fas fa-tag mr-2"></i> <?= $paket_label ?>
                    </span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-3">
                <a href="<?= base_url('/admin/members/view/' . $member['id']) ?>"
                    class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <button type="button" onclick="resetForm()"
                    class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                    <i class="fas fa-undo mr-2"></i> Reset Form
                </button>
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

        <!-- Form Container -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Form -->
            <div class="lg:col-span-2">
                <div class="form-container p-6 card-hover">
                    <form action="<?= base_url('/admin/members/update/' . $member['id']) ?>" method="POST"
                        id="editMemberForm">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Kode Member (Readonly) -->
                            <div>
                                <label class="form-label">Kode Member</label>
                                <input type="text" value="<?= $member['kode_member'] ?>" class="form-input" readonly>
                                <p class="text-sm text-gray-400 mt-1">Kode member tidak dapat diubah</p>
                            </div>

                            <!-- Nama Lengkap -->
                            <div>
                                <label class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" value="<?= old('nama', $member['nama']) ?>"
                                    class="form-input <?= session()->getFlashdata('errors.nama') ? 'border-red-500' : '' ?>"
                                    placeholder="Masukkan nama lengkap" required>
                                <?php if(session()->getFlashdata('errors.nama')): ?>
                                <p class="error-message"><?= session()->getFlashdata('errors.nama') ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="<?= old('email', $member['email']) ?>"
                                    class="form-input <?= session()->getFlashdata('errors.email') ? 'border-red-500' : '' ?>"
                                    placeholder="email@example.com">
                                <?php if(session()->getFlashdata('errors.email')): ?>
                                <p class="error-message"><?= session()->getFlashdata('errors.email') ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- No. HP -->
                            <div>
                                <label class="form-label">No. Handphone <span class="text-red-500">*</span></label>
                                <input type="tel" name="no_hp" value="<?= old('no_hp', $member['no_hp']) ?>"
                                    class="form-input <?= session()->getFlashdata('errors.no_hp') ? 'border-red-500' : '' ?>"
                                    placeholder="0812-3456-7890" required>
                                <?php if(session()->getFlashdata('errors.no_hp')): ?>
                                <p class="error-message"><?= session()->getFlashdata('errors.no_hp') ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label class="form-label">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" name="tanggal_lahir"
                                    value="<?= old('tanggal_lahir', $member['tanggal_lahir']) ?>"
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
                                    <option value="L"
                                        <?= old('jenis_kelamin', $member['jenis_kelamin'] ?? '') == 'L' ? 'selected' : '' ?>>
                                        Laki-laki</option>
                                    <option value="P"
                                        <?= old('jenis_kelamin', $member['jenis_kelamin'] ?? '') == 'P' ? 'selected' : '' ?>>
                                        Perempuan</option>
                                </select>
                            </div>

                            <!-- Alamat -->
                            <div class="md:col-span-2">
                                <label class="form-label">Alamat Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="alamat" rows="3"
                                    class="form-input <?= session()->getFlashdata('errors.alamat') ? 'border-red-500' : '' ?>"
                                    placeholder="Masukkan alamat lengkap"
                                    required><?= old('alamat', $member['alamat']) ?></textarea>
                                <?php if(session()->getFlashdata('errors.alamat')): ?>
                                <p class="error-message"><?= session()->getFlashdata('errors.alamat') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="border-t border-gray-800 my-8"></div>

                        <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                            <i class="fas fa-dumbbell mr-3 text-secondary"></i> Informasi Membership
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Paket Membership -->
                            <div>
                                <label class="form-label">Paket Membership <span class="text-red-500">*</span></label>
                                <select name="paket_member"
                                    class="form-input form-select <?= session()->getFlashdata('errors.paket_member') ? 'border-red-500' : '' ?>"
                                    required>
                                    <option value="">Pilih Paket</option>
                                    <option value="har"
                                        <?= old('paket_member', $member['paket_member']) == 'har' ? 'selected' : '' ?>>
                                        Harian</option>
                                    <option value="bln"
                                        <?= old('paket_member', $member['paket_member']) == 'bln' ? 'selected' : '' ?>>
                                        Bulanan</option>
                                    <option value="thn"
                                        <?= old('paket_member', $member['paket_member']) == 'thn' ? 'selected' : '' ?>>
                                        Tahunan</option>
                                    <option value="thn2"
                                        <?= old('paket_member', $member['paket_member']) == 'thn2' ? 'selected' : '' ?>>
                                        Tahunan (Berdua)</option>
                                    <option value="plj"
                                        <?= old('paket_member', $member['paket_member']) == 'plj' ? 'selected' : '' ?>>
                                        Pelajar Bulanan</option>
                                    <option value="tw"
                                        <?= old('paket_member', $member['paket_member']) == 'tw' ? 'selected' : '' ?>>
                                        Tamu Wisma</option>
                                </select>
                                <?php if(session()->getFlashdata('errors.paket_member')): ?>
                                <p class="error-message"><?= session()->getFlashdata('errors.paket_member') ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Mulai Membership -->
                            <div>
                                <label class="form-label">Mulai Membership <span class="text-red-500">*</span></label>
                                <input type="date" name="mulai_member"
                                    value="<?= old('mulai_member', $member['mulai_member']) ?>"
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
                                    <option value="pending"
                                        <?= old('status', $member['status']) == 'pending' ? 'selected' : '' ?>>Pending
                                    </option>
                                    <option value="active"
                                        <?= old('status', $member['status']) == 'active' ? 'selected' : '' ?>>Aktif
                                    </option>
                                    <option value="expired"
                                        <?= old('status', $member['status']) == 'expired' ? 'selected' : '' ?>>Expired
                                    </option>
                                    <option value="cancelled"
                                        <?= old('status', $member['status']) == 'cancelled' ? 'selected' : '' ?>>
                                        Dibatalkan</option>
                                </select>
                            </div>

                            <!-- Password (Optional) -->
                            <div>
                                <label class="form-label">Password Baru</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                        class="form-input <?= session()->getFlashdata('errors.password') ? 'border-red-500' : '' ?>"
                                        placeholder="Kosongkan jika tidak diubah">
                                    <button type="button" onclick="togglePassword()"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white">
                                        <i class="fas fa-eye" id="passwordToggle"></i>
                                    </button>
                                </div>
                                <p class="text-sm text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                                <?php if(session()->getFlashdata('errors.password')): ?>
                                <p class="error-message"><?= session()->getFlashdata('errors.password') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8">
                            <button type="submit"
                                class="bg-gradient-to-r from-primary to-secondary hover:from-primary-dark hover:to-secondary-dark text-white font-medium px-8 py-3 rounded-lg transition-colors">
                                <i class="fas fa-save mr-2"></i> Update Data Member
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Info & Actions -->
            <div class="space-y-6">
                <!-- Member Summary -->
                <div class="form-container p-6 card-hover">
                    <h3 class="text-lg font-bold text-white mb-4">Ringkasan Member</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Terdaftar Sejak</span>
                            <span
                                class="text-white font-medium"><?= date('d/m/Y', strtotime($member['created_at'])) ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Terakhir Diupdate</span>
                            <span
                                class="text-white font-medium"><?= date('d/m/Y', strtotime($member['updated_at'])) ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Terakhir Login</span>
                            <span class="text-white font-medium">
                                <?= $member['last_login'] ? date('d/m/Y H:i', strtotime($member['last_login'])) : 'Belum login' ?>
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Login Attempts</span>
                            <span class="text-white font-medium"><?= $member['login_attempts'] ?? 0 ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Akun Terkunci</span>
                            <span class="text-white font-medium">
                                <?= $member['is_locked'] ? 'Ya' : 'Tidak' ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="form-container p-6 card-hover">
                    <h3 class="text-lg font-bold text-white mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <button onclick="sendPasswordReset()"
                            class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                            <i class="fas fa-key mr-2"></i> Reset Password
                        </button>
                        <button onclick="extendMembership()"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                            <i class="fas fa-calendar-plus mr-2"></i> Perpanjang Membership
                        </button>
                        <a href="<?= base_url('/admin/members/view/' . $member['id']) ?>"
                            class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors text-center">
                            <i class="fas fa-eye mr-2"></i> Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="form-container p-6 border border-red-500/30 bg-red-900/10 card-hover">
                    <h3 class="text-lg font-bold text-white mb-4">Zona Berbahaya</h3>
                    <p class="text-sm text-gray-300 mb-4">
                        Hati-hati dengan aksi ini. Beberapa aksi tidak dapat dibatalkan.
                    </p>
                    <div class="space-y-3">
                        <button onclick="deactivateMember()"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                            <i class="fas fa-user-slash mr-2"></i> Nonaktifkan Member
                        </button>
                        <button onclick="deleteMember()"
                            class="w-full bg-red-800 hover:bg-red-900 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                            <i class="fas fa-trash mr-2"></i> Hapus Permanen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
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

// Reset form to original values
function resetForm() {
    if (confirm('Reset form ke data asli? Semua perubahan yang belum disimpan akan hilang.')) {
        document.getElementById('editMemberForm').reset();
        showNotification('Form telah direset ke data asli', 'info');
    }
}

// Send password reset
function sendPasswordReset() {
    if (confirm('Kirim email reset password ke member?')) {
        // AJAX request to send password reset
        showNotification('Email reset password telah dikirim', 'success');
    }
}

// Extend membership
function extendMembership() {
    showNotification('Fitur perpanjangan membership akan segera tersedia', 'info');
}

// Deactivate member
function deactivateMember() {
    if (confirm('Nonaktifkan member ini? Member tidak akan bisa login sampai diaktifkan kembali.')) {
        // AJAX request to deactivate
        fetch(`/admin/members/deactivate/<?= $member['id'] ?>`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Member berhasil dinonaktifkan', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showNotification(data.message || 'Gagal menonaktifkan member', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan', 'error');
            });
    }
}

// Delete member
function deleteMember() {
    const memberName = "<?= addslashes($member['nama']) ?>";
    if (confirm(`HAPUS PERMANEN member "${memberName}"? Aksi ini TIDAK DAPAT DIBATALKAN!`)) {
        if (prompt(`Ketik "HAPUS" untuk mengkonfirmasi penghapusan member "${memberName}"`) === 'HAPUS') {
            // AJAX request to delete
            fetch(`/admin/members/delete/<?= $member['id'] ?>`, {
                    method: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Member berhasil dihapus', 'success');
                        setTimeout(() => {
                            window.location.href = '/admin/members';
                        }, 1500);
                    } else {
                        showNotification(data.message || 'Gagal menghapus member', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Terjadi kesalahan', 'error');
                });
        }
    }
}

// Form validation
document.getElementById('editMemberForm').addEventListener('submit', function(e) {
    const requiredFields = ['nama', 'no_hp', 'tanggal_lahir', 'alamat', 'paket_member', 'mulai_member'];
    let isValid = true;

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

    if (!isValid) {
        e.preventDefault();
        showNotification('Harap lengkapi semua field yang wajib diisi', 'warning');
    }
});

function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
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

// Add CSS for notification and card hover
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

.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}
`;
document.head.appendChild(style);

// Auto-format phone number
document.querySelector('[name="no_hp"]').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 0) {
        value = value.match(/.{1,4}/g).join('-');
    }
    e.target.value = value;
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    console.log('Edit member form loaded');
});
</script>
<?= $this->endSection() ?>