<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Member Area - Atensi Fitness Center' ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
    :root {
        --primary: #dc2626;
        --primary-light: #f87171;
        --primary-dark: #991b1b;
        --secondary: #f97316;
        --accent: #84cc16;
        --dark: #0f172a;
        --dark-light: #1e293b;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--dark);
        color: #f8fafc;
    }

    .glass-effect {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .gradient-text {
        background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .sidebar {
        transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }
    }

    .sidebar-item.active {
        background: linear-gradient(90deg, rgba(220, 38, 38, 0.2), rgba(249, 115, 22, 0.1));
        border-right: 3px solid var(--primary);
    }

    .sidebar-item:hover {
        background: rgba(255, 255, 255, 0.05);
    }
    </style>

    <?= $this->renderSection('styles') ?>
</head>

<body class="font-inter">
    <!-- Mobile Menu Button -->
    <button id="mobileMenuBtn" class="md:hidden fixed top-4 left-4 z-50 bg-primary text-white p-3 rounded-lg shadow-lg">
        <i class="fas fa-bars"></i>
    </button>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="sidebar w-64 bg-dark-light shadow-xl fixed md:relative h-full z-40">
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-gray-800">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center">
                        <i class="fas fa-dumbbell text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">Atensi <span class="text-primary">Fitness</span></h2>
                        <p class="text-xs text-gray-400">Member Area</p>
                    </div>
                </div>
            </div>

            <!-- User Info -->
            <div class="p-6 border-b border-gray-800">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold text-xl">
                        <?= strtoupper(substr(session()->get('member_nama'), 0, 1)) ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-white truncate"><?= session()->get('member_nama') ?></p>
                        <p class="text-sm text-gray-400 truncate"><?= session()->get('member_email') ?></p>
                        <p class="text-xs text-gray-400 mt-1">
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full bg-green-900/50 text-green-300 text-xs">
                                <i class="fas fa-circle mr-1" style="font-size: 6px;"></i>
                                <?= ucfirst(session()->get('member_status')) ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <a href="<?= base_url('member/dashboard') ?>"
                    class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= ($page ?? '') == 'dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>

                <a href="<?= base_url('member/profile') ?>"
                    class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= ($page ?? '') == 'profile' ? 'active' : '' ?>">
                    <i class="fas fa-user w-5 text-center"></i>
                    <span>Profile Saya</span>
                </a>

                <a href="<?= base_url('member/membership') ?>"
                    class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= ($page ?? '') == 'membership' ? 'active' : '' ?>">
                    <i class="fas fa-id-card w-5 text-center"></i>
                    <span>Keanggotaan</span>
                </a>

                <a href="<?= base_url('member/attendance') ?>"
                    class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= ($page ?? '') == 'attendance' ? 'active' : '' ?>">
                    <i class="fas fa-calendar-check w-5 text-center"></i>
                    <span>Presensi</span>
                </a>

                <a href="<?= base_url('member/bookings') ?>"
                    class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= ($page ?? '') == 'bookings' ? 'active' : '' ?>">
                    <i class="fas fa-calendar-alt w-5 text-center"></i>
                    <span>Booking</span>
                </a>

                <div class="pt-4 mt-4 border-t border-gray-800">
                    <a href="<?= base_url('/') ?>" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg">
                        <i class="fas fa-globe w-5 text-center"></i>
                        <span>Website Utama</span>
                    </a>

                    <a href="<?= base_url('auth/logout') ?>"
                        class="sidebar-item flex items-center space-x-3 p-3 rounded-lg text-red-400 hover:text-red-300">
                        <i class="fas fa-sign-out-alt w-5 text-center"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </nav>

            <!-- Sidebar Footer -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-800">
                <p class="text-xs text-gray-500 text-center">
                    &copy; <?= date('Y') ?> Atensi Fitness Center
                </p>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-dark">
            <!-- Top Bar -->
            <div class="glass-effect sticky top-0 z-30 p-4 flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-bold"><?= $title ?? 'Member Area' ?></h1>
                    <p class="text-sm text-gray-400"><?= date('l, d F Y') ?></p>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Notification Bell -->
                    <button class="relative p-2 text-gray-400 hover:text-white">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- Quick Menu -->
                    <div class="relative">
                        <button id="userMenuBtn" class="flex items-center space-x-2 text-gray-300 hover:text-white">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-semibold">
                                <?= strtoupper(substr(session()->get('member_nama'), 0, 1)) ?>
                            </div>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userMenu"
                            class="absolute right-0 mt-2 w-48 bg-dark-light rounded-lg shadow-xl border border-gray-800 hidden">
                            <div class="p-4 border-b border-gray-800">
                                <p class="font-semibold"><?= session()->get('member_nama') ?></p>
                                <p class="text-sm text-gray-400 truncate"><?= session()->get('member_email') ?></p>
                            </div>
                            <div class="p-2">
                                <a href="<?= base_url('member/profile') ?>"
                                    class="flex items-center space-x-2 p-2 rounded hover:bg-gray-800">
                                    <i class="fas fa-user w-5"></i>
                                    <span>Profile</span>
                                </a>
                                <a href="<?= base_url('member/membership') ?>"
                                    class="flex items-center space-x-2 p-2 rounded hover:bg-gray-800">
                                    <i class="fas fa-id-card w-5"></i>
                                    <span>Keanggotaan</span>
                                </a>
                                <div class="border-t border-gray-800 mt-2 pt-2">
                                    <a href="<?= base_url('auth/logout') ?>"
                                        class="flex items-center space-x-2 p-2 rounded text-red-400 hover:bg-red-900/20">
                                        <i class="fas fa-sign-out-alt w-5"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div>
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

    <!-- JavaScript -->
    <script>
    // Mobile Menu Toggle
    document.getElementById('mobileMenuBtn').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('active');
        this.innerHTML = document.querySelector('.sidebar').classList.contains('active') ?
            '<i class="fas fa-times"></i>' :
            '<i class="fas fa-bars"></i>';
    });

    // User Menu Toggle
    document.getElementById('userMenuBtn').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('userMenu').classList.toggle('hidden');
    });

    // Close menus when clicking outside
    document.addEventListener('click', function(e) {
        const userMenu = document.getElementById('userMenu');
        const userMenuBtn = document.getElementById('userMenuBtn');

        if (!userMenu.contains(e.target) && !userMenuBtn.contains(e.target)) {
            userMenu.classList.add('hidden');
        }

        // Close mobile menu on content click
        if (window.innerWidth < 768) {
            const sidebar = document.querySelector('.sidebar');
            const mobileBtn = document.getElementById('mobileMenuBtn');

            if (sidebar.classList.contains('active') &&
                !sidebar.contains(e.target) &&
                !mobileBtn.contains(e.target)) {
                sidebar.classList.remove('active');
                mobileBtn.innerHTML = '<i class="fas fa-bars"></i>';
            }
        }
    });

    // Active sidebar item
    document.querySelectorAll('.sidebar-item').forEach(item => {
        item.addEventListener('click', function() {
            // On mobile, close sidebar after click
            if (window.innerWidth < 768) {
                document.querySelector('.sidebar').classList.remove('active');
                document.getElementById('mobileMenuBtn').innerHTML = '<i class="fas fa-bars"></i>';
            }
        });
    });

    // Auto-hide mobile menu on resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            document.querySelector('.sidebar').classList.remove('active');
            document.getElementById('mobileMenuBtn').innerHTML = '<i class="fas fa-bars"></i>';
        }
    });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>