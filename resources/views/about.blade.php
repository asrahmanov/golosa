@extends('layouts.app')

@section('title', 'О проекте — Голоса Единства')

@section('styles')
<style>
    .about-hero {
        padding: 10rem 2rem 6rem;
        text-align: center;
        position: relative;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center top, rgba(201, 168, 108, 0.15) 0%, transparent 60%);
        pointer-events: none;
    }

    .about-hero-content {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .about-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(201, 168, 108, 0.15);
        border: 1px solid rgba(201, 168, 108, 0.3);
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-size: 0.85rem;
        color: var(--color-accent);
        margin-bottom: 2rem;
    }

    .about-title {
        font-family: var(--font-display);
        font-size: 3.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-accent-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .about-subtitle {
        color: var(--color-text-muted);
        font-size: 1.3rem;
        line-height: 1.8;
    }

    /* Mission Section */
    .mission-section {
        padding: 6rem 0;
        background: var(--color-bg-medium);
    }

    .mission-content {
        max-width: 900px;
        margin: 0 auto;
    }

    .mission-title {
        font-family: var(--font-display);
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 3rem;
        color: var(--color-accent);
    }

    .mission-text {
        font-size: 1.2rem;
        line-height: 2;
        color: var(--color-text);
        text-align: center;
    }

    .mission-quote {
        background: var(--color-bg-card);
        border-radius: 20px;
        padding: 3rem;
        margin: 3rem 0;
        border-left: 4px solid var(--color-accent);
        position: relative;
    }

    .mission-quote::before {
        content: '"';
        position: absolute;
        top: 1rem;
        left: 1.5rem;
        font-family: var(--font-display);
        font-size: 4rem;
        color: var(--color-accent);
        opacity: 0.3;
        line-height: 1;
    }

    .mission-quote p {
        font-family: var(--font-display);
        font-size: 1.4rem;
        font-style: italic;
        color: var(--color-text);
        line-height: 1.8;
        padding-left: 1rem;
    }

    /* Goals Section */
    .goals-section {
        padding: 6rem 0;
    }

    .goals-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin-top: 3rem;
    }

    .goal-card {
        background: var(--color-bg-card);
        border-radius: 20px;
        padding: 2.5rem;
        border: 1px solid var(--color-border);
        transition: all 0.3s ease;
    }

    .goal-card:hover {
        transform: translateY(-5px);
        border-color: var(--color-accent);
    }

    .goal-number {
        font-family: var(--font-display);
        font-size: 3rem;
        font-weight: 700;
        color: var(--color-accent);
        opacity: 0.5;
        margin-bottom: 1rem;
    }

    .goal-title {
        font-family: var(--font-display);
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
    }

    .goal-text {
        color: var(--color-text-muted);
        line-height: 1.7;
    }

    /* Values Section */
    .values-section {
        padding: 6rem 0;
        background: var(--color-bg-medium);
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .value-card {
        text-align: center;
        padding: 2rem;
        background: var(--color-bg-card);
        border-radius: 16px;
        border: 1px solid var(--color-border);
        transition: all 0.4s ease;
    }

    .value-card:hover {
        transform: translateY(-5px);
        border-color: var(--color-accent);
    }

    .value-card:hover .value-icon-svg {
        transform: scale(1.1);
    }

    .value-card:hover .value-icon-svg svg {
        filter: drop-shadow(0 0 15px var(--color-accent));
    }

    .value-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .value-icon-svg {
        width: 100%;
        height: 100%;
        transition: transform 0.4s ease;
    }

    .value-icon-svg svg {
        width: 100%;
        height: 100%;
        transition: filter 0.4s ease;
    }

    /* Unity Icon Animation */
    .value-icon-unity .unity-circle {
        animation: unityPulse 3s ease-in-out infinite;
        transform-origin: center;
    }

    .value-icon-unity .unity-circle:nth-child(2) {
        animation-delay: 0.5s;
    }

    .value-icon-unity .unity-circle:nth-child(3) {
        animation-delay: 1s;
    }

    @keyframes unityPulse {
        0%, 100% { opacity: 0.6; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.05); }
    }

    /* Heritage Icon Animation */
    .value-icon-heritage .heritage-page {
        animation: heritageTurn 4s ease-in-out infinite;
        transform-origin: left center;
    }

    @keyframes heritageTurn {
        0%, 100% { transform: rotateY(0deg); }
        50% { transform: rotateY(10deg); }
    }

    /* Wisdom Icon Animation */
    .value-icon-wisdom .wisdom-ray {
        animation: wisdomGlow 2s ease-in-out infinite;
        transform-origin: center bottom;
    }

    .value-icon-wisdom .wisdom-ray:nth-child(2) { animation-delay: 0.2s; }
    .value-icon-wisdom .wisdom-ray:nth-child(3) { animation-delay: 0.4s; }
    .value-icon-wisdom .wisdom-ray:nth-child(4) { animation-delay: 0.6s; }
    .value-icon-wisdom .wisdom-ray:nth-child(5) { animation-delay: 0.8s; }

    @keyframes wisdomGlow {
        0%, 100% { opacity: 0.4; transform: scaleY(0.8); }
        50% { opacity: 1; transform: scaleY(1); }
    }

    /* Closeness Icon Animation */
    .value-icon-closeness .closeness-wave {
        animation: closenessWave 3s ease-in-out infinite;
    }

    .value-icon-closeness .closeness-wave:nth-child(2) { animation-delay: 0.3s; }
    .value-icon-closeness .closeness-wave:nth-child(3) { animation-delay: 0.6s; }

    @keyframes closenessWave {
        0%, 100% { transform: translateY(0); opacity: 0.6; }
        50% { transform: translateY(-3px); opacity: 1; }
    }

    .value-title {
        font-family: var(--font-display);
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        color: var(--color-accent);
    }

    .value-text {
        color: var(--color-text-muted);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Team Section */
    .team-section {
        padding: 6rem 0;
    }

    .team-info {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .team-text {
        font-size: 1.15rem;
        line-height: 1.9;
        color: var(--color-text-muted);
        margin-bottom: 2rem;
    }

    /* CTA Section */
    .cta-section {
        padding: 6rem 0;
        text-align: center;
    }

    .cta-box {
        background: linear-gradient(135deg, var(--color-bg-card) 0%, var(--color-bg-medium) 100%);
        border-radius: 24px;
        padding: 4rem;
        border: 1px solid var(--color-border);
        position: relative;
        overflow: hidden;
    }

    .cta-box::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(ellipse at center, rgba(201, 168, 108, 0.1) 0%, transparent 50%);
        animation: rotate 30s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .cta-content {
        position: relative;
        z-index: 1;
    }

    .cta-title {
        font-family: var(--font-display);
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .cta-text {
        color: var(--color-text-muted);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 2rem;
    }

    /* Partners */
    .partners-section {
        padding: 4rem 0;
        text-align: center;
    }

    .partners-title {
        font-family: var(--font-display);
        font-size: 1.5rem;
        color: var(--color-text-muted);
        margin-bottom: 2rem;
    }

    .partners-logos {
        display: flex;
        justify-content: center;
        gap: 3rem;
        flex-wrap: wrap;
        opacity: 0.6;
    }

    .partner-logo {
        padding: 1rem 2rem;
        background: var(--color-bg-card);
        border-radius: 10px;
        font-family: var(--font-display);
        color: var(--color-text-muted);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .values-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .about-title {
            font-size: 2.5rem;
        }

        .goals-grid {
            grid-template-columns: 1fr;
        }

        .values-grid {
            grid-template-columns: 1fr;
        }

        .mission-quote {
            padding: 2rem 1.5rem;
        }

        .mission-quote p {
            font-size: 1.15rem;
        }

        .cta-box {
            padding: 2.5rem 1.5rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="about-hero-content">
            <div class="about-badge">
                <span>🇷🇺</span>
                Год единства народов России — 2026
            </div>
            <h1 class="about-title">О проекте</h1>
            <p class="about-subtitle">
                «Голоса Единства» — всероссийская культурная инициатива, создающая аудиобиблиотеку 
                народных сказок для укрепления единства и взаимного уважения между народами России.
            </p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="container">
            <div class="mission-content">
                <h2 class="mission-title">Наша миссия</h2>
                <p class="mission-text">
                    Показать, что доброта, взаимовыручка и уважение — вечные ценности, 
                    присутствующие в культурах всех народов России. Через искренние голоса 
                    известных людей и мудрость народных сказок мы напоминаем о том, что нас объединяет.
                </p>
                
                <div class="mission-quote">
                    <p>
                        «Голоса Единства» — это обращение к светлой стороне каждого человека. 
                        Это подарок детям, семьям и всей стране. Это общая история, рассказанная 
                        множеством голосов — но говорящая об одном: мы вместе.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Goals Section -->
    <section class="goals-section container">
        <h2 class="section-title" style="text-align: center;">Задачи проекта</h2>
        <p class="section-subtitle" style="text-align: center;">Что мы делаем для достижения цели</p>
        
        <div class="goals-grid">
            <div class="goal-card">
                <div class="goal-number">01</div>
                <h3 class="goal-title">Собираем сказки</h3>
                <p class="goal-text">
                    10–15 коротких народных сказок из разных регионов и народов России — 
                    с добрым, объединяющим смыслом.
                </p>
            </div>
            <div class="goal-card">
                <div class="goal-number">02</div>
                <h3 class="goal-title">Профессиональная озвучка</h3>
                <p class="goal-text">
                    Организуем озвучку с участием актёров, музыкантов, общественных деятелей 
                    и известных лиц страны.
                </p>
            </div>
            <div class="goal-card">
                <div class="goal-number">03</div>
                <h3 class="goal-title">Открытая библиотека</h3>
                <p class="goal-text">
                    Создаём цифровую аудиобиблиотеку, доступную каждому жителю страны — 
                    детям, семьям, школам, культурным центрам.
                </p>
            </div>
            <div class="goal-card">
                <div class="goal-number">04</div>
                <h3 class="goal-title">Культурное единство</h3>
                <p class="goal-text">
                    Показываем богатство и многообразие культур России, 
                    подчёркивая их общие ценности.
                </p>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container">
            <h2 class="section-title" style="text-align: center;">Наши ценности</h2>
            <p class="section-subtitle" style="text-align: center;">Что объединяет все народы России</p>
            
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <div class="value-icon-svg value-icon-unity">
                            <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Три пересекающихся круга - символ единства -->
                                <circle class="unity-circle" cx="32" cy="35" r="18" stroke="#c9a86c" stroke-width="2" fill="none" opacity="0.7"/>
                                <circle class="unity-circle" cx="48" cy="35" r="18" stroke="#6b8cae" stroke-width="2" fill="none" opacity="0.7"/>
                                <circle class="unity-circle" cx="40" cy="50" r="18" stroke="#8ba8c7" stroke-width="2" fill="none" opacity="0.7"/>
                                <!-- Центральная точка соединения -->
                                <circle cx="40" cy="40" r="4" fill="#c9a86c"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="value-title">Единство</h3>
                    <p class="value-text">Мы разные — но мы единая страна</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <div class="value-icon-svg value-icon-heritage">
                            <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Раскрытая книга -->
                                <path d="M40 20 L40 65" stroke="#c9a86c" stroke-width="2"/>
                                <!-- Левая страница -->
                                <path class="heritage-page" d="M40 20 Q25 22 15 25 L15 60 Q25 57 40 55" stroke="#6b8cae" stroke-width="2" fill="none"/>
                                <path d="M20 30 L35 28" stroke="#8ba8c7" stroke-width="1" opacity="0.5"/>
                                <path d="M20 38 L35 36" stroke="#8ba8c7" stroke-width="1" opacity="0.5"/>
                                <path d="M20 46 L35 44" stroke="#8ba8c7" stroke-width="1" opacity="0.5"/>
                                <!-- Правая страница -->
                                <path class="heritage-page" d="M40 20 Q55 22 65 25 L65 60 Q55 57 40 55" stroke="#6b8cae" stroke-width="2" fill="none"/>
                                <path d="M45 28 L60 30" stroke="#8ba8c7" stroke-width="1" opacity="0.5"/>
                                <path d="M45 36 L60 38" stroke="#8ba8c7" stroke-width="1" opacity="0.5"/>
                                <path d="M45 44 L60 46" stroke="#8ba8c7" stroke-width="1" opacity="0.5"/>
                                <!-- Декоративный элемент -->
                                <circle cx="40" cy="15" r="3" fill="#c9a86c"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="value-title">Наследие</h3>
                    <p class="value-text">Мы наследники богатой культуры</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <div class="value-icon-svg value-icon-wisdom">
                            <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Свеча мудрости с лучами света -->
                                <rect x="35" y="45" width="10" height="20" rx="2" fill="#6b8cae" opacity="0.6"/>
                                <ellipse cx="40" cy="45" rx="5" ry="2" fill="#6b8cae"/>
                                <!-- Пламя -->
                                <path d="M40 45 Q35 35 40 25 Q45 35 40 45" fill="#c9a86c"/>
                                <path d="M40 42 Q38 36 40 30 Q42 36 40 42" fill="#dfc28a"/>
                                <!-- Лучи света -->
                                <line class="wisdom-ray" x1="40" y1="20" x2="40" y2="10" stroke="#c9a86c" stroke-width="2" stroke-linecap="round"/>
                                <line class="wisdom-ray" x1="25" y1="25" x2="18" y2="18" stroke="#c9a86c" stroke-width="2" stroke-linecap="round"/>
                                <line class="wisdom-ray" x1="55" y1="25" x2="62" y2="18" stroke="#c9a86c" stroke-width="2" stroke-linecap="round"/>
                                <line class="wisdom-ray" x1="20" y1="40" x2="10" y2="40" stroke="#c9a86c" stroke-width="2" stroke-linecap="round"/>
                                <line class="wisdom-ray" x1="60" y1="40" x2="70" y2="40" stroke="#c9a86c" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="value-title">Мудрость</h3>
                    <p class="value-text">Добро и свет объединяют людей</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <div class="value-icon-svg value-icon-closeness">
                            <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Руки тянутся друг к другу -->
                                <path class="closeness-wave" d="M10 45 Q20 40 30 42 L35 40" stroke="#6b8cae" stroke-width="3" stroke-linecap="round" fill="none"/>
                                <path class="closeness-wave" d="M70 45 Q60 40 50 42 L45 40" stroke="#6b8cae" stroke-width="3" stroke-linecap="round" fill="none"/>
                                <!-- Соединяющий элемент - сердце/связь -->
                                <path d="M40 35 L35 40 L40 50 L45 40 Z" fill="#c9a86c"/>
                                <!-- Звуковые волны объединения -->
                                <path class="closeness-wave" d="M30 30 Q40 25 50 30" stroke="#8ba8c7" stroke-width="1.5" fill="none" opacity="0.6"/>
                                <path class="closeness-wave" d="M25 22 Q40 15 55 22" stroke="#8ba8c7" stroke-width="1.5" fill="none" opacity="0.4"/>
                                <path class="closeness-wave" d="M30 55 Q40 60 50 55" stroke="#8ba8c7" stroke-width="1.5" fill="none" opacity="0.6"/>
                                <path class="closeness-wave" d="M25 63 Q40 70 55 63" stroke="#8ba8c7" stroke-width="1.5" fill="none" opacity="0.4"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="value-title">Близость</h3>
                    <p class="value-text">Культура делает нас ближе</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section container">
        <div class="team-info">
            <h2 class="section-title">О команде</h2>
            <p class="section-subtitle">Проект создаётся совместными усилиями</p>
            
            <p class="team-text">
                Проект «Голоса Единства» объединяет культурные организации, деятелей искусства, 
                известных людей страны и неравнодушных граждан. Мы верим, что вместе можем создать 
                что-то по-настоящему значимое для будущих поколений.
            </p>
            <p class="team-text">
                Если вы хотите присоединиться к проекту в качестве партнёра, чтеца или спонсора — 
                мы будем рады сотрудничеству.
            </p>
            
            <a href="mailto:info@golosa-edinstva.ru" class="btn btn-primary">
                Связаться с нами
            </a>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section">
        <div class="container">
            <h3 class="partners-title">При поддержке</h3>
            <div class="partners-logos">
                <div class="partner-logo">Министерство культуры</div>
                <div class="partner-logo">Российский фонд культуры</div>
                <div class="partner-logo">Яндекс</div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section container">
        <div class="cta-box">
            <div class="cta-content">
                <h2 class="cta-title">Станьте частью проекта</h2>
                <p class="cta-text">
                    Мы приглашаем партнёров, спонсоров и известных людей присоединиться 
                    к созданию аудиобиблиотеки народных сказок России.
                </p>
                <a href="mailto:info@golosa-edinstva.ru" class="btn btn-primary">
                    Связаться с нами
                </a>
            </div>
        </div>
    </section>
@endsection

