@extends('layouts.app')

@section('title', 'Библиотека сказок — Голоса Единства')

@section('styles')
<style>
    .page-header {
        padding: 10rem 2rem 4rem;
        text-align: center;
        position: relative;
    }

    .page-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center top, rgba(107, 140, 174, 0.15) 0%, transparent 60%);
        pointer-events: none;
    }

    .page-title {
        font-family: var(--font-display);
        font-size: 3.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-accent-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-subtitle {
        color: var(--color-text-muted);
        font-size: 1.2rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Yandex Music Section */
    .yandex-section {
        padding: 4rem 0;
    }

    .yandex-card {
        max-width: 700px;
        margin: 0 auto;
        background: var(--color-bg-card);
        border-radius: 24px;
        padding: 2.5rem;
        border: 1px solid var(--color-border);
        text-align: center;
    }

    .yandex-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 204, 0, 0.15);
        border: 1px solid rgba(255, 204, 0, 0.3);
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-size: 0.9rem;
        color: #ffcc00;
        margin-bottom: 1.5rem;
    }

    .yandex-title {
        font-family: var(--font-display);
        font-size: 1.8rem;
        margin-bottom: 1rem;
        color: var(--color-text);
    }

    .yandex-text {
        color: var(--color-text-muted);
        margin-bottom: 2rem;
        line-height: 1.7;
    }

    .yandex-iframe-wrapper {
        background: #fff;
        border-radius: 16px;
        padding: 1rem;
        display: inline-block;
    }

    .yandex-iframe-wrapper iframe {
        border-radius: 12px;
        max-width: 100%;
    }

    /* Tales Library Section */
    .tales-section {
        padding: 4rem 0 6rem;
    }

    .tales-grid {
        display: grid;
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .tale-card {
        background: var(--color-bg-card);
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid var(--color-border);
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 1.5rem;
        align-items: center;
        transition: all 0.3s ease;
    }

    .tale-card:hover {
        border-color: var(--color-accent);
        transform: translateY(-2px);
    }

    .tale-play-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--color-accent), var(--color-accent-light));
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .tale-play-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(201, 168, 108, 0.4);
    }

    .tale-play-btn.playing {
        background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
    }

    .tale-play-btn svg {
        width: 24px;
        height: 24px;
        fill: var(--color-bg-dark);
    }

    .tale-info {
        min-width: 0;
    }

    .tale-title {
        font-family: var(--font-display);
        font-size: 1.15rem;
        color: var(--color-text);
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .tale-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        align-items: center;
    }

    .tale-narrator {
        color: var(--color-accent);
        font-size: 0.9rem;
    }

    .tale-region {
        background: rgba(107, 140, 174, 0.2);
        color: var(--color-primary-light);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
    }

    .tale-duration {
        color: var(--color-text-muted);
        font-size: 0.85rem;
        white-space: nowrap;
    }

    /* Audio Progress */
    .tale-progress-container {
        display: none;
        grid-column: 1 / -1;
        padding-top: 1rem;
        border-top: 1px solid var(--color-border);
        margin-top: 1rem;
    }

    .tale-card.active .tale-progress-container {
        display: block;
    }

    .tale-progress-bar {
        width: 100%;
        height: 6px;
        background: var(--color-bg-medium);
        border-radius: 3px;
        cursor: pointer;
        position: relative;
    }

    .tale-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--color-accent), var(--color-accent-light));
        border-radius: 3px;
        width: 0%;
        transition: width 0.1s linear;
    }

    .tale-time {
        display: flex;
        justify-content: space-between;
        margin-top: 0.5rem;
        font-size: 0.8rem;
        color: var(--color-text-muted);
    }

    /* Stats Section */
    .stats-section {
        padding: 3rem 0;
        border-top: 1px solid var(--color-border);
        border-bottom: 1px solid var(--color-border);
        margin-bottom: 4rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        text-align: center;
    }

    .stat-item {
        padding: 1rem;
    }

    .stat-number {
        font-family: var(--font-display);
        font-size: 3rem;
        color: var(--color-accent);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--color-text-muted);
        font-size: 0.95rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 8rem 1.5rem 3rem;
        }

        .page-title {
            font-size: 2.2rem;
        }

        .page-subtitle {
            font-size: 1.05rem;
        }

        .yandex-section {
            padding: 3rem 0;
        }

        .yandex-card {
            padding: 1.5rem;
            margin: 0;
            border-radius: 16px;
        }

        .yandex-title {
            font-size: 1.4rem;
        }

        .yandex-iframe-wrapper {
            padding: 0.5rem;
            width: 100%;
        }

        .yandex-iframe-wrapper iframe {
            width: 100% !important;
            height: 400px !important;
        }

        .tales-section {
            padding: 3rem 0 5rem;
        }

        .tale-card {
            grid-template-columns: 1fr;
            gap: 1rem;
            padding: 1.25rem;
        }

        .tale-play-btn {
            width: 50px;
            height: 50px;
        }

        .tale-info {
            order: -1;
        }

        .tale-title {
            font-size: 1rem;
        }

        .tale-duration {
            display: none;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .stat-number {
            font-size: 2.5rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <h1 class="page-title">Библиотека сказок</h1>
        <p class="page-subtitle">
            Аудиосказки народов России, озвученные голосами известных людей
        </p>
    </section>

    <!-- Stats Section -->
    <section class="stats-section container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">15</div>
                <div class="stat-label">Записанных сказок</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">9</div>
                <div class="stat-label">Народов России</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">15</div>
                <div class="stat-label">Чтецов</div>
            </div>
        </div>
    </section>

    <!-- Yandex Music Section -->
    <section class="yandex-section container">
        <div class="yandex-card">
            <div class="yandex-badge">
                <span>🎵</span>
                Яндекс Музыка
            </div>
            <h2 class="yandex-title">Слушайте на Яндекс Музыке</h2>
            <p class="yandex-text">
                Все сказки проекта «Голоса Единства» доступны на Яндекс Музыке. 
                Слушайте в высоком качестве, добавляйте в плейлисты и делитесь с друзьями!
            </p>
            <div class="yandex-iframe-wrapper">
                <iframe frameborder="0" allow="clipboard-write" style="border:none;width:614px;height:556px;" width="614" height="556" src="https://music.yandex.ru/iframe/album/39779260">Слушайте <a href="https://music.yandex.ru/album/39779260?utm_source=web&utm_medium=copy_link">Голоса единства</a> на Яндекс Музыке</iframe>
            </div>
        </div>
    </section>

    <!-- Tales Library Section -->
    <section class="tales-section container">
        <h2 class="section-title" style="text-align: center;">Наша коллекция</h2>
        <p class="section-subtitle" style="text-align: center;">Слушайте сказки прямо на сайте</p>

        <div class="tales-grid">
            <!-- Сказка 1 -->
            <div class="tale-card" data-audio="/audio/«ВОЛК,-ЛИСА-И-ПЕТУХ»-Ингушетская-народная-сказка-читает-Анна-Колесникова-_-Anna-Kolesnikova.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Волк, Лиса и Петух</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Анна Колесникова</span>
                        <span class="tale-region">Ингушская</span>
                    </div>
                </div>
                <span class="tale-duration">2:30</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">2:30</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 2 -->
            <div class="tale-card" data-audio="/audio/«ЧЕТЫРЕ-ДРУГА»-Народная-сказка-сибирских-татар-читает-Методие-Бужор-_-Metodiye-Buzhor.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Четыре друга</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Методие Бужор</span>
                        <span class="tale-region">Сибирских татар</span>
                    </div>
                </div>
                <span class="tale-duration">8:40</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">8:40</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 3 -->
            <div class="tale-card" data-audio="/audio/«ЖЁРНОВ-ХИЙСИ-ИЛИ-ПОЧЕМУ-ВОДА-В-МОРЕ-СОЛЁНАЯ»-Карельская-народная-сказка-читает-Виктория-Полторак-_-Viktoriya-Poltorak.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Жёрнов Хийси, или Почему вода в море солёная</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Виктория Полторак</span>
                        <span class="tale-region">Карельская</span>
                    </div>
                </div>
                <span class="tale-duration">13:45</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">13:45</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 4 -->
            <div class="tale-card" data-audio="/audio/«ГОРДЫЙ-ОЛЕНЬ»-Мансийская-сказка-читает-Екатерина-Егорова-(опера)-_-Ekaterina-Egorova.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Гордый олень</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Екатерина Егорова (опера)</span>
                        <span class="tale-region">Мансийская</span>
                    </div>
                </div>
                <span class="tale-duration">8:40</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">8:40</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 5 -->
            <div class="tale-card" data-audio="/audio/«ПАХАРЬ,-КУЗНЕЦ-И-ПЛОТНИК-(ВРОЗЬ-—-ПЛОХО,-ВМЕСТЕ-—-ХОРОШО)»-Мордовская-народная-сказка-читает-Егор-Тимофеев-_-Egor-Timofeev.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Пахарь, Кузнец и Плотник (Врозь — плохо, вместе — хорошо)</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Егор Тимофеев</span>
                        <span class="tale-region">Мордовская</span>
                    </div>
                </div>
                <span class="tale-duration">4:20</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">4:20</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 6 -->
            <div class="tale-card" data-audio="/audio/«СТО-ЛОШАДЕЙ-ИЛИ-СТО-ДРУЗЕЙ_»-Осетинская-народная-сказка-читает-Глеб-Владимирович-Темнов-_-Gleb-Vladimirovich-Temnov.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Сто лошадей или сто друзей?</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Глеб Владимирович Темнов</span>
                        <span class="tale-region">Осетинская</span>
                    </div>
                </div>
                <span class="tale-duration">7:30</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">7:30</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 7 -->
            <div class="tale-card" data-audio="/audio/«ЛИСА-И-ЖУРАВЛЬ»-Русская-народная-сказка-читает-Вячеслав-Жеребкин-_-Vyacheslav-Zherebkin.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Лиса и Журавль</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Вячеслав Жеребкин</span>
                        <span class="tale-region">Русская</span>
                    </div>
                </div>
                <span class="tale-duration">3:55</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">3:55</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 8 -->
            <div class="tale-card" data-audio="/audio/«СИВКА-БУРКА»-Русская-народная-сказка-читает-Афи́на-Я́нисовна-Делиони́ди-_-Afina-Yanisovna-Delionidi.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Сивка-Бурка</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Афина Янисовна Делиониди</span>
                        <span class="tale-region">Русская</span>
                    </div>
                </div>
                <span class="tale-duration">18:00</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">18:00</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 9 -->
            <div class="tale-card" data-audio="/audio/«ПОТЕРЯННОЕ-СЛОВО»-Белорусская-народная-сказка-читает-Алексей-Обровец-_-Aleksey-Obrovets.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Потерянное слово</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Алексей Обровец</span>
                        <span class="tale-region">Белорусская</span>
                    </div>
                </div>
                <span class="tale-duration">5:30</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">5:30</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 10 -->
            <div class="tale-card" data-audio="/audio/«ГУСИ-ЛЕБЕДИ»-Русская-народная-сказка-читает-Александр-Шлеменко-_-Alexander-Shlemenko.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Гуси-Лебеди</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Александр Шлеменко</span>
                        <span class="tale-region">Русская</span>
                    </div>
                </div>
                <span class="tale-duration">9:10</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">9:10</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 11 -->
            <div class="tale-card" data-audio="/audio/«ПО-ЩУЧЬЕМУ-ВЕЛЕНИЮ»-русская-народная-сказка-читает-Виктор-Костенко-_-Viktor-Kostenko.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">По щучьему велению</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Виктор Костенко</span>
                        <span class="tale-region">Русская</span>
                    </div>
                </div>
                <span class="tale-duration">23:25</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">23:25</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 12 -->
            <div class="tale-card" data-audio="/audio/ВЕСЁЛЫЙ-ВОРОБЕЙ»-калмыцкая-народная-сказка-читает-Театральная-студия-УМКА-_-Theatre-Studio-UMKA.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Весёлый воробей</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Театральная студия УМКА</span>
                        <span class="tale-region">Калмыцкая</span>
                    </div>
                </div>
                <span class="tale-duration">4:30</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">4:30</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 13 -->
            <div class="tale-card" data-audio="/audio/«ЗОЛОТАЯ-БАБУШКА»-якутская-народная-сказка-читает-Светлана-Бесчастнова-_-Svetlana-Beschastnova.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Золотая бабушка</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Светлана Бесчастнова</span>
                        <span class="tale-region">Якутская</span>
                    </div>
                </div>
                <span class="tale-duration">5:45</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">5:45</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 14 -->
            <div class="tale-card" data-audio="/audio/«МОРОЗКО»-русская-народная-сказка-читает-Театральная-студия-УМКА-_-Theatre-Studio-UMKA.mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Морозко</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Театральная студия УМКА</span>
                        <span class="tale-region">Русская</span>
                    </div>
                </div>
                <span class="tale-duration">14:55</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">14:55</span>
                    </div>
                </div>
            </div>

            <!-- Сказка 15 -->
            <div class="tale-card" data-audio="/audio/«ЗИМОВЬЕ-ЗВЕРЕЙ»-русская-народная-сказка-читает-актриса-и-певица-Анна-Янкевич-(Штарке)-_-Anna-Iankevich-(Starke).mp3">
                <button class="tale-play-btn" onclick="togglePlay(this)">
                    <svg class="play-icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg class="pause-icon" style="display:none" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div class="tale-info">
                    <h3 class="tale-title">Зимовье зверей</h3>
                    <div class="tale-meta">
                        <span class="tale-narrator">Анна Янкевич (Штарке)</span>
                        <span class="tale-region">Русская</span>
                    </div>
                </div>
                <span class="tale-duration">10:30</span>
                <div class="tale-progress-container">
                    <div class="tale-progress-bar" onclick="seekAudio(event, this)">
                        <div class="tale-progress-fill"></div>
                    </div>
                    <div class="tale-time">
                        <span class="current-time">0:00</span>
                        <span class="total-time">10:30</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
let currentAudio = null;
let currentCard = null;

function togglePlay(btn) {
    const card = btn.closest('.tale-card');
    const audioSrc = card.dataset.audio;
    
    // Если кликнули на ту же карточку
    if (currentCard === card) {
        if (currentAudio.paused) {
            currentAudio.play();
            showPauseIcon(btn);
            card.classList.add('active');
        } else {
            currentAudio.pause();
            showPlayIcon(btn);
        }
        return;
    }
    
    // Остановить предыдущее аудио
    if (currentAudio) {
        currentAudio.pause();
        if (currentCard) {
            const prevBtn = currentCard.querySelector('.tale-play-btn');
            showPlayIcon(prevBtn);
            currentCard.classList.remove('active');
        }
    }
    
    // Создать новое аудио
    currentAudio = new Audio(audioSrc);
    currentCard = card;
    
    // Обработчики событий
    currentAudio.addEventListener('timeupdate', () => updateProgress(card));
    currentAudio.addEventListener('loadedmetadata', () => {
        const totalTime = card.querySelector('.total-time');
        totalTime.textContent = formatTime(currentAudio.duration);
    });
    currentAudio.addEventListener('ended', () => {
        showPlayIcon(btn);
        card.classList.remove('active');
        const progressFill = card.querySelector('.tale-progress-fill');
        progressFill.style.width = '0%';
    });
    
    currentAudio.play();
    showPauseIcon(btn);
    card.classList.add('active');
}

function showPlayIcon(btn) {
    btn.querySelector('.play-icon').style.display = 'block';
    btn.querySelector('.pause-icon').style.display = 'none';
    btn.classList.remove('playing');
}

function showPauseIcon(btn) {
    btn.querySelector('.play-icon').style.display = 'none';
    btn.querySelector('.pause-icon').style.display = 'block';
    btn.classList.add('playing');
}

function updateProgress(card) {
    if (!currentAudio) return;
    
    const progressFill = card.querySelector('.tale-progress-fill');
    const currentTimeEl = card.querySelector('.current-time');
    
    const percent = (currentAudio.currentTime / currentAudio.duration) * 100;
    progressFill.style.width = percent + '%';
    currentTimeEl.textContent = formatTime(currentAudio.currentTime);
}

function seekAudio(event, progressBar) {
    if (!currentAudio) return;
    
    const rect = progressBar.getBoundingClientRect();
    const percent = (event.clientX - rect.left) / rect.width;
    currentAudio.currentTime = percent * currentAudio.duration;
}

function formatTime(seconds) {
    const mins = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${mins}:${secs.toString().padStart(2, '0')}`;
}
</script>
@endsection
