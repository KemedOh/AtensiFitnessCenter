<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section id="home" class="hero-bg min-h-screen flex items-center py-20 px-4">
    <div class="container mx-auto">
        <div class="max-w-3xl mx-auto text-center animate-fade-in">
            <!-- Tagline -->
            <div
                class="inline-flex items-center space-x-2 bg-gradient-to-r from-primary/20 to-secondary/20 border border-primary/30 rounded-full py-2 px-4 mb-6">
                <span class="w-2 h-2 bg-accent rounded-full animate-pulse"></span>
                <span class="text-sm font-medium">Gym Modern & Profesional</span>
            </div>

            <!-- Headline -->
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Bangun <span class="gradient-text">Versi Terbaik</span> Dirimu di Atensi Fitness Center
            </h1>

            <!-- Subheadline -->
            <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                Transformasi tubuh dan mindset Anda dengan program latihan terstruktur, fasilitas premium, dan dukungan
                komunitas yang positif.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="<?= base_url('daftar') ?>"
                    class="bg-gradient-to-r from-primary to-secondary text-white font-bold py-4 px-8 rounded-lg text-lg hover:shadow-xl hover:shadow-primary/30 transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-user-plus mr-2"></i> Daftar Member
                </a>
                <a href="#contact"
                    class="glass-effect border border-gray-700 text-white font-bold py-4 px-8 rounded-lg text-lg hover:bg-gray-800 transition-all duration-300">
                    <i class="fas fa-phone-alt mr-2"></i> Hubungi Kami
                </a>
            </div>

            <!-- Stats -->
            <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary">500+</div>
                    <div class="text-gray-400">Member Aktif</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-secondary">15+</div>
                    <div class="text-gray-400">Trainer Profesional</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-accent">100+</div>
                    <div class="text-gray-400">Alat Modern</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary-light">5+</div>
                    <div class="text-gray-400">Tahun Pengalaman</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tentang Kami -->
<section id="about" class="py-20 px-4">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Tentang <span class="text-primary">Atensi Fitness
                    Center</span></h2>
            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mb-6"></div>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Kami lebih dari sekadar gym biasa. Di Atensi, kami membangun komunitas yang mendukung setiap perjalanan
                fitness Anda.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Gambar/Ilustrasi -->
            <div class="relative">
                <div class="w-full h-80 bg-gradient-to-br from-primary/20 to-secondary/20 rounded-2xl overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-dumbbell text-9xl text-gray-800"></i>
                    </div>
                </div>
                <div
                    class="absolute -bottom-6 -right-6 w-40 h-40 bg-gradient-to-tr from-accent/20 to-secondary/20 rounded-2xl -z-10">
                </div>
            </div>

            <!-- Konten -->
            <div>
                <h3 class="text-2xl font-bold mb-6">Fokus pada <span class="text-primary">Konsistensi</span>, <span
                        class="text-secondary">Komunitas</span>, dan <span class="text-accent">Kenyamanan</span></h3>
                <p class="text-gray-300 mb-6">
                    Atensi Fitness Center didirikan dengan visi untuk menciptakan lingkungan latihan yang aman, nyaman,
                    dan efektif bagi semua kalangan. Kami percaya bahwa transformasi fisik dimulai dari mindset yang
                    tepat.
                </p>
                <p class="text-gray-300 mb-6">
                    Dengan fasilitas modern, trainer berpengalaman, dan program yang terpersonalisasi, kami siap
                    membantu Anda mencapai target fitness apapun - dari penurunan berat badan, pembentukan otot, hingga
                    peningkatan kebugaran secara menyeluruh.
                </p>

                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Program Personalisasi</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Trainer Bersertifikat</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Lingkungan Positif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fasilitas Unggulan -->
<section id="facilities" class="py-20 px-4 bg-dark-light">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Fasilitas <span class="text-primary">Unggulan</span></h2>
            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mb-6"></div>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Nikmati pengalaman fitness terbaik dengan fasilitas modern dan lengkap yang dirancang untuk kenyamanan
                dan efektivitas latihan Anda.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($fasilitas as $item): ?>
            <div
                class="glass-effect p-6 rounded-2xl hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 animate-slide-up">
                <div class="text-4xl mb-4"><?= $item['icon'] ?></div>
                <h3 class="text-xl font-bold mb-3"><?= $item['judul'] ?></h3>
                <p class="text-gray-400"><?= $item['deskripsi'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Program & Paket Member -->
<section id="packages" class="py-20 px-4">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Program & <span class="text-primary">Paket Member</span>
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mb-6"></div>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Pilih paket membership yang sesuai dengan kebutuhan dan budget Anda. Semua paket sudah termasuk akses ke
                semua fasilitas gym.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach($paket_member as $paket): ?>
            <div
                class="glass-effect rounded-2xl overflow-hidden border <?= $paket['populer'] ? 'border-primary shadow-2xl shadow-primary/20 relative' : 'border-gray-800' ?> transform hover:-translate-y-2 transition-all duration-300">
                <?php if($paket['populer']): ?>
                <div
                    class="absolute top-0 left-0 right-0 bg-gradient-to-r from-primary to-secondary text-center py-2 text-sm font-bold">
                    <i class="fas fa-crown mr-2"></i> PAKET TERPOPULER
                </div>
                <?php endif; ?>

                <div class="p-6 <?= $paket['populer'] ? 'pt-12' : '' ?>">
                    <h3 class="text-2xl font-bold mb-2"><?= $paket['nama'] ?></h3>
                    <div class="flex items-baseline mb-6">
                        <span class="text-4xl font-bold">Rp<?= $paket['harga'] ?></span>
                        <span class="text-gray-400 ml-2"><?= $paket['periode'] ?></span>
                    </div>

                    <ul class="space-y-3 mb-8">
                        <?php foreach($paket['fitur'] as $fitur): ?>
                        <li class="flex items-start">
                            <i class="fas fa-check text-accent mr-2 mt-1"></i>
                            <span><?= $fitur ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <a href="#contact"
                        class="block text-center <?= $paket['populer'] ? 'bg-gradient-to-r from-primary to-secondary' : 'bg-gray-800 hover:bg-gray-700' ?> text-white font-bold py-3 rounded-lg transition-colors">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Kenapa Atensi Fitness Center -->
<section class="py-20 px-4 bg-dark-light">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Kenapa Memilih <span class="text-primary">Atensi?</span>
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mb-6"></div>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Kami berbeda dari gym lainnya karena fokus kami tidak hanya pada fasilitas, tapi juga pada pengalaman
                dan hasil member.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach($keunggulan as $item): ?>
            <div class="text-center p-6">
                <div class="text-4xl mb-4"><?= $item['icon'] ?></div>
                <h3 class="text-xl font-bold mb-3"><?= $item['judul'] ?></h3>
                <p class="text-gray-400"><?= $item['deskripsi'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Testimoni Member -->
<section id="testimonials" class="py-20 px-4">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Testimoni <span class="text-primary">Member</span></h2>
            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mb-6"></div>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Lihat pengalaman dan hasil yang dicapai oleh member Atensi Fitness Center.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php foreach($testimoni as $item): ?>
            <div class="glass-effect p-6 rounded-2xl">
                <div class="flex items-center mb-6">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold mr-4">
                        <?= substr($item['nama'], 0, 1) ?>
                    </div>
                    <div>
                        <h4 class="font-bold"><?= $item['nama'] ?></h4>
                        <p class="text-sm text-gray-400"><?= $item['role'] ?></p>
                        <div class="text-sm text-accent font-medium"><?= $item['hasil'] ?></div>
                    </div>
                </div>

                <p class="text-gray-300 italic mb-4">"<?= $item['kutipan'] ?>"</p>

                <div class="flex text-yellow-400">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call To Action (Closing) -->
<section class="py-20 px-4 bg-gradient-to-br from-dark to-primary/20">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Tidak Ada Kata <span class="gradient-text">Terlambat</span>
            Untuk Mulai</h2>
        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
            Langkah pertama adalah yang terberat. Biarkan kami membantu Anda memulai perjalanan fitness dengan cara yang
            benar.
        </p>

        <a href="#contact"
            class="inline-block bg-gradient-to-r from-primary to-secondary text-white font-bold py-4 px-12 rounded-lg text-lg hover:shadow-2xl hover:shadow-primary/30 transition-all duration-300 transform hover:scale-105 animate-pulse-slow">
            <i class="fas fa-user-plus mr-3"></i> Gabung Sekarang
        </a>
    </div>
</section>

<script>
// Animasi saat scroll
function animateOnScroll() {
    const elements = document.querySelectorAll('.animate-slide-up');

    elements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;

        if (elementTop < windowHeight - 100) {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }
    });
}

// Set initial state for animated elements
document.querySelectorAll('.animate-slide-up').forEach(element => {
    element.style.opacity = '0';
    element.style.transform = 'translateY(20px)';
    element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
});

// Trigger animation on load and scroll
window.addEventListener('load', animateOnScroll);
window.addEventListener('scroll', animateOnScroll);
</script>

<?= $this->endSection() ?>