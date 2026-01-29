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

.password-toggle {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #9ca3af;
    cursor: pointer;
}

.password-toggle:hover {
    color: #ffffff;
}

.info-card {
    background: rgba(15, 23, 42, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.5rem;
    padding: 1rem;
    margin-bottom: 1rem;
}

.role-info {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-right: 0.5rem;
}

.role-superadmin {
    background: rgba(168, 85, 247, 0.2);
    color: #d8b4fe;
}

.role-admin {
    background: rgba(59, 130, 246, 0.2);
    color: #93c5fd;
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
                <a href="<?= base_url('/admin/admins') ?>"
                    class="flex items-center px-3 py-2 text-sm font-medium <?= strpos(current_url(), '/admin/admins') !== false ? 'text-primary border-b-2 border-primary' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fas fa-user-cog mr-2"></i> Kelola Admin
                </a>
                <a href="<?= base_url('/admin/admins/create') ?>"
                    class="flex items-center px-3 py-2 text-sm font-medium <?= current_url() == base_url('/admin/admins/create') ? 'text-primary border-b-2 border-primary' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Admin
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
                            <a href="<?= base_url('/admin/admins') ?>"
                                class="text-sm text-gray-400 hover:text-white">Kelola Admin</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-600 mx-2"></i>
                            <span class="text-sm text-white">Tambah Admin Baru</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Tambah Admin Baru</h1>
                <p class="text-gray-400">Buat akun admin baru untuk sistem Atensi Fitness Center</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-3">
                <a href="<?= base_url('/admin/admins') ?>"
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

        <!-- Role Information -->
        <div class="info-card mb-6">
            <h3 class="text-lg font-bold text-white mb-3">Informasi Role Admin</h3>
            <div class="flex flex-wrap gap-2 mb-3">
                <span class="role-info role-superadmin">
                    <i class="fas fa-crown mr-1"></i> Superadmin
                </span>
                <span class="role-info role-admin">
                    <i class="fas fa-user-shield mr-1"></i> Admin
                </span>
            </div>
            <p class="text-sm text-gray-300">
                <strong>Superadmin:</strong> Akses penuh ke semua fitur sistem termasuk manajemen admin lain.<br>
                <strong>Admin:</strong> Akses terbatas untuk mengelola member, presensi, dan laporan.
            </p>
        </div>

        <!-- Form Container -->
        <div class="form-container p-6">
            <form action="<?= base_url('/admin/admins/store') ?>" method="POST" id="createAdminForm">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Username -->
                    <div>
                        <label class="form-label">Username <span class="text-red-500">*</span></label>
                        <input type="text" name="username" value="<?= old('username') ?>"
                            class="form-input <?= session()->getFlashdata('errors.username') ? 'border-red-500' : '' ?>"
                            placeholder="Masukkan username" required>
                        <?php if(session()->getFlashdata('errors.username')): ?>
                        <p class="error-message"><?= session()->getFlashdata('errors.username') ?></p>
                        <?php endif; ?>
                        <p class="text-sm text-gray-400 mt-1">Minimal 3 karakter, tanpa spasi</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="form-label">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="<?= old('email') ?>"
                            class="form-input <?= session()->getFlashdata('errors.email') ? 'border-red-500' : '' ?>"
                            placeholder="email@atensifitness.com" required>
                        <?php if(session()->getFlashdata('errors.email')): ?>
                        <p class="error-message"><?= session()->getFlashdata('errors.email') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="<?= old('nama_lengkap') ?>"
                            class="form-input <?= session()->getFlashdata('errors.nama_lengkap') ? 'border-red-500' : '' ?>"
                            placeholder="Masukkan nama lengkap" required>
                        <?php if(session()->getFlashdata('errors.nama_lengkap')): ?>
                        <p class="error-message"><?= session()->getFlashdata('errors.nama_lengkap') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="form-label">Role <span class="text-red-500">*</span></label>
                        <select name="role"
                            class="form-input form-select <?= session()->getFlashdata('errors.role') ? 'border-red-500' : '' ?>"
                            required>
                            <option value="">Pilih Role</option>
                            <option value="admin" <?= old('role') == 'admin' ? 'selected' : 'selected' ?>>Admin</option>
                            <option value="superadmin" <?= old('role') == 'superadmin' ? 'selected' : '' ?>>Superadmin
                            </option>
                        </select>
                        <?php if(session()->getFlashdata('errors.role')): ?>
                        <p class="error-message"><?= session()->getFlashdata('errors.role') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="form-label">Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="form-input <?= session()->getFlashdata('errors.password') ? 'border-red-500' : '' ?>"
                                placeholder="Masukkan password" required>
                            <button type="button" onclick="togglePassword('password')" class="password-toggle">
                                <i class="fas fa-eye" id="passwordToggle"></i>
                            </button>
                        </div>
                        <?php if(session()->getFlashdata('errors.password')): ?>
                        <p class="error-message"><?= session()->getFlashdata('errors.password') ?></p>
                        <?php endif; ?>
                        <p class="text-sm text-gray-400 mt-1">Minimal 6 karakter</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="form-label">Konfirmasi Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-input <?= session()->getFlashdata('errors.password_confirmation') ? 'border-red-500' : '' ?>"
                                placeholder="Ulangi password" required>
                            <button type="button" onclick="togglePassword('password_confirmation')"
                                class="password-toggle">
                                <i class="fas fa-eye" id="passwordConfirmToggle"></i>
                            </button>
                        </div>
                        <?php if(session()->getFlashdata('errors.password_confirmation')): ?>
                        <p class="error-message"><?= session()->getFlashdata('errors.password_confirmation') ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Status -->
                <div class="mt-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1"
                            class="w-4 h-4 text-primary bg-gray-700 border-gray-600 rounded focus:ring-primary focus:ring-2"
                            <?= old('is_active', '1') == '1' ? 'checked' : '' ?>>
                        <span class="ml-2 text-gray-300">Aktifkan akun admin setelah dibuat</span>
                    </label>
                    <p class="text-sm text-gray-400 mt-1">Jika dicentang, admin dapat langsung login. Jika tidak, admin
                        perlu diaktifkan manual.</p>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-8">
                    <button type="submit"
                        class="bg-gradient-to-r from-primary to-secondary hover:from-primary-dark hover:to-secondary-dark text-white font-medium px-8 py-3 rounded-lg transition-colors">
                        <i class="fas fa-save mr-2"></i> Simpan Admin Baru
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Text -->
        <div class="mt-8 p-4 bg-blue-900/20 border border-blue-700/30 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-blue-400 mr-3"></i>
                <div>
                    <p class="text-sm text-blue-300">
                        <strong>Tips:</strong> Pastikan memberikan role yang sesuai dengan kebutuhan.
                        Superadmin memiliki akses penuh termasuk menghapus admin lain.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const toggleIcon = document.getElementById(fieldId === 'password' ? 'passwordToggle' : 'passwordConfirmToggle');

    if (field.type === 'password') {
        field.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Form validation
document.getElementById('createAdminForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;

    // Check password match
    if (password !== confirmPassword) {
        e.preventDefault();
        showNotification('Password dan konfirmasi password tidak sama', 'error');

        // Highlight error
        document.getElementById('password').classList.add('border-red-500');
        document.getElementById('password_confirmation').classList.add('border-red-500');

        return;
    }

    // Check password strength
    if (password.length < 6) {
        e.preventDefault();
        showNotification('Password minimal 6 karakter', 'error');
        document.getElementById('password').classList.add('border-red-500');
        return;
    }

    // Username validation
    const username = document.querySelector('[name="username"]').value;
    if (username.length < 3) {
        e.preventDefault();
        showNotification('Username minimal 3 karakter', 'error');
        return;
    }

    // Email validation
    const email = document.querySelector('[name="email"]').value;
    if (!isValidEmail(email)) {
        e.preventDefault();
        showNotification('Format email tidak valid', 'error');
        return;
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
        'bg-yellow-900/90 border border-yellow-700 text-yellow-300'
    }`;

    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} mr-3"></i>
            <span class="font-medium">${message}</span>
        </div>
    `;

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.5s ease';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 500);
    }, 5000);
}

// Add CSS for notification
const style = document.createElement('style');
style.textContent = `
.custom-notification {
    backdrop-filter: blur(10px);
    animation: slideIn 0.3s ease-out;
    min-width: 300px;
    max-width: 400px;
    cursor: pointer;
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

// Click notification to dismiss
document.addEventListener('click', function(e) {
    if (e.target.closest('.custom-notification')) {
        e.target.closest('.custom-notification').remove();
    }
});

// Generate random password
function generatePassword() {
    const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
    let password = '';
    for (let i = 0; i < 10; i++) {
        password += chars.charAt(Math.floor(Math.random() * chars.length));
    }

    document.getElementById('password').value = password;
    document.getElementById('password_confirmation').value = password;

    showNotification('Password berhasil digenerate', 'success');
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    console.log('Create admin form loaded');

    // Add generate password button
    const passwordField = document.getElementById('password').parentElement;
    const generateBtn = document.createElement('button');
    generateBtn.type = 'button';
    generateBtn.className =
        'absolute right-10 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white';
    generateBtn.innerHTML = '<i class="fas fa-random"></i>';
    generateBtn.title = 'Generate password';
    generateBtn.onclick = generatePassword;

    passwordField.appendChild(generateBtn);
});
</script>
<?= $this->endSection() ?>