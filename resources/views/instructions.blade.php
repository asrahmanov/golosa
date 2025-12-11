@extends('layouts.app')

@section('title', 'Инструкция — Голоса Единства')

@section('styles')
<style>
    .instructions-hero {
        padding: 10rem 2rem 4rem;
        text-align: center;
        position: relative;
    }

    .instructions-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center top, rgba(107, 140, 174, 0.15) 0%, transparent 60%);
        pointer-events: none;
    }

    .instructions-hero-content {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    /* Video Circle */
    .hero-video-circle {
        margin-bottom: 2rem;
    }

    .video-circle-outer {
        width: 180px;
        height: 180px;
        margin: 0 auto;
        position: relative;
    }

    .video-circle-border {
        position: absolute;
        inset: -8px;
        border: 2px dashed var(--color-accent);
        border-radius: 50%;
        animation: spin 30s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .video-circle-inner {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        overflow: hidden;
        position: relative;
        z-index: 2;
        border: 3px solid var(--color-accent);
    }

    .video-circle-inner video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .video-circle-glow {
        position: absolute;
        inset: -20px;
        background: radial-gradient(circle, rgba(201, 168, 108, 0.3) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 1;
        animation: pulse-glow 3s ease-in-out infinite;
    }

    @keyframes pulse-glow {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.05); }
    }

    .instructions-badge {
        display: inline-block;
        background: var(--color-accent);
        color: var(--color-bg-dark);
        padding: 0.5rem 1.5rem;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 1.5rem;
    }

    .instructions-title {
        font-family: var(--font-display);
        font-size: 3.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-accent-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .instructions-subtitle {
        color: var(--color-text-muted);
        font-size: 1.2rem;
        line-height: 1.7;
    }

    /* Quick Actions */
    .quick-actions {
        padding: 3rem 0;
    }

    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }

    .quick-action-card {
        background: var(--color-bg-card);
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid var(--color-border);
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
    }

    .quick-action-card:hover {
        border-color: var(--color-accent);
        transform: translateY(-3px);
    }

    .quick-action-number {
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 28px;
        height: 28px;
        background: var(--color-accent);
        color: var(--color-bg-dark);
        border-radius: 50%;
        font-size: 0.85rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quick-action-icon {
        width: 50px;
        height: 50px;
        margin: 0.5rem auto 1rem;
    }

    .quick-action-icon svg {
        width: 100%;
        height: 100%;
    }

    .quick-action-card h3 {
        font-family: var(--font-display);
        font-size: 1rem;
        margin-bottom: 0.5rem;
        color: var(--color-text);
    }

    .quick-action-card p {
        color: var(--color-text-muted);
        font-size: 0.85rem;
        line-height: 1.5;
    }

    /* Deadline Badge */
    .deadline-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, rgba(201, 168, 108, 0.2), rgba(201, 168, 108, 0.1));
        border: 1px solid var(--color-accent);
        padding: 0.75rem 1.5rem;
        border-radius: 30px;
        margin-top: 2rem;
        color: var(--color-accent);
        font-weight: 500;
    }

    .deadline-badge svg {
        width: 20px;
        height: 20px;
    }

    /* Goal Section */
    .goal-section {
        padding: 3rem 0;
    }

    .goal-card {
        max-width: 800px;
        margin: 0 auto;
        background: linear-gradient(135deg, var(--color-bg-card), rgba(107, 140, 174, 0.1));
        border-radius: 24px;
        padding: 2.5rem;
        border: 2px solid var(--color-primary);
        text-align: center;
    }

    .goal-card h2 {
        font-family: var(--font-display);
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--color-accent);
    }

    .goal-card p {
        color: var(--color-text);
        font-size: 1.1rem;
        line-height: 1.7;
    }

    /* Main Instructions */
    .main-instructions {
        padding: 4rem 0;
    }

    .instruction-section {
        max-width: 900px;
        margin: 0 auto 4rem;
    }

    .instruction-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .instruction-stage {
        width: 60px;
        height: 60px;
        background: var(--color-accent);
        color: var(--color-bg-dark);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .instruction-header h2 {
        font-family: var(--font-display);
        font-size: 2rem;
        color: var(--color-text);
    }

    .instruction-header h2 span {
        color: var(--color-accent);
    }

    /* Steps */
    .instruction-steps {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .instruction-step {
        background: var(--color-bg-card);
        border-radius: 16px;
        padding: 1.5rem 2rem;
        border: 1px solid var(--color-border);
        transition: all 0.3s ease;
    }

    .instruction-step:hover {
        border-color: var(--color-primary);
    }

    .instruction-step h3 {
        font-family: var(--font-display);
        font-size: 1.15rem;
        color: var(--color-text);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .step-number {
        width: 28px;
        height: 28px;
        background: var(--color-bg-medium);
        color: var(--color-accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        font-weight: 600;
        flex-shrink: 0;
    }

    .instruction-step p {
        color: var(--color-text-muted);
        line-height: 1.7;
        margin-left: 2.25rem;
    }

    .instruction-step ul {
        margin-left: 2.25rem;
        margin-top: 0.75rem;
    }

    .instruction-step ul li {
        color: var(--color-text-muted);
        line-height: 1.8;
        padding-left: 1.5rem;
        position: relative;
        margin-bottom: 0.5rem;
    }

    .instruction-step ul li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.6em;
        width: 6px;
        height: 6px;
        background: var(--color-accent);
        border-radius: 50%;
    }

    /* Method Card */
    .method-card {
        background: linear-gradient(135deg, var(--color-bg-card), rgba(201, 168, 108, 0.05));
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid var(--color-accent);
        margin-bottom: 1.5rem;
    }

    .method-badge {
        display: inline-block;
        background: var(--color-accent);
        color: var(--color-bg-dark);
        padding: 0.35rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
    }

    .method-card h3 {
        font-family: var(--font-display);
        font-size: 1.25rem;
        color: var(--color-text);
        margin-bottom: 1rem;
    }

    .method-steps {
        counter-reset: method-step;
    }

    .method-steps li {
        color: var(--color-text-muted);
        line-height: 1.8;
        padding-left: 2rem;
        position: relative;
        margin-bottom: 0.75rem;
        counter-increment: method-step;
    }

    .method-steps li::before {
        content: counter(method-step);
        position: absolute;
        left: 0;
        top: 0;
        width: 22px;
        height: 22px;
        background: var(--color-bg-medium);
        color: var(--color-accent);
        border-radius: 50%;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Tips Section */
    .tips-section {
        padding: 4rem 0;
        background: var(--color-bg-medium);
    }

    .tips-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .tip-card {
        background: var(--color-bg-card);
        border-radius: 16px;
        padding: 1.75rem;
        border: 1px solid var(--color-border);
    }

    .tip-card h3 {
        font-family: var(--font-display);
        font-size: 1.1rem;
        color: var(--color-accent);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tip-card p {
        color: var(--color-text-muted);
        font-size: 0.95rem;
        line-height: 1.7;
    }

    /* Bonus Section */
    .bonus-section {
        padding: 4rem 0;
    }

    .bonus-card {
        max-width: 900px;
        margin: 0 auto;
        background: linear-gradient(135deg, rgba(201, 168, 108, 0.1), rgba(107, 140, 174, 0.1));
        border-radius: 24px;
        padding: 2.5rem;
        border: 2px dashed var(--color-accent);
    }

    .bonus-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .bonus-icon {
        width: 50px;
        height: 50px;
        background: var(--color-accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .bonus-header h2 {
        font-family: var(--font-display);
        font-size: 1.5rem;
        color: var(--color-text);
    }

    .bonus-content ul li {
        color: var(--color-text-muted);
        line-height: 1.8;
        padding-left: 1.5rem;
        position: relative;
        margin-bottom: 0.75rem;
    }

    .bonus-content ul li::before {
        content: '✦';
        position: absolute;
        left: 0;
        color: var(--color-accent);
    }

    /* Final Message */
    .final-message {
        padding: 4rem 0;
        text-align: center;
    }

    .final-card {
        max-width: 700px;
        margin: 0 auto;
        background: var(--color-bg-card);
        border-radius: 24px;
        padding: 3rem;
        border: 1px solid var(--color-border);
    }

    .final-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .final-card h2 {
        font-family: var(--font-display);
        font-size: 1.75rem;
        color: var(--color-text);
        margin-bottom: 1rem;
    }

    .final-card p {
        color: var(--color-text-muted);
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 2rem;
    }

    .final-card .highlight {
        color: var(--color-accent);
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .quick-actions-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .tips-grid {
            grid-template-columns: 1fr;
        }

        .instructions-title {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 600px) {
        .quick-actions-grid {
            grid-template-columns: 1fr;
        }

        .instruction-header h2 {
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="instructions-hero">
        <div class="instructions-hero-content">
            <div class="hero-video-circle">
                <div class="video-circle-outer">
                    <div class="video-circle-border"></div>
                    <div class="video-circle-inner">
                        <video autoplay muted loop playsinline>
                            <source src="{{ asset('video/hot.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="video-circle-glow"></div>
                </div>
            </div>
            <span class="instructions-badge">Голоса Единства</span>
            <h1 class="instructions-title">Инструкция по записи</h1>
            <p class="instructions-subtitle">
                Всероссийский культурно-благотворительный проект.<br>
                Следуйте этой инструкции, чтобы записать аудиосказку для нашей библиотеки.
            </p>
            <div class="deadline-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
                Дедлайн: 22 декабря 2025
            </div>
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="quick-actions container">
        <h2 class="section-title" style="text-align: center;">Что нужно сделать</h2>
        <p class="section-subtitle" style="text-align: center;">4 простых шага для участия в проекте</p>

        <div class="quick-actions-grid">
            <div class="quick-action-card">
                <span class="quick-action-number">1</span>
                <div class="quick-action-icon">
                    <svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="25" cy="18" r="8" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <rect x="21" y="26" width="8" height="16" rx="4" stroke="#6b8cae" stroke-width="2" fill="none"/>
                        <path d="M15 35 L35 35" stroke="#6b8cae" stroke-width="2" stroke-linecap="round"/>
                        <path d="M25 42 L25 46" stroke="#c9a86c" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3>Записать аудиосказку</h3>
                <p>В студии или на телефон</p>
            </div>

            <div class="quick-action-card">
                <span class="quick-action-number">2</span>
                <div class="quick-action-icon">
                    <svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="12" y="8" width="26" height="34" rx="3" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <circle cx="25" cy="25" r="8" stroke="#6b8cae" stroke-width="2" fill="none"/>
                        <circle cx="25" cy="25" r="3" fill="#c9a86c"/>
                        <path d="M12 38 L38 38" stroke="#6b8cae" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Записать бэкстейдж</h3>
                <p>Видео 1–3 минуты</p>
            </div>

            <div class="quick-action-card">
                <span class="quick-action-number">3</span>
                <div class="quick-action-icon">
                    <svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 35 L10 15 Q10 10 15 10 L35 10 Q40 10 40 15 L40 35 Q40 40 35 40 L15 40 Q10 40 10 35" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <circle cx="20" cy="22" r="3" fill="#6b8cae"/>
                        <circle cx="30" cy="22" r="3" fill="#6b8cae"/>
                        <path d="M18 30 Q25 36 32 30" stroke="#c9a86c" stroke-width="2" fill="none" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3>Ответить на видео</h3>
                <p>«Что для Вас участие в проекте»</p>
            </div>

            <div class="quick-action-card">
                <span class="quick-action-number">4</span>
                <div class="quick-action-icon">
                    <svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 15 L25 28 L42 15" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <rect x="8" y="15" width="34" height="24" rx="3" stroke="#6b8cae" stroke-width="2" fill="none"/>
                        <path d="M28 8 L35 8 L35 18" stroke="#c9a86c" stroke-width="2" stroke-linecap="round"/>
                        <path d="M32 11 L35 8 L38 11" stroke="#c9a86c" stroke-width="2" stroke-linecap="round" fill="none"/>
                    </svg>
                </div>
                <h3>Прислать файлы</h3>
                <p>В Telegram или на почту</p>
            </div>
        </div>
    </section>

    <!-- Goal Section -->
    <section class="goal-section container">
        <div class="goal-card">
            <h2>🎯 Цель записи</h2>
            <p>
                Создать чистое, приятное для слуха аудио с вашим чтением сказки. 
                Главное — ваше тёплое, близкое голосовое присутствие. 
                Даже с небольшими шумами такая запись станет по-настоящему ценной для маленьких слушателей.
            </p>
        </div>
    </section>

    <!-- Main Instructions -->
    <section class="main-instructions container">
        <!-- Stage 1: Preparation -->
        <div class="instruction-section">
            <div class="instruction-header">
                <div class="instruction-stage">1</div>
                <h2>Подготовка <span>(залог успеха!)</span></h2>
            </div>

            <div class="instruction-steps">
                <div class="instruction-step">
                    <h3><span class="step-number">1</span>Выберите сказку</h3>
                    <p>Заранее определите текст. Можно читать с экрана или распечатать для удобства.</p>
                    <ul>
                        <li>Пролистайте текст заранее</li>
                        <li>Отметьте интонации</li>
                        <li>Продумайте разные голоса для персонажей</li>
                    </ul>
                </div>

                <div class="instruction-step">
                    <h3><span class="step-number">2</span>Подготовьте помещение</h3>
                    <ul>
                        <li>Выберите самую тихую комнату</li>
                        <li>Выключите вентиляторы, кондиционеры, телевизоры, закройте окна</li>
                        <li>Предупредите домочадцев, чтобы вас не беспокоили</li>
                        <li>Лучше всего записываться в комнате с мягкой мебелью, коврами и шторами — они поглощают эхо</li>
                    </ul>
                </div>

                <div class="instruction-step">
                    <h3><span class="step-number">3</span>Подготовьте телефон</h3>
                    <ul>
                        <li>Переведите в режим «Не беспокоить», чтобы звонки и уведомления не прервали запись</li>
                        <li>Отключите Bluetooth, чтобы телефон случайно не подключился к колонкам или наушникам</li>
                        <li>Зарядите телефон или подключите к зарядке</li>
                    </ul>
                </div>

                <div class="instruction-step">
                    <h3><span class="step-number">4</span>Подготовьте себя</h3>
                    <ul>
                        <li>Приготовьте стакан воды</li>
                        <li>Сделайте небольшую разминку для губ и языка (скороговорки отлично подойдут)</li>
                        <li>Читайте немного медленнее, чем в обычной жизни — детям это поможет лучше воспринимать речь</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Stage 2: Recording -->
        <div class="instruction-section">
            <div class="instruction-header">
                <div class="instruction-stage">2</div>
                <h2>Запись <span>(основной способ)</span></h2>
            </div>

            <div class="method-card">
                <span class="method-badge">Простой и быстрый</span>
                <h3>Приложение «Диктофон»</h3>
                <ol class="method-steps">
                    <li>Найдите и откройте стандартное приложение «Диктофон»</li>
                    <li>Положите телефон на устойчивую поверхность перед собой (например, на стол, прислонив к книге). Микрофон должен быть направлен на вас</li>
                    <li>Нажмите большую красную кнопку для начала записи</li>
                    <li>Начните читать. Не страшно, если ошиблись — сделайте паузу, глубоко вдохните и повторите фразу заново</li>
                    <li>По окончании нажмите красную кнопку ещё раз, чтобы остановить запись</li>
                    <li>Нажмите «Готово», дайте записи название (например, «Колобок_версия1»)</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section class="tips-section">
        <div class="container">
            <h2 class="section-title" style="text-align: center;">Важные советы для записи</h2>

            <div class="tips-grid">
                <div class="tip-card">
                    <h3>📏 Расстояние</h3>
                    <p>Оптимально 15–30 см до микрофона. Не держите телефон в руке — будут слышны шумы и касания.</p>
                </div>

                <div class="tip-card">
                    <h3>📍 Положение</h3>
                    <p>Читайте сидя за столом, положив телефон на подставку. Постарайтесь не менять ваше положение рядом с телефоном.</p>
                </div>

                <div class="tip-card">
                    <h3>💨 Дыхание</h3>
                    <p>Старайтесь не дышать прямо в микрофон. Разверните телефон микрофоном чуть в сторону от линии рта.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Saving Section -->
    <section class="main-instructions container" style="padding-top: 4rem;">
        <div class="instruction-section">
            <div class="instruction-header">
                <div class="instruction-stage">3</div>
                <h2>Сохранение <span>и отправка</span></h2>
            </div>

            <div class="instruction-step">
                <h3><span class="step-number">📤</span>Как отправить запись</h3>
                <p>Готовой записью можно поделиться (кнопка в виде квадрата со стрелкой) и отправить:</p>
                <ul>
                    <li>В Telegram координатору проекта</li>
                    <li>На почту проекта</li>
                    <li>Сохранить в облако (iCloud Drive, Яндекс.Диск, Google Диск) и прислать ссылку</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Bonus Section -->
    <section class="bonus-section container">
        <div class="bonus-card">
            <div class="bonus-header">
                <div class="bonus-icon">✨</div>
                <h2>Бонус: Продвинутые советы для создания волшебства</h2>
            </div>
            <div class="bonus-content">
                <ul>
                    <li><strong>Используйте внешний микрофон.</strong> Подойдут микрофоны с подключением Lightning, Type-C или через разветвитель. Это кардинально улучшит качество. Лучше не использовать AirPods, чтобы не было ощущения записи телефонного разговора.</li>
                    <li><strong>Включайте запись заранее.</strong> Минимум за пару секунд до начала речи, и нажимайте «стоп» чуть позже последнего слова. Эти лишние секунды дадут свободу при монтаже.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Final Message -->
    <section class="final-message container">
        <div class="final-card">
            <div class="final-icon">🎧</div>
            <h2>Удачи в творчестве!</h2>
            <p>
                Главное — ваше <span class="highlight">тёплое, близкое голосовое присутствие</span>. 
                Даже с небольшими шумами такая запись станет по-настоящему ценной для маленьких слушателей.
            </p>
            <a href="{{ route('contacts') }}" class="btn btn-primary">Связаться с нами →</a>
        </div>
    </section>
@endsection

