<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<style>
.dashboard-content {
    min-height: calc(100vh - 80px);
}

.stat-card {
    transition: all 0.3s ease;
    background: rgba(30, 41, 59, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(220, 38, 38, 0.2);
    border-color: rgba(220, 38, 38, 0.3);
}

.sidebar-link {
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.sidebar-link:hover {
    background: rgba(220, 38, 38, 0.1);
    border-left-color: rgba(220, 38, 38, 0.5);
}

.sidebar-link.active {
    background: rgba(220, 38, 38, 0.2);
    border-left-color: #dc2626;
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

.table-member {
    transition: all 0.3s ease;
}

.table-member:hover {
    background: rgba(220, 38, 38, 0.05);
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
                    <!-- Notifications -->
                    <div class="relative">
                        <button id="notificationBtn" class="text-gray-300 hover:text-white relative">
                            <i class="fas fa-bell text-xl"></i>
                            <span
                                class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                        </button>
                    </div>

                    <!-- User Profile -->
                    <div class="relative">
                        <button id="userMenuBtn" class="flex items-center space-x-3 text-gray-300 hover:text-white">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="text-left">
                                <div class="font-medium text-white"><?= session()->get('admin_nama') ?? 'Admin' ?></div>
                                <div class="text-xs text-gray-400 capitalize">
                                    <?= session()->get('admin_role') ?? 'Admin' ?></div>
                            </div>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdown"
                            class="absolute right-0 mt-2 w-48 bg-gray-900/95 backdrop-blur-lg border border-gray-800 rounded-lg shadow-xl hidden">
                            <div class="p-4 border-b border-gray-800">
                                <p class="font-medium text-white"><?= session()->get('admin_nama') ?? 'Admin' ?></p>
                                <p class="text-sm text-gray-400">
                                    <?= session()->get('admin_email') ?? 'admin@atensi.com' ?></p>
                            </div>
                            <div class="py-2">
                                <a href="<?= base_url('/admin/profile') ?>"
                                    class="flex items-center px-4 py-2 text-gray-300 hover:text-white hover:bg-gray-800/50">
                                    <i class="fas fa-user-circle mr-3"></i> Profile
                                </a>
                                <?php if(session()->get('is_superadmin')): ?>
                                <a href="<?= base_url('/admin/settings') ?>"
                                    class="flex items-center px-4 py-2 text-gray-300 hover:text-white hover:bg-gray-800/50">
                                    <i class="fas fa-cog mr-3"></i> Pengaturan
                                </a>
                                <?php endif; ?>
                            </div>
                            <div class="border-t border-gray-800 py-2">
                                <a href="<?= base_url('/admin/auth/logout') ?>"
                                    class="flex items-center px-4 py-2 text-red-400 hover:text-red-300 hover:bg-red-900/20">
                                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Navigation -->
            <div class="flex space-x-6 pb-4 overflow-x-auto">
                <a href="<?= base_url('/admin/dashboard') ?>"
                    class="flex items-center px-3 py-2 text-sm font-medium <?= current_url() == base_url('/admin/dashboard') ? 'text-primary border-b-2 border-primary' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="<?= base_url('/admin/members') ?>"
                    class="flex items-center px-3 py-2 text-sm font-medium <?= strpos(current_url(), '/admin/members') !== false ? 'text-primary border-b-2 border-primary' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fas fa-users mr-2"></i> Member
                </a>
                <?php if(session()->get('is_superadmin')): ?>
                <a href="<?= base_url('/admin/admins') ?>"
                    class="flex items-center px-3 py-2 text-sm font-medium <?= strpos(current_url(), '/admin/manage-admins') !== false ? 'text-primary border-b-2 border-primary' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fas fa-user-cog mr-2"></i> Admin
                </a>
                <?php endif; ?>
                <a href="<?= base_url('/admin/reports') ?>"
                    class="flex items-center px-3 py-2 text-sm font-medium <?= strpos(current_url(), '/admin/reports') !== false ? 'text-primary border-b-2 border-primary' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fas fa-chart-bar mr-2"></i> Laporan
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Dashboard Admin</h1>
            <p class="text-gray-400">Selamat datang kembali, <?= session()->get('admin_nama') ?? 'Admin' ?>!</p>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
                <div class="stat-card p-6 rounded-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Member</p>
                            <h3 class="text-3xl font-bold text-white mt-2"><?= $total_members ?? 0 ?></h3>
                        </div>
                        <div class="w-12 h-12 bg-blue-500/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-blue-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card p-6 rounded-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Member Aktif</p>
                            <h3 class="text-3xl font-bold text-white mt-2"><?= $active_members ?? 0 ?></h3>
                        </div>
                        <div class="w-12 h-12 bg-green-500/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-check text-green-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card p-6 rounded-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Pending</p>
                            <h3 class="text-3xl font-bold text-white mt-2"><?= $pending_members ?? 0 ?></h3>
                        </div>
                        <div class="w-12 h-12 bg-yellow-500/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card p-6 rounded-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Admin</p>
                            <h3 class="text-3xl font-bold text-white mt-2"><?= $total_admins ?? 0 ?></h3>
                        </div>
                        <div class="w-12 h-12 bg-purple-500/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-shield text-purple-400 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Recent Members -->
                <div class="glass-effect rounded-xl p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-white">Member Terbaru</h2>
                        <a href="<?= base_url('/admin/members') ?>"
                            class="text-primary hover:text-primary-light text-sm font-medium">
                            Lihat semua
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-800">
                                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Kode Member</th>
                                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Nama</th>
                                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Paket</th>
                                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($recent_members)): ?>
                                <?php foreach($recent_members as $member): ?>
                                <tr class="table-member border-b border-gray-800/50">
                                    <td class="py-3 px-4">
                                        <div class="font-medium text-white"><?= $member['kode_member'] ?></div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="font-medium text-white"><?= $member['nama'] ?></div>
                                        <div class="text-sm text-gray-400"><?= $member['email'] ?? '-' ?></div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <?php
                                            $paket_map = [
                                                'har' => 'Harian',
                                                'bln' => 'Bulanan',
                                                'thn' => 'Tahunan',
                                                'thn2' => 'Tahunan (Berdua)',
                                                'plj' => 'Pelajar Bulanan',
                                                'tw' => 'Tamu Wisma'
                                            ];
                                            ?>
                                        <span
                                            class="text-sm text-gray-300"><?= $paket_map[$member['paket_member']] ?? $member['paket_member'] ?></span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <?php
                                            $badge_class = [
                                                'pending' => 'badge-pending',
                                                'active' => 'badge-active',
                                                'expired' => 'badge-expired',
                                                'cancelled' => 'badge-cancelled'
                                            ];
                                            ?>
                                        <span
                                            class="badge-status <?= $badge_class[$member['status']] ?? 'badge-pending' ?>">
                                            <?= ucfirst($member['status']) ?>
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <a href="<?= base_url('/admin/members/view/' . $member['id']) ?>"
                                            class="text-primary hover:text-primary-light text-sm font-medium">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-400">
                                        <i class="fas fa-users text-3xl mb-3"></i>
                                        <p>Belum ada data member</p>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="glass-effect rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-6">Aksi Cepat</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="<?= base_url('/admin/members/create') ?>"
                            class="bg-primary/20 hover:bg-primary/30 border border-primary/30 rounded-lg p-4 transition-colors">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary/30 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-user-plus text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-white">Tambah Member</h3>
                                    <p class="text-sm text-gray-400">Registrasi member baru</p>
                                </div>
                            </div>
                        </a>

                        <a href="<?= base_url('/admin/reports') ?>"
                            class="bg-blue-500/20 hover:bg-blue-500/30 border border-blue-500/30 rounded-lg p-4 transition-colors">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-blue-500/30 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-chart-bar text-blue-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-white">Generate Laporan</h3>
                                    <p class="text-sm text-gray-400">Lihat laporan bulanan</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-8">
                <!-- System Info -->
                <div class="glass-effect rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-6">Info Sistem</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Server Time</span>
                            <span class="text-white font-medium"><?= date('H:i:s') ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Tanggal</span>
                            <span class="text-white font-medium"><?= date('d F Y') ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Login Sebagai</span>
                            <span class="text-white font-medium"><?= session()->get('admin_role') ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Terakhir Login</span>
                            <span class="text-white font-medium">Hari ini</span>
                        </div>
                    </div>
                </div>

                <!-- Admin List (if superadmin) -->
                <?php if(session()->get('is_superadmin') && !empty($recent_admins)): ?>
                <div class="glass-effect rounded-xl p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-white">Admin Aktif</h2>
                        <a href="<?= base_url('/admin/manage-admins') ?>"
                            class="text-primary hover:text-primary-light text-sm font-medium">
                            Kelola
                        </a>
                    </div>

                    <div class="space-y-4">
                        <?php foreach($recent_admins as $admin): ?>
                        <div class="flex items-center justify-between p-3 bg-gray-800/30 rounded-lg">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-white"><?= $admin['nama_lengkap'] ?></h4>
                                    <p class="text-xs text-gray-400"><?= $admin['username'] ?></p>
                                </div>
                            </div>
                            <span
                                class="text-xs px-2 py-1 <?= $admin['role'] === 'superadmin' ? 'bg-purple-500/20 text-purple-400' : 'bg-blue-500/20 text-blue-400' ?> rounded-full">
                                <?= ucfirst($admin['role']) ?>
                            </span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Need Help -->
                <div class="glass-effect rounded-xl p-6 border border-primary/20">
                    <h2 class="text-xl font-bold text-white mb-4">Butuh Bantuan?</h2>
                    <p class="text-gray-400 text-sm mb-4">
                        Ada masalah atau pertanyaan seputar sistem admin?
                    </p>
                    <div class="space-y-3">
                        <a href="#" class="flex items-center text-primary hover:text-primary-light">
                            <i class="fas fa-book mr-3"></i> Dokumentasi
                        </a>
                        <a href="#" class="flex items-center text-primary hover:text-primary-light">
                            <i class="fas fa-headset mr-3"></i> Hubungi Support
                        </a>
                        <a href="<?= base_url('/admin/auth/logout') ?>"
                            class="flex items-center text-red-400 hover:text-red-300">
                            <i class="fas fa-sign-out-alt mr-3"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// User Dropdown
const userMenuBtn = document.getElementById('userMenuBtn');
const userDropdown = document.getElementById('userDropdown');

if (userMenuBtn && userDropdown) {
    userMenuBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        userDropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
            userDropdown.classList.add('hidden');
        }
    });
}

// Update time every second
function updateTime() {
    const now = new Date();
    const timeElement = document.querySelector('.text-white.font-medium:nth-child(2)');
    if (timeElement) {
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        timeElement.textContent = `${hours}:${minutes}:${seconds}`;
    }
}

// Initial call and set interval
updateTime();
setInterval(updateTime, 1000);

// Add animation to stat cards
document.querySelectorAll('.stat-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-5px)';
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0)';
    });
});

// Auto-hide notifications after 5 seconds
setTimeout(() => {
    const notifications = document.querySelectorAll('[class*="bg-"][class*="900"]');
    notifications.forEach(notification => {
        notification.style.transition = 'opacity 0.5s ease';
        notification.style.opacity = '0';
        setTimeout(() => notification.remove(), 500);
    });
}, 5000);
</script>
<?= $this->endSection() ?>