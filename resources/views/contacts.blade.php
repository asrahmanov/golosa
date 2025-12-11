@extends('layouts.app')

@section('title', 'Контакты — Голоса Единства')

@section('styles')
<style>
    .contacts-hero {
        padding: 10rem 2rem 4rem;
        text-align: center;
        position: relative;
    }

    .contacts-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center top, rgba(107, 140, 174, 0.15) 0%, transparent 60%);
        pointer-events: none;
    }

    .contacts-hero-content {
        max-width: 700px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .contacts-title {
        font-family: var(--font-display);
        font-size: 3.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-accent-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .contacts-subtitle {
        color: var(--color-text-muted);
        font-size: 1.2rem;
        line-height: 1.7;
    }

    /* Coordinator Section */
    .coordinator-section {
        padding: 3rem 0;
    }

    .coordinator-card {
        max-width: 500px;
        margin: 0 auto;
        background: linear-gradient(135deg, var(--color-bg-card), rgba(201, 168, 108, 0.1));
        border-radius: 24px;
        padding: 2.5rem;
        border: 2px solid var(--color-accent);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .coordinator-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(ellipse at center, rgba(201, 168, 108, 0.05) 0%, transparent 50%);
        animation: rotate 30s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .coordinator-content {
        position: relative;
        z-index: 1;
    }

    .coordinator-badge {
        display: inline-block;
        background: var(--color-accent);
        color: var(--color-bg-dark);
        padding: 0.35rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 1rem;
    }

    .coordinator-avatar {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        background: var(--color-bg-medium);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        border: 3px solid var(--color-accent);
    }

    .coordinator-name {
        font-family: var(--font-display);
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
        color: var(--color-text);
    }

    .coordinator-role {
        color: var(--color-accent);
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .coordinator-phone {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: var(--color-bg-medium);
        padding: 1rem 1.5rem;
        border-radius: 12px;
        text-decoration: none;
        color: var(--color-text);
        font-size: 1.2rem;
        font-family: var(--font-display);
        transition: all 0.3s ease;
    }

    .coordinator-phone:hover {
        background: var(--color-accent);
        color: var(--color-bg-dark);
    }

    .coordinator-phone svg {
        width: 24px;
        height: 24px;
    }

    /* Departments Section */
    .departments-section {
        padding: 4rem 0;
    }

    .departments-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }

    .department-card {
        background: var(--color-bg-card);
        border-radius: 16px;
        padding: 1.75rem;
        border: 1px solid var(--color-border);
        transition: all 0.3s ease;
        text-align: center;
    }

    .department-card:hover {
        border-color: var(--color-primary);
        transform: translateY(-5px);
    }

    .department-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 1rem;
        background: var(--color-bg-medium);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .department-icon svg {
        width: 24px;
        height: 24px;
    }

    .department-name {
        font-family: var(--font-display);
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
        color: var(--color-text);
    }

    .department-role {
        color: var(--color-accent);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
    }

    .department-phone {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .department-phone a {
        color: var(--color-text-muted);
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.3s ease;
    }

    .department-phone a:hover {
        color: var(--color-accent);
    }

    /* Contact Methods */
    .contact-methods {
        padding: 4rem 0;
        background: var(--color-bg-medium);
    }

    .methods-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .method-card {
        background: var(--color-bg-card);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid var(--color-border);
        text-align: center;
        transition: all 0.3s ease;
    }

    .method-card:hover {
        border-color: var(--color-accent);
    }

    .method-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 1rem;
        background: var(--color-bg-medium);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .method-card h3 {
        font-family: var(--font-display);
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        color: var(--color-text);
    }

    .method-card p {
        color: var(--color-text-muted);
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .method-card a {
        color: var(--color-accent);
        text-decoration: none;
        font-weight: 500;
    }

    .method-card a:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .departments-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .contacts-title {
            font-size: 2.5rem;
        }

        .departments-grid {
            grid-template-columns: 1fr;
        }

        .methods-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="contacts-hero">
        <div class="contacts-hero-content">
            <h1 class="contacts-title">Контакты</h1>
            <p class="contacts-subtitle">
                Свяжитесь с нами по любым вопросам сотрудничества, партнёрства или участия в проекте
            </p>
        </div>
    </section>

    <!-- Coordinator Section -->
    <section class="coordinator-section container">
        <div class="coordinator-card">
            <div class="coordinator-content">
                <span class="coordinator-badge">Координатор проекта</span>
                <div class="coordinator-avatar">👩‍💼</div>
                <h2 class="coordinator-name">Юля Титова</h2>
                <p class="coordinator-role">Главный координатор</p>
                <a href="tel:+79215939096" class="coordinator-phone">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    +7 (921) 593-90-96
                </a>
            </div>
        </div>
    </section>

    <!-- Departments Section -->
    <section class="departments-section container">
        <h2 class="section-title" style="text-align: center;">Отделы проекта</h2>
        <p class="section-subtitle" style="text-align: center;">Обратитесь напрямую в нужный отдел</p>

        <div class="departments-grid">
            <div class="department-card">
                <div class="department-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#c9a86c" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </div>
                <h3 class="department-name">Юля Рон</h3>
                <p class="department-role">СМИ</p>
                <div class="department-phone">
                    <a href="tel:+79095790347">+7 (909) 579-03-47</a>
                </div>
            </div>

            <div class="department-card">
                <div class="department-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#c9a86c" stroke-width="2">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                        <line x1="2" y1="20" x2="22" y2="20"/>
                    </svg>
                </div>
                <h3 class="department-name">Татьяна Б.</h3>
                <p class="department-role">Финансы</p>
                <div class="department-phone">
                    <a href="tel:+79523968567">+7 (952) 396-85-67</a>
                </div>
            </div>

            <div class="department-card">
                <div class="department-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#c9a86c" stroke-width="2">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                    </svg>
                </div>
                <h3 class="department-name">Ольга</h3>
                <p class="department-role">Производство</p>
                <div class="department-phone">
                    <a href="tel:+79522392609">+7 (952) 239-26-09</a>
                </div>
            </div>

            <div class="department-card">
                <div class="department-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#c9a86c" stroke-width="2">
                        <path d="M12 20h9"/>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                    </svg>
                </div>
                <h3 class="department-name">Алексей</h3>
                <p class="department-role">Редакция</p>
                <div class="department-phone">
                    <a href="tel:+79160230202">+7 (916) 023-02-02</a>
                </div>
            </div>

            <div class="department-card">
                <div class="department-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#c9a86c" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                </div>
                <h3 class="department-name">Олеся</h3>
                <p class="department-role">Продюсер</p>
                <div class="department-phone">
                    <a href="tel:+79111216162">+7 (911) 121-61-62</a>
                </div>
            </div>

            <div class="department-card">
                <div class="department-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#c9a86c" stroke-width="2">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                </div>
                <h3 class="department-name">Алиса</h3>
                <p class="department-role">SMM</p>
                <div class="department-phone">
                    <a href="tel:+79110529690">+7 (911) 052-96-90</a>
                    <a href="tel:+79217260072">+7 (921) 726-00-72</a>
                </div>
            </div>

            <div class="department-card">
                <div class="department-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#c9a86c" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <line x1="9" y1="3" x2="9" y2="21"/>
                    </svg>
                </div>
                <h3 class="department-name">Виктор</h3>
                <p class="department-role">Презентации</p>
                <div class="department-phone">
                    <a href="tel:+79504525253">+7 (950) 452-52-53</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Methods -->
    <section class="contact-methods">
        <div class="container">
            <h2 class="section-title" style="text-align: center;">Другие способы связи</h2>
            <p class="section-subtitle" style="text-align: center;">Выберите удобный способ</p>

            <div class="methods-grid">
                <div class="method-card">
                    <div class="method-icon">📧</div>
                    <h3>Email</h3>
                    <p>Напишите нам на почту</p>
                    <a href="mailto:info@golosa-edinstva.ru">info@golosa-edinstva.ru</a>
                </div>

                <div class="method-card">
                    <div class="method-icon">💬</div>
                    <h3>Telegram</h3>
                    <p>Быстрая связь в мессенджере</p>
                    <a href="https://t.me/golosa_edinstva" target="_blank">@golosa_edinstva</a>
                </div>

                <div class="method-card">
                    <div class="method-icon">🌐</div>
                    <h3>ВКонтакте</h3>
                    <p>Следите за новостями</p>
                    <a href="https://vk.com/golosa_edinstva" target="_blank">vk.com/golosa_edinstva</a>
                </div>
            </div>
        </div>
    </section>
@endsection

