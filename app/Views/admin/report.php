<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<style>
.report-card {
    background: rgba(30, 41, 59, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.75rem;
    transition: all 0.3s ease;
}

.report-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(220, 38, 38, 0.2);
}

.filter-btn {
    background: rgba(30, 41, 59, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.5rem;
    color: #9ca3af;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
}

.filter-btn:hover,
.filter-btn.active {
    background: #dc2626;
    color: white;
    border-color: #dc2626;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(90deg, #f97316, #dc2626);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.stat-trend {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.5rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
}

.trend-up {
    background: rgba(34, 197, 94, 0.2);
    color: #86efac;
}

.trend-down {
    background: rgba(239, 68, 68, 0.2);
    color: #fca5a5;
}

.simple-chart {
    height: 200px;
    display: flex;
    align-items: flex-end;
    gap: 4px;
    padding: 1rem 0;
}

.chart-bar {
    flex: 1;
    background: linear-gradient(to top, #dc2626, #f97316);
    border-radius: 4px 4px 0 0;
    min-height: 10px;
    transition: height 0.5s ease;
}

.chart-label {
    text-align: center;
    font-size: 0.75rem;
    color: #9ca3af;
    margin-top: 0.5rem;
}

.progress-bar {
    height: 0.5rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 9999px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    border-radius: 9999px;
    background: linear-gradient(90deg, #dc2626, #f97316);
    transition: width 1s ease-in-out;
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
                <?php if(session()->get('is_superadmin')): ?>
                <a href="<?= base_url('/admin/admins') ?>"
                    class="flex items-center px-3 py-2 text-sm font-medium <?= strpos(current_url(), '/admin/admins') !== false ? 'text-primary border-b-2 border-primary' : 'text-gray-300 hover:text-white' ?>">
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
                            <span class="text-sm text-white">Laporan & Analytics</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Laporan & Analytics</h1>
                <p class="text-gray-400">Analisis data dan statistik Atensi Fitness Center</p>
            </div>

            <!-- Export Buttons -->
            <div class="flex space-x-2">
                <button onclick="exportPDF()"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </button>
                <button onclick="exportExcel()"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                    <i class="fas fa-file-excel mr-2"></i> Export Excel
                </button>
            </div>
        </div>

        <!-- Time Filter -->
        <div class="flex flex-wrap gap-2 mb-8">
            <button class="filter-btn active" onclick="filterReports('today')">Hari Ini</button>
            <button class="filter-btn" onclick="filterReports('week')">Minggu Ini</button>
            <button class="filter-btn" onclick="filterReports('month')">Bulan Ini</button>
            <button class="filter-btn" onclick="filterReports('quarter')">Kuartal Ini</button>
            <button class="filter-btn" onclick="filterReports('year')">Tahun Ini</button>
        </div>

        <!-- Key Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Members -->
            <div class="report-card p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-gray-400 text-sm">Total Member</p>
                        <div class="stat-number"><?= number_format($total_members ?? 0) ?></div>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-blue-400 text-xl"></i>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm <?= ($member_growth ?? 0) >= 0 ? 'text-green-400' : 'text-red-400' ?>">
                        <i class="fas fa-arrow-<?= ($member_growth ?? 0) >= 0 ? 'up' : 'down' ?> mr-1"></i>
                        <?= abs($member_growth ?? 0) ?>% dari bulan lalu
                    </span>
                    <span class="stat-trend <?= ($member_growth ?? 0) >= 0 ? 'trend-up' : 'trend-down' ?>">
                        <?= ($member_growth ?? 0) >= 0 ? '+' : '' ?><?= $member_growth ?? 0 ?>%
                    </span>
                </div>
            </div>

            <!-- Active Members -->
            <div class="report-card p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-gray-400 text-sm">Member Aktif</p>
                        <div class="stat-number"><?= number_format($active_members ?? 0) ?></div>
                    </div>
                    <div class="w-12 h-12 bg-green-500/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-check text-green-400 text-xl"></i>
                    </div>
                </div>
                <div class="progress-bar mb-2">
                    <div class="progress-fill" style="width: <?= $active_percentage ?? 0 ?>%"></div>
                </div>
                <p class="text-sm text-gray-400"><?= $active_percentage ?? 0 ?>% dari total member</p>
            </div>

            <!-- New Members This Month -->
            <div class="report-card p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-gray-400 text-sm">Member Baru (Bulan Ini)</p>
                        <div class="stat-number"><?= number_format($new_members_this_month ?? 0) ?></div>
                    </div>
                    <div class="w-12 h-12 bg-purple-500/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-plus text-purple-400 text-xl"></i>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-full pr-4">
                        <div class="flex justify-between text-xs text-gray-400 mb-1">
                            <span>Target: <?= number_format($monthly_target ?? 0) ?></span>
                            <span><?= $target_percentage ?? 0 ?>%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?= $target_percentage ?? 0 ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Average Attendance -->
            <div class="report-card p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-gray-400 text-sm">Rata-rata Presensi/Hari</p>
                        <div class="stat-number"><?= number_format($avg_daily_attendance ?? 0, 1) ?></div>
                    </div>
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar-check text-yellow-400 text-xl"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-400">
                    <?= ($attendance_growth ?? 0) >= 0 ? '↑' : '↓' ?>
                    <?= abs($attendance_growth ?? 0) ?>% dari minggu lalu
                </p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Member Growth Chart -->
            <div class="report-card p-6">
                <h3 class="text-lg font-bold text-white mb-4">Pertumbuhan Member (6 Bulan Terakhir)</h3>
                <div class="simple-chart" id="memberGrowthChart">
                    <?php 
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
                    $growthData = [45, 52, 48, 60, 55, 65]; // Example data
                    $maxValue = max($growthData);
                    ?>
                    <?php foreach($growthData as $index => $value): ?>
                    <div class="chart-column">
                        <div class="chart-bar" style="height: <?= ($value / $maxValue) * 100 ?>%"></div>
                        <div class="chart-label"><?= $months[$index] ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-sm text-gray-400 mt-4">
                    <i class="fas fa-info-circle mr-1"></i>
                    Trend pertumbuhan member menunjukkan peningkatan konsisten
                </div>
            </div>

            <!-- Membership Packages -->
            <div class="report-card p-6">
                <h3 class="text-lg font-bold text-white mb-4">Distribusi Paket Membership</h3>
                <div class="space-y-4">
                    <?php 
                    $packages = [
                        ['name' => 'Bulanan', 'count' => $package_stats['monthly_count'] ?? 120, 'percentage' => $package_stats['monthly'] ?? 40, 'color' => 'bg-blue-500'],
                        ['name' => 'Tahunan', 'count' => $package_stats['yearly_count'] ?? 80, 'percentage' => $package_stats['yearly'] ?? 27, 'color' => 'bg-green-500'],
                        ['name' => 'Harian', 'count' => $package_stats['daily_count'] ?? 45, 'percentage' => $package_stats['daily'] ?? 15, 'color' => 'bg-purple-500'],
                        ['name' => 'Pelajar', 'count' => $package_stats['student_count'] ?? 35, 'percentage' => $package_stats['student'] ?? 12, 'color' => 'bg-yellow-500'],
                        ['name' => 'Lainnya', 'count' => $package_stats['other_count'] ?? 20, 'percentage' => $package_stats['other'] ?? 6, 'color' => 'bg-gray-500']
                    ];
                    ?>
                    <?php foreach($packages as $package): ?>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-300"><?= $package['name'] ?></span>
                            <span class="text-white font-medium"><?= $package['percentage'] ?>%
                                (<?= $package['count'] ?>)</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill <?= $package['color'] ?>"
                                style="width: <?= $package['percentage'] ?>%"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Registration Trend -->
            <div class="report-card p-6">
                <h3 class="text-lg font-bold text-white mb-4">Trend Registrasi Tahun <?= date('Y') ?></h3>
                <div class="simple-chart" id="registrationChart">
                    <?php 
                    $registrationData = [30, 45, 35, 50, 40, 55, 60, 65, 70, 75, 80, 85]; // Example data
                    $regMaxValue = max($registrationData);
                    ?>
                    <?php foreach($registrationData as $index => $value): ?>
                    <div class="chart-column">
                        <div class="chart-bar"
                            style="height: <?= ($value / $regMaxValue) * 100 ?>%; background: linear-gradient(to top, #10b981, #34d399)">
                        </div>
                        <div class="chart-label"><?= $index + 1 ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-sm text-green-400 mt-4">
                    <i class="fas fa-chart-line mr-1"></i>
                    <?= $registration_growth ?? 25 ?>% growth YoY
                </div>
            </div>

            <!-- Member Status -->
            <div class="report-card p-6">
                <h3 class="text-lg font-bold text-white mb-4">Status Member</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-4 bg-gray-800/30 rounded-lg">
                        <div class="text-3xl font-bold text-green-400"><?= $status_stats['active'] ?? 0 ?></div>
                        <div class="text-sm text-gray-400">Aktif</div>
                    </div>
                    <div class="text-center p-4 bg-gray-800/30 rounded-lg">
                        <div class="text-3xl font-bold text-yellow-400"><?= $status_stats['pending'] ?? 0 ?></div>
                        <div class="text-sm text-gray-400">Pending</div>
                    </div>
                    <div class="text-center p-4 bg-gray-800/30 rounded-lg">
                        <div class="text-3xl font-bold text-red-400"><?= $status_stats['expired'] ?? 0 ?></div>
                        <div class="text-sm text-gray-400">Expired</div>
                    </div>
                    <div class="text-center p-4 bg-gray-800/30 rounded-lg">
                        <div class="text-3xl font-bold text-gray-400"><?= $status_stats['cancelled'] ?? 0 ?></div>
                        <div class="text-sm text-gray-400">Dibatalkan</div>
                    </div>
                </div>
                <div class="mt-4 p-3 bg-gray-800/30 rounded-lg">
                    <div class="text-sm text-gray-400 mb-2">Retention Rate</div>
                    <div class="flex items-center justify-between">
                        <div class="text-2xl font-bold text-green-400"><?= $retention_rate ?? 85 ?>%</div>
                        <div class="text-right">
                            <div class="text-xs text-gray-400">Bulan lalu: <?= $last_month_retention ?? 82 ?>%</div>
                            <div
                                class="text-xs <?= ($retention_change ?? 0) >= 0 ? 'text-green-400' : 'text-red-400' ?>">
                                <?= ($retention_change ?? 0) >= 0 ? '↑' : '↓' ?> <?= abs($retention_change ?? 0) ?>%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Reports -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Activities -->
            <div class="report-card p-6">
                <h3 class="text-lg font-bold text-white mb-4">Aktivitas Terbaru</h3>
                <div class="space-y-4">
                    <?php foreach($recent_activities as $activity): ?>
                    <div class="flex items-start p-3 bg-gray-800/30 rounded-lg">
                        <div
                            class="w-10 h-10 <?= $activity['bg_color'] ?> rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="<?= $activity['icon'] ?> <?= $activity['icon_color'] ?>"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-white"><?= $activity['description'] ?></p>
                            <p class="text-xs text-gray-400 mt-1">
                                <i class="fas fa-clock mr-1"></i><?= $activity['time'] ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="report-card p-6">
                <h3 class="text-lg font-bold text-white mb-4">Statistik Cepat</h3>
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-3 bg-gray-800/30 rounded-lg text-center">
                            <div class="text-xl font-bold text-white"><?= $peak_hour ?? '17:00' ?></div>
                            <div class="text-xs text-gray-400">Jam Puncak</div>
                        </div>
                        <div class="p-3 bg-gray-800/30 rounded-lg text-center">
                            <div class="text-xl font-bold text-white"><?= $avg_age ?? 28 ?></div>
                            <div class="text-xs text-gray-400">Rata-rata Usia</div>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-800/30 rounded-lg">
                        <div class="text-sm text-gray-400 mb-2">Gender Ratio</div>
                        <div class="flex items-center justify-between">
                            <div class="text-center">
                                <div class="text-lg font-bold text-blue-400"><?= $gender_ratio['male'] ?? 65 ?>%</div>
                                <div class="text-xs text-gray-400">Pria</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-pink-400"><?= $gender_ratio['female'] ?? 32 ?>%</div>
                                <div class="text-xs text-gray-400">Wanita</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-gray-400"><?= $gender_ratio['other'] ?? 3 ?>%</div>
                                <div class="text-xs text-gray-400">Lainnya</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-800/30 rounded-lg">
                        <div class="text-sm text-gray-400 mb-2">Top Trainer</div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-dumbbell text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-white">John Doe</div>
                                    <div class="text-xs text-gray-400">45 sessions</div>
                                </div>
                            </div>
                            <span class="text-yellow-400">
                                <i class="fas fa-star"></i> 4.9
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Help Text -->
        <div class="mt-8 p-4 bg-blue-900/20 border border-blue-700/30 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-blue-400 mr-3"></i>
                <div>
                    <p class="text-sm text-blue-300">
                        <strong>Tips:</strong> Data diperbarui setiap hari secara otomatis.
                        Klik filter periode untuk melihat data berdasarkan waktu tertentu.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Filter functionality
function filterReports(period) {
    // Update active button
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');

    // Show loading
    showNotification(`Memuat data untuk ${getPeriodName(period)}...`, 'info');

    // In real implementation, you would make an AJAX call here
    // fetch(`/admin/reports/filter/${period}`).then(...)

    // Simulate loading
    setTimeout(() => {
        showNotification(`Data ${getPeriodName(period)} berhasil dimuat`, 'success');
    }, 1000);
}

function getPeriodName(period) {
    const names = {
        'today': 'Hari Ini',
        'week': 'Minggu Ini',
        'month': 'Bulan Ini',
        'quarter': 'Kuartal Ini',
        'year': 'Tahun Ini'
    };
    return names[period] || period;
}

// Export functions
function exportPDF() {
    showNotification('Membuat laporan PDF...', 'info');
    // Simulate PDF generation
    setTimeout(() => {
        showNotification('Laporan PDF berhasil dibuat!', 'success');
        // In real implementation, trigger download
        // window.open('/admin/reports/export/pdf');
    }, 1500);
}

function exportExcel() {
    showNotification('Membuat laporan Excel...', 'info');
    // Simulate Excel generation
    setTimeout(() => {
        showNotification('Laporan Excel berhasil dibuat!', 'success');
        // In real implementation, trigger download
        // window.open('/admin/reports/export/excel');
    }, 1500);
}

// Simple chart animation
document.addEventListener('DOMContentLoaded', function() {
    // Animate chart bars
    setTimeout(() => {
        document.querySelectorAll('.chart-bar').forEach(bar => {
            const height = bar.style.height;
            bar.style.height = '0%';
            setTimeout(() => {
                bar.style.height = height;
            }, 100);
        });
    }, 500);

    // Animate progress bars
    setTimeout(() => {
        document.querySelectorAll('.progress-fill').forEach(fill => {
            const width = fill.style.width;
            fill.style.width = '0%';
            setTimeout(() => {
                fill.style.width = width;
            }, 200);
        });
    }, 800);
});

// Notification system
function showNotification(message, type = 'success') {
    // Remove existing notifications
    document.querySelectorAll('.custom-notification').forEach(n => n.remove());

    // Create notification
    const notification = document.createElement('div');
    notification.className = `custom-notification fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg ${
        type === 'success' ? 'bg-green-900 text-green-300' :
        type === 'error' ? 'bg-red-900 text-red-300' :
        'bg-blue-900 text-blue-300'
    }`;

    const icons = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-circle',
        info: 'fa-info-circle'
    };

    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${icons[type] || 'fa-info-circle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;

    document.body.appendChild(notification);

    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Add CSS for notifications
const style = document.createElement('style');
style.textContent = `
.custom-notification {
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

.chart-column {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}
`;
document.head.appendChild(style);

// Click notification to dismiss
document.addEventListener('click', function(e) {
    if (e.target.closest('.custom-notification')) {
        e.target.closest('.custom-notification').remove();
    }
});

console.log('Reports page loaded successfully');
</script>
<?= $this->endSection() ?>