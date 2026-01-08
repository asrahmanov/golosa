@extends('layouts.app')

@section('title', 'Результаты проекта — Голоса Единства')

@section('styles')
<style>
    /* Hide default footer for landing effect */
    .footer {
        display: none;
    }

    /* Full-page sections */
    .results-container {
        scroll-snap-type: y mandatory;
        overflow-y: scroll;
        height: 100vh;
        scroll-behavior: smooth;
    }

    .result-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        scroll-snap-align: start;
        position: relative;
        padding: 2rem;
        overflow: hidden;
    }

    /* Custom Scroll Indicator */
    .scroll-indicator {
        position: fixed;
        right: 2rem;
        top: 50%;
        transform: translateY(-50%);
        z-index: 100;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .scroll-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--color-border);
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .scroll-dot::before {
        content: '';
        position: absolute;
        inset: -4px;
        border: 2px solid transparent;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .scroll-dot.active {
        background: var(--color-accent);
        transform: scale(1.2);
    }

    .scroll-dot.active::before {
        border-color: var(--color-accent);
    }

    .scroll-dot:hover {
        background: var(--color-accent-light);
    }

    /* Section backgrounds */
    .result-section::before {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0.03;
        background-size: 100px 100px;
        background-image: 
            linear-gradient(var(--color-accent) 1px, transparent 1px),
            linear-gradient(90deg, var(--color-accent) 1px, transparent 1px);
    }

    /* Hero Section */
    .hero-section {
        background: radial-gradient(ellipse at center, var(--color-bg-medium) 0%, var(--color-bg-dark) 100%);
    }

    .hero-content {
        text-align: center;
        max-width: 900px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: rgba(201, 168, 108, 0.1);
        border: 1px solid var(--color-accent);
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        margin-bottom: 2rem;
        font-size: 0.95rem;
        color: var(--color-accent);
        letter-spacing: 0.05em;
    }

    .hero-title {
        font-family: var(--font-display);
        font-size: 5rem;
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-accent) 50%, var(--color-primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        opacity: 0;
        transform: translateY(50px);
        animation: heroReveal 1s ease-out 0.3s forwards;
    }

    @keyframes heroReveal {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-subtitle {
        font-size: 1.4rem;
        color: var(--color-text-muted);
        max-width: 600px;
        margin: 0 auto 3rem;
        opacity: 0;
        animation: heroReveal 1s ease-out 0.5s forwards;
    }

    .scroll-hint {
        opacity: 0;
        animation: heroReveal 1s ease-out 0.8s forwards;
    }

    .scroll-hint-text {
        font-size: 0.9rem;
        color: var(--color-text-muted);
        margin-bottom: 1rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

    .scroll-arrow {
        width: 30px;
        height: 50px;
        border: 2px solid var(--color-accent);
        border-radius: 15px;
        margin: 0 auto;
        position: relative;
    }

    .scroll-arrow::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 8px;
        width: 6px;
        height: 6px;
        background: var(--color-accent);
        border-radius: 50%;
        transform: translateX(-50%);
        animation: scrollBounce 2s ease-in-out infinite;
    }

    @keyframes scrollBounce {
        0%, 100% { top: 8px; opacity: 1; }
        50% { top: 28px; opacity: 0.3; }
    }

    /* Stat Section */
    .stat-content {
        text-align: center;
        max-width: 1000px;
        opacity: 0;
        transform: translateY(100px) scale(0.9);
        transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .stat-content.visible {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    /* Custom Icons */
    .stat-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 2rem;
        position: relative;
    }

    .stat-icon svg {
        width: 100%;
        height: 100%;
        stroke: var(--color-accent);
        fill: none;
        stroke-width: 1.5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .stat-icon::before {
        content: '';
        position: absolute;
        inset: -20px;
        background: radial-gradient(circle, rgba(201, 168, 108, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        animation: iconPulse 3s ease-in-out infinite;
    }

    @keyframes iconPulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .stat-icon-ring {
        position: absolute;
        inset: -30px;
        border: 1px dashed var(--color-accent);
        border-radius: 50%;
        opacity: 0.3;
        animation: iconSpin 20s linear infinite;
    }

    @keyframes iconSpin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .stat-label {
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: var(--color-accent);
        margin-bottom: 1rem;
    }

    .stat-value {
        font-family: var(--font-display);
        font-size: 10rem;
        font-weight: 700;
        line-height: 1;
        background: linear-gradient(180deg, var(--color-text) 0%, var(--color-primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1rem;
    }

    .stat-suffix {
        font-size: 4rem;
        vertical-align: top;
        margin-left: 0.5rem;
    }

    .stat-description {
        font-size: 1.5rem;
        color: var(--color-text-muted);
        margin-bottom: 2rem;
    }

    .stat-extra {
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        background: var(--color-bg-card);
        border: 1px solid var(--color-border);
        padding: 1rem 2rem;
        border-radius: 60px;
        font-size: 1.1rem;
    }

    .stat-extra-highlight {
        color: var(--color-accent);
        font-weight: 700;
    }

    /* Progress Ring */
    .progress-ring {
        width: 200px;
        height: 200px;
        margin: 2rem auto;
        position: relative;
    }

    .progress-ring svg {
        transform: rotate(-90deg);
    }

    .progress-ring-bg {
        fill: none;
        stroke: var(--color-bg-card);
        stroke-width: 8;
    }

    .progress-ring-fill {
        fill: none;
        stroke: var(--color-accent);
        stroke-width: 8;
        stroke-linecap: round;
        stroke-dasharray: 565;
        stroke-dashoffset: 565;
        transition: stroke-dashoffset 2s ease-out;
    }

    .progress-ring-text {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .progress-ring-value {
        font-family: var(--font-display);
        font-size: 3rem;
        font-weight: 700;
        color: var(--color-accent);
    }

    .progress-ring-label {
        font-size: 0.9rem;
        color: var(--color-text-muted);
    }

    /* Fundraising Section */
    .fundraising-section {
        background: linear-gradient(180deg, var(--color-bg-dark) 0%, var(--color-bg-medium) 50%, var(--color-bg-dark) 100%);
    }

    .fundraising-value {
        font-family: var(--font-display);
        font-size: 8rem;
        font-weight: 700;
        color: var(--color-accent);
        line-height: 1;
    }

    .fundraising-currency {
        font-size: 3rem;
        vertical-align: top;
    }

    .success-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        color: white;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.2rem;
        margin-top: 2rem;
        box-shadow: 0 10px 40px rgba(34, 197, 94, 0.3);
    }

    .success-icon {
        width: 24px;
        height: 24px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .success-icon svg {
        width: 14px;
        height: 14px;
        stroke: #22c55e;
        stroke-width: 3;
    }

    /* Media Section */
    .media-section {
        background: var(--color-bg-dark);
    }

    .media-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 2rem;
        max-width: 1200px;
        width: 100%;
    }

    .media-card {
        background: var(--color-bg-card);
        border: 1px solid var(--color-border);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(50px);
    }

    .media-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .media-card:hover {
        transform: translateY(-10px);
        border-color: var(--color-accent);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .media-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-light) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .media-icon svg {
        width: 28px;
        height: 28px;
        stroke: var(--color-bg-dark);
        fill: none;
        stroke-width: 2;
    }

    .media-count {
        font-family: var(--font-display);
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 0.5rem;
    }

    .media-label {
        font-size: 0.95rem;
        color: var(--color-text-muted);
    }

    /* Links Section */
    .links-section {
        background: linear-gradient(180deg, var(--color-bg-dark) 0%, var(--color-bg-medium) 100%);
    }

    .links-content {
        max-width: 1000px;
        width: 100%;
    }

    .links-title {
        font-family: var(--font-display);
        font-size: 3rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 3rem;
        color: var(--color-text);
    }

    .links-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .link-card {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        background: var(--color-bg-card);
        border: 1px solid var(--color-border);
        border-radius: 16px;
        padding: 1.5rem;
        text-decoration: none;
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateX(-30px);
    }

    .link-card.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .link-card:hover {
        border-color: var(--color-accent);
        transform: translateX(10px);
        background: var(--color-bg-medium);
    }

    .link-status {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #22c55e, #4ade80);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .link-status svg {
        width: 20px;
        height: 20px;
        stroke: white;
        stroke-width: 3;
    }

    .link-info {
        flex: 1;
    }

    .link-name {
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 0.25rem;
    }

    .link-url {
        font-size: 0.85rem;
        color: var(--color-primary-light);
    }

    .link-arrow {
        width: 24px;
        height: 24px;
        stroke: var(--color-text-muted);
        transition: all 0.3s ease;
    }

    .link-card:hover .link-arrow {
        stroke: var(--color-accent);
        transform: translateX(5px);
    }

    /* Final CTA Section */
    .cta-section {
        background: radial-gradient(ellipse at center, var(--color-bg-medium) 0%, var(--color-bg-dark) 100%);
    }

    .cta-content {
        text-align: center;
        max-width: 700px;
    }

    .cta-title {
        font-family: var(--font-display);
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-accent) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .cta-text {
        font-size: 1.3rem;
        color: var(--color-text-muted);
        margin-bottom: 2.5rem;
    }

    .cta-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .media-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .scroll-indicator {
            display: none;
        }

        .hero-title {
            font-size: 2.8rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .stat-value {
            font-size: 5rem;
        }

        .stat-suffix {
            font-size: 2rem;
        }

        .stat-description {
            font-size: 1.2rem;
        }

        .stat-icon {
            width: 80px;
            height: 80px;
        }

        .fundraising-value {
            font-size: 4rem;
        }

        .fundraising-currency {
            font-size: 1.5rem;
        }

        .media-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .media-card {
            padding: 1.5rem 1rem;
        }

        .media-count {
            font-size: 2rem;
        }

        .links-grid {
            grid-template-columns: 1fr;
        }

        .links-title {
            font-size: 2rem;
        }

        .cta-title {
            font-size: 2.2rem;
        }

        .cta-text {
            font-size: 1.1rem;
        }

        .result-section {
            padding: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .media-grid {
            grid-template-columns: 1fr 1fr;
        }

        .stat-extra {
            flex-direction: column;
            gap: 0.5rem;
            padding: 1rem 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="results-container" id="resultsContainer">
    <!-- Scroll Indicator -->
    <div class="scroll-indicator" id="scrollIndicator">
        <div class="scroll-dot active" data-section="0"></div>
        <div class="scroll-dot" data-section="1"></div>
        <div class="scroll-dot" data-section="2"></div>
        <div class="scroll-dot" data-section="3"></div>
        <div class="scroll-dot" data-section="4"></div>
        <div class="scroll-dot" data-section="5"></div>
        <div class="scroll-dot" data-section="6"></div>
    </div>

    <!-- Hero -->
    <section class="result-section hero-section">
        <div class="hero-content">
            <div class="hero-badge">
                <span>Культурно-благотворительный проект</span>
            </div>
            <h1 class="hero-title">Результаты проекта</h1>
            <p class="hero-subtitle">Голоса Единства — всероссийская аудиобиблиотека народных сказок к Году единства народов России</p>
            <div class="scroll-hint">
                <div class="scroll-hint-text">Листайте вниз</div>
                <div class="scroll-arrow"></div>
            </div>
        </div>
    </section>

    <!-- Listens -->
    <section class="result-section">
        <div class="stat-content">
            <div class="stat-icon">
                <div class="stat-icon-ring"></div>
                <svg viewBox="0 0 24 24">
                    <path d="M3 18v-6a9 9 0 0 1 18 0v6"/>
                    <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>
                </svg>
            </div>
            <div class="stat-label">Прослушиваний</div>
            <div class="stat-value">
                <span data-counter="3246">0</span>
            </div>
            <div class="stat-description">аудиосказок прослушано</div>
            <div class="stat-extra">
                <span>План: 1 107</span>
                <span class="stat-extra-highlight">Выполнено на 293%</span>
            </div>
        </div>
    </section>

    <!-- Fundraising -->
    <section class="result-section fundraising-section">
        <div class="stat-content">
            <div class="stat-icon">
                <div class="stat-icon-ring"></div>
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 6v12"/>
                    <path d="M15 9.5c0-1.38-1.34-2.5-3-2.5s-3 1.12-3 2.5c0 1.38 1.34 2.5 3 2.5s3 1.12 3 2.5c0 1.38-1.34 2.5-3 2.5"/>
                </svg>
            </div>
            <div class="stat-label">Собрано средств</div>
            <div class="fundraising-value">
                <span data-counter="258118">0</span>
                <span class="fundraising-currency">₽</span>
            </div>
            <div class="stat-description">из 250 000 ₽ цели</div>
            <div class="progress-ring">
                <svg width="200" height="200">
                    <circle class="progress-ring-bg" cx="100" cy="100" r="90"/>
                    <circle class="progress-ring-fill" cx="100" cy="100" r="90" data-progress="103"/>
                </svg>
                <div class="progress-ring-text">
                    <div class="progress-ring-value">103%</div>
                    <div class="progress-ring-label">цели</div>
                </div>
            </div>
            <div class="success-badge">
                <span class="success-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </span>
                Цель достигнута!
            </div>
        </div>
    </section>

    <!-- Blogger Reach -->
    <section class="result-section">
        <div class="stat-content">
            <div class="stat-icon">
                <div class="stat-icon-ring"></div>
                <svg viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="stat-label">Охват блогеров</div>
            <div class="stat-value">
                <span data-counter="481000">0</span>
            </div>
            <div class="stat-description">подписчиков охвачено</div>
            <div class="stat-extra">
                <span>Блог «1001образ | Стиль»</span>
                <span class="stat-extra-highlight">Катерина Красивова</span>
            </div>
        </div>
    </section>

    <!-- Media Coverage -->
    <section class="result-section media-section">
        <div class="stat-content" style="max-width: 1200px;">
            <div class="stat-label" style="margin-bottom: 3rem;">Медийное покрытие</div>
            <div class="media-grid">
                <div class="media-card">
                    <div class="media-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                            <path d="M18 14h-8"/>
                            <path d="M15 18h-5"/>
                            <path d="M10 6h8v4h-8z"/>
                        </svg>
                    </div>
                    <div class="media-count" data-counter="2">0</div>
                    <div class="media-label">Печатные СМИ</div>
                </div>
                <div class="media-card">
                    <div class="media-icon">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="2"/>
                            <path d="M16.24 7.76a6 6 0 0 1 0 8.49m-8.48-.01a6 6 0 0 1 0-8.49m11.31-2.82a10 10 0 0 1 0 14.14m-14.14 0a10 10 0 0 1 0-14.14"/>
                        </svg>
                    </div>
                    <div class="media-count" data-counter="2">0</div>
                    <div class="media-label">Радио эфиры</div>
                </div>
                <div class="media-card">
                    <div class="media-icon">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="7" width="20" height="15" rx="2" ry="2"/>
                            <polyline points="17 2 12 7 7 2"/>
                        </svg>
                    </div>
                    <div class="media-count" data-counter="1">0</div>
                    <div class="media-label">ТВ сюжеты</div>
                </div>
                <div class="media-card">
                    <div class="media-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 20h9"/>
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                        </svg>
                    </div>
                    <div class="media-count" data-counter="1">0</div>
                    <div class="media-label">Блогеры</div>
                </div>
                <div class="media-card">
                    <div class="media-icon">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="2" y1="12" x2="22" y2="12"/>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                    </div>
                    <div class="media-count" data-counter="6">0</div>
                    <div class="media-label">Интернет СМИ</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Links -->
    <section class="result-section links-section">
        <div class="links-content">
            <h2 class="links-title">Публикации</h2>
            <div class="links-grid">
                <a href="https://argumenti.ru/society/2025/12/981293" target="_blank" class="link-card">
                    <div class="link-status">
                        <svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="link-info">
                        <div class="link-name">Аргументы недели</div>
                        <div class="link-url">argumenti.ru</div>
                    </div>
                    <svg class="link-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="https://gazeta.spb.ru/2647261-v-peterburge-zapustyat-proekt-po-sozdaniyu-audioteki-skazok-narodov-strany/" target="_blank" class="link-card">
                    <div class="link-status">
                        <svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="link-info">
                        <div class="link-name">Gazeta.SPb</div>
                        <div class="link-url">gazeta.spb.ru</div>
                    </div>
                    <svg class="link-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="https://gazeta-lo.ru/2025/12/29/v-peterburge-startuet-kulturno-blagotvoritelnyj-proekt-golosa-edinstva/" target="_blank" class="link-card">
                    <div class="link-status">
                        <svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="link-info">
                        <div class="link-name">Gazeta.LO</div>
                        <div class="link-url">gazeta-lo.ru</div>
                    </div>
                    <svg class="link-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="https://nevskiy.pro/v-peterburge-startuet-kulturno-blagotvoritelnyj-proekt-golosa-edinstva/" target="_blank" class="link-card">
                    <div class="link-status">
                        <svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="link-info">
                        <div class="link-name">Nevskiy.pro</div>
                        <div class="link-url">nevskiy.pro</div>
                    </div>
                    <svg class="link-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="https://allnw.ru/2025/12/29/v-peterburge-startuet-kulturno-blagotvoritelnyj-proekt-golosa-edinstva/" target="_blank" class="link-card">
                    <div class="link-status">
                        <svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="link-info">
                        <div class="link-name">AllNW.ru</div>
                        <div class="link-url">allnw.ru</div>
                    </div>
                    <svg class="link-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="https://trk-canyon.ru/events/priglasaem-vas-nacat-god-s-otkrytiia-audiobiblioteki-narodnyx-skazok-golosa-edinstva" target="_blank" class="link-card">
                    <div class="link-status">
                        <svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="link-info">
                        <div class="link-name">ТРК «Гранд Каньон»</div>
                        <div class="link-url">trk-canyon.ru</div>
                    </div>
                    <svg class="link-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="result-section cta-section">
        <div class="cta-content stat-content">
            <h2 class="cta-title">Спасибо за поддержку!</h2>
            <p class="cta-text">Вместе мы сохраняем культурное наследие народов России для будущих поколений</p>
            <div class="cta-buttons">
                <a href="{{ route('tales.index') }}" class="btn btn-primary">Слушать сказки</a>
                <a href="{{ route('home') }}" class="btn btn-secondary">На главную</a>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    const container = document.getElementById('resultsContainer');
    const sections = container.querySelectorAll('.result-section');
    const dots = document.querySelectorAll('.scroll-dot');
    const statContents = document.querySelectorAll('.stat-content');
    const mediaCards = document.querySelectorAll('.media-card');
    const linkCards = document.querySelectorAll('.link-card');

    // Animate counter
    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const startTime = performance.now();
        
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeProgress = 1 - Math.pow(1 - progress, 4);
            const current = Math.floor(start + (target - start) * easeProgress);
            element.textContent = current.toLocaleString('ru-RU');
            
            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }
        
        requestAnimationFrame(update);
    }

    // Animate progress ring
    function animateProgressRing(element, progress) {
        const circumference = 2 * Math.PI * 90;
        const offset = circumference - (progress / 100) * circumference;
        element.style.strokeDashoffset = offset;
    }

    // Intersection Observer for sections
    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const index = Array.from(sections).indexOf(entry.target);
                
                // Update dots
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });

                // Animate content
                const content = entry.target.querySelector('.stat-content');
                if (content && !content.classList.contains('visible')) {
                    content.classList.add('visible');
                    
                    // Animate counters in this section
                    content.querySelectorAll('[data-counter]').forEach(counter => {
                        const target = parseInt(counter.dataset.counter);
                        setTimeout(() => animateCounter(counter, target, 2500), 300);
                    });

                    // Animate progress ring
                    const progressRing = content.querySelector('[data-progress]');
                    if (progressRing) {
                        setTimeout(() => {
                            animateProgressRing(progressRing, parseInt(progressRing.dataset.progress));
                        }, 500);
                    }
                }

                // Animate media cards
                if (entry.target.classList.contains('media-section')) {
                    const cards = entry.target.querySelectorAll('.media-card');
                    cards.forEach((card, i) => {
                        setTimeout(() => {
                            card.classList.add('visible');
                            const counter = card.querySelector('[data-counter]');
                            if (counter) {
                                animateCounter(counter, parseInt(counter.dataset.counter), 1500);
                            }
                        }, i * 100);
                    });
                }

                // Animate link cards
                if (entry.target.classList.contains('links-section')) {
                    const cards = entry.target.querySelectorAll('.link-card');
                    cards.forEach((card, i) => {
                        setTimeout(() => card.classList.add('visible'), i * 100);
                    });
                }
            }
        });
    }, { threshold: 0.5 });

    sections.forEach(section => sectionObserver.observe(section));

    // Dot navigation
    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            sections[i].scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        const currentIndex = Array.from(dots).findIndex(d => d.classList.contains('active'));
        
        if (e.key === 'ArrowDown' && currentIndex < sections.length - 1) {
            e.preventDefault();
            sections[currentIndex + 1].scrollIntoView({ behavior: 'smooth' });
        }
        if (e.key === 'ArrowUp' && currentIndex > 0) {
            e.preventDefault();
            sections[currentIndex - 1].scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>
@endsection
