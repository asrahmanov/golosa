@extends('layouts.app')

@section('title', 'Торжественное открытие — Голоса Единства')

@section('styles')
<style>
    /* Hero Section */
    .opening-hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8rem 2rem 4rem;
        position: relative;
        overflow: hidden;
    }

    .opening-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(ellipse at 30% 20%, rgba(201, 168, 108, 0.15) 0%, transparent 50%),
            radial-gradient(ellipse at 70% 80%, rgba(107, 140, 174, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .opening-hero-content {
        max-width: 900px;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .opening-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: linear-gradient(135deg, rgba(201, 168, 108, 0.2), rgba(201, 168, 108, 0.1));
        border: 1px solid rgba(201, 168, 108, 0.3);
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        margin-bottom: 2rem;
        animation: badgePulse 3s ease-in-out infinite;
    }

    @keyframes badgePulse {
        0%, 100% { box-shadow: 0 0 20px rgba(201, 168, 108, 0.2); }
        50% { box-shadow: 0 0 40px rgba(201, 168, 108, 0.4); }
    }

    .opening-badge span {
        font-size: 1.5rem;
    }

    .opening-badge-text {
        font-weight: 600;
        color: var(--color-accent);
        font-size: 0.95rem;
    }

    .opening-title {
        font-family: var(--font-display);
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-accent) 50%, var(--color-text) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: titleShine 3s ease-in-out infinite;
        background-size: 200% auto;
    }

    @keyframes titleShine {
        0%, 100% { background-position: 0% center; }
        50% { background-position: 200% center; }
    }

    .opening-subtitle {
        font-size: 1.4rem;
        color: var(--color-text);
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .opening-date {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        background: var(--color-bg-card);
        border: 2px solid var(--color-accent);
        border-radius: 20px;
        padding: 1.5rem 3rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 40px rgba(201, 168, 108, 0.2);
    }

    .opening-date-day {
        font-family: var(--font-display);
        font-size: 4rem;
        font-weight: 700;
        color: var(--color-accent);
        line-height: 1;
    }

    .opening-date-month {
        font-size: 1.2rem;
        color: var(--color-text);
        margin-bottom: 0.5rem;
    }

    .opening-date-time {
        font-size: 1.1rem;
        color: var(--color-text-muted);
    }

    .opening-location {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        color: var(--color-text-muted);
        font-size: 1.1rem;
        margin-bottom: 2.5rem;
    }

    .opening-location svg {
        width: 24px;
        height: 24px;
        fill: var(--color-accent);
    }

    /* Intro Section */
    .intro-section {
        padding: 5rem 0;
    }

    .intro-card {
        background: linear-gradient(135deg, var(--color-bg-card), var(--color-bg-medium));
        border: 1px solid var(--color-border);
        border-radius: 24px;
        padding: 3rem;
        max-width: 900px;
        margin: 0 auto;
    }

    .intro-text {
        font-size: 1.15rem;
        line-height: 1.9;
        color: var(--color-text);
        text-align: center;
    }

    .intro-text p {
        margin-bottom: 1.5rem;
    }

    .intro-text p:last-child {
        margin-bottom: 0;
    }

    .intro-highlight {
        color: var(--color-accent);
        font-weight: 600;
    }

    /* What's Waiting Section */
    .waiting-section {
        padding: 5rem 0;
    }

    .waiting-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .waiting-card {
        background: var(--color-bg-card);
        border: 1px solid var(--color-border);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .waiting-card:hover {
        transform: translateY(-5px);
        border-color: var(--color-accent);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .waiting-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(201, 168, 108, 0.2), rgba(201, 168, 108, 0.1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.5rem;
    }

    .waiting-card h3 {
        font-family: var(--font-display);
        font-size: 1.3rem;
        color: var(--color-text);
        margin-bottom: 0.75rem;
    }

    .waiting-card p {
        color: var(--color-text-muted);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Program Section */
    .program-section {
        padding: 5rem 0;
        background: linear-gradient(180deg, transparent, rgba(26, 35, 50, 0.5), transparent);
    }

    .program-timeline {
        max-width: 800px;
        margin: 3rem auto 0;
        position: relative;
    }

    .program-timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, var(--color-accent), var(--color-primary), var(--color-accent));
        transform: translateX(-50%);
    }

    .program-item {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
        position: relative;
    }

    .program-item:nth-child(even) {
        flex-direction: row-reverse;
    }

    .program-time {
        flex: 1;
        text-align: right;
        padding-right: 2rem;
    }

    .program-item:nth-child(even) .program-time {
        text-align: left;
        padding-right: 0;
        padding-left: 2rem;
    }

    .program-time-value {
        font-family: var(--font-display);
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--color-accent);
    }

    .program-content {
        flex: 1;
        background: var(--color-bg-card);
        border: 1px solid var(--color-border);
        border-radius: 16px;
        padding: 1.5rem;
    }

    .program-content h4 {
        font-family: var(--font-display);
        font-size: 1.2rem;
        color: var(--color-text);
        margin-bottom: 0.5rem;
    }

    .program-content p {
        color: var(--color-text-muted);
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .program-dot {
        position: absolute;
        left: 50%;
        top: 1.5rem;
        width: 16px;
        height: 16px;
        background: var(--color-accent);
        border-radius: 50%;
        transform: translateX(-50%);
        box-shadow: 0 0 20px rgba(201, 168, 108, 0.5);
    }

    /* Mobile Timeline */
    @media (max-width: 768px) {
        .program-timeline::before {
            left: 20px;
        }

        .program-item,
        .program-item:nth-child(even) {
            flex-direction: column;
            padding-left: 50px;
        }

        .program-time,
        .program-item:nth-child(even) .program-time {
            text-align: left;
            padding: 0;
        }

        .program-dot {
            left: 20px;
        }
    }

    /* Venue Section */
    .venue-section {
        padding: 5rem 0;
    }

    .venue-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .venue-image {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--color-border);
        aspect-ratio: 4/3;
    }

    .venue-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .venue-image:hover img {
        transform: scale(1.05);
    }

    /* Decoration Section */
    .decoration-section {
        padding: 5rem 0;
        background: linear-gradient(180deg, transparent, rgba(26, 35, 50, 0.3), transparent);
    }

    .decoration-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .decoration-card {
        background: var(--color-bg-card);
        border: 1px solid var(--color-border);
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
    }

    .decoration-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .decoration-card h4 {
        font-family: var(--font-display);
        color: var(--color-text);
        margin-bottom: 0.5rem;
    }

    .decoration-card p {
        color: var(--color-text-muted);
        font-size: 0.9rem;
    }

    /* CTA Section */
    .cta-section {
        padding: 5rem 0;
    }

    .cta-card {
        background: linear-gradient(135deg, var(--color-bg-card), var(--color-bg-medium));
        border: 2px solid var(--color-accent);
        border-radius: 24px;
        padding: 4rem;
        text-align: center;
        max-width: 700px;
        margin: 0 auto;
        box-shadow: 0 20px 60px rgba(201, 168, 108, 0.15);
    }

    .cta-title {
        font-family: var(--font-display);
        font-size: 2rem;
        color: var(--color-text);
        margin-bottom: 1rem;
    }

    .cta-text {
        color: var(--color-text-muted);
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .cta-date-big {
        font-family: var(--font-display);
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--color-accent);
        margin-bottom: 0.5rem;
    }

    .cta-location-big {
        color: var(--color-text);
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }

    /* Interactive Zone */
    .interactive-section {
        padding: 5rem 0;
    }

    .interactive-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .interactive-card {
        background: linear-gradient(135deg, rgba(107, 140, 174, 0.1), rgba(107, 140, 174, 0.05));
        border: 1px solid var(--color-border);
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .interactive-card:hover {
        border-color: var(--color-primary);
        transform: translateY(-3px);
    }

    .interactive-icon {
        font-size: 2rem;
        margin-bottom: 0.75rem;
    }

    .interactive-card h4 {
        font-family: var(--font-display);
        color: var(--color-text);
        font-size: 1.1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .opening-hero {
            padding: 6rem 1.5rem 3rem;
        }

        .opening-title {
            font-size: 2rem;
        }

        .opening-subtitle {
            font-size: 1.1rem;
        }

        .opening-date {
            padding: 1.25rem 2rem;
        }

        .opening-date-day {
            font-size: 3rem;
        }

        .intro-card {
            padding: 2rem 1.5rem;
        }

        .intro-text {
            font-size: 1rem;
        }

        .cta-card {
            padding: 2.5rem 1.5rem;
        }

        .cta-title {
            font-size: 1.5rem;
        }

        .cta-date-big {
            font-size: 1.8rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="opening-hero">
        <div class="opening-hero-content fade-in">
            <div class="opening-badge">
                <span>🧚📖</span>
                <span class="opening-badge-text">Сказки народов России в исполнении звёзд!</span>
            </div>

            <h1 class="opening-title">Торжественное открытие</h1>
            <p class="opening-subtitle">
                Стартуем в Год единства народов России!<br>
                Дарим вам путешествие в мир мудрости и дружбы!
            </p>

            <div class="opening-date">
                <span class="opening-date-day">4</span>
                <span class="opening-date-month">января 2025</span>
                <span class="opening-date-time">13:00 — 16:00</span>
            </div>

            <div class="opening-location">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                ТРЦ «Гранд Каньон», 3 этаж, «Дивный город»<br>
                пр-т. Энгельса, 154, Санкт-Петербург, 194358
            </div>

            <a href="#program" class="btn btn-primary">Программа мероприятия</a>
        </div>
    </section>

    <!-- Intro Section -->
    <section class="intro-section container fade-in">
        <div class="intro-card">
            <div class="intro-text">
                <p>
                    <strong>Дорогие друзья, ребята и родители!</strong> ❄️
                </p>
                <p>
                    В самое волшебное время — дни новогодних каникул — мы дарим вам путешествие в мир мудрости и дружбы!
                </p>
                <p>
                    <span class="intro-highlight">4 января</span> на территории развития <span class="intro-highlight">«Гранд Каньон»</span> 
                    мы с размахом открываем Год единства народов России и представляем уникальный всероссийский проект — 
                    <span class="intro-highlight">«Голоса Единства»</span>!
                </p>
                <p>
                    Наша команда <strong>«Формула 107»</strong> создала не просто аудиокниги, а настоящие звуковые подарки: 
                    сказки народов России, озвученные творческими детскими коллективами, известными людьми в своих сферах — 
                    актёрами, музыкантами и общественными деятелями. 
                </p>
                <p>
                    Каждая история — это урок доброты, честности и уважения к культуре нашей большой страны.
                </p>
            </div>
        </div>
    </section>

    <!-- What's Waiting Section -->
    <section class="waiting-section container fade-in">
        <h2 class="section-title" style="text-align: center;">Ждём вас на празднике!</h2>
        <p class="section-subtitle" style="text-align: center;">Что вас ожидает на мероприятии</p>

        <div class="waiting-grid">
            <div class="waiting-card">
                <div class="waiting-icon">🎤</div>
                <h3>Живой концерт</h3>
                <p>С участием артистов проекта и детских творческих коллективов</p>
            </div>

            <div class="waiting-card">
                <div class="waiting-icon">🎭</div>
                <h3>Автограф-сессия</h3>
                <p>Личная встреча с известными голосами «Голосов Единства»</p>
            </div>

            <div class="waiting-card">
                <div class="waiting-icon">🎨</div>
                <h3>Мастер-классы</h3>
                <p>Творческие занятия для детей по мотивам народных сказок</p>
            </div>

            <div class="waiting-card">
                <div class="waiting-icon">🧠</div>
                <h3>Викторина с призами</h3>
                <p>Увлекательные вопросы о культуре народов России</p>
            </div>

            <div class="waiting-card">
                <div class="waiting-icon">🎁</div>
                <h3>Новогодние подарки</h3>
                <p>Сюрпризы и отличное настроение для всей семьи!</p>
            </div>

            <div class="waiting-card">
                <div class="waiting-icon">📸</div>
                <h3>Фотозона</h3>
                <p>Ковёр-самолёт, сказочные герои и яркие декорации</p>
            </div>
        </div>
    </section>

    <!-- Program Section -->
    <section class="program-section container fade-in" id="program">
        <h2 class="section-title" style="text-align: center;">Программа мероприятия</h2>
        <p class="section-subtitle" style="text-align: center;">Подробное расписание праздника</p>

        <div class="program-timeline">
            <!-- 13:00-13:15 -->
            <div class="program-item">
                <div class="program-time">
                    <span class="program-time-value">13:00 — 13:15</span>
                </div>
                <div class="program-content">
                    <h4>Пролог — приветствие и сбор гостей</h4>
                    <p>Фоновая музыка с элементами этнических мотивов народов России. Показ видеоролика о миссии проекта. Ведущий встречает гостей у входа.</p>
                </div>
                <div class="program-dot"></div>
            </div>

            <!-- 13:15-13:25 -->
            <div class="program-item">
                <div class="program-time">
                    <span class="program-time-value">13:15 — 13:25</span>
                </div>
                <div class="program-content">
                    <h4>Официальное открытие</h4>
                    <p>Ведущий приветствует гостей, рассказывает о значимости 2026 года как Года единства народов России. Слово организаторам и детям.</p>
                </div>
                <div class="program-dot"></div>
            </div>

            <!-- 13:25-13:40 -->
            <div class="program-item">
                <div class="program-time">
                    <span class="program-time-value">13:25 — 13:40</span>
                </div>
                <div class="program-content">
                    <h4>Выступления друзей и партнёров</h4>
                    <p>Приветствия от представителей культурных организаций, артистов, музыкантов. Выступление ансамбля «Питер-Непоседы»: «Рощица».</p>
                </div>
                <div class="program-dot"></div>
            </div>

            <!-- 13:40-14:00 -->
            <div class="program-item">
                <div class="program-time">
                    <span class="program-time-value">13:40 — 14:00</span>
                </div>
                <div class="program-content">
                    <h4>Презентация проекта</h4>
                    <p>Раскрытие замысла проекта, яркие факты о сказках. Прослушивание первых аудиофрагментов. Видеообращения от гостей. Выступление Анны Шамович — 2 песни. «Питер-Непоседы»: «Кадрильная».</p>
                </div>
                <div class="program-dot"></div>
            </div>

            <!-- 14:00-14:30 -->
            <div class="program-item">
                <div class="program-time">
                    <span class="program-time-value">14:00 — 14:30</span>
                </div>
                <div class="program-content">
                    <h4>Интерактивная часть</h4>
                    <p>Короткая викторина на знание сказок народов России. Мини-мастер-класс «Моя сказка» — совместное сочинение короткого сюжета с публикой.</p>
                </div>
                <div class="program-dot"></div>
            </div>

            <!-- 14:30-14:45 -->
            <div class="program-item">
                <div class="program-time">
                    <span class="program-time-value">14:30 — 14:45</span>
                </div>
                <div class="program-content">
                    <h4>Музыкальный номер, арт-пауза</h4>
                    <p>Выступления музыкантов с национальными инструментами. «Питер-Непоседы»: «Мираж». Возможность для фото и свободного общения.</p>
                </div>
                <div class="program-dot"></div>
            </div>

            <!-- 14:45-14:55 -->
            <div class="program-item">
                <div class="program-time">
                    <span class="program-time-value">14:45 — 14:55</span>
                </div>
                <div class="program-content">
                    <h4>Благодарности и финал</h4>
                    <p>Благодарности партнёрам, участникам, гостям. Объявление о запуске аудиотеки. Создание круга единства — все берутся за руки. «Питер-Непоседы»: «Ах, Несмеяны».</p>
                </div>
                <div class="program-dot"></div>
            </div>

            <!-- 14:55-15:00 -->
            <div class="program-item">
                <div class="program-time">
                    <span class="program-time-value">14:55 — 15:00</span>
                </div>
                <div class="program-content">
                    <h4>Завершение и общение</h4>
                    <p>Неформальное общение, экспресс-интервью для желающих, обсуждение идей и знакомства.</p>
                </div>
                <div class="program-dot"></div>
            </div>
        </div>
    </section>

    <!-- Venue Section -->
    <section class="venue-section container fade-in">
        <h2 class="section-title" style="text-align: center;">Место проведения</h2>
        <p class="section-subtitle" style="text-align: center;">ТРЦ «Гранд Каньон», 3 этаж, «Дивный город»</p>

        <div class="venue-grid">
            <div class="venue-image">
                <img src="{{ asset('img/grand/photo_2025-12-21 20.41.12.jpeg') }}" alt="Гранд Каньон">
            </div>
            <div class="venue-image">
                <img src="{{ asset('img/grand/photo_2025-12-21 20.41.16.jpeg') }}" alt="Гранд Каньон">
            </div>
            <div class="venue-image">
                <img src="{{ asset('img/grand/61864015.jpeg') }}" alt="Гранд Каньон">
            </div>
            <div class="venue-image">
                <img src="{{ asset('img/grand/photo_2025-12-21 20.41.24.jpeg') }}" alt="Гранд Каньон">
            </div>
        </div>
    </section>

    <!-- Decoration Section -->
    <section class="decoration-section container fade-in">
        <h2 class="section-title" style="text-align: center;">Оформление праздника</h2>
        <p class="section-subtitle" style="text-align: center;">Сказочная атмосфера для всей семьи</p>

        <div class="decoration-grid">
            <div class="decoration-card">
                <div class="decoration-icon">🎨</div>
                <h4>Национальные мотивы</h4>
                <p>Яркие декорации с элементами народов России</p>
            </div>

            <div class="decoration-card">
                <div class="decoration-icon">🎈</div>
                <h4>Праздничное оформление</h4>
                <p>Баннеры, шарики, магнитики и листовки</p>
            </div>

            <div class="decoration-card">
                <div class="decoration-icon">📸</div>
                <h4>Фотозона</h4>
                <p>Ковёр-самолёт, сундучок, микрофон и герои сказок</p>
            </div>

            <div class="decoration-card">
                <div class="decoration-icon">🎅</div>
                <h4>Дед Мороз и Снегурочка</h4>
                <p>Сказочные персонажи для фото и поздравлений</p>
            </div>

            <div class="decoration-card">
                <div class="decoration-icon">🫧</div>
                <h4>Детская зона</h4>
                <p>Мыльные пузыри, аквагрим и развлечения</p>
            </div>

            <div class="decoration-card">
                <div class="decoration-icon">🌲</div>
                <h4>Сказочный лес</h4>
                <p>Баннеры с лесными пейзажами и героями</p>
            </div>
        </div>
    </section>

    <!-- Interactive Zone -->
    <section class="interactive-section container fade-in">
        <h2 class="section-title" style="text-align: center;">Детская интерактивная зона</h2>
        <p class="section-subtitle" style="text-align: center;">Развлечения для маленьких гостей</p>

        <div class="interactive-grid">
            <div class="interactive-card">
                <div class="interactive-icon">🫧</div>
                <h4>Мыльные пузыри</h4>
            </div>

            <div class="interactive-card">
                <div class="interactive-icon">🎨</div>
                <h4>Аквагрим</h4>
            </div>

            <div class="interactive-card">
                <div class="interactive-icon">✂️</div>
                <h4>Мастер-классы</h4>
            </div>

            <div class="interactive-card">
                <div class="interactive-icon">🎭</div>
                <h4>Герои сказок</h4>
            </div>

            <div class="interactive-card">
                <div class="interactive-icon">🎁</div>
                <h4>Подарки</h4>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section container fade-in">
        <div class="cta-card">
            <h2 class="cta-title">Это больше, чем мероприятие</h2>
            <p class="cta-text">
                Это возможность услышать культуру, почувствовать единство и создать яркие семейные воспоминания в праздничные дни.
            </p>

            <div class="cta-date-big">4 января, 13:00 — 16:00</div>
            <div class="cta-location-big">ТРЦ «Гранд Каньон», 3 этаж, «Дивный город»<br>пр-т. Энгельса, 154, Санкт-Петербург</div>

            <a href="{{ route('about') }}" class="btn btn-primary">Узнать о проекте</a>
        </div>
    </section>
@endsection

