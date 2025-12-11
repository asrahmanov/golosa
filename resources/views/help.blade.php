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
        background: rgba(201, 168, 108, 0.15);
        border: 1px solid rgba(201, 168, 108, 0.3);
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-size: 0.85rem;
        color: var(--color-accent);
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

    /* Payment Section */
    .payment-section {
        padding: 4rem 0;
    }

    .payment-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: start;
    }

    .payment-qr-card {
        background: var(--color-bg-card);
        border-radius: 24px;
        padding: 2.5rem;
        border: 1px solid var(--color-border);
        text-align: center;
    }

    .payment-qr-title {
        font-family: var(--font-display);
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        color: var(--color-accent);
    }

    .payment-qr-image {
        width: 280px;
        height: 280px;
        margin: 0 auto 1.5rem;
        background: #fff;
        border-radius: 16px;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .payment-qr-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .payment-qr-hint {
        color: var(--color-text-muted);
        font-size: 0.9rem;
    }

    /* Details Card */
    .payment-details-card {
        background: var(--color-bg-card);
        border-radius: 24px;
        padding: 2.5rem;
        border: 1px solid var(--color-border);
    }

    .payment-details-title {
        font-family: var(--font-display);
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        color: var(--color-accent);
    }

    .payment-recipient {
        background: var(--color-bg-medium);
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .payment-recipient-name {
        font-family: var(--font-display);
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        color: var(--color-text);
    }

    .payment-recipient-phone {
        color: var(--color-accent);
        font-size: 1.1rem;
    }

    .payment-details-list {
        list-style: none;
    }

    .payment-details-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--color-border);
    }

    .payment-details-item:last-child {
        border-bottom: none;
    }

    .payment-details-label {
        color: var(--color-text-muted);
        font-size: 0.9rem;
    }

    .payment-details-value {
        color: var(--color-text);
        font-size: 0.95rem;
        text-align: right;
        word-break: break-all;
        margin-left: 1rem;
        font-family: 'Courier New', monospace;
    }

    .copy-btn {
        background: none;
        border: none;
        color: var(--color-accent);
        cursor: pointer;
        font-size: 0.85rem;
        padding: 0.25rem 0.5rem;
        margin-left: 0.5rem;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .copy-btn:hover {
        background: rgba(201, 168, 108, 0.2);
    }

    /* Alternative Payment Section */
    .alt-payment-section {
        padding: 4rem 0;
        border-top: 1px solid var(--color-border);
    }

    .alt-payment-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin-top: 2rem;
    }

    .alt-payment-card {
        background: var(--color-bg-card);
        border-radius: 20px;
        padding: 2.5rem;
        border: 1px solid var(--color-border);
        text-align: center;
        transition: all 0.3s ease;
    }

    .alt-payment-card:hover {
        border-color: var(--color-accent);
        transform: translateY(-5px);
    }

    .alt-payment-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 1.5rem;
        background: var(--color-bg-medium);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .alt-payment-icon svg {
        width: 35px;
        height: 35px;
    }

    .alt-payment-card h3 {
        font-family: var(--font-display);
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: var(--color-text);
    }

    .alt-payment-card p {
        color: var(--color-text-muted);
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .alt-payment-phone {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin: 1rem 0;
    }

    .phone-number {
        font-family: var(--font-display);
        font-size: 1.4rem;
        color: var(--color-accent);
        letter-spacing: 0.02em;
    }

    .alt-payment-recipient {
        color: var(--color-text-muted);
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }

    .alt-payment-recipient strong {
        color: var(--color-text);
    }

    @media (max-width: 768px) {
        .alt-payment-grid {
            grid-template-columns: 1fr;
        }
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
        .payment-grid {
            grid-template-columns: 1fr;
        }

        .help-cards-grid {
            grid-template-columns: 1fr;
        }

        .help-title {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 600px) {
        .payment-qr-card,
        .payment-details-card {
            padding: 1.5rem;
        }

        .payment-qr-image {
            width: 220px;
            height: 220px;
        }

        .payment-details-item {
            flex-direction: column;
            gap: 0.5rem;
        }

        .payment-details-value {
            text-align: left;
            margin-left: 0;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="help-hero">
        <div class="help-hero-content">
            <div class="help-badge">
                <span>💝</span>
                Поддержите проект
            </div>
            <h1 class="help-title">Как помочь проекту</h1>
            <p class="help-subtitle">
                «Голоса Единства» — некоммерческий культурный проект. 
                Ваша поддержка поможет нам создать аудиобиблиотеку народных сказок России.
            </p>
        </div>
    </section>

    <!-- Payment Section -->
    <section class="payment-section container">
        <div class="payment-grid">
            <!-- QR Code -->
            <div class="payment-qr-card">
                <h2 class="payment-qr-title">Перевод по QR-коду</h2>
                <div class="payment-qr-image">
                    <img src="/img/qr-payment.jpg" alt="QR-код для оплаты">
                </div>
                <p class="payment-qr-hint">Отсканируйте QR-код в приложении вашего банка</p>
            </div>

            <!-- Bank Details -->
            <div class="payment-details-card">
                <h2 class="payment-details-title">Банковские реквизиты</h2>
                
                <div class="payment-recipient">
                    <div class="payment-recipient-name">Белова Елена Валерьевна</div>
                    <div class="payment-recipient-phone">+7 (921) 852-44-04</div>
                </div>

                <ul class="payment-details-list">
                    <li class="payment-details-item">
                        <span class="payment-details-label">Номер счёта</span>
                        <span class="payment-details-value">
                            40817810205611453252
                            <button class="copy-btn" onclick="copyToClipboard('40817810205611453252')">📋</button>
                        </span>
                    </li>
                    <li class="payment-details-item">
                        <span class="payment-details-label">Банк получателя</span>
                        <span class="payment-details-value">АО «Альфа-Банк», г. Москва</span>
                    </li>
                    <li class="payment-details-item">
                        <span class="payment-details-label">БИК</span>
                        <span class="payment-details-value">
                            044525593
                            <button class="copy-btn" onclick="copyToClipboard('044525593')">📋</button>
                        </span>
                    </li>
                    <li class="payment-details-item">
                        <span class="payment-details-label">ИНН Банка</span>
                        <span class="payment-details-value">7728168971</span>
                    </li>
                    <li class="payment-details-item">
                        <span class="payment-details-label">КПП Банка</span>
                        <span class="payment-details-value">770801001</span>
                    </li>
                    <li class="payment-details-item">
                        <span class="payment-details-label">Кор. счёт</span>
                        <span class="payment-details-value">
                            30101810200000000593
                            <button class="copy-btn" onclick="copyToClipboard('30101810200000000593')">📋</button>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Alternative Payment Section -->
    <section class="alt-payment-section container">
        <h2 class="section-title" style="text-align: center;">Альтернативные способы</h2>
        <p class="section-subtitle" style="text-align: center;">Выберите удобный для вас способ перевода</p>

        <div class="alt-payment-grid">
            <!-- Т-Банк -->
            <div class="alt-payment-card">
                <div class="alt-payment-icon">
                    <svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="8" y="15" width="34" height="22" rx="3" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <path d="M8 22 L42 22" stroke="#6b8cae" stroke-width="2"/>
                        <rect x="12" y="28" width="12" height="4" rx="1" fill="#c9a86c" opacity="0.5"/>
                    </svg>
                </div>
                <h3>Т-Банк (Тинькофф)</h3>
                <p>Быстрый перевод через платёжную страницу</p>
                <a href="https://www.tbank.ru/cf/3EmKMvrkg8t" target="_blank" class="btn btn-primary" style="margin-top: 1rem;">
                    Перевести через Т-Банк →
                </a>
            </div>

            <!-- По номеру телефона -->
            <div class="alt-payment-card">
                <div class="alt-payment-icon">
                    <svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="15" y="8" width="20" height="34" rx="3" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <circle cx="25" cy="36" r="2" fill="#6b8cae"/>
                        <path d="M20 12 L30 12" stroke="#6b8cae" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3>Перевод по номеру телефона</h3>
                <p>Переведите через приложение любого банка</p>
                <div class="alt-payment-phone">
                    <span class="phone-number">+7 916 023-02-02</span>
                    <button class="copy-btn" onclick="copyToClipboard('+79160230202')">📋</button>
                </div>
                <div class="alt-payment-recipient">
                    Получатель: <strong>Алексей Рахманов</strong>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Need Section -->
    <section class="needs-section container">
        <h2 class="section-title" style="text-align: center;">Что нам нужно</h2>
        <p class="section-subtitle" style="text-align: center;">Помимо финансовой поддержки, проекту требуются ресурсы и специалисты</p>

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
                Каждый вклад приближает нас к цели — создать бесплатную аудиобиблиотеку 
                народных сказок для всех жителей России. Вместе мы сохраним культурное 
                наследие для будущих поколений.
            </p>
        </div>
    </section>
@endsection

@section('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        // Показываем уведомление
        const notification = document.createElement('div');
        notification.textContent = 'Скопировано!';
        notification.style.cssText = `
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            background: var(--color-accent);
            color: var(--color-bg-dark);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            z-index: 1000;
            animation: fadeInUp 0.3s ease;
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 2000);
    });
}
</script>
@endsection

