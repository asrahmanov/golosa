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

    /* Coming Soon Section */
    .coming-soon-section {
        padding: 4rem 0 8rem;
    }

    .coming-soon-card {
        max-width: 800px;
        margin: 0 auto;
        background: var(--color-bg-card);
        border-radius: 24px;
        padding: 4rem;
        border: 1px solid var(--color-border);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .coming-soon-card::before {
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

    .coming-soon-content {
        position: relative;
        z-index: 1;
    }

    .coming-soon-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 2rem;
        background: linear-gradient(135deg, var(--color-bg-medium), var(--color-bg-card));
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
        inset: -8px;
        border: 1px dashed var(--color-accent);
        border-radius: 50%;
        animation: spinSlow 20s linear infinite;
    }

    @keyframes spinSlow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .coming-soon-icon svg {
        width: 50px;
        height: 50px;
    }

    .coming-soon-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(201, 168, 108, 0.15);
        border: 1px solid rgba(201, 168, 108, 0.3);
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-size: 0.9rem;
        color: var(--color-accent);
        margin-bottom: 1.5rem;
    }

    .coming-soon-title {
        font-family: var(--font-display);
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--color-text);
    }

    .coming-soon-text {
        color: var(--color-text-muted);
        font-size: 1.15rem;
        line-height: 1.8;
        margin-bottom: 2rem;
        max-width: 550px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Progress indicators */
    .progress-section {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid var(--color-border);
    }

    .progress-title {
        font-family: var(--font-display);
        font-size: 1.2rem;
        color: var(--color-accent);
        margin-bottom: 1.5rem;
    }

    .progress-items {
        display: flex;
        justify-content: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .progress-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--color-text-muted);
        font-size: 0.95rem;
    }

    .progress-item-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
    }

    .progress-item-icon.done {
        background: rgba(107, 174, 107, 0.2);
        color: #6bae6b;
    }

    .progress-item-icon.in-progress {
        background: rgba(201, 168, 108, 0.2);
        color: var(--color-accent);
        animation: pulse 2s ease-in-out infinite;
    }

    .progress-item-icon.pending {
        background: rgba(143, 163, 186, 0.2);
        color: var(--color-text-muted);
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Notification form */
    .notify-section {
        margin-top: 2.5rem;
    }

    .notify-text {
        color: var(--color-text-muted);
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .notify-form {
        display: flex;
        gap: 0.75rem;
        max-width: 400px;
        margin: 0 auto;
    }

    .notify-input {
        flex: 1;
        padding: 0.875rem 1.25rem;
        background: var(--color-bg-medium);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        color: var(--color-text);
        font-size: 1rem;
        font-family: var(--font-body);
    }

    .notify-input:focus {
        outline: none;
        border-color: var(--color-accent);
    }

    .notify-input::placeholder {
        color: var(--color-text-muted);
    }

    .notify-btn {
        padding: 0.875rem 1.5rem;
        background: linear-gradient(135deg, var(--color-accent), var(--color-accent-light));
        border: none;
        border-radius: 12px;
        color: var(--color-bg-dark);
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .notify-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(201, 168, 108, 0.3);
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

        .coming-soon-section {
            padding: 3rem 0 5rem;
        }

        .coming-soon-card {
            padding: 2rem 1.5rem;
            margin: 0;
            border-radius: 16px;
        }

        .coming-soon-title {
            font-size: 1.6rem;
        }

        .coming-soon-text {
            font-size: 1rem;
        }

        .notify-form {
            flex-direction: column;
            gap: 1rem;
        }

        .notify-input {
            width: 100%;
        }

        .progress-items {
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }

        .progress-item {
            width: 100%;
            max-width: 280px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
document.getElementById('subscribeForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = this;
    const email = document.getElementById('subscribeEmail').value;
    const btn = document.getElementById('subscribeBtn');
    const message = document.getElementById('subscribeMessage');
    
    // Показываем загрузку
    btn.disabled = true;
    btn.textContent = '...';
    
    try {
        const response = await fetch('{{ route("subscribe") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ email: email, source: 'tales_page' })
        });
        
        const data = await response.json();
        
        if (data.success) {
            message.textContent = data.message;
            message.style.display = 'block';
            message.style.color = 'var(--color-accent)';
            form.reset();
            
            if (!data.already_subscribed) {
                btn.textContent = '✓ Готово';
                btn.style.background = 'rgba(107, 174, 107, 0.3)';
            } else {
                btn.textContent = 'Уведомить';
            }
        } else {
            throw new Error(data.message || 'Ошибка');
        }
    } catch (error) {
        message.textContent = 'Произошла ошибка. Попробуйте ещё раз.';
        message.style.display = 'block';
        message.style.color = '#e57373';
        btn.textContent = 'Уведомить';
    }
    
    btn.disabled = false;
});
</script>
@endsection

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <h1 class="page-title">Библиотека сказок</h1>
        <p class="page-subtitle">
            Аудиосказки народов России, озвученные голосами известных людей
        </p>
    </section>

    <!-- Coming Soon Section -->
    <section class="coming-soon-section container">
        <div class="coming-soon-card">
            <div class="coming-soon-content">
                <div class="coming-soon-icon">
                    <svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25 5 L25 25 L35 35" stroke="#c9a86c" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="25" cy="25" r="20" stroke="#6b8cae" stroke-width="2" fill="none"/>
                        <circle cx="25" cy="5" r="2" fill="#c9a86c"/>
                        <circle cx="45" cy="25" r="2" fill="#c9a86c"/>
                        <circle cx="25" cy="45" r="2" fill="#c9a86c"/>
                        <circle cx="5" cy="25" r="2" fill="#c9a86c"/>
                    </svg>
                </div>

                <div class="coming-soon-badge">
                    <span>🎧</span>
                    Скоро открытие
                </div>

                <h2 class="coming-soon-title">Скоро вы сможете послушать</h2>
                
                <p class="coming-soon-text">
                    Мы собираем коллекцию народных сказок из разных уголков России. 
                    Известные актёры, музыканты и общественные деятели уже готовятся 
                    озвучить эти мудрые истории для вас.
                </p>

                <div class="progress-section">
                    <h3 class="progress-title">Этапы подготовки</h3>
                    <div class="progress-items">
                        <div class="progress-item">
                            <div class="progress-item-icon in-progress">●</div>
                            <span>Сбор сказок</span>
                        </div>
                        <div class="progress-item">
                            <div class="progress-item-icon in-progress">●</div>
                            <span>Приглашение чтецов</span>
                        </div>
                        <div class="progress-item">
                            <div class="progress-item-icon pending">○</div>
                            <span>Запись озвучки</span>
                        </div>
                        <div class="progress-item">
                            <div class="progress-item-icon pending">○</div>
                            <span>Публикация</span>
                        </div>
                    </div>
                </div>

                <div class="notify-section">
                    <p class="notify-text">Хотите узнать первыми о запуске?</p>
                    <form class="notify-form" id="subscribeForm">
                        @csrf
                        <input type="email" name="email" class="notify-input" id="subscribeEmail" placeholder="Ваш email" required>
                        <button type="submit" class="notify-btn" id="subscribeBtn">Уведомить</button>
                    </form>
                    <p class="notify-message" id="subscribeMessage" style="display: none; margin-top: 1rem; color: var(--color-accent);"></p>
                </div>
            </div>
        </div>
    </section>
@endsection
