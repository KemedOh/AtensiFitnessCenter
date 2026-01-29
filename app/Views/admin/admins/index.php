<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<style>
.table-container {
    background: rgba(30, 41, 59, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.75rem;
    overflow: hidden;
}

.table-header {
    background: rgba(15, 23, 42, 0.8);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.table-row {
    transition: all 0.3s ease;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.table-row:hover {
    background: rgba(220, 38, 38, 0.05);
}

.role-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
}

.role-superadmin {
    background: rgba(168, 85, 247, 0.2);
    color: #d8b4fe;
}

.role-admin {
    background: rgba(59, 130, 246, 0.2);
    color: #93c5fd;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-active {
    background: rgba(34, 197, 94, 0.2);
    color: #86efac;
}

.status-inactive {
    background: rgba(239, 68, 68, 0.2);
    color: #fca5a5;
}

.action-btn {
    transition: all 0.3s ease;
}

.action-btn:hover {
    transform: translateY(-2px);
}

.search-input {
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.5rem;
    color: white;
    padding: 0.75rem 1rem;
    width: 100%;
    transition: all 0.3s ease;
}

.search-input:focus {
    outline: none;
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2);
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
                        <button class="text-gray-300 hover:text-white relative">
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
                    </div>
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
                <a href="<?= base_url('/admin/reports') ?>"
                    class="flex items-center px-3 py-2 text-sm font-medium <?= strpos(current_url(), '/admin/reports') !== false ? 'text-primary border-b-2 border-primary' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fas fa-chart-bar mr-2"></i> Laporan
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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-600 mx-2"></i>
                            <span class="text-sm text-white">Kelola Admin</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Kelola Admin</h1>
                <p class="text-gray-400">Manajemen akses admin dan superadmin sistem</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-3">
                <a href="<?= base_url('/admin/admins/create') ?>"
                    class="bg-gradient-to-r from-primary to-secondary hover:from-primary-dark hover:to-secondary-dark text-white font-medium px-6 py-3 rounded-lg transition-colors">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Admin
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if(session()->getFlashdata('success')): ?>
        <div class="mb-6 p-4 bg-green-900/30 border border-green-700/50 rounded-lg animate-fade-in">
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
        <div class="mb-6 p-4 bg-red-900/30 border border-red-700/50 rounded-lg animate-fade-in">
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

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-gray-800/50 rounded-lg p-4">
                <div class="text-2xl font-bold text-white"><?= $total_admins ?? 0 ?></div>
                <div class="text-sm text-gray-400">Total Admin</div>
            </div>
            <div class="bg-gray-800/50 rounded-lg p-4">
                <div class="text-2xl font-bold text-purple-500"><?= $superadmin_count ?? 0 ?></div>
                <div class="text-sm text-gray-400">Superadmin</div>
            </div>
            <div class="bg-gray-800/50 rounded-lg p-4">
                <div class="text-2xl font-bold text-blue-500"><?= $admin_count ?? 0 ?></div>
                <div class="text-sm text-gray-400">Admin</div>
            </div>
            <div class="bg-gray-800/50 rounded-lg p-4">
                <div class="text-2xl font-bold text-green-500"><?= $active_admins ?? 0 ?></div>
                <div class="text-sm text-gray-400">Aktif</div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="glass-effect rounded-xl p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <!-- Search -->
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-500"></i>
                        </div>
                        <input type="text" id="searchInput" class="search-input pl-10"
                            placeholder="Cari username, nama, atau email...">
                    </div>
                </div>

                <!-- Filter Options -->
                <div class="flex items-center space-x-4">
                    <select id="roleFilter" class="search-input">
                        <option value="">Semua Role</option>
                        <option value="superadmin">Superadmin</option>
                        <option value="admin">Admin</option>
                    </select>

                    <select id="statusFilter" class="search-input">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Admins Table -->
        <div class="table-container">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Username</th>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Nama Lengkap</th>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Email</th>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Role</th>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Status</th>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Terakhir Login</th>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($admins)): ?>
                        <?php foreach($admins as $admin): ?>
                        <tr class="table-row" data-role="<?= $admin['role'] ?>"
                            data-status="<?= $admin['is_active'] ? 'active' : 'inactive' ?>">
                            <td class="py-4 px-6">
                                <div class="font-medium text-white"><?= $admin['username'] ?></div>
                                <div class="text-sm text-gray-400">ID: <?= $admin['id'] ?></div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-medium text-white"><?= $admin['nama_lengkap'] ?></div>
                                <?php if($admin['id'] == session()->get('admin_id')): ?>
                                <div class="text-xs text-primary mt-1">
                                    <i class="fas fa-user mr-1"></i> Anda
                                </div>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-gray-300"><?= $admin['email'] ?></div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="role-badge role-<?= $admin['role'] ?>">
                                    <?= ucfirst($admin['role']) ?>
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <?php if($admin['is_active']): ?>
                                <span class="status-badge status-active">Aktif</span>
                                <?php else: ?>
                                <span class="status-badge status-inactive">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm text-gray-300">
                                    <?= $admin['last_login'] ? date('d/m/Y H:i', strtotime($admin['last_login'])) : 'Belum login' ?>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-2">
                                    <!-- Edit Button -->
                                    <a href="<?= base_url('/admin/admins/edit/' . $admin['id']) ?>"
                                        class="action-btn text-blue-400 hover:text-blue-300" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Toggle Status Button -->
                                    <?php if($admin['id'] != session()->get('admin_id')): ?>
                                    <?php if($admin['is_active']): ?>
                                    <button onclick="toggleAdminStatus(<?= $admin['id'] ?>, false)"
                                        class="action-btn text-yellow-400 hover:text-yellow-300" title="Nonaktifkan">
                                        <i class="fas fa-toggle-on"></i>
                                    </button>
                                    <?php else: ?>
                                    <button onclick="toggleAdminStatus(<?= $admin['id'] ?>, true)"
                                        class="action-btn text-gray-400 hover:text-gray-300" title="Aktifkan">
                                        <i class="fas fa-toggle-off"></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php endif; ?>

                                    <!-- Delete Button (only for non-superadmin) -->
                                    <?php if($admin['role'] != 'superadmin' && $admin['id'] != session()->get('admin_id')): ?>
                                    <button onclick="deleteAdmin(<?= $admin['id'] ?>, '<?= $admin['username'] ?>')"
                                        class="action-btn text-red-400 hover:text-red-300" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" class="py-12 text-center">
                                <div class="text-gray-400">
                                    <i class="fas fa-user-shield text-4xl mb-4"></i>
                                    <p class="text-lg">Belum ada admin terdaftar</p>
                                    <p class="text-sm mt-2">Mulai dengan menambahkan admin baru</p>
                                    <a href="<?= base_url('/admin/admins/create') ?>"
                                        class="inline-block mt-4 bg-gradient-to-r from-primary to-secondary text-white px-6 py-2 rounded-lg">
                                        <i class="fas fa-user-plus mr-2"></i> Tambah Admin Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if(!empty($admins)): ?>
            <div class="px-6 py-4 border-t border-gray-800">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-400">
                        Menampilkan <?= count($admins) ?> dari <?= count($admins) ?> admin
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="px-3 py-1 bg-gray-800 rounded text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-1 bg-primary text-white rounded">1</button>
                        <button class="px-3 py-1 bg-gray-800 rounded text-gray-300 hover:bg-gray-700">2</button>
                        <button class="px-3 py-1 bg-gray-800 rounded text-gray-300 hover:bg-gray-700">3</button>
                        <button class="px-3 py-1 bg-gray-800 rounded text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Help Text -->
        <div class="mt-8 p-4 bg-blue-900/20 border border-blue-700/30 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-blue-400 mr-3"></i>
                <div>
                    <p class="text-sm text-blue-300">
                        <strong>Informasi:</strong> Hanya Superadmin yang dapat mengelola admin lain.
                        Anda tidak dapat menonaktifkan atau menghapus akun sendiri.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('.table-row');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Filter functionality
document.getElementById('roleFilter').addEventListener('change', function(e) {
    filterTable();
});

document.getElementById('statusFilter').addEventListener('change', function(e) {
    filterTable();
});

function filterTable() {
    const roleFilter = document.getElementById('roleFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('.table-row');

    rows.forEach(row => {
        const role = row.getAttribute('data-role');
        const status = row.getAttribute('data-status');

        let showRow = true;

        if (roleFilter && role !== roleFilter) {
            showRow = false;
        }

        if (statusFilter && status !== statusFilter) {
            showRow = false;
        }

        row.style.display = showRow ? '' : 'none';
    });
}

// Toggle admin status
function toggleAdminStatus(adminId, activate) {
    const action = activate ? 'mengaktifkan' : 'menonaktifkan';
    const confirmMessage = `Apakah Anda yakin ingin ${action} admin ini?`;

    if (!confirm(confirmMessage)) {
        return;
    }

    // Show loading
    const button = document.querySelector(`button[onclick="toggleAdminStatus(${adminId}, ${activate})"]`);
    const originalIcon = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

    // AJAX request
    fetch(`/admin/admins/update-status/${adminId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
            },
            body: JSON.stringify({
                is_active: activate
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI
                if (activate) {
                    button.setAttribute('onclick', `toggleAdminStatus(${adminId}, false)`);
                    button.innerHTML = '<i class="fas fa-toggle-on"></i>';
                    button.classList.remove('text-gray-400', 'hover:text-gray-300');
                    button.classList.add('text-yellow-400', 'hover:text-yellow-300');

                    // Update status badge
                    const statusBadge = button.closest('tr').querySelector('.status-badge');
                    statusBadge.className = 'status-badge status-active';
                    statusBadge.textContent = 'Aktif';
                } else {
                    button.setAttribute('onclick', `toggleAdminStatus(${adminId}, true)`);
                    button.innerHTML = '<i class="fas fa-toggle-off"></i>';
                    button.classList.remove('text-yellow-400', 'hover:text-yellow-300');
                    button.classList.add('text-gray-400', 'hover:text-gray-300');

                    // Update status badge
                    const statusBadge = button.closest('tr').querySelector('.status-badge');
                    statusBadge.className = 'status-badge status-inactive';
                    statusBadge.textContent = 'Nonaktif';
                }

                showNotification(data.message || 'Status admin berhasil diupdate!', 'success');
            } else {
                button.innerHTML = originalIcon;
                showNotification(data.message || 'Gagal update status', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            button.innerHTML = originalIcon;
            showNotification('Terjadi kesalahan', 'error');
        });
}

// Delete admin
function deleteAdmin(adminId, adminName) {
    if (!confirm(`HAPUS admin "${adminName}"? Aksi ini TIDAK DAPAT DIBATALKAN!`)) {
        return;
    }

    if (prompt(`Ketik "HAPUS" untuk mengkonfirmasi penghapusan admin "${adminName}"`) !== 'HAPUS') {
        return;
    }

    // AJAX request
    fetch(`/admin/admins/delete/${adminId}`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove row from table
                const row = document.querySelector(`button[onclick="deleteAdmin(${adminId}, '${adminName}')"]`)
                    .closest('tr');
                row.style.opacity = '0';
                row.style.transition = 'opacity 0.3s ease';

                setTimeout(() => {
                    row.remove();

                    // Update stats
                    updateAdminStats();

                    showNotification(data.message || 'Admin berhasil dihapus!', 'success');
                }, 300);
            } else {
                showNotification(data.message || 'Gagal menghapus admin', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan', 'error');
        });
}

// Update admin stats (simplified)
function updateAdminStats() {
    // In real implementation, you might want to reload the stats via AJAX
    const totalAdmins = document.querySelector('.grid.grid-cols-1 > div:nth-child(1) .text-2xl');
    if (totalAdmins) {
        const current = parseInt(totalAdmins.textContent);
        totalAdmins.textContent = current - 1;
    }
}

// Notification function
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

.table-row {
    transition: all 0.3s ease;
}

.action-btn {
    transition: all 0.3s ease;
}

.action-btn:hover {
    transform: translateY(-2px);
}
`;
document.head.appendChild(style);

// Click notification to dismiss
document.addEventListener('click', function(e) {
    if (e.target.closest('.custom-notification')) {
        e.target.closest('.custom-notification').remove();
    }
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    console.log('Admin management page loaded');
});
</script>
<?= $this->endSection() ?>