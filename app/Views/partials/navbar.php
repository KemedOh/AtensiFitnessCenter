<nav class="sticky top-0 z-50 glass-effect py-4 px-6 shadow-xl">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <div
                class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center">
                <i class="fas fa-dumbbell text-white"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold">Atensi <span class="text-primary">Fitness</span></h1>
                <p class="text-xs text-gray-400">Center</p>
            </div>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-8">
            <a href="#home" class="text-gray-300 hover:text-primary transition-colors font-medium">Home</a>
            <a href="#about" class="text-gray-300 hover:text-primary transition-colors font-medium">Tentang</a>
            <a href="#facilities" class="text-gray-300 hover:text-primary transition-colors font-medium">Fasilitas</a>
            <a href="#packages" class="text-gray-300 hover:text-primary transition-colors font-medium">Paket</a>

            <!-- Auth Buttons untuk Desktop -->
            <div class="flex items-center space-x-4 ml-4">
                <?php if(session()->get('member_logged_in')): ?>
                <a href="<?= base_url('member/dashboard') ?>"
                    class="text-gray-300 hover:text-primary transition-colors font-medium">
                    <i class="fas fa-user mr-1"></i> Dashboard
                </a>
                <a href="<?= base_url('auth/logout') ?>"
                    class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                    Logout
                </a>
                <?php else: ?>
                <a href="<?= base_url('auth/login') ?>"
                    class="text-gray-300 hover:text-primary transition-colors font-medium">
                    <i class="fas fa-sign-in-alt mr-1"></i> Login
                </a>
                <a href="<?= base_url('daftar') ?>"
                    class="bg-gradient-to-r from-primary to-secondary hover:from-primary-dark hover:to-secondary-dark text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                    <i class="fas fa-user-plus mr-1"></i> Daftar Member
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobileMenuBtn" class="md:hidden text-gray-300 text-xl">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobileMenu" class="md:hidden hidden mt-4 pb-4 border-t border-gray-800 pt-4">
        <div class="container mx-auto flex flex-col space-y-4">
            <a href="#home" class="text-gray-300 hover:text-primary transition-colors font-medium py-2">
                <i class="fas fa-home mr-2 w-5 text-center"></i> Home
            </a>
            <a href="#about" class="text-gray-300 hover:text-primary transition-colors font-medium py-2">
                <i class="fas fa-info-circle mr-2 w-5 text-center"></i> Tentang
            </a>
            <a href="#facilities" class="text-gray-300 hover:text-primary transition-colors font-medium py-2">
                <i class="fas fa-dumbbell mr-2 w-5 text-center"></i> Fasilitas
            </a>
            <a href="#packages" class="text-gray-300 hover:text-primary transition-colors font-medium py-2">
                <i class="fas fa-tags mr-2 w-5 text-center"></i> Paket
            </a>
            <a href="#contact" class="text-gray-300 hover:text-primary transition-colors font-medium py-2">
                <i class="fas fa-phone-alt mr-2 w-5 text-center"></i> Kontak
            </a>

            <!-- Auth Buttons untuk Mobile -->
            <div class="pt-4 border-t border-gray-800 space-y-3">
                <?php if(session()->get('member_logged_in')): ?>
                <a href="<?= base_url('member/dashboard') ?>"
                    class="block text-center bg-gray-800 hover:bg-gray-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors">
                    <i class="fas fa-user mr-2"></i> Dashboard
                </a>
                <a href="<?= base_url('auth/logout') ?>"
                    class="block text-center bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-4 rounded-lg transition-colors">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
                <?php else: ?>
                <a href="<?= base_url('auth/login') ?>"
                    class="block text-center bg-gray-800 hover:bg-gray-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
                <a href="<?= base_url('daftar') ?>"
                    class="block text-center bg-gradient-to-r from-primary to-secondary hover:from-primary-dark hover:to-secondary-dark text-white font-semibold py-3 px-4 rounded-lg transition-colors">
                    <i class="fas fa-user-plus mr-2"></i> Daftar Member
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script>
// Mobile Menu Toggle
document.getElementById('mobileMenuBtn').addEventListener('click', function() {
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('hidden');

    // Ganti icon menu
    const icon = this.querySelector('i');
    if (icon.classList.contains('fa-bars')) {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-times');
    } else {
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
    }
});

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');

    if (!mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
        mobileMenu.classList.add('hidden');
        const icon = mobileMenuBtn.querySelector('i');
        if (icon.classList.contains('fa-times')) {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    }
});

// Close mobile menu when clicking a link
document.querySelectorAll('#mobileMenu a').forEach(link => {
    link.addEventListener('click', function() {
        document.getElementById('mobileMenu').classList.add('hidden');
        const icon = document.getElementById('mobileMenuBtn').querySelector('i');
        if (icon.classList.contains('fa-times')) {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();

        const targetId = this.getAttribute('href');
        if (targetId === '#') return;

        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            // Close mobile menu if open
            const mobileMenu = document.getElementById('mobileMenu');
            const menuBtnIcon = document.querySelector('#mobileMenuBtn i');
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                menuBtnIcon.classList.remove('fa-times');
                menuBtnIcon.classList.add('fa-bars');
            }

            // Smooth scroll
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    });
});
</script>