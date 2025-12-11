@extends('layouts.app')

@section('title', 'Скоро — Голоса Единства')

@section('styles')
<style>
    .coming-soon-page {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8rem 2rem 4rem;
    }

    .coming-soon-content {
        max-width: 600px;
        text-align: center;
    }

    .coming-soon-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 2rem;
        background: var(--color-bg-card);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--color-border);
        position: relative;
    }

    .coming-soon-icon::before {
        content: '';
        position: absolute;
        inset: -10px;
        border: 1px dashed var(--color-accent);
        border-radius: 50%;
        animation: spin 20s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .coming-soon-icon svg {
        width: 50px;
        height: 50px;
    }

    .coming-soon-title {
        font-family: var(--font-display);
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--color-accent);
    }

    .coming-soon-text {
        color: var(--color-text-muted);
        font-size: 1.15rem;
        line-height: 1.8;
        margin-bottom: 2rem;
    }
</style>
@endsection

@section('content')
    <section class="coming-soon-page">
        <div class="coming-soon-content">
            <div class="coming-soon-icon">
                <svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="25" cy="25" r="20" stroke="#6b8cae" stroke-width="2" fill="none"/>
                    <path d="M20 15 L35 25 L20 35 Z" fill="#c9a86c"/>
                </svg>
            </div>
            
            <h1 class="coming-soon-title">Скоро здесь появится сказка</h1>
            
            <p class="coming-soon-text">
                Мы готовим аудиобиблиотеку народных сказок России. 
                Известные актёры и общественные деятели уже записывают озвучку. 
                Совсем скоро вы сможете послушать эту сказку.
            </p>
            
            <a href="{{ route('tales.index') }}" class="btn btn-primary">
                ← Вернуться в библиотеку
            </a>
        </div>
    </section>
@endsection
