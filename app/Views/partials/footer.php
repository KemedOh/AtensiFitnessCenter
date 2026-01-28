<!-- Footer -->
<footer id="contact" class="pt-16 pb-8 px-4 bg-dark-light">
    <div class="container mx-auto">
        <div class="grid md:grid-cols-4 gap-8 mb-12">
            <!-- Brand Info -->
            <div>
                <div class="flex items-center space-x-2 mb-6">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center">
                        <i class="fas fa-dumbbell text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">Atensi <span class="text-primary">Fitness</span></h2>
                        <p class="text-sm text-gray-400">Center</p>
                    </div>
                </div>
                <p class="text-gray-400 mb-6">
                    Gym modern dengan fasilitas lengkap, trainer profesional, dan komunitas yang mendukung untuk
                    membantu Anda mencapai versi terbaik diri.
                </p>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="text-xl font-bold mb-6">Kontak Kami</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt text-primary mr-3 mt-1"></i>
                        <span class="text-gray-400">Jl. Fitness Sehat No. 123, Jakarta Selatan</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-phone-alt text-primary mr-3 mt-1"></i>
                        <span class="text-gray-400">(021) 1234-5678</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-envelope text-primary mr-3 mt-1"></i>
                        <span class="text-gray-400">info@atensifitness.com</span>
                    </li>
                </ul>
            </div>

            <!-- Jam Operasional -->
            <div>
                <h3 class="text-xl font-bold mb-6">Jam Operasional</h3>
                <ul class="space-y-3">
                    <li class="flex justify-between">
                        <span class="text-gray-400">Senin - Jumat</span>
                        <span class="font-medium">05:00 - 22:00</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-400">Sabtu</span>
                        <span class="font-medium">06:00 - 20:00</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-400">Minggu</span>
                        <span class="font-medium">07:00 - 18:00</span>
                    </li>
                </ul>
            </div>

            <!-- Sosial Media -->
            <div>
                <h3 class="text-xl font-bold mb-6">Ikuti Kami</h3>
                <div class="flex space-x-4 mb-6">
                    <a href="#"
                        class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                    <a href="#"
                        class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#"
                        class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#"
                        class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-red-600 transition-colors">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div>

                <!-- Form Pendaftaran Dummy -->
                <div class="glass-effect p-4 rounded-lg">
                    <h4 class="font-bold mb-3">Daftar Newsletter</h4>
                    <div class="flex">
                        <input type="email" placeholder="Email Anda"
                            class="flex-grow bg-gray-900 text-white py-2 px-3 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <button
                            class="bg-primary text-white py-2 px-4 rounded-r-lg hover:bg-primary-dark transition-colors">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="pt-8 border-t border-gray-800 text-center text-gray-500 text-sm">
            <p>&copy; <?= date('Y') ?> Atensi Fitness Center. All rights reserved.</p>
            <p class="mt-2">Dibuat dengan <i class="fas fa-heart text-primary"></i> untuk komunitas fitness Indonesia
            </p>
        </div>
    </div>
</footer>