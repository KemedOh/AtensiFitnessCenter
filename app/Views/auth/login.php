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

.gradient-text {
    background: linear-gradient(90deg, #dc2626, #f97316, #84cc16);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.login-tabs {
    display: flex;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 2rem;
}

.tab-button {
    flex: 1;
    padding: 1rem;
    background: none;
    border: none;
    color: #9ca3af;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.tab-button:hover {
    color: #e5e7eb;
}

.tab-button.active {
    color: white;
}

.tab-button.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #dc2626, #f97316);
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.role-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-left: 0.5rem;
}

.role-member {
    background: rgba(220, 38, 38, 0.2);
    color: #fca5a5;
}

.role-admin {
    background: rgba(59, 130, 246, 0.2);
    color: #93c5fd;
}

.role-superadmin {
    background: rgba(168, 85, 247, 0.2);
    color: #d8b4fe;
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
                Login <span class="gradient-text">Sistem</span>
            </h1>
            <div class="w-32 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mb-6"></div>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Pilih jenis akun untuk masuk ke sistem Atensi Fitness Center
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start justify-center">
            <!-- Login Form Container -->
            <div class="form-container rounded-2xl shadow-2xl overflow-hidden flex-1 max-w-md">
                <div class="p-2 bg-gradient-to-r from-primary to-secondary"></div>

                <div class="p-8">
                    <!-- Error/Success Messages -->
                    <?php if(session()->getFlashdata('error')): ?>
                    <div class="mb-6 p-4 bg-red-900/50 border border-red-700 text-red-300 rounded-lg">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('success')): ?>
                    <div class="mb-6 p-4 bg-green-900/50 border border-green-700 text-green-300 rounded-lg">
                        <i class="fas fa-check-circle mr-2"></i>
                        <?= session()->getFlashdata('success') ?>
                    </div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('errors')): ?>
                    <div class="mb-6 p-4 bg-red-900/50 border border-red-700 text-red-300 rounded-lg">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Terdapat kesalahan dalam pengisian form.
                    </div>
                    <?php endif; ?>

                    <!-- Login Type Tabs -->
                    <div class="login-tabs">
                        <button type="button" class="tab-button active" data-tab="member">
                            <i class="fas fa-user mr-2"></i> Member
                        </button>
                        <button type="button" class="tab-button" data-tab="admin">
                            <i class="fas fa-user-shield mr-2"></i> Admin
                        </button>
                    </div>

                    <!-- Member Login Form -->
                    <div id="member-tab" class="tab-content active">
                        <form action="<?= base_url('auth/login') ?>" method="POST" class="space-y-6">
                            <?= csrf_field() ?>
                            <input type="hidden" name="login_type" value="member">

                            <div class="mb-4">
                                <span class="role-badge role-member">
                                    <i class="fas fa-user mr-1"></i> Member
                                </span>
                            </div>

                            <!-- Email/Kode Member -->
                            <div>
                                <label for="member_email_kode" class="block text-gray-300 mb-2 font-medium">
                                    Email atau Kode Member <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-500"></i>
                                    </div>
                                    <input type="text" id="member_email_kode" name="email_kode"
                                        value="<?= old('email_kode') ?>"
                                        class="w-full pl-10 input-field bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary"
                                        placeholder="Email atau kode member Anda" required>
                                </div>
                                <?php if(isset(session()->getFlashdata('errors')['email_kode'])): ?>
                                <p class="text-red-400 text-sm mt-1">
                                    <?= session()->getFlashdata('errors')['email_kode'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="member_password" class="block text-gray-300 mb-2 font-medium">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-500"></i>
                                    </div>
                                    <input type="password" id="member_password" name="password"
                                        class="w-full pl-10 pr-10 input-field bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary"
                                        placeholder="Password Anda" required>
                                    <button type="button"
                                        class="toggle-password absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-300"
                                        data-target="member_password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <?php if(isset(session()->getFlashdata('errors')['password'])): ?>
                                <p class="text-red-400 text-sm mt-1">
                                    <?= session()->getFlashdata('errors')['password'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="checkbox" id="member_remember" name="remember" value="1"
                                        class="w-4 h-4 text-primary bg-gray-700 border-gray-600 rounded focus:ring-primary focus:ring-2">
                                    <label for="member_remember" class="ml-2 text-sm text-gray-300">Ingat saya</label>
                                </div>
                                <a href="<?= base_url('auth/forgot-password') ?>"
                                    class="text-sm text-primary hover:text-primary-light transition-colors">
                                    Lupa Password?
                                </a>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-primary to-secondary hover:from-primary-dark hover:to-secondary-dark text-white font-bold py-4 px-6 rounded-lg text-lg transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl hover:shadow-primary/30">
                                <i class="fas fa-sign-in-alt mr-3"></i> Masuk sebagai Member
                            </button>
                        </form>
                    </div>

                    <!-- Admin Login Form -->
                    <div id="admin-tab" class="tab-content">
                        <form action="<?= base_url('admin/auth/login') ?>" method="POST" class="space-y-6">
                            <?= csrf_field() ?>

                            <div class="mb-4">
                                <span class="role-badge role-admin">
                                    <i class="fas fa-user-shield mr-1"></i> Admin/Staff
                                </span>
                            </div>

                            <!-- Username/Email -->
                            <div>
                                <label for="admin_username" class="block text-gray-300 mb-2 font-medium">
                                    Username atau Email <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user-tie text-gray-500"></i>
                                    </div>
                                    <input type="text" id="admin_username" name="username"
                                        class="w-full pl-10 input-field bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary"
                                        placeholder="Username atau email admin" required>
                                </div>
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="admin_password" class="block text-gray-300 mb-2 font-medium">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-500"></i>
                                    </div>
                                    <input type="password" id="admin_password" name="password"
                                        class="w-full pl-10 pr-10 input-field bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary"
                                        placeholder="Password admin" required>
                                    <button type="button"
                                        class="toggle-password absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-300"
                                        data-target="admin_password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="flex items-center">
                                <input type="checkbox" id="admin_remember" name="remember" value="1"
                                    class="w-4 h-4 text-primary bg-gray-700 border-gray-600 rounded focus:ring-primary focus:ring-2">
                                <label for="admin_remember" class="ml-2 text-sm text-gray-300">Ingat saya</label>
                            </div>

                            <!-- Admin Info -->
                            <div class="p-3 bg-blue-900/20 border border-blue-700/30 rounded-lg">
                                <p class="text-sm text-blue-300 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    <span>Login admin hanya untuk staff dan pengelola gym</span>
                                </p>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-6 rounded-lg text-lg transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl hover:shadow-blue-500/30">
                                <i class="fas fa-sign-in-alt mr-3"></i> Masuk sebagai Admin
                            </button>
                        </form>
                    </div>

                    <!-- Links -->
                    <div class="mt-8 pt-6 border-t border-gray-800">
                        <div id="member-links" class="tab-content active">
                            <p class="text-center text-gray-400 mb-4">
                                Belum punya akun member?
                            </p>
                            <a href="<?= base_url('daftar') ?>"
                                class="block text-center border-2 border-primary text-primary hover:bg-primary hover:text-white font-bold py-3 px-6 rounded-lg transition-colors">
                                <i class="fas fa-user-plus mr-2"></i> Daftar Member Baru
                            </a>
                        </div>

                        <div id="admin-links" class="tab-content">
                            <p class="text-center text-gray-400 mb-4">
                                Hanya untuk staff yang berwenang
                            </p>
                            <div class="text-center text-sm text-gray-500">
                                <i class="fas fa-shield-alt mr-1"></i>
                                Akses terbatas untuk pengelola sistem
                            </div>
                        </div>

                        <p class="text-center text-gray-400 text-sm mt-4">
                            <a href="<?= base_url('/') ?>"
                                class="text-primary hover:text-primary-light transition-colors">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Info Panel -->
            <div class="form-container rounded-2xl shadow-2xl overflow-hidden flex-1 max-w-md">
                <div class="p-2 bg-gradient-to-r from-secondary to-accent"></div>

                <div class="p-8">
                    <div class="text-center mb-8">
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-dumbbell text-white text-3xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-3">Login Sesuai Peran</h2>
                        <p class="text-gray-400">Pilih jenis login sesuai dengan peran Anda di Atensi Fitness</p>
                    </div>

                    <!-- Role Information -->
                    <div class="space-y-6">
                        <!-- Member Info -->
                        <div class="p-4 bg-gray-900/50 rounded-lg border-l-4 border-primary">
                            <div class="flex items-center mb-2">
                                <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-white">Member / Pelanggan</h3>
                                    <p class="text-xs text-gray-400">Untuk pengguna layanan gym</p>
                                </div>
                            </div>
                            <ul class="text-sm text-gray-400 space-y-1 mt-3">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-accent mr-2 mt-1"></i>
                                    <span>Akses dashboard personal</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-accent mr-2 mt-1"></i>
                                    <span>Booking kelas dan trainer</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-accent mr-2 mt-1"></i>
                                    <span>Lihat riwayat presensi</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-accent mr-2 mt-1"></i>
                                    <span>Kelola profile dan membership</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Admin Info -->
                        <div class="p-4 bg-gray-900/50 rounded-lg border-l-4 border-blue-500">
                            <div class="flex items-center mb-2">
                                <div
                                    class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user-shield text-blue-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-white">Admin / Staff</h3>
                                    <p class="text-xs text-gray-400">Untuk pengelola dan operator</p>
                                </div>
                            </div>
                            <ul class="text-sm text-gray-400 space-y-1 mt-3">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-blue-400 mr-2 mt-1"></i>
                                    <span>Kelola data member</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-blue-400 mr-2 mt-1"></i>
                                    <span>Verifikasi pembayaran</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-blue-400 mr-2 mt-1"></i>
                                    <span>Generate laporan</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-blue-400 mr-2 mt-1"></i>
                                    <span>Monitoring sistem</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Superadmin Info -->
                        <div class="p-4 bg-gray-900/50 rounded-lg border-l-4 border-purple-500">
                            <div class="flex items-center mb-2">
                                <div
                                    class="w-10 h-10 bg-purple-500/20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-crown text-purple-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-white">Super Admin</h3>
                                    <p class="text-xs text-gray-400">Untuk pemilik dan pengembang</p>
                                </div>
                            </div>
                            <ul class="text-sm text-gray-400 space-y-1 mt-3">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-purple-400 mr-2 mt-1"></i>
                                    <span>Kelola semua admin</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-purple-400 mr-2 mt-1"></i>
                                    <span>Konfigurasi sistem</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-purple-400 mr-2 mt-1"></i>
                                    <span>Akses penuh database</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-purple-400 mr-2 mt-1"></i>
                                    <span>Backup dan restore</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="mt-8 p-4 bg-gray-900/30 rounded-lg">
                        <h3 class="font-bold text-white mb-3 text-center">Statistik Sistem</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-3 bg-gray-800/50 rounded-lg">
                                <div class="text-2xl font-bold text-primary">500+</div>
                                <div class="text-xs text-gray-400">Total Member</div>
                            </div>
                            <div class="text-center p-3 bg-gray-800/50 rounded-lg">
                                <div class="text-2xl font-bold text-secondary">15+</div>
                                <div class="text-xs text-gray-400">Trainer</div>
                            </div>
                            <div class="text-center p-3 bg-gray-800/50 rounded-lg">
                                <div class="text-2xl font-bold text-blue-400">5+</div>
                                <div class="text-xs text-gray-400">Admin Aktif</div>
                            </div>
                            <div class="text-center p-3 bg-gray-800/50 rounded-lg">
                                <div class="text-2xl font-bold text-accent">24/7</div>
                                <div class="text-xs text-gray-400">Operasional</div>
                            </div>
                        </div>
                    </div>

                    <!-- Support -->
                    <div class="mt-8 p-4 bg-primary/10 rounded-lg border border-primary/20">
                        <h3 class="font-bold text-white mb-2 flex items-center">
                            <i class="fas fa-headset mr-2"></i> Butuh Bantuan Login?
                        </h3>
                        <p class="text-sm text-gray-400 mb-3">
                            Hubungi kami jika mengalami masalah login
                        </p>
                        <div class="space-y-2">
                            <a href="https://wa.me/6281234567890" target="_blank"
                                class="flex items-center text-sm text-green-400 hover:text-green-300 transition-colors">
                                <i class="fab fa-whatsapp mr-2"></i> WhatsApp Support
                            </a>
                            <a href="tel:+622112345678"
                                class="flex items-center text-sm text-blue-400 hover:text-blue-300 transition-colors">
                                <i class="fas fa-phone-alt mr-2"></i> (021) 1234-5678
                            </a>
                            <a href="mailto:support@atensifitness.com"
                                class="flex items-center text-sm text-yellow-400 hover:text-yellow-300 transition-colors">
                                <i class="fas fa-envelope mr-2"></i> support@atensifitness.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Tab Switching
document.querySelectorAll('.tab-button').forEach(button => {
    button.addEventListener('click', function() {
        const tabId = this.getAttribute('data-tab');

        // Update active tab button
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('active');
        });
        this.classList.add('active');

        // Show active tab content
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });
        document.getElementById(`${tabId}-tab`).classList.add('active');

        // Update links visibility
        document.getElementById('member-links').classList.toggle('active', tabId === 'member');
        document.getElementById('admin-links').classList.toggle('active', tabId === 'admin');

        // Focus on first input in active tab
        setTimeout(() => {
            const firstInput = document.getElementById(`${tabId}-tab`).querySelector('input');
            if (firstInput) {
                firstInput.focus();
            }
        }, 100);
    });
});

// Show/hide password for all toggle buttons
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function() {
        const targetId = this.getAttribute('data-target');
        const passwordInput = document.getElementById(targetId);
        const icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
});

// Form validation on submit
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        const loginType = this.querySelector('input[name="login_type"]')?.value || 'admin';
        const usernameField = loginType === 'member' ?
            document.getElementById('member_email_kode') :
            document.getElementById('admin_username');
        const passwordField = loginType === 'member' ?
            document.getElementById('member_password') :
            document.getElementById('admin_password');

        if (!usernameField.value.trim() || !passwordField.value.trim()) {
            e.preventDefault();
            alert('Harap isi semua field yang wajib diisi.');
            return;
        }

        // Optional: Add loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
        submitBtn.disabled = true;

        // Re-enable after 3 seconds if still on page (in case of error)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 3000);
    });
});

// Auto-focus on appropriate field based on URL parameter
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const loginType = urlParams.get('type');

    if (loginType === 'admin') {
        // Switch to admin tab
        document.querySelector('.tab-button[data-tab="admin"]').click();
        document.getElementById('admin_username').focus();
    } else {
        // Default to member tab
        document.getElementById('member_email_kode').focus();

        // Check for saved member credentials
        const savedEmail = localStorage.getItem('atensi_member_email');
        const savedRemember = localStorage.getItem('atensi_member_remember');

        if (savedEmail && savedRemember === 'true') {
            document.getElementById('member_email_kode').value = savedEmail;
            document.getElementById('member_remember').checked = true;
        }

        // Check for saved admin credentials
        const savedAdminUser = localStorage.getItem('atensi_admin_username');
        const savedAdminRemember = localStorage.getItem('atensi_admin_remember');

        if (savedAdminUser && savedAdminRemember === 'true') {
            document.getElementById('admin_username').value = savedAdminUser;
            document.getElementById('admin_remember').checked = true;
        }
    }

    // Save member credentials if remember me is checked
    document.getElementById('member_remember').addEventListener('change', function() {
        const emailKode = document.getElementById('member_email_kode').value;

        if (this.checked && emailKode) {
            localStorage.setItem('atensi_member_email', emailKode);
            localStorage.setItem('atensi_member_remember', 'true');
        } else {
            localStorage.removeItem('atensi_member_email');
            localStorage.removeItem('atensi_member_remember');
        }
    });

    // Save admin credentials if remember me is checked
    document.getElementById('admin_remember').addEventListener('change', function() {
        const username = document.getElementById('admin_username').value;

        if (this.checked && username) {
            localStorage.setItem('atensi_admin_username', username);
            localStorage.setItem('atensi_admin_remember', 'true');
        } else {
            localStorage.removeItem('atensi_admin_username');
            localStorage.removeItem('atensi_admin_remember');
        }
    });
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Alt + 1 for member tab
    if (e.altKey && e.key === '1') {
        e.preventDefault();
        document.querySelector('.tab-button[data-tab="member"]').click();
    }

    // Alt + 2 for admin tab
    if (e.altKey && e.key === '2') {
        e.preventDefault();
        document.querySelector('.tab-button[data-tab="admin"]').click();
    }

    // Enter to submit form in active tab
    if (e.key === 'Enter' && !e.target.matches('textarea, button')) {
        const activeTab = document.querySelector('.tab-content.active');
        const form = activeTab.querySelector('form');
        if (form) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.click();
            }
        }
    }
});

// Show keyboard shortcut hint on focus
document.querySelectorAll('input').forEach(input => {
    input.addEventListener('focus', function() {
        const tab = this.closest('.tab-content').id.replace('-tab', '');
        const hint = document.createElement('div');
        hint.className = 'text-xs text-gray-500 mt-1';
        hint.innerHTML =
            `Tekan <kbd class="px-1 py-0.5 bg-gray-800 rounded">Alt+${tab === 'member' ? '1' : '2'}</kbd> untuk pindah tab`;

        // Remove existing hint
        const existingHint = this.parentElement.querySelector('.shortcut-hint');
        if (existingHint) {
            existingHint.remove();
        }

        hint.classList.add('shortcut-hint');
        this.parentElement.appendChild(hint);
    });

    input.addEventListener('blur', function() {
        const hint = this.parentElement.querySelector('.shortcut-hint');
        if (hint) {
            hint.remove();
        }
    });
});
</script>
<?= $this->endSection() ?>