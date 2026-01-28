<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<style>
.detail-card {
    background: rgba(30, 41, 59, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.75rem;
}

.info-row {
    padding: 1rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    color: #9ca3af;
    font-weight: 500;
    min-width: 150px;
}

.info-value {
    color: #ffffff;
    font-weight: 500;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    font-weight: 600;
    display: inline-block;
}

.badge-active {
    background: rgba(34, 197, 94, 0.2);
    color: #86efac;
}

.badge-pending {
    background: rgba(234, 179, 8, 0.2);
    color: #fde047;
}

.badge-expired {
    background: rgba(239, 68, 68, 0.2);
    color: #fca5a5;
}

.badge-cancelled {
    background: rgba(107, 114, 128, 0.2);
    color: #d1d5db;
}

.package-tag {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 500;
}

.tag-harian {
    background: rgba(59, 130, 246, 0.2);
    color: #93c5fd;
}

.tag-bulanan {
    background: rgba(34, 197, 94, 0.2);
    color: #86efac;
}

.tag-tahunan {
    background: rgba(168, 85, 247, 0.2);
    color: #d8b4fe;
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
                            <span class="text-sm text-white">Detail Member</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Detail Member</h1>
                <p class="text-gray-400">Informasi lengkap member Atensi Fitness Center</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-3">
                <a href="<?= base_url('/admin/members') ?>"
                    class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <button onclick="printMemberCard()"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                    <i class="fas fa-print mr-2"></i> Print Kartu
                </button>
            </div>
        </div>

        <!-- Member Information -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Basic Info -->
            <div class="lg:col-span-2">
                <div class="detail-card p-6 mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div
                                class="w-20 h-20 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-3xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white"><?= $member['nama'] ?></h2>
                                <div class="flex items-center space-x-3 mt-2">
                                    <span class="status-badge badge-<?= $member['status'] ?>">
                                        <?= ucfirst($member['status']) ?>
                                    </span>
                                    <span class="text-gray-400">•</span>
                                    <span class="text-white font-medium"><?= $member['kode_member'] ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="flex items-center space-x-2">
                            <button onclick="sendWelcomeEmail()"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                                <i class="fas fa-envelope mr-1"></i> Kirim Email
                            </button>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                                <i class="fas fa-id-card mr-2 text-primary"></i> Informasi Pribadi
                            </h3>
                            <div class="space-y-4">
                                <div class="info-row">
                                    <div class="info-label">No. HP</div>
                                    <div class="info-value"><?= $member['no_hp'] ?></div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Email</div>
                                    <div class="info-value"><?= $member['email'] ?? '-' ?></div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Tanggal Lahir</div>
                                    <div class="info-value"><?= date('d F Y', strtotime($member['tanggal_lahir'])) ?>
                                    </div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Alamat</div>
                                    <div class="info-value"><?= $member['alamat'] ?></div>
                                </div>
                            </div>
                        </div>

                        <!-- Membership Information -->
                        <div>
                            <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                                <i class="fas fa-dumbbell mr-2 text-secondary"></i> Informasi Membership
                            </h3>
                            <div class="space-y-4">
                                <div class="info-row">
                                    <div class="info-label">Paket Member</div>
                                    <div class="info-value">
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
                                        $tag_class = [
                                            'har' => 'tag-harian',
                                            'bln' => 'tag-bulanan',
                                            'thn' => 'tag-tahunan',
                                            'thn2' => 'tag-tahunan',
                                            'plj' => 'tag-bulanan',
                                            'tw' => 'tag-harian'
                                        ];
                                        ?>
                                        <span class="package-tag <?= $tag_class[$member['paket_member']] ?? '' ?>">
                                            <?= $paket_label ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Mulai Member</div>
                                    <div class="info-value"><?= date('d F Y', strtotime($member['mulai_member'])) ?>
                                    </div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Durasi</div>
                                    <div class="info-value">
                                        <?php
                                        $durations = [
                                            'har' => '1 Hari',
                                            'bln' => '1 Bulan',
                                            'thn' => '1 Tahun',
                                            'thn2' => '1 Tahun',
                                            'plj' => '1 Bulan',
                                            'tw' => '1 Hari'
                                        ];
                                        echo $durations[$member['paket_member']] ?? '-';
                                        ?>
                                    </div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Terakhir Login</div>
                                    <div class="info-value">
                                        <?= $member['last_login'] ? date('d/m/Y H:i', strtotime($member['last_login'])) : 'Belum pernah login' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="detail-card p-6">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-accent"></i> Informasi Tambahan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="info-row">
                                <div class="info-label">Foto Identitas</div>
                                <div class="info-value">
                                    <?php if($member['foto_identitas']): ?>
                                    <a href="<?= base_url('uploads/identitas/' . $member['foto_identitas']) ?>"
                                        target="_blank" class="text-primary hover:text-primary-light">
                                        Lihat File
                                    </a>
                                    <?php else: ?>
                                    <span class="text-gray-400">Tidak ada</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Login Attempts</div>
                                <div class="info-value"><?= $member['login_attempts'] ?? 0 ?></div>
                            </div>
                        </div>
                        <div>
                            <div class="info-row">
                                <div class="info-label">Dibuat Pada</div>
                                <div class="info-value"><?= date('d/m/Y H:i', strtotime($member['created_at'])) ?></div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Diupdate Pada</div>
                                <div class="info-value"><?= date('d/m/Y H:i', strtotime($member['updated_at'])) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Actions & Stats -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="detail-card p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <button onclick="editMember()"
                            class="w-full bg-gradient-to-r from-primary to-secondary hover:from-primary-dark hover:to-secondary-dark text-white font-medium py-3 px-4 rounded-lg transition-colors">
                            <i class="fas fa-edit mr-2"></i> Edit Data Member
                        </button>

                        <button onclick="changeStatus()"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                            <i class="fas fa-exchange-alt mr-2"></i> Ubah Status
                        </button>

                        <button onclick="resetPassword()"
                            class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                            <i class="fas fa-key mr-2"></i> Reset Password
                        </button>

                        <button onclick="extendMembership()"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                            <i class="fas fa-calendar-plus mr-2"></i> Perpanjang Membership
                        </button>
                    </div>
                </div>

                <!-- Membership Stats -->
                <div class="detail-card p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Statistik</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="text-sm text-gray-400">Total Presensi</div>
                            <div class="text-2xl font-bold text-white">0</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-400">Total Pembayaran</div>
                            <div class="text-2xl font-bold text-white">0</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-400">Booking Aktif</div>
                            <div class="text-2xl font-bold text-white">0</div>
                        </div>
                    </div>
                </div>

                <!-- Status Update Form -->
                <div class="detail-card p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Update Status</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Status Baru</label>
                            <select id="newStatus"
                                class="w-full bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary">
                                <option value="">Pilih Status</option>
                                <option value="pending" <?= $member['status'] == 'pending' ? 'selected' : '' ?>>Pending
                                </option>
                                <option value="active" <?= $member['status'] == 'active' ? 'selected' : '' ?>>Aktif
                                </option>
                                <option value="expired" <?= $member['status'] == 'expired' ? 'selected' : '' ?>>Expired
                                </option>
                                <option value="cancelled" <?= $member['status'] == 'cancelled' ? 'selected' : '' ?>>
                                    Dibatalkan</option>
                            </select>
                        </div>
                        <button onclick="applyStatusChange()"
                            class="w-full bg-gradient-to-r from-primary to-secondary hover:from-primary-dark hover:to-secondary-dark text-white font-medium py-3 px-4 rounded-lg transition-colors">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes Section -->
        <div class="mt-8 detail-card p-6">
            <h3 class="text-lg font-bold text-white mb-4">Catatan</h3>
            <textarea
                class="w-full bg-gray-900 border border-gray-700 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-primary h-32"
                placeholder="Tambahkan catatan tentang member ini..."></textarea>
            <div class="flex justify-end mt-4">
                <button class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-6 py-2 rounded-lg">
                    Simpan Catatan
                </button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// CSRF token untuk AJAX request
const csrfToken = '<?= csrf_token() ?>';
const csrfHash = '<?= csrf_hash() ?>';

// Function to edit member
function editMember() {
    showNotification('Fitur edit akan segera tersedia', 'info');
}

// Function to focus on status dropdown
function changeStatus() {
    document.getElementById('newStatus').focus();
}

// Function to apply status change
function applyStatusChange() {
    const newStatus = document.getElementById('newStatus').value;

    if (!newStatus) {
        showNotification('Pilih status baru terlebih dahulu', 'warning');
        return;
    }

    if (!confirm(`Apakah Anda yakin ingin mengubah status member menjadi "${newStatus}"?`)) {
        return;
    }

    // Show loading state
    const button = document.querySelector('button[onclick="applyStatusChange()"]');
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
    button.disabled = true;

    // Prepare form data
    const formData = new FormData();
    formData.append('status', newStatus);
    formData.append(csrfToken, csrfHash);

    // Send AJAX request
    fetch(`/admin/members/update-status/<?= $member['id'] ?>`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update status badge on page
                updateStatusBadge(newStatus);

                // Show success notification
                showNotification(data.message || 'Status berhasil diupdate!', 'success');

                // Reset select
                document.getElementById('newStatus').value = '';
            } else {
                showNotification(data.message || 'Gagal mengupdate status', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan: ' + error.message, 'error');
        })
        .finally(() => {
            // Restore button state
            button.innerHTML = originalText;
            button.disabled = false;
        });
}

// Update status badge visually
function updateStatusBadge(newStatus) {
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
    if (newStatusData) {
        // Update all status badges on the page
        document.querySelectorAll('.status-badge').forEach(badge => {
            badge.className = `status-badge ${newStatusData.class}`;
            badge.textContent = newStatusData.text;
        });
    }
}

// Function to reset password
function resetPassword() {
    if (confirm('Reset password member? Password baru akan dikirim ke email member.')) {
        showNotification('Permintaan reset password telah dikirim', 'success');
    }
}

// Function to extend membership
function extendMembership() {
    showNotification('Fitur perpanjangan membership akan segera tersedia', 'info');
}

// Notification system
function showNotification(message, type = 'success') {
    // Remove existing notifications
    document.querySelectorAll('.custom-notification').forEach(n => n.remove());

    // Create notification
    const notification = document.createElement('div');
    notification.className = `custom-notification fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-xl animate-fade-in ${
        type === 'success' ? 'bg-green-900/90 border border-green-700 text-green-300' :
        type === 'error' ? 'bg-red-900/90 border border-red-700 text-red-300' :
        type === 'warning' ? 'bg-yellow-900/90 border border-yellow-700 text-yellow-300' :
        'bg-blue-900/90 border border-blue-700 text-blue-300'
    }`;

    const icons = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-circle',
        warning: 'fa-exclamation-triangle',
        info: 'fa-info-circle'
    };

    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${icons[type] || 'fa-info-circle'} mr-3 text-lg"></i>
            <span class="font-medium">${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-gray-400 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
}

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

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.3s ease-out;
}
`;
document.head.appendChild(style);

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    console.log('Member detail page loaded');
});

// Function to print member card
function printMemberCard() {
    showNotification('Fitur print kartu member akan segera tersedia', 'info');
}

// Function to send welcome email
function sendWelcomeEmail() {
    if (confirm('Kirim email selamat datang ke member?')) {
        // AJAX request untuk kirim email
        showNotification('Email selamat datang telah dikirim', 'success');
    }
}

// Function to save notes
function saveNotes() {
    const notesTextarea = document.querySelector('textarea');
    const notes = notesTextarea.value.trim();

    if (!notes) {
        showNotification('Tambahkan catatan terlebih dahulu', 'warning');
        return;
    }

    // Show loading
    const button = document.querySelector('button[onclick="saveNotes()"]');
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
    button.disabled = true;

    // Simulasi AJAX request
    setTimeout(() => {
        showNotification('Catatan berhasil disimpan', 'success');
        button.innerHTML = originalText;
        button.disabled = false;
    }, 1000);
}
</script>
<?= $this->endSection() ?>