@extends('layouts.app')

@section('title', 'Как помочь проекту — Голоса Единства')

@section('styles')
<style>
    .help-hero {
        padding: 10rem 2rem 4rem;
        text-align: center;
        position: relative;
    }

    .help-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center top, rgba(201, 168, 108, 0.15) 0%, transparent 60%);
        pointer-events: none;
    }

    .help-hero-content {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .help-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(107, 174, 107, 0.15);
        border: 1px solid rgba(107, 174, 107, 0.3);
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-size: 0.85rem;
        color: #6bae6b;
        margin-bottom: 2rem;
    }

    .help-title {
        font-family: var(--font-display);
        font-size: 3.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-accent-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .help-subtitle {
        color: var(--color-text-muted);
        font-size: 1.25rem;
        line-height: 1.8;
    }

    /* Collection Complete Section */
    .collection-complete-section {
        padding: 4rem 0;
    }

    .collection-complete-card {
        max-width: 800px;
        margin: 0 auto;
        background: linear-gradient(135deg, var(--color-bg-card), rgba(107, 174, 107, 0.1));
        border-radius: 24px;
        padding: 3rem;
        border: 1px solid rgba(107, 174, 107, 0.3);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .collection-complete-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(ellipse at center, rgba(107, 174, 107, 0.05) 0%, transparent 50%);
        animation: rotate 30s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .collection-complete-content {
        position: relative;
        z-index: 1;
    }

    .collection-complete-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 2rem;
        background: linear-gradient(135deg, rgba(107, 174, 107, 0.2), rgba(107, 174, 107, 0.1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        border: 2px solid rgba(107, 174, 107, 0.3);
    }

    .collection-complete-title {
        font-family: var(--font-display);
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #6bae6b;
    }

    .collection-complete-text {
        color: var(--color-text-muted);
        font-size: 1.15rem;
        line-height: 1.8;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .collection-complete-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: linear-gradient(135deg, var(--color-accent), var(--color-accent-light));
        color: var(--color-bg-dark);
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .collection-complete-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(201, 168, 108, 0.3);
    }

    .collection-complete-cta svg {
        width: 24px;
        height: 24px;
        fill: currentColor;
    }

    /* Event Info Card */
    .event-info-section {
        padding: 4rem 0;
    }

    .event-info-card {
        max-width: 900px;
        margin: 0 auto;
        background: var(--color-bg-card);
        border-radius: 24px;
        padding: 2.5rem;
        border: 1px solid var(--color-border);
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 2rem;
        align-items: center;
    }

    .event-date-block {
        background: linear-gradient(135deg, var(--color-accent), var(--color-accent-light));
        border-radius: 16px;
        padding: 1.5rem 2rem;
        text-align: center;
        color: var(--color-bg-dark);
    }

    .event-date-day {
        font-family: var(--font-display);
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1;
    }

    .event-date-month {
        font-size: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .event-date-time {
        font-size: 0.9rem;
        margin-top: 0.5rem;
        opacity: 0.9;
    }

    .event-info-content h3 {
        font-family: var(--font-display);
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
        color: var(--color-text);
    }

    .event-info-content p {
        color: var(--color-text-muted);
        margin-bottom: 1rem;
        line-height: 1.7;
    }

    .event-location {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--color-accent);
        font-size: 0.95rem;
    }

    .event-location svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    /* What We Need Section */
    .needs-section {
        padding: 4rem 0;
        border-top: 1px solid var(--color-border);
    }

    .needs-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .need-card {
        background: var(--color-bg-card);
        border-radius: 16px;
        padding: 1.75rem;
        border: 1px solid var(--color-border);
        transition: all 0.3s ease;
        position: relative;
    }

    .need-card:hover {
        border-color: var(--color-primary);
        transform: translateY(-3px);
    }

    .need-card-highlight {
        border-color: var(--color-accent);
        background: linear-gradient(135deg, var(--color-bg-card), rgba(201, 168, 108, 0.1));
    }

    .need-card-equipment {
        border-color: var(--color-primary);
    }

    .need-icon {
        width: 50px;
        height: 50px;
        margin-bottom: 1rem;
    }

    .need-icon svg {
        width: 100%;
        height: 100%;
    }

    .need-card h3 {
        font-family: var(--font-display);
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: var(--color-text);
    }

    .need-card p {
        color: var(--color-text-muted);
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .need-card p strong {
        color: var(--color-accent);
    }

    .need-tag {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: rgba(107, 140, 174, 0.2);
        color: var(--color-primary-light);
        font-size: 0.75rem;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .need-tag-important {
        background: rgba(201, 168, 108, 0.2);
        color: var(--color-accent);
    }

    .need-tag-equipment {
        background: rgba(139, 168, 199, 0.2);
        color: var(--color-primary-light);
    }

    .needs-contact {
        text-align: center;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid var(--color-border);
    }

    .needs-contact p {
        color: var(--color-text-muted);
        margin-bottom: 1rem;
    }

    @media (max-width: 1024px) {
        .needs-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .needs-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Other Help Section */
    .other-help-section {
        padding: 4rem 0;
        border-top: 1px solid var(--color-border);
    }

    .other-help-title {
        font-family: var(--font-display);
        font-size: 2rem;
        text-align: center;
        margin-bottom: 2rem;
        color: var(--color-text);
    }

    .other-help-subtitle {
        text-align: center;
        color: var(--color-text-muted);
        margin-bottom: 3rem;
        font-size: 1.1rem;
    }

    .help-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .help-card {
        background: var(--color-bg-card);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid var(--color-border);
        text-align: center;
        transition: all 0.3s ease;
    }

    .help-card:hover {
        transform: translateY(-5px);
        border-color: var(--color-accent);
    }

    .help-card-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 1.5rem;
        background: var(--color-bg-medium);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .help-card-icon svg {
        width: 35px;
        height: 35px;
    }

    .help-card h3 {
        font-family: var(--font-display);
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
        color: var(--color-accent);
    }

    .help-card p {
        color: var(--color-text-muted);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Help Contacts Section */
    .help-contacts-section {
        padding: 4rem 0;
        border-top: 1px solid var(--color-border);
    }

    .help-contacts-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .help-contact-card {
        background: var(--color-bg-card);
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid var(--color-border);
        text-align: center;
        transition: all 0.3s ease;
    }

    .help-contact-card:hover {
        border-color: var(--color-primary);
        transform: translateY(-3px);
    }

    .help-contact-main {
        border-color: var(--color-accent);
        background: linear-gradient(135deg, var(--color-bg-card), rgba(201, 168, 108, 0.1));
    }

    .help-contact-avatar {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .help-contact-badge {
        display: inline-block;
        background: var(--color-accent);
        color: var(--color-bg-dark);
        padding: 0.2rem 0.75rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 0.75rem;
    }

    .help-contact-role {
        color: var(--color-accent);
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .help-contact-card h3 {
        font-family: var(--font-display);
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: var(--color-text);
    }

    .help-contact-card a,
    .help-contact-phone {
        color: var(--color-text-muted);
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
        display: block;
    }

    .help-contact-card a:hover,
    .help-contact-phone:hover {
        color: var(--color-accent);
    }

    .help-contact-phone {
        font-size: 1rem;
        color: var(--color-text);
    }

    @media (max-width: 900px) {
        .help-contacts-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 500px) {
        .help-contacts-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Thank You Note */
    .thank-you-section {
        padding: 4rem 0;
        text-align: center;
    }

    .thank-you-card {
        max-width: 700px;
        margin: 0 auto;
        background: linear-gradient(135deg, var(--color-bg-card), var(--color-bg-medium));
        border-radius: 24px;
        padding: 3rem;
        border: 1px solid var(--color-border);
    }

    .thank-you-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .thank-you-title {
        font-family: var(--font-display);
        font-size: 1.8rem;
        margin-bottom: 1rem;
        color: var(--color-accent);
    }

    .thank-you-text {
        color: var(--color-text-muted);
        font-size: 1.1rem;
        line-height: 1.8;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .help-cards-grid {
            grid-template-columns: 1fr;
        }

        .help-title {
            font-size: 2.5rem;
        }

        .event-info-card {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .event-location {
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .help-hero {
            padding: 8rem 1.5rem 3rem;
        }

        .help-title {
            font-size: 2.5rem;
        }

        .help-subtitle {
            font-size: 1.1rem;
        }

        .collection-complete-section {
            padding: 3rem 0;
        }

        .collection-complete-card {
            padding: 2rem 1.5rem;
            margin: 0;
        }

        .collection-complete-title {
            font-size: 1.6rem;
        }

        .needs-section {
            padding: 3rem 0;
        }

        .needs-grid {
            grid-template-columns: 1fr;
        }

        .other-help-section {
            padding: 3rem 0;
        }

        .thank-you-section {
            padding: 3rem 0;
        }

        .thank-you-card {
            padding: 2rem 1.5rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="help-hero">
        <div class="help-hero-content">
            <div class="help-badge">
                <span>✓</span>
                Сбор завершён
            </div>
            <h1 class="help-title">Как помочь проекту</h1>
            <p class="help-subtitle">
                «Голоса Единства» — некоммерческий культурный проект. 
                Благодарим всех, кто поддержал нас!
            </p>
        </div>
    </section>

    <!-- Collection Complete Section -->
    <section class="collection-complete-section container">
        <div class="collection-complete-card">
            <div class="collection-complete-content">
                <div class="collection-complete-icon">🎉</div>
                <h2 class="collection-complete-title">Сбор средств завершён!</h2>
                <p class="collection-complete-text">
                    Благодарим всех, кто поддержал наш проект! Благодаря вашей помощи мы смогли 
                    записать 15 прекрасных сказок народов России. Теперь приглашаем вас на 
                    торжественное открытие проекта!
                </p>
                <a href="{{ route('opening') }}" class="collection-complete-cta">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    Подробнее о мероприятии
                </a>
            </div>
        </div>
    </section>

    <!-- Event Info Section -->
    <section class="event-info-section container">
        <div class="event-info-card">
            <div class="event-date-block">
                <div class="event-date-day">4</div>
                <div class="event-date-month">января</div>
                <div class="event-date-time">13:00 — 16:00</div>
            </div>
            <div class="event-info-content">
                <h3>Торжественное открытие проекта</h3>
                <p>
                    Приглашаем вас на праздник, где вы сможете первыми услышать записанные сказки, 
                    познакомиться с командой проекта и принять участие в творческих мастер-классах.
                </p>
                <div class="event-location">
                    <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    Территория развития «Гранд Каньон», 3 этаж, «Дивный город»
                </div>
            </div>
        </div>
    </section>

    <!-- What We Need Section -->
    <section class="needs-section container">
        <h2 class="section-title" style="text-align: center;">Что ещё нам нужно</h2>
        <p class="section-subtitle" style="text-align: center;">Проекту по-прежнему требуются ресурсы и специалисты</p>

        <div class="needs-grid">
            <!-- Студии звукозаписи -->
            <div class="need-card">
                <div class="need-icon">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="20" cy="20" r="8" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <circle cx="20" cy="20" r="3" fill="#c9a86c"/>
                        <path d="M20 8 L20 5 M20 35 L20 32 M8 20 L5 20 M35 20 L32 20" stroke="#6b8cae" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3>Студии звукозаписи</h3>
                <p>Ищем студии для профессиональной записи озвучки сказок</p>
                <span class="need-tag">Партнёрство</span>
            </div>

            <!-- Звукорежиссёры -->
            <div class="need-card">
                <div class="need-icon">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="8" y="15" width="24" height="14" rx="2" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <path d="M12 20 L12 24 M16 18 L16 26 M20 16 L20 28 M24 18 L24 26 M28 20 L28 24" stroke="#6b8cae" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3>Звукорежиссёры</h3>
                <p>Специалисты для обработки и сведения аудиозаписей</p>
                <span class="need-tag">Волонтёры</span>
            </div>

            <!-- Ведущие -->
            <div class="need-card">
                <div class="need-icon">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="20" cy="12" r="6" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <path d="M10 32 Q10 22 20 22 Q30 22 30 32" stroke="#6b8cae" stroke-width="2" fill="none"/>
                        <path d="M15 18 L12 35 M25 18 L28 35" stroke="#c9a86c" stroke-width="1.5" opacity="0.5"/>
                    </svg>
                </div>
                <h3>Ведущие мероприятий</h3>
                <p>Ведущие для торжественного открытия проекта</p>
                <span class="need-tag">Волонтёры</span>
            </div>

            <!-- Мастер-классы -->
            <div class="need-card">
                <div class="need-icon">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 8 L20 20 L28 28" stroke="#c9a86c" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="20" cy="20" r="14" stroke="#6b8cae" stroke-width="2" fill="none"/>
                        <circle cx="20" cy="20" r="2" fill="#c9a86c"/>
                    </svg>
                </div>
                <h3>Ведущие мастер-классов</h3>
                <p>Люди, которые смогут провести творческие мастер-классы</p>
                <span class="need-tag">Волонтёры</span>
            </div>

            <!-- Аниматоры -->
            <div class="need-card">
                <div class="need-icon">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="5" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <circle cx="25" cy="15" r="5" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <path d="M10 28 Q10 22 15 22 M20 22 Q25 22 25 28 M30 28 Q30 22 25 22" stroke="#6b8cae" stroke-width="2" fill="none"/>
                        <path d="M15 32 L15 35 M25 32 L25 35" stroke="#6b8cae" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3>Аниматоры для детей</h3>
                <p>Аниматоры для работы с детьми на мероприятиях проекта</p>
                <span class="need-tag">Волонтёры</span>
            </div>

            <!-- Актёры и певцы -->
            <div class="need-card need-card-highlight">
                <div class="need-icon">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 5 L22 12 L30 12 L24 17 L26 25 L20 20 L14 25 L16 17 L10 12 L18 12 Z" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <circle cx="20" cy="32" r="4" stroke="#6b8cae" stroke-width="2" fill="none"/>
                    </svg>
                </div>
                <h3>Актёры и известные певцы</h3>
                <p>Ищем контакты с известными людьми для озвучки сказок</p>
                <span class="need-tag need-tag-important">Очень нужно</span>
            </div>

            <!-- Наушники -->
            <div class="need-card need-card-equipment">
                <div class="need-icon">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 22 Q10 12 20 12 Q30 12 30 22" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <rect x="6" y="22" width="6" height="10" rx="2" stroke="#6b8cae" stroke-width="2" fill="none"/>
                        <rect x="28" y="22" width="6" height="10" rx="2" stroke="#6b8cae" stroke-width="2" fill="none"/>
                    </svg>
                </div>
                <h3>Bluetooth-наушники</h3>
                <p>Нужны <strong>20 штук</strong> для включения сказок на мероприятии</p>
                <span class="need-tag need-tag-equipment">Оборудование</span>
            </div>
        </div>

        <div class="needs-contact">
            <p>Если вы можете помочь — напишите нам:</p>
            <a href="mailto:info@golosa-edinstva.ru" class="btn btn-primary">
                Написать на почту
            </a>
        </div>
    </section>

    <!-- Other Help Section -->
    <section class="other-help-section container">
        <h2 class="other-help-title">Простые способы помочь</h2>
        <p class="other-help-subtitle">Каждый может внести свой вклад</p>

        <div class="help-cards-grid">
            <div class="help-card">
                <div class="help-card-icon">
                    <svg viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="17.5" cy="17.5" r="14" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <path d="M12 17.5 L22 17.5 M17.5 12 L17.5 23" stroke="#6b8cae" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3>Стать партнёром</h3>
                <p>Культурные организации, фонды и компании могут стать официальными партнёрами проекта</p>
            </div>

            <div class="help-card">
                <div class="help-card-icon">
                    <svg viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="17.5" cy="10" r="5" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <path d="M8 28 Q8 20 17.5 20 Q27 20 27 28" stroke="#6b8cae" stroke-width="2" fill="none"/>
                    </svg>
                </div>
                <h3>Стать волонтёром</h3>
                <p>Помогите проекту своим временем и навыками — любая помощь ценна</p>
            </div>

            <div class="help-card">
                <div class="help-card-icon">
                    <svg viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5 5 L20 12 L28 12 L22 17 L24 25 L17.5 20 L11 25 L13 17 L7 12 L15 12 Z" stroke="#c9a86c" stroke-width="2" fill="none"/>
                    </svg>
                </div>
                <h3>Рассказать друзьям</h3>
                <p>Поделитесь информацией о проекте в социальных сетях и с друзьями</p>
            </div>
        </div>
    </section>

    <!-- Contacts Section -->
    <section class="help-contacts-section container">
        <h2 class="section-title" style="text-align: center;">Свяжитесь с нами</h2>
        <p class="section-subtitle" style="text-align: center;">По вопросам помощи и сотрудничества</p>

        <div class="help-contacts-grid">
            <div class="help-contact-card help-contact-main">
                <div class="help-contact-avatar">👩‍💼</div>
                <span class="help-contact-badge">Координатор</span>
                <h3>Юля Титова</h3>
                <a href="tel:+79215939096" class="help-contact-phone">+7 (921) 593-90-96</a>
            </div>

            <div class="help-contact-card">
                <div class="help-contact-role">Финансы</div>
                <h3>Татьяна Б.</h3>
                <a href="tel:+79523968567">+7 (952) 396-85-67</a>
            </div>

            <div class="help-contact-card">
                <div class="help-contact-role">Производство</div>
                <h3>Ольга</h3>
                <a href="tel:+79522392609">+7 (952) 239-26-09</a>
            </div>

            <div class="help-contact-card">
                <div class="help-contact-role">Продюсер</div>
                <h3>Олеся</h3>
                <a href="tel:+79111216162">+7 (911) 121-61-62</a>
            </div>
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('contacts') }}" class="btn btn-secondary">Все контакты →</a>
        </div>
    </section>

    <!-- Thank You Section -->
    <section class="thank-you-section container">
        <div class="thank-you-card">
            <div class="thank-you-icon">🙏</div>
            <h2 class="thank-you-title">Благодарим за поддержку!</h2>
            <p class="thank-you-text">
                Каждый вклад приблизил нас к цели — создать бесплатную аудиобиблиотеку 
                народных сказок для всех жителей России. Вместе мы сохраним культурное 
                наследие для будущих поколений.
            </p>
        </div>
    </section>
@endsection
