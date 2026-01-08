@extends('layouts.app')

@section('title', 'Результаты проекта — Голоса Единства')

@section('styles')
<style>
    /* Hero Section */
    .results-hero {
        min-height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 10rem 2rem 4rem;
        position: relative;
    }

    .results-hero h1 {
        font-family: var(--font-display);
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-light) 50%, var(--color-text) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .results-hero p {
        font-size: 1.3rem;
        color: var(--color-text-muted);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Main Stats Section */
    .main-stats {
        padding: 4rem 2rem;
    }

    .main-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .main-stat-card {
        background: linear-gradient(145deg, var(--color-bg-card) 0%, var(--color-bg-medium) 100%);
        border-radius: 24px;
        padding: 3rem 2rem;
        text-align: center;
        border: 1px solid var(--color-border);
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .main-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--color-accent), var(--color-primary-light));
    }

    .main-stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(201, 168, 108, 0.15);
        border-color: var(--color-accent);
    }

    .main-stat-icon {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        display: inline-block;
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .main-stat-value {
        font-family: var(--font-display);
        font-size: 4rem;
        font-weight: 700;
        color: var(--color-accent);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .main-stat-label {
        font-size: 1.1rem;
        color: var(--color-text-muted);
        margin-bottom: 1rem;
    }

    .main-stat-progress {
        background: var(--color-bg-dark);
        border-radius: 10px;
        height: 12px;
        overflow: hidden;
        margin-top: 1.5rem;
    }

    .main-stat-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--color-accent), var(--color-primary-light));
        border-radius: 10px;
        width: 0;
        transition: width 2s ease-out;
    }

    .main-stat-progress-text {
        font-size: 0.9rem;
        color: var(--color-text-muted);
        margin-top: 0.75rem;
    }

    .main-stat-progress-text strong {
        color: var(--color-accent);
    }

    /* Trophy Categories */
    .trophy-section {
        padding: 4rem 2rem;
    }

    .trophy-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .trophy-card {
        background: var(--color-bg-card);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid var(--color-border);
        transition: all 0.3s ease;
    }

    .trophy-card:hover {
        border-color: var(--color-accent);
        transform: translateY(-4px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .trophy-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--color-border);
    }

    .trophy-icon {
        font-size: 2rem;
    }

    .trophy-title {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--color-text);
    }

    .trophy-count {
        margin-left: auto;
        background: linear-gradient(135deg, var(--color-accent), var(--color-accent-light));
        color: var(--color-bg-dark);
        font-weight: 700;
        padding: 0.5rem 1rem;
        border-radius: 30px;
        font-size: 0.9rem;
    }

    .trophy-items {
        list-style: none;
    }

    .trophy-item {
        padding: 1rem 0;
        border-bottom: 1px solid rgba(61, 79, 102, 0.5);
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .trophy-item:last-child {
        border-bottom: none;
    }

    .trophy-item-status {
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .trophy-item-content {
        flex: 1;
    }

    .trophy-item-name {
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 0.25rem;
    }

    .trophy-item-details {
        font-size: 0.9rem;
        color: var(--color-text-muted);
    }

    .trophy-item-link {
        color: var(--color-primary-light);
        text-decoration: none;
        font-size: 0.85rem;
        display: inline-block;
        margin-top: 0.5rem;
        transition: color 0.3s ease;
    }

    .trophy-item-link:hover {
        color: var(--color-accent);
    }

    /* Fundraising Section */
    .fundraising-section {
        padding: 4rem 2rem;
        max-width: 900px;
        margin: 0 auto;
    }

    .fundraising-card {
        background: linear-gradient(145deg, var(--color-bg-card) 0%, var(--color-bg-medium) 100%);
        border-radius: 30px;
        padding: 3rem;
        text-align: center;
        border: 2px solid var(--color-accent);
        position: relative;
        overflow: hidden;
    }

    .fundraising-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(201, 168, 108, 0.1) 0%, transparent 50%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .fundraising-content {
        position: relative;
        z-index: 1;
    }

    .fundraising-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        display: inline-block;
    }

    .fundraising-title {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 2rem;
    }

    .fundraising-value {
        font-family: var(--font-display);
        font-size: 5rem;
        font-weight: 700;
        color: var(--color-accent);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .fundraising-currency {
        font-size: 2rem;
        vertical-align: top;
    }

    .fundraising-label {
        font-size: 1.2rem;
        color: var(--color-text-muted);
        margin-bottom: 2rem;
    }

    .fundraising-progress {
        background: var(--color-bg-dark);
        border-radius: 15px;
        height: 20px;
        overflow: hidden;
        margin: 2rem 0;
    }

    .fundraising-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #4ade80, #22c55e, var(--color-accent));
        border-radius: 15px;
        width: 0;
        transition: width 2.5s ease-out;
        position: relative;
    }

    .fundraising-progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .fundraising-goal {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1rem;
        color: var(--color-text-muted);
    }

    .fundraising-goal strong {
        color: var(--color-text);
    }

    .success-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #22c55e, #4ade80);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1.1rem;
        margin-top: 1.5rem;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4); }
        50% { box-shadow: 0 0 0 15px rgba(34, 197, 94, 0); }
    }

    /* Section Headers */
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-header h2 {
        font-family: var(--font-display);
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .section-header p {
        color: var(--color-text-muted);
        font-size: 1.1rem;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .main-stats-grid {
            grid-template-columns: 1fr;
            max-width: 500px;
        }

        .trophy-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .results-hero {
            padding: 8rem 1.5rem 3rem;
        }

        .results-hero h1 {
            font-size: 2.5rem;
        }

        .results-hero p {
            font-size: 1.1rem;
        }

        .main-stat-value {
            font-size: 3rem;
        }

        .fundraising-value {
            font-size: 3.5rem;
        }

        .fundraising-currency {
            font-size: 1.5rem;
        }

        .fundraising-card {
            padding: 2rem 1.5rem;
        }

        .trophy-card {
            padding: 1.5rem;
        }

        .trophy-header {
            flex-wrap: wrap;
        }

        .trophy-count {
            margin-left: 0;
            margin-top: 0.5rem;
        }

        .section-header h2 {
            font-size: 1.8rem;
        }
    }

    /* Confetti animation for success */
    .confetti {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1000;
        overflow: hidden;
    }

    .confetti-piece {
        position: absolute;
        width: 10px;
        height: 20px;
        top: -20px;
        animation: confettiFall linear forwards;
    }

    @keyframes confettiFall {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(720deg);
            opacity: 0;
        }
    }
</style>
@endsection

@section('content')
<section class="results-hero">
    <div>
        <h1>🏆 Результаты проекта</h1>
        <p>Достижения культурно-благотворительного проекта «Голоса Единства»</p>
    </div>
</section>

<!-- Main Statistics -->
<section class="main-stats">
    <div class="main-stats-grid">
        <div class="main-stat-card fade-in">
            <div class="main-stat-icon">🎧</div>
            <div class="main-stat-value" data-target="3246" data-suffix="">0</div>
            <div class="main-stat-label">Прослушиваний</div>
            <div class="main-stat-progress">
                <div class="main-stat-progress-bar" data-width="293"></div>
            </div>
            <div class="main-stat-progress-text">
                <strong>293%</strong> от плана (1107)
            </div>
        </div>

        <div class="main-stat-card fade-in">
            <div class="main-stat-icon">📰</div>
            <div class="main-stat-value" data-target="11" data-suffix="">0</div>
            <div class="main-stat-label">Публикаций в СМИ</div>
            <div class="main-stat-progress">
                <div class="main-stat-progress-bar" data-width="100"></div>
            </div>
            <div class="main-stat-progress-text">
                Печать, радио, ТВ, интернет
            </div>
        </div>

        <div class="main-stat-card fade-in">
            <div class="main-stat-icon">👥</div>
            <div class="main-stat-value" data-target="481000" data-suffix="">0</div>
            <div class="main-stat-label">Охват у блогеров</div>
            <div class="main-stat-progress">
                <div class="main-stat-progress-bar" data-width="100"></div>
            </div>
            <div class="main-stat-progress-text">
                Блог «1001образ | Стиль»
            </div>
        </div>
    </div>
</section>

<!-- Fundraising Success -->
<section class="fundraising-section">
    <div class="fundraising-card fade-in">
        <div class="fundraising-content">
            <div class="fundraising-icon">💰</div>
            <div class="fundraising-title">Сбор средств завершён!</div>
            <div class="fundraising-value">
                <span data-target="258118" data-suffix="">0</span>
                <span class="fundraising-currency">₽</span>
            </div>
            <div class="fundraising-label">собрано из 250 000 ₽</div>
            <div class="fundraising-progress">
                <div class="fundraising-progress-bar" data-width="103"></div>
            </div>
            <div class="fundraising-goal">
                <span>Цель: <strong>250 000 ₽</strong></span>
                <span>Собрано: <strong>103%</strong></span>
            </div>
            <div class="success-badge">
                ✓ Цель достигнута!
            </div>
        </div>
    </div>
</section>

<!-- Trophy Categories -->
<section class="trophy-section">
    <div class="section-header">
        <h2>Медийное покрытие</h2>
        <p>Освещение проекта в различных каналах</p>
    </div>

    <div class="trophy-grid">
        <!-- Печатные СМИ -->
        <div class="trophy-card fade-in">
            <div class="trophy-header">
                <span class="trophy-icon">🏆</span>
                <span class="trophy-title">Печатное СМИ</span>
                <span class="trophy-count">2 публикации</span>
            </div>
            <ul class="trophy-items">
                <li class="trophy-item">
                    <span class="trophy-item-status">⏳</span>
                    <div class="trophy-item-content">
                        <div class="trophy-item-name">Таврида</div>
                        <div class="trophy-item-details">Публикация готовится</div>
                    </div>
                </li>
                <li class="trophy-item">
                    <span class="trophy-item-status">✅</span>
                    <div class="trophy-item-content">
                        <div class="trophy-item-name">Сетевое издание «Аргументы недели»</div>
                        <a href="https://argumenti.ru/society/2025/12/981293" target="_blank" class="trophy-item-link">argumenti.ru →</a>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Радио -->
        <div class="trophy-card fade-in">
            <div class="trophy-header">
                <span class="trophy-icon">🏆</span>
                <span class="trophy-title">Радио</span>
                <span class="trophy-count">2 эфира</span>
            </div>
            <ul class="trophy-items">
                <li class="trophy-item">
                    <span class="trophy-item-status">✅</span>
                    <div class="trophy-item-content">
                        <div class="trophy-item-name">Дорожное радио</div>
                        <div class="trophy-item-details">31.12 — эфир состоялся</div>
                    </div>
                </li>
                <li class="trophy-item">
                    <span class="trophy-item-status">✅</span>
                    <div class="trophy-item-content">
                        <div class="trophy-item-name">Радио метро</div>
                        <div class="trophy-item-details">31.12 в утренних новостях / волна 102,4 FM</div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- ТВ -->
        <div class="trophy-card fade-in">
            <div class="trophy-header">
                <span class="trophy-icon">🏆</span>
                <span class="trophy-title">Телевидение</span>
                <span class="trophy-count">1 сюжет</span>
            </div>
            <ul class="trophy-items">
                <li class="trophy-item">
                    <span class="trophy-item-status">✅</span>
                    <div class="trophy-item-content">
                        <div class="trophy-item-name">Бугровское ТВ</div>
                        <div class="trophy-item-details">Были на презентации, сюжет вышел 04.01</div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Блогеры -->
        <div class="trophy-card fade-in">
            <div class="trophy-header">
                <span class="trophy-icon">🏆</span>
                <span class="trophy-title">Блогеры</span>
                <span class="trophy-count">481К охват</span>
            </div>
            <ul class="trophy-items">
                <li class="trophy-item">
                    <span class="trophy-item-status">✅</span>
                    <div class="trophy-item-content">
                        <div class="trophy-item-name">Блог «1001образ | Стиль»</div>
                        <div class="trophy-item-details">Катерина Красивова — 481 000 подписчиков</div>
                        <a href="https://vk.ru/style1001obraz" target="_blank" class="trophy-item-link">vk.ru/style1001obraz →</a>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Электронные СМИ -->
        <div class="trophy-card fade-in" style="grid-column: 1 / -1;">
            <div class="trophy-header">
                <span class="trophy-icon">🏆</span>
                <span class="trophy-title">Электронные СМИ</span>
                <span class="trophy-count">6 публикаций</span>
            </div>
            <ul class="trophy-items" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 0 2rem;">
                <li class="trophy-item">
                    <span class="trophy-item-status">✅</span>
                    <div class="trophy-item-content">
                        <div class="trophy-item-name">47медиа</div>
                        <div class="trophy-item-details">4 публикации</div>
                    </div>
                </li>
                <li class="trophy-item">
                    <span class="trophy-item-status">✅</span>
                    <div class="trophy-item-content">
                        <div class="trophy-item-name">Gazeta.SPb</div>
                        <a href="https://gazeta.spb.ru/2647261-v-peterburge-zapustyat-proekt-po-sozdaniyu-audioteki-skazok-narodov-strany/" target="_blank" class="trophy-item-link">gazeta.spb.ru →</a>
                    </div>
                </li>
                <li class="trophy-item">
                    <span class="trophy-item-status">✅</span>
                    <div class="trophy-item-content">
                        <div class="trophy-item-name">Gazeta.LO</div>
                        <a href="https://gazeta-lo.ru/2025/12/29/v-peterburge-startuet-kulturno-blagotvoritelnyj-proekt-golosa-edinstva/" target="_blank" class="trophy-item-link">gazeta-lo.ru →</a>
                    </div>
                </li>
                <li class="trophy-item">
                    <span class="trophy-item-status">✅</span>
                    <div class="trophy-item-content">
                        <div class="trophy-item-name">Nevskiy.pro</div>
                        <a href="https://nevskiy.pro/v-peterburge-startuet-kulturno-blagotvoritelnyj-proekt-golosa-edinstva/" target="_blank" class="trophy-item-link">nevskiy.pro →</a>
                    </div>
                </li>
                <li class="trophy-item">
                    <span class="trophy-item-status">✅</span>
                    <div class="trophy-item-content">
                        <div class="trophy-item-name">AllNW.ru</div>
                        <a href="https://allnw.ru/2025/12/29/v-peterburge-startuet-kulturno-blagotvoritelnyj-proekt-golosa-edinstva/" target="_blank" class="trophy-item-link">allnw.ru →</a>
                    </div>
                </li>
                <li class="trophy-item">
                    <span class="trophy-item-status">✅</span>
                    <div class="trophy-item-content">
                        <div class="trophy-item-name">ТРК «Гранд Каньон»</div>
                        <a href="https://trk-canyon.ru/events/priglasaem-vas-nacat-god-s-otkrytiia-audiobiblioteki-narodnyx-skazok-golosa-edinstva" target="_blank" class="trophy-item-link">trk-canyon.ru →</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Animated Counter
    function animateCounter(element, target, duration = 2000, suffix = '') {
        const start = 0;
        const startTime = performance.now();
        
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Easing function (ease-out-expo)
            const easeProgress = 1 - Math.pow(1 - progress, 4);
            
            const current = Math.floor(start + (target - start) * easeProgress);
            element.textContent = current.toLocaleString('ru-RU') + suffix;
            
            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }
        
        requestAnimationFrame(update);
    }

    // Progress bar animation
    function animateProgressBar(element, targetWidth) {
        setTimeout(() => {
            element.style.width = Math.min(targetWidth, 100) + '%';
        }, 500);
    }

    // Intersection Observer for triggering animations
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Animate counters
                const counters = entry.target.querySelectorAll('[data-target]');
                counters.forEach(counter => {
                    const target = parseInt(counter.dataset.target);
                    const suffix = counter.dataset.suffix || '';
                    animateCounter(counter, target, 2500, suffix);
                });

                // Animate progress bars
                const progressBars = entry.target.querySelectorAll('[data-width]');
                progressBars.forEach(bar => {
                    const width = parseInt(bar.dataset.width);
                    animateProgressBar(bar, width);
                });

                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    // Observe all cards
    document.querySelectorAll('.main-stat-card, .fundraising-card').forEach(card => {
        counterObserver.observe(card);
    });

    // Create confetti effect
    function createConfetti() {
        const container = document.createElement('div');
        container.className = 'confetti';
        document.body.appendChild(container);

        const colors = ['#c9a86c', '#6b8cae', '#8ba8c7', '#dfc28a', '#22c55e', '#4ade80'];
        
        for (let i = 0; i < 50; i++) {
            const piece = document.createElement('div');
            piece.className = 'confetti-piece';
            piece.style.left = Math.random() * 100 + '%';
            piece.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            piece.style.animationDuration = (Math.random() * 3 + 2) + 's';
            piece.style.animationDelay = Math.random() * 2 + 's';
            container.appendChild(piece);
        }

        setTimeout(() => container.remove(), 6000);
    }

    // Trigger confetti on page load
    setTimeout(createConfetti, 1000);
</script>
@endsection

