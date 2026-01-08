<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Голоса Единства — всероссийская аудиобиблиотека народных сказок к Году единства народов России — 2026">
    <title>@yield('title', 'Голоса Единства — Аудиобиблиотека народных сказок')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">
    <meta name="theme-color" content="#0f1419">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --color-bg-dark: #0f1419;
            --color-bg-medium: #1a2332;
            --color-bg-card: #232f42;
            --color-primary: #6b8cae;
            --color-primary-light: #8ba8c7;
            --color-accent: #c9a86c;
            --color-accent-light: #dfc28a;
            --color-text: #e8edf3;
            --color-text-muted: #8fa3ba;
            --color-border: #3d4f66;
            --font-display: 'Cormorant Garamond', Georgia, serif;
            --font-body: 'Nunito', -apple-system, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            background: var(--color-bg-dark);
            color: var(--color-text);
            line-height: 1.7;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Magical Background */
        .magical-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        }

        .magical-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background:
                radial-gradient(ellipse at 20% 30%, rgba(107, 140, 174, 0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(201, 168, 108, 0.06) 0%, transparent 40%),
                radial-gradient(ellipse at 50% 80%, rgba(107, 140, 174, 0.05) 0%, transparent 45%);
            animation: nebula 60s ease-in-out infinite;
        }

        @keyframes nebula {
            0%, 100% { transform: translateX(0) translateY(0) rotate(0deg); }
            33% { transform: translateX(30px) translateY(-20px) rotate(5deg); }
            66% { transform: translateX(-20px) translateY(30px) rotate(-3deg); }
        }

        /* Floating Orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.4;
            animation: float 20s ease-in-out infinite;
        }

        .orb-1 {
            width: 300px;
            height: 300px;
            background: var(--color-primary);
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 200px;
            height: 200px;
            background: var(--color-accent);
            top: 60%;
            right: 10%;
            animation-delay: -7s;
        }

        .orb-3 {
            width: 250px;
            height: 250px;
            background: var(--color-primary-light);
            bottom: 20%;
            left: 30%;
            animation-delay: -14s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-30px) scale(1.05); }
        }

        /* Floating Particles */
        .particles-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--color-accent);
            border-radius: 50%;
            opacity: 0;
            animation: particleFloat linear infinite;
        }

        .particle::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: inherit;
            border-radius: inherit;
            filter: blur(2px);
            transform: scale(2);
            opacity: 0.5;
        }

        @keyframes particleFloat {
            0% {
                opacity: 0;
                transform: translateY(100vh) translateX(0) scale(0);
            }
            10% {
                opacity: 0.6;
                transform: translateY(90vh) translateX(10px) scale(1);
            }
            90% {
                opacity: 0.6;
                transform: translateY(10vh) translateX(-10px) scale(1);
            }
            100% {
                opacity: 0;
                transform: translateY(0) translateX(0) scale(0);
            }
        }

        /* Sound Wave Animation */
        .sound-wave {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 120px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 3px;
            opacity: 0.15;
            pointer-events: none;
        }

        .sound-wave-bar {
            width: 3px;
            background: linear-gradient(to top, var(--color-accent), var(--color-primary-light));
            border-radius: 3px;
            animation: soundWave ease-in-out infinite;
        }

        @keyframes soundWave {
            0%, 100% { height: 20px; }
            50% { height: var(--wave-height, 60px); }
        }

        /* Ambient Glow Effect */
        .ambient-glow {
            position: fixed;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--color-accent) 0%, transparent 70%);
            filter: blur(100px);
            opacity: 0.03;
            pointer-events: none;
            z-index: -1;
            animation: ambientMove 30s ease-in-out infinite;
        }

        .ambient-glow-2 {
            background: radial-gradient(circle, var(--color-primary) 0%, transparent 70%);
            animation-delay: -15s;
            animation-direction: reverse;
        }

        @keyframes ambientMove {
            0%, 100% {
                top: 20%;
                left: 20%;
            }
            25% {
                top: 60%;
                left: 70%;
            }
            50% {
                top: 80%;
                left: 30%;
            }
            75% {
                top: 30%;
                left: 60%;
            }
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 1rem 2rem;
            background: linear-gradient(to bottom, var(--color-bg-dark) 0%, transparent 100%);
            transition: background 0.3s ease;
        }

        .header.scrolled {
            background: rgba(15, 20, 25, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--color-border);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: var(--color-text);
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--color-accent), var(--color-accent-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 20px rgba(201, 168, 108, 0.3);
        }

        .logo-text {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: 0.02em;
        }

        .logo-text span {
            display: block;
            font-size: 0.7rem;
            font-family: var(--font-body);
            font-weight: 400;
            color: var(--color-text-muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: var(--color-text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--color-accent);
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: var(--color-text);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link.active {
            color: var(--color-accent);
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--color-text);
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Main Content */
        main {
            min-height: 100vh;
        }

        /* Footer */
        .footer {
            background: var(--color-bg-medium);
            border-top: 1px solid var(--color-border);
            padding: 4rem 2rem 2rem;
            margin-top: 6rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
        }

        .footer-brand {
            max-width: 300px;
        }

        .footer-brand .logo {
            margin-bottom: 1rem;
        }

        .footer-brand p {
            color: var(--color-text-muted);
            font-size: 0.9rem;
        }

        .footer-section h4 {
            font-family: var(--font-display);
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: var(--color-accent);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: var(--color-text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--color-text);
        }

        .footer-bottom {
            max-width: 1400px;
            margin: 3rem auto 0;
            padding-top: 2rem;
            border-top: 1px solid var(--color-border);
            text-align: center;
            color: var(--color-text-muted);
            font-size: 0.85rem;
        }

        .footer-bottom a {
            color: var(--color-accent);
            text-decoration: none;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.75rem;
            border-radius: 50px;
            font-family: var(--font-body);
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--color-accent), var(--color-accent-light));
            color: var(--color-bg-dark);
            box-shadow: 0 4px 20px rgba(201, 168, 108, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(201, 168, 108, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: var(--color-text);
            border: 2px solid var(--color-border);
        }

        .btn-secondary:hover {
            border-color: var(--color-accent);
            color: var(--color-accent);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Section Title */
        .section-title {
            font-family: var(--font-display);
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--color-text) 0%, var(--color-primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            color: var(--color-text-muted);
            font-size: 1.1rem;
            margin-bottom: 3rem;
        }

        /* Cards */
        .card {
            background: var(--color-bg-card);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--color-border);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border-color: var(--color-primary);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 1rem 1.25rem;
            }

            .nav {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--color-bg-medium);
                flex-direction: column;
                padding: 1.5rem;
                gap: 1rem;
                border-bottom: 1px solid var(--color-border);
            }

            .nav.active {
                display: flex;
            }

            .mobile-menu-btn {
                display: block;
            }

            .footer {
                padding: 3rem 1.5rem 2rem;
            }

            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2rem;
            }

            .footer-brand {
                max-width: none;
            }

            .footer-bottom {
                padding: 1.5rem 0 0;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .section-subtitle {
                font-size: 1rem;
                margin-bottom: 2rem;
            }

            .container {
                padding: 0 1.5rem;
            }

            .btn {
                padding: 0.75rem 1.5rem;
                font-size: 0.9rem;
            }

            .card {
                border-radius: 12px;
            }
        }

        /* Scroll animations */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Magical Background -->
    <div class="magical-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <!-- Ambient Glow Effects -->
    <div class="ambient-glow"></div>
    <div class="ambient-glow ambient-glow-2"></div>

    <!-- Floating Particles Container -->
    <div class="particles-container" id="particles"></div>

    <!-- Sound Wave Background -->
    <div class="sound-wave" id="soundWave"></div>

    <!-- Header -->
    <header class="header" id="header">
        <div class="header-content">
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-icon">🪶</div>
                <div class="logo-text">
                    Голоса Единства
                    <span>Год единства народов России</span>
                </div>
            </a>

            <nav class="nav" id="nav">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Главная</a>
                <a href="{{ route('opening') }}" class="nav-link {{ request()->routeIs('opening') ? 'active' : '' }}">Открытие</a>
                <a href="{{ route('results') }}" class="nav-link {{ request()->routeIs('results') ? 'active' : '' }}">Результаты</a>
                <a href="{{ route('tales.index') }}" class="nav-link {{ request()->routeIs('tales.*') ? 'active' : '' }}">Сказки</a>
                <a href="{{ route('regions.index') }}" class="nav-link {{ request()->routeIs('regions.*') ? 'active' : '' }}">Народы</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">О проекте</a>
                <a href="{{ route('instructions') }}" class="nav-link {{ request()->routeIs('instructions') ? 'active' : '' }}">Инструкция</a>
                <a href="{{ route('help') }}" class="nav-link {{ request()->routeIs('help') ? 'active' : '' }}">Помочь</a>
                <a href="{{ route('contacts') }}" class="nav-link {{ request()->routeIs('contacts') ? 'active' : '' }}">Контакты</a>
            </nav>

            <button class="mobile-menu-btn" onclick="toggleMobileMenu()">☰</button>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="logo">
                    <div class="logo-icon">🪶</div>
                    <div class="logo-text">
                        Голоса Единства
                        <span>2026</span>
                    </div>
                </a>
                <p>Всероссийская культурная инициатива к Году единства народов России. Мы объединяем народы через мудрость сказок.</p>
            </div>

            <div class="footer-section">
                <h4>Навигация</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('tales.index') }}">Все сказки</a></li>
                    <li><a href="{{ route('regions.index') }}">Народы России</a></li>
                    <li><a href="{{ route('about') }}">О проекте</a></li>
                    <li><a href="{{ route('help') }}">Помочь проекту</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Проект</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('help') }}">Партнёрам</a></li>
                    <li><a href="{{ route('contacts') }}">Контакты</a></li>
                    <li><a href="tel:+79215939096">+7 (921) 593-90-96</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Социальные сети</h4>
                <ul class="footer-links">
                    <li><a href="#">ВКонтакте</a></li>
                    <li><a href="#">Telegram</a></li>
                    <li><a href="#">Одноклассники</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© {{ date('Y') }} Голоса Единства. Всероссийская культурная инициатива.</p>
            <p style="margin-top: 0.5rem;">Проект посвящён <a href="#">Году единства народов России — 2026</a></p>
        </div>
    </footer>

    <script>
        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            document.getElementById('nav').classList.toggle('active');
        }

        // Fade in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

        // Create floating particles
        function createParticles() {
            const container = document.getElementById('particles');
            const particleCount = 25; // Спокойное количество частиц

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';

                // Рандомизация позиции и анимации
                const left = Math.random() * 100;
                const duration = 15 + Math.random() * 20; // 15-35 секунд
                const delay = Math.random() * 20;
                const size = 2 + Math.random() * 4;

                // Рандомный цвет между accent и primary
                const colors = ['var(--color-accent)', 'var(--color-primary-light)', 'var(--color-primary)'];
                const color = colors[Math.floor(Math.random() * colors.length)];

                particle.style.cssText = `
                    left: ${left}%;
                    width: ${size}px;
                    height: ${size}px;
                    background: ${color};
                    animation-duration: ${duration}s;
                    animation-delay: ${delay}s;
                `;

                container.appendChild(particle);
            }
        }

        // Create sound wave bars
        function createSoundWave() {
            const container = document.getElementById('soundWave');
            const barCount = 60;

            for (let i = 0; i < barCount; i++) {
                const bar = document.createElement('div');
                bar.className = 'sound-wave-bar';

                // Создаём волнообразный паттерн
                const centerOffset = Math.abs(i - barCount / 2) / (barCount / 2);
                const baseHeight = 20 + (1 - centerOffset) * 80; // Выше в центре
                const duration = 2 + Math.random() * 2;
                const delay = (i / barCount) * 2 + Math.random() * 0.5;

                bar.style.cssText = `
                    --wave-height: ${baseHeight}px;
                    animation-duration: ${duration}s;
                    animation-delay: ${delay}s;
                `;

                container.appendChild(bar);
            }
        }

        // Initialize animations
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
            createSoundWave();
        });
    </script>
    @yield('scripts')
</body>
</html>

