@extends('layouts.app')

@section('title', 'Народы России — Голоса Единства')

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
        background: radial-gradient(ellipse at center top, rgba(201, 168, 108, 0.15) 0%, transparent 60%);
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
        max-width: 700px;
        margin: 0 auto;
    }

    /* Regions Map Style Grid */
    .regions-section {
        padding: 4rem 0 6rem;
    }

    .regions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
    }

    .region-card {
        position: relative;
        background: var(--color-bg-card);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--color-border);
        transition: all 0.4s ease;
        text-decoration: none;
        color: var(--color-text);
    }

    .region-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        border-color: var(--region-color, var(--color-accent));
    }

    .region-card-header {
        height: 150px;
        position: relative;
        overflow: hidden;
    }

    .region-card-bg {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--region-color, var(--color-primary)) 0%, transparent 100%);
        opacity: 0.3;
    }

    .region-card-pattern {
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .region-card-icon {
        position: absolute;
        bottom: -20px;
        right: 20px;
        font-size: 5rem;
        opacity: 0.3;
        transition: transform 0.4s ease;
    }

    .region-card:hover .region-card-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .region-card-content {
        padding: 2rem;
        position: relative;
    }

    .region-card-title {
        font-family: var(--font-display);
        font-size: 1.6rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .region-card-people {
        font-size: 1rem;
        color: var(--region-color, var(--color-accent));
        margin-bottom: 1rem;
    }

    .region-card-desc {
        color: var(--color-text-muted);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .region-card-stats {
        display: flex;
        gap: 1.5rem;
    }

    .region-stat {
        display: flex;
        flex-direction: column;
    }

    .region-stat-value {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--region-color, var(--color-accent));
    }

    .region-stat-label {
        font-size: 0.8rem;
        color: var(--color-text-muted);
    }

    .coming-soon-badge-small {
        background: rgba(201, 168, 108, 0.2);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem !important;
    }

    .region-card-arrow {
        position: absolute;
        bottom: 2rem;
        right: 2rem;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .region-card:hover .region-card-arrow {
        background: var(--region-color, var(--color-accent));
        color: var(--color-bg-dark);
    }

    /* Info Section */
    .info-section {
        padding: 4rem 0;
        background: var(--color-bg-medium);
        text-align: center;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-top: 3rem;
    }

    .info-card {
        background: var(--color-bg-card);
        border-radius: 16px;
        padding: 2rem;
        border: 1px solid var(--color-border);
    }

    .info-card-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 1.5rem;
    }

    .info-card-icon svg {
        width: 100%;
        height: 100%;
    }

    .info-card h3 {
        font-family: var(--font-display);
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
    }

    .info-card p {
        color: var(--color-text-muted);
        font-size: 0.95rem;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2.5rem;
        }

        .regions-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <h1 class="page-title">Народы России</h1>
        <p class="page-subtitle">
            Россия — многонациональная страна, богатая культурным наследием. 
            Откройте для себя мудрость разных народов через их сказки.
        </p>
    </section>

    <!-- Regions Grid -->
    <section class="regions-section container">
        <div class="regions-grid">
            @foreach($regions as $region)
            <a href="{{ route('regions.show', $region) }}" class="region-card" style="--region-color: {{ $region->color }};">
                <div class="region-card-header">
                    <div class="region-card-bg"></div>
                    <div class="region-card-pattern"></div>
                </div>
                <div class="region-card-content">
                    <h2 class="region-card-title">{{ $region->name }}</h2>
                    <p class="region-card-people">{{ $region->people_name }}</p>
                    @if($region->description)
                    <p class="region-card-desc">{{ Str::limit($region->description, 120) }}</p>
                    @endif
                    <div class="region-card-stats">
                        <div class="region-stat">
                            <span class="region-stat-value coming-soon-badge-small">Скоро</span>
                            <span class="region-stat-label">Сказки готовятся</span>
                        </div>
                    </div>
                    <div class="region-card-arrow">→</div>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <!-- Info Section -->
    <section class="info-section">
        <div class="container">
            <h2 class="section-title">Многообразие культур</h2>
            <p class="section-subtitle">
                Каждый народ хранит уникальные традиции и мудрость поколений
            </p>
            
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-card-icon">
                        <svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25 8 L25 42" stroke="#c9a86c" stroke-width="2"/>
                            <path d="M25 8 Q12 10 8 13 L8 38 Q12 35 25 33" stroke="#6b8cae" stroke-width="2" fill="none"/>
                            <path d="M25 8 Q38 10 42 13 L42 38 Q38 35 25 33" stroke="#6b8cae" stroke-width="2" fill="none"/>
                            <path d="M12 18 L22 16" stroke="#8ba8c7" stroke-width="1.5" opacity="0.5"/>
                            <path d="M12 24 L22 22" stroke="#8ba8c7" stroke-width="1.5" opacity="0.5"/>
                            <path d="M28 16 L38 18" stroke="#8ba8c7" stroke-width="1.5" opacity="0.5"/>
                            <path d="M28 22 L38 24" stroke="#8ba8c7" stroke-width="1.5" opacity="0.5"/>
                        </svg>
                    </div>
                    <h3>Уникальные сюжеты</h3>
                    <p>Каждая сказка отражает уникальный взгляд народа на мир, природу и человеческие отношения</p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">
                        <svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="18" cy="22" r="8" stroke="#c9a86c" stroke-width="2" fill="none"/>
                            <circle cx="32" cy="22" r="8" stroke="#c9a86c" stroke-width="2" fill="none"/>
                            <path d="M10 38 Q10 30 18 30" stroke="#6b8cae" stroke-width="2" fill="none"/>
                            <path d="M40 38 Q40 30 32 30" stroke="#6b8cae" stroke-width="2" fill="none"/>
                            <path d="M18 30 Q25 28 32 30" stroke="#6b8cae" stroke-width="2" fill="none"/>
                            <circle cx="25" cy="35" r="3" fill="#c9a86c"/>
                        </svg>
                    </div>
                    <h3>Общие ценности</h3>
                    <p>Несмотря на различия, все народы России объединены общими ценностями добра, справедливости и взаимопомощи</p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">
                        <svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18 Q10 12 15 8 Q20 4 25 10 Q30 4 35 8 Q40 12 35 18" stroke="#c9a86c" stroke-width="2" fill="none"/>
                            <ellipse cx="25" cy="28" rx="12" ry="8" stroke="#6b8cae" stroke-width="2" fill="none"/>
                            <path d="M18 36 L18 44 M32 36 L32 44" stroke="#6b8cae" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="21" cy="26" r="2" fill="#c9a86c"/>
                            <circle cx="29" cy="26" r="2" fill="#c9a86c"/>
                            <path d="M22 31 Q25 33 28 31" stroke="#c9a86c" stroke-width="1.5" fill="none"/>
                        </svg>
                    </div>
                    <h3>Живое наследие</h3>
                    <p>Сказки передают мудрость предков новым поколениям, сохраняя культурную связь времён</p>
                </div>
            </div>
        </div>
    </section>
@endsection

