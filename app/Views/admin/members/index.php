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

.filter-tabs {
    display: flex;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.filter-tab {
    padding: 0.75rem 1.5rem;
    background: none;
    border: none;
    color: #9ca3af;
    font-weight: 600;
    cursor: pointer;
    position: relative;
}

.filter-tab:hover {
    color: #e5e7eb;
}

.filter-tab.active {
    color: white;
}

.filter-tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #dc2626, #f97316);
}

.status-count {
    display: inline-block;
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border-radius: 9999px;
    padding: 0.125rem 0.5rem;
    font-size: 0.75rem;
    margin-left: 0.5rem;
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
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Data Member</h1>
                    <p class="text-gray-400">Kelola data member Atensi Fitness Center</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-3">
                    <a href="<?= base_url('/admin/members/create') ?>"
                        class="bg-gradient-to-r from-primary to-secondary hover:from-primary-dark hover:to-secondary-dark text-white font-medium px-6 py-3 rounded-lg transition-colors">
                        <i class="fas fa-user-plus mr-2"></i> Tambah Member
                    </a>
                    <button onclick="exportMembers()"
                        class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                        <i class="fas fa-file-export mr-2"></i> Export
                    </button>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-gray-800/50 rounded-lg p-4">
                    <div class="text-2xl font-bold text-white"><?= $total_pending ?? 0 ?></div>
                    <div class="text-sm text-gray-400">Pending</div>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-4">
                    <div class="text-2xl font-bold text-primary"><?= $total_active ?? 0 ?></div>
                    <div class="text-sm text-gray-400">Aktif</div>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-4">
                    <div class="text-2xl font-bold text-yellow-500"><?= isset($members) ? count($members) : 0 ?></div>
                    <div class="text-sm text-gray-400">Total</div>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-4">
                    <div class="text-2xl font-bold text-green-500"><?= date('d/m/Y') ?></div>
                    <div class="text-sm text-gray-400">Tanggal</div>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="filter-tabs mb-6">
                <a href="<?= base_url('/admin/members') ?>" class="filter-tab <?= !$current_status ? 'active' : '' ?>">
                    Semua <span class="status-count"><?= isset($members) ? count($members) : 0 ?></span>
                </a>
                <a href="<?= base_url('/admin/members?status=pending') ?>"
                    class="filter-tab <?= $current_status == 'pending' ? 'active' : '' ?>">
                    Pending <span class="status-count"><?= $total_pending ?? 0 ?></span>
                </a>
                <a href="<?= base_url('/admin/members?status=active') ?>"
                    class="filter-tab <?= $current_status == 'active' ? 'active' : '' ?>">
                    Aktif <span class="status-count"><?= $total_active ?? 0 ?></span>
                </a>
                <a href="<?= base_url('/admin/members?status=expired') ?>"
                    class="filter-tab <?= $current_status == 'expired' ? 'active' : '' ?>">
                    Expired
                </a>
                <a href="<?= base_url('/admin/members?status=cancelled') ?>"
                    class="filter-tab <?= $current_status == 'cancelled' ? 'active' : '' ?>">
                    Dibatalkan
                </a>
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
                        <input type="text" id="searchInput"
                            class="w-full pl-10 bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary"
                            placeholder="Cari nama, kode member, atau email...">
                    </div>
                </div>

                <!-- Filter Options -->
                <div class="flex items-center space-x-4">
                    <select
                        class="bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary">
                        <option value="">Paket Membership</option>
                        <option value="har">Harian</option>
                        <option value="bln">Bulanan</option>
                        <option value="thn">Tahunan</option>
                        <option value="thn2">Tahunan (Berdua)</option>
                        <option value="plj">Pelajar Bulanan</option>
                        <option value="tw">Tamu Wisma</option>
                    </select>

                    <input type="date"
                        class="bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary">
                </div>
            </div>
        </div>

        <!-- Members Table -->
        <div class="table-container">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Kode Member</th>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Nama</th>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Paket</th>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Mulai Member</th>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Status</th>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($members)): ?>
                        <?php foreach($members as $member): ?>
                        <tr class="table-row">
                            <td class="py-4 px-6">
                                <div class="font-medium text-white"><?= $member['kode_member'] ?></div>
                                <div class="text-sm text-gray-400">ID: <?= $member['id'] ?></div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-medium text-white"><?= $member['nama'] ?></div>
                                <div class="text-sm text-gray-400">
                                    <?= $member['no_hp'] ?> |
                                    <?= $member['email'] ?? '-' ?>
                                </div>
                            </td>
                            <td class="py-4 px-6">
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
                                <span class="text-sm text-gray-300"><?= $paket_label ?></span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm text-gray-300">
                                    <?= date('d/m/Y', strtotime($member['mulai_member'])) ?>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <?php
                                    $badge_class = [
                                        'pending' => 'badge-pending',
                                        'active' => 'badge-active',
                                        'expired' => 'badge-expired',
                                        'cancelled' => 'badge-cancelled'
                                    ];
                                    ?>
                                <span class="badge-status <?= $badge_class[$member['status']] ?? 'badge-pending' ?>"
                                    id="status-<?= $member['id'] ?>">
                                    <?= ucfirst($member['status']) ?>
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-2">
                                    <a href="<?= base_url('/admin/members/view/' . $member['id']) ?>"
                                        class="text-primary hover:text-primary-light" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Status Dropdown -->
                                    <div class="relative inline-block">
                                        <button onclick="toggleStatusDropdown(<?= $member['id'] ?>)"
                                            class="text-gray-400 hover:text-white">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>

                                        <div id="status-dropdown-<?= $member['id'] ?>"
                                            class="absolute right-0 mt-2 w-48 bg-gray-900 border border-gray-800 rounded-lg shadow-xl hidden z-10">
                                            <div class="py-2">
                                                <button onclick="updateStatus(<?= $member['id'] ?>, 'pending')"
                                                    class="block w-full text-left px-4 py-2 text-sm text-yellow-400 hover:bg-gray-800">
                                                    <i class="fas fa-clock mr-2"></i> Set Pending
                                                </button>
                                                <button onclick="updateStatus(<?= $member['id'] ?>, 'active')"
                                                    class="block w-full text-left px-4 py-2 text-sm text-green-400 hover:bg-gray-800">
                                                    <i class="fas fa-check mr-2"></i> Set Aktif
                                                </button>
                                                <button onclick="updateStatus(<?= $member['id'] ?>, 'expired')"
                                                    class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-800">
                                                    <i class="fas fa-times mr-2"></i> Set Expired
                                                </button>
                                                <button onclick="updateStatus(<?= $member['id'] ?>, 'cancelled')"
                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-400 hover:bg-gray-800">
                                                    <i class="fas fa-ban mr-2"></i> Set Dibatalkan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <div class="text-gray-400">
                                    <i class="fas fa-users text-4xl mb-4"></i>
                                    <p class="text-lg">Tidak ada data member</p>
                                    <p class="text-sm mt-2">Mulai dengan menambahkan member baru</p>
                                    <a href="<?= base_url('/admin/members/create') ?>"
                                        class="inline-block mt-4 bg-gradient-to-r from-primary to-secondary text-white px-6 py-2 rounded-lg">
                                        <i class="fas fa-user-plus mr-2"></i> Tambah Member Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if(!empty($members)): ?>
            <div class="px-6 py-4 border-t border-gray-800">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-400">
                        Menampilkan <?= count($members) ?> dari <?= count($members) ?> member
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
                        <strong>Tips:</strong> Gunakan filter untuk melihat member berdasarkan status. Klik tombol aksi
                        untuk mengubah status member.
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

// Status dropdown toggle
function toggleStatusDropdown(memberId) {
    const dropdown = document.getElementById('status-dropdown-' + memberId);
    const allDropdowns = document.querySelectorAll('[id^="status-dropdown-"]');

    // Close all other dropdowns
    allDropdowns.forEach(d => {
        if (d.id !== dropdown.id) {
            d.classList.add('hidden');
        }
    });

    dropdown.classList.toggle('hidden');
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('[id^="status-dropdown-"]') && !e.target.closest(
            '[onclick*="toggleStatusDropdown"]')) {
        document.querySelectorAll('[id^="status-dropdown-"]').forEach(d => {
            d.classList.add('hidden');
        });
    }
});

// Update member status
function updateStatus(memberId, newStatus) {
    if (!confirm('Apakah Anda yakin ingin mengubah status member?')) {
        return;
    }

    // Show loading
    const statusBadge = document.getElementById('status-' + memberId);
    const originalText = statusBadge.textContent;
    const originalClass = statusBadge.className;
    statusBadge.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';

    // Prepare form data
    const formData = new FormData();
    formData.append('status', newStatus);
    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

    // AJAX request
    fetch(`/admin/members/update-status/${memberId}`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update badge
                const statusLabels = {
                    'pending': {
                        class: 'badge-pending',
                        text: 'Pending'
                    },
                    'active': {
                        class: 'badge-active',
                        text: 'Aktif'
                    },
                    'expired': {
                        class: 'badge-expired',
                        text: 'Expired'
                    },
                    'cancelled': {
                        class: 'badge-cancelled',
                        text: 'Dibatalkan'
                    }
                };

                const newStatusData = statusLabels[newStatus];
                statusBadge.className = `badge-status ${newStatusData.class}`;
                statusBadge.textContent = newStatusData.text;

                // Show success message
                showNotification(data.message || 'Status member berhasil diupdate!', 'success');

                // Update stats count if on filtered page
                if (window.location.search.includes('status=')) {
                    // Update the status count badge
                    updateStatusCount(newStatus);
                }
            } else {
                statusBadge.className = originalClass;
                statusBadge.textContent = originalText;
                showNotification(data.message || 'Gagal update status', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            statusBadge.className = originalClass;
            statusBadge.textContent = originalText;
            showNotification('Terjadi kesalahan: ' + error.message, 'error');
        });

    // Close dropdown
    const dropdown = document.getElementById('status-dropdown-' + memberId);
    if (dropdown) dropdown.classList.add('hidden');
}

// Update status count in the tabs
function updateStatusCount(statusChanged) {
    const tabs = document.querySelectorAll('.filter-tab');
    tabs.forEach(tab => {
        const href = tab.getAttribute('href') || '';
        if (href.includes(`status=${statusChanged}`)) {
            const countSpan = tab.querySelector('.status-count');
            if (countSpan) {
                let count = parseInt(countSpan.textContent) || 0;
                countSpan.textContent = count + 1;
            }
        }
        // Also decrease count from previous status
        const currentStatus = '<?= $current_status ?? "" ?>';
        if (currentStatus && href.includes(`status=${currentStatus}`)) {
            const countSpan = tab.querySelector('.status-count');
            if (countSpan) {
                let count = parseInt(countSpan.textContent) || 1;
                countSpan.textContent = Math.max(0, count - 1);
            }
        }
    });
}

// Export functionality
function exportMembers() {
    // You can implement CSV/Excel export here
    alert('Fitur export akan segera tersedia!');
}

// Notification function
function showNotification(message, type = 'success') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.custom-notification');
    existingNotifications.forEach(notification => notification.remove());

    // Create new notification
    const notification = document.createElement('div');
    notification.className = `custom-notification fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg animate-slide-up ${
        type === 'success' ? 'bg-green-900 text-green-300 border border-green-700' : 'bg-red-900 text-red-300 border border-red-700'
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

    // Add click to dismiss
    notification.addEventListener('click', function() {
        this.style.opacity = '0';
        setTimeout(() => {
            if (this.parentNode) {
                this.parentNode.removeChild(this);
            }
        }, 500);
    });
}

// Initialize date picker if exists
if (typeof flatpickr !== 'undefined') {
    flatpickr("input[type=date]", {
        dateFormat: "Y-m-d",
        theme: "dark"
    });
}

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Escape to close all dropdowns
    if (e.key === 'Escape') {
        document.querySelectorAll('[id^="status-dropdown-"]').forEach(d => {
            d.classList.add('hidden');
        });
    }
});

// Add some CSS for notification
const style = document.createElement('style');
style.textContent = `
.custom-notification {
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

.badge-status {
    transition: all 0.3s ease;
}

.table-row {
    transition: background-color 0.3s ease;
}
`;
document.head.appendChild(style);
</script>
<?= $this->endSection() ?>