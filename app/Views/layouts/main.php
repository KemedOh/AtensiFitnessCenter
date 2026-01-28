<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atensi Fitness Center - Bangun Versi Terbaik Dirimu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#dc2626',
                    'primary-light': '#f87171',
                    'primary-dark': '#991b1b',
                    secondary: '#f97316',
                    accent: '#84cc16',
                    dark: '#0f172a',
                    'dark-light': '#1e293b',
                },
                fontFamily: {
                    'inter': ['Inter', 'sans-serif']
                },
                animation: {
                    'pulse-slow': 'pulse 3s infinite',
                    'fade-in': 'fadeIn 1s ease-in-out',
                    'slide-up': 'slideUp 0.5s ease-out'
                },
                keyframes: {
                    fadeIn: {
                        '0%': {
                            opacity: '0'
                        },
                        '100%': {
                            opacity: '1'
                        }
                    },
                    slideUp: {
                        '0%': {
                            transform: 'translateY(10px)',
                            opacity: '0'
                        },
                        '100%': {
                            transform: 'translateY(0)',
                            opacity: '1'
                        }
                    }
                }
            }
        }
    }
    </script>
    <style>
    html {
        scroll-behavior: smooth;
        font-family: 'Inter', sans-serif;
    }

    body {
        background-color: #0f172a;
        color: #f8fafc;
    }

    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #1e293b;
    }

    ::-webkit-scrollbar-thumb {
        background: #dc2626;
        border-radius: 5px;
    }

    .hero-bg {
        background: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.9)), url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .glass-effect {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .gradient-text {
        background: linear-gradient(90deg, #f97316, #dc2626, #84cc16);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    </style>
</head>

<body class="font-inter">

    <?= $this->include('partials/navbar') ?>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('partials/footer') ?>

    <script>
    document.getElementById('mobileMenuBtn')?.addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-times');
    });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>