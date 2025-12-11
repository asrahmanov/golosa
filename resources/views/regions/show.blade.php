@extends('layouts.app')

@section('title', $region->people_name . ' сказки — Голоса Единства')

@section('styles')
<style>
    .region-hero {
        padding: 10rem 2rem 4rem;
        position: relative;
        overflow: hidden;
    }

    .region-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center top, {{ $region->color }}44 0%, transparent 60%);
        pointer-events: none;
    }

    .region-hero-content {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .region-title {
        font-family: var(--font-display);
        font-size: 3.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, var(--color-text) 0%, {{ $region->color }} 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .region-people {
        font-size: 1.3rem;
        color: {{ $region->color }};
        margin-bottom: 1.5rem;
    }

    .region-description {
        color: var(--color-text-muted);
        font-size: 1.15rem;
        line-height: 1.8;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Coming Soon Section */
    .coming-soon-section {
        padding: 4rem 0 6rem;
    }

    .coming-soon-card {
        max-width: 600px;
        margin: 0 auto;
        background: var(--color-bg-card);
        border-radius: 20px;
        padding: 3rem;
        border: 1px solid var(--color-border);
        text-align: center;
    }

    .coming-soon-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: var(--color-bg-medium);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }

    .coming-soon-title {
        font-family: var(--font-display);
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--color-accent);
    }

    .coming-soon-text {
        color: var(--color-text-muted);
        font-size: 1rem;
        line-height: 1.7;
    }

    /* Back Button */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--color-text-muted);
        text-decoration: none;
        font-size: 0.95rem;
        margin-bottom: 2rem;
        transition: color 0.3s ease;
    }

    .back-link:hover {
        color: var(--color-text);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .region-hero {
            padding: 8rem 1.5rem 3rem;
        }

        .region-title {
            font-size: 2.2rem;
        }

        .region-people {
            font-size: 1.1rem;
        }

        .region-description {
            font-size: 1.05rem;
        }

        .coming-soon-section {
            padding: 2rem 0 4rem;
        }

        .back-link {
            margin-bottom: 1.5rem;
        }

        .coming-soon-card {
            margin: 0;
            padding: 2rem 1.5rem;
            border-radius: 16px;
        }

        .coming-soon-title {
            font-size: 1.5rem;
        }

        .coming-soon-text {
            font-size: 1rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Region Hero -->
    <section class="region-hero">
        <div class="region-hero-content">
            <h1 class="region-title">{{ $region->name }}</h1>
            <p class="region-people">{{ $region->people_name }} народные сказки</p>
            @if($region->description)
            <p class="region-description">{{ $region->description }}</p>
            @endif
        </div>
    </section>

    <!-- Coming Soon Section -->
    <section class="coming-soon-section container">
        <a href="{{ route('regions.index') }}" class="back-link">← Все народы</a>
        
        <div class="coming-soon-card">
            <div class="coming-soon-icon">🎧</div>
            <h2 class="coming-soon-title">Сказки готовятся</h2>
            <p class="coming-soon-text">
                Мы собираем {{ mb_strtolower($region->people_name) }} народные сказки 
                и приглашаем известных людей для их озвучки. 
                Скоро здесь появятся аудиозаписи мудрых историй этого народа.
            </p>
        </div>
    </section>
@endsection
