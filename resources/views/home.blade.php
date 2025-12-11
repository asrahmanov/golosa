@extends('layouts.app')

@section('title', 'Голоса Единства — Аудиобиблиотека народных сказок России')

@section('styles')
<style>
    /* Hero Section */
    .hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 8rem 2rem 4rem;
        position: relative;
        overflow: hidden;
    }

    .hero-content {
        max-width: 900px;
        z-index: 1;
    }

    /* Hero Layout */
    .hero-layout {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4rem;
        position: relative;
        z-index: 2;
        max-width: 1200px;
        padding: 0 2rem;
    }

    .hero-layout .hero-content {
        text-align: left;
        max-width: 600px;
    }

    /* Hero Video Side */
    .hero-video-side {
        flex-shrink: 0;
    }

    .hero-video-circle {
        width: 280px;
        height: 280px;
        position: relative;
    }

    .hero-video-border {
        position: absolute;
        inset: -12px;
        border: 2px dashed var(--color-accent);
        border-radius: 50%;
        animation: hero-spin 25s linear infinite;
    }

    .hero-video-border::before {
        content: '';
        position: absolute;
        inset: -8px;
        border: 1px solid rgba(201, 168, 108, 0.3);
        border-radius: 50%;
        animation: hero-spin 40s linear infinite reverse;
    }

    @keyframes hero-spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .hero-video-inner {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        overflow: hidden;
        position: relative;
        z-index: 2;
        border: 4px solid var(--color-accent);
        box-shadow: 0 0 40px rgba(201, 168, 108, 0.3);
    }

    .hero-video-inner video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero-video-glow {
        position: absolute;
        inset: -30px;
        background: radial-gradient(circle, rgba(201, 168, 108, 0.25) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 1;
        animation: hero-pulse 4s ease-in-out infinite;
    }

    @keyframes hero-pulse {
        0%, 100% { opacity: 0.6; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.08); }
    }

    .hero-video-particles {
        position: absolute;
        inset: 0;
        z-index: 3;
        pointer-events: none;
    }

    .hero-video-particles span {
        position: absolute;
        width: 6px;
        height: 6px;
        background: var(--color-accent);
        border-radius: 50%;
        animation: hero-particle 6s ease-in-out infinite;
    }

    .hero-video-particles span:nth-child(1) { top: 5%; left: 50%; animation-delay: 0s; }
    .hero-video-particles span:nth-child(2) { top: 25%; right: 5%; animation-delay: 1.2s; }
    .hero-video-particles span:nth-child(3) { bottom: 25%; right: 10%; animation-delay: 2.4s; }
    .hero-video-particles span:nth-child(4) { bottom: 10%; left: 30%; animation-delay: 3.6s; }
    .hero-video-particles span:nth-child(5) { top: 30%; left: 5%; animation-delay: 4.8s; }

    @keyframes hero-particle {
        0%, 100% { opacity: 0; transform: scale(0) translateY(0); }
        50% { opacity: 1; transform: scale(1) translateY(-20px); }
    }

    @media (max-width: 900px) {
        .hero-layout {
            flex-direction: column-reverse;
            gap: 2rem;
        }

        .hero-layout .hero-content {
            text-align: center;
        }

        .hero-video-circle {
            width: 200px;
            height: 200px;
        }
    }

    /* Hero Sound Wave */
    .hero-sound-wave {
        position: absolute;
        bottom: 80px;
        left: 0;
        right: 0;
        height: 100px;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        gap: 4px;
        opacity: 0.12;
        pointer-events: none;
    }

    .hero-wave-bar {
        width: 4px;
        background: linear-gradient(to top, var(--color-accent), var(--color-primary-light));
        border-radius: 4px;
        animation: heroWave ease-in-out infinite;
    }

    @keyframes heroWave {
        0%, 100% { height: 15px; }
        50% { height: var(--wave-height, 50px); }
    }

    /* Circular Sound Rings */
    .sound-rings {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
        z-index: 0;
    }

    .sound-ring {
        position: absolute;
        border: 1px solid var(--color-accent);
        border-radius: 50%;
        opacity: 0;
        animation: ringPulse 4s ease-out infinite;
    }

    .sound-ring:nth-child(1) {
        width: 200px;
        height: 200px;
        margin-left: -100px;
        margin-top: -100px;
        animation-delay: 0s;
    }

    .sound-ring:nth-child(2) {
        width: 350px;
        height: 350px;
        margin-left: -175px;
        margin-top: -175px;
        animation-delay: 1s;
    }

    .sound-ring:nth-child(3) {
        width: 500px;
        height: 500px;
        margin-left: -250px;
        margin-top: -250px;
        animation-delay: 2s;
    }

    .sound-ring:nth-child(4) {
        width: 650px;
        height: 650px;
        margin-left: -325px;
        margin-top: -325px;
        animation-delay: 3s;
    }

    @keyframes ringPulse {
        0% {
            transform: scale(0.8);
            opacity: 0.4;
        }
        100% {
            transform: scale(1.2);
            opacity: 0;
        }
    }

    .hero-badge {
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
        animation: fadeInDown 0.8s ease;
    }

    .hero-title {
        font-family: var(--font-display);
        font-size: clamp(3rem, 8vw, 5.5rem);
        font-weight: 600;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-accent-light) 50%, var(--color-text) 100%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmer 4s linear infinite, fadeInUp 1s ease;
    }

    @keyframes shimmer {
        0% { background-position: 0% center; }
        100% { background-position: 200% center; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .hero-subtitle {
        font-size: 1.35rem;
        color: var(--color-text-muted);
        margin-bottom: 2.5rem;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        animation: fadeInUp 1s ease 0.2s both;
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        animation: fadeInUp 1s ease 0.4s both;
    }

    .hero-scroll {
        position: absolute;
        bottom: 3rem;
        left: 50%;
        transform: translateX(-50%);
        animation: bounce 2s infinite;
    }

    .hero-scroll span {
        display: block;
        width: 30px;
        height: 50px;
        border: 2px solid var(--color-border);
        border-radius: 25px;
        position: relative;
    }

    .hero-scroll span::before {
        content: '';
        position: absolute;
        top: 10px;
        left: 50%;
        width: 6px;
        height: 6px;
        background: var(--color-accent);
        border-radius: 50%;
        transform: translateX(-50%);
        animation: scroll 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
        40% { transform: translateX(-50%) translateY(-10px); }
        60% { transform: translateX(-50%) translateY(-5px); }
    }

    @keyframes scroll {
        0% { opacity: 1; top: 10px; }
        100% { opacity: 0; top: 30px; }
    }

    /* Quote Section */
    .quote-section {
        padding: 6rem 2rem;
        text-align: center;
        position: relative;
    }

    .quote {
        font-family: var(--font-display);
        font-size: 2rem;
        font-style: italic;
        color: var(--color-text);
        max-width: 800px;
        margin: 0 auto;
        position: relative;
    }

    .quote::before,
    .quote::after {
        content: '"';
        font-size: 4rem;
        color: var(--color-accent);
        opacity: 0.3;
        position: absolute;
    }

    .quote::before {
        top: -1.5rem;
        left: -1rem;
    }

    .quote::after {
        bottom: -3rem;
        right: -1rem;
    }

    .quote-source {
        margin-top: 2rem;
        color: var(--color-accent);
        font-size: 1rem;
    }

    /* Stats Section */
    .stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        padding: 4rem 0;
    }

    .stat-card {
        text-align: center;
        padding: 2rem;
        background: var(--color-bg-card);
        border-radius: 16px;
        border: 1px solid var(--color-border);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        border-color: var(--color-accent);
        transform: translateY(-5px);
    }

    .stat-number {
        font-family: var(--font-display);
        font-size: 3rem;
        font-weight: 700;
        color: var(--color-accent);
        display: block;
    }

    .stat-label {
        color: var(--color-text-muted);
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }

    /* Featured Tales */
    .featured-section {
        padding: 6rem 0;
    }

    .featured-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .tale-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        background: var(--color-bg-card);
        border: 1px solid var(--color-border);
        transition: all 0.4s ease;
    }

    .tale-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
        border-color: var(--color-primary);
    }

    .tale-card-image {
        height: 220px;
        background: linear-gradient(135deg, var(--color-bg-medium), var(--color-bg-card));
        position: relative;
        overflow: hidden;
    }

    .tale-card-image::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, var(--color-bg-card) 0%, transparent 50%);
        z-index: 1;
    }

    .tale-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .tale-card:hover .tale-card-image img {
        transform: scale(1.1);
    }

    .tale-card-region {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: rgba(15, 20, 25, 0.8);
        backdrop-filter: blur(10px);
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        color: var(--color-accent);
        z-index: 2;
        border: 1px solid var(--color-border);
    }

    .tale-card-play {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.8);
        width: 60px;
        height: 60px;
        background: var(--color-accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 2;
        box-shadow: 0 10px 30px rgba(201, 168, 108, 0.4);
    }

    .tale-card-play::before {
        content: '';
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 10px 0 10px 16px;
        border-color: transparent transparent transparent var(--color-bg-dark);
        margin-left: 4px;
    }

    .tale-card:hover .tale-card-play {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }

    .tale-card-content {
        padding: 1.5rem;
    }

    .tale-card-title {
        font-family: var(--font-display);
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--color-text);
    }

    .tale-card-narrator {
        font-size: 0.9rem;
        color: var(--color-text-muted);
        margin-bottom: 1rem;
    }

    .tale-card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
        color: var(--color-text-muted);
    }

    .tale-card-duration {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* Coming Preview Section */
    .coming-preview {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .coming-preview-card {
        background: var(--color-bg-card);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        border: 1px solid var(--color-border);
        text-align: center;
        transition: all 0.4s ease;
    }

    .coming-preview-card:hover {
        transform: translateY(-8px);
        border-color: var(--color-accent);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .coming-preview-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: var(--color-bg-medium);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.4s ease;
    }

    .coming-preview-card:hover .coming-preview-icon {
        transform: scale(1.1);
    }

    .coming-preview-icon svg {
        width: 40px;
        height: 40px;
    }

    .coming-preview-card h3 {
        font-family: var(--font-display);
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
        color: var(--color-accent);
    }

    .coming-preview-card p {
        color: var(--color-text-muted);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    @media (max-width: 900px) {
        .coming-preview {
            grid-template-columns: 1fr;
        }
    }

    /* Supported By Section */
    .supported-section {
        padding: 4rem 0;
    }

    .supported-content {
        text-align: center;
    }

    .supported-label {
        font-size: 0.9rem;
        color: var(--color-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.15em;
        margin-bottom: 1.5rem;
    }

    .supported-company {
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        background: var(--color-bg-card);
        padding: 1rem 2rem;
        border-radius: 16px;
        border: 1px solid var(--color-border);
        transition: all 0.3s ease;
    }

    .supported-company:hover {
        border-color: var(--color-accent);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .supported-logo {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .supported-logo svg {
        width: 100%;
        height: 100%;
    }

    .supported-info {
        text-align: left;
    }

    .supported-name {
        font-family: var(--font-display);
        font-size: 1.2rem;
        color: var(--color-text);
    }

    /* Regions Section */
    .regions-section {
        padding: 6rem 0;
    }

    .regions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .region-card {
        position: relative;
        padding: 2rem;
        background: var(--color-bg-card);
        border-radius: 16px;
        border: 1px solid var(--color-border);
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--color-text);
        overflow: hidden;
    }

    .region-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--region-color, var(--color-accent));
        transition: width 0.3s ease;
    }

    .region-card:hover {
        transform: translateX(5px);
        border-color: var(--region-color, var(--color-accent));
    }

    .region-card:hover::before {
        width: 8px;
    }

    .region-card-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .region-card-title {
        font-family: var(--font-display);
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .region-card-people {
        font-size: 0.9rem;
        color: var(--color-text-muted);
        margin-bottom: 0.5rem;
    }

    .region-card-count {
        font-size: 0.85rem;
        color: var(--color-accent);
    }

    /* Mission Section */
    .mission-section {
        padding: 6rem 0;
        position: relative;
    }

    .mission-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .mission-content h2 {
        font-family: var(--font-display);
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
    }

    .mission-content p {
        color: var(--color-text-muted);
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
    }

    .mission-list {
        list-style: none;
        margin: 2rem 0;
    }

    .mission-list li {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1rem;
        color: var(--color-text);
    }

    .mission-list li::before {
        content: '✓';
        color: var(--color-accent);
        font-weight: bold;
        flex-shrink: 0;
    }

    .mission-visual {
        position: relative;
    }

    .mission-visual-inner {
        aspect-ratio: 1;
        background: var(--color-bg-card);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        border: 3px solid var(--color-accent);
        overflow: hidden;
        box-shadow: 0 0 60px rgba(201, 168, 108, 0.2);
    }

    .mission-visual-inner::before {
        content: '';
        position: absolute;
        inset: -20px;
        border: 1px dashed var(--color-accent);
        border-radius: 50%;
        animation: rotate 60s linear infinite;
        opacity: 0.5;
    }

    .mission-visual-inner::after {
        content: '';
        position: absolute;
        inset: -35px;
        border: 1px dashed var(--color-border);
        border-radius: 50%;
        animation: rotate 90s linear infinite reverse;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .mission-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .mission-center {
        font-size: 6rem;
        animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* CTA Section */
    .cta-section {
        padding: 6rem 0;
        text-align: center;
    }

    .cta-box {
        background: linear-gradient(135deg, var(--color-bg-card) 0%, var(--color-bg-medium) 100%);
        border-radius: 24px;
        padding: 4rem;
        border: 1px solid var(--color-border);
        position: relative;
        overflow: hidden;
    }

    .cta-box::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(ellipse at center, rgba(201, 168, 108, 0.1) 0%, transparent 50%);
        animation: rotate 30s linear infinite;
    }

    .cta-content {
        position: relative;
        z-index: 1;
    }

    .cta-title {
        font-family: var(--font-display);
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .cta-text {
        color: var(--color-text-muted);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 2rem;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .featured-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .mission-grid {
            grid-template-columns: 1fr;
            gap: 3rem;
        }

        .mission-visual {
            max-width: 400px;
            margin: 0 auto;
        }
    }

    @media (max-width: 768px) {
        .hero {
            padding: 7rem 1.5rem 4rem;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.05rem;
        }

        .hero-layout {
            gap: 2rem;
        }

        .hero-video-circle {
            width: 200px;
            height: 200px;
        }

        .stats {
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .stat-card {
            padding: 1.5rem 1rem;
        }

        .stat-number {
            font-size: 2rem;
        }

        .featured-section {
            padding: 4rem 0;
        }

        .featured-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .coming-preview {
            gap: 1.5rem;
        }

        .coming-preview-card {
            padding: 2rem 1.5rem;
        }

        .quote-section {
            padding: 3rem 0;
        }

        .quote {
            font-size: 1.3rem;
            padding: 0;
        }

        .cta-box {
            padding: 2.5rem 1.5rem;
        }

        .cta-title {
            font-size: 1.8rem;
        }

        .regions-grid {
            gap: 1rem;
        }

        .supported-section {
            padding: 3rem 0;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <!-- Sound Rings Animation -->
        <div class="sound-rings">
            <div class="sound-ring"></div>
            <div class="sound-ring"></div>
            <div class="sound-ring"></div>
            <div class="sound-ring"></div>
        </div>

        <!-- Hero Sound Wave -->
        <div class="hero-sound-wave" id="heroSoundWave"></div>

        <div class="hero-layout">
            <div class="hero-content">
                <div class="hero-badge">
                    <span>🇷🇺</span>
                    Год единства народов России — 2025
                </div>
                <h1 class="hero-title">Голоса Единства</h1>
                <p class="hero-subtitle">
                    Всероссийская аудиобиблиотека народных сказок, рассказанных голосами известных людей. 
                    Мудрость поколений, объединяющая народы России.
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('about') }}" class="btn btn-primary">
                        Узнать о проекте
                    </a>
                    <a href="{{ route('tales.index') }}" class="btn btn-secondary">
                        🎧 Скоро: библиотека
                    </a>
                </div>
            </div>
            <div class="hero-video-side">
                <div class="hero-video-circle">
                    <div class="hero-video-border"></div>
                    <div class="hero-video-inner">
                        <video autoplay muted loop playsinline>
                            <source src="{{ asset('video/hot.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="hero-video-glow"></div>
                    <div class="hero-video-particles">
                        <span></span><span></span><span></span><span></span><span></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-scroll">
            <span></span>
        </div>
    </section>

    <!-- Quote Section -->
    <section class="quote-section container fade-in">
        <blockquote class="quote">
            Мы разные — но мы единая страна. Мы наследники богатого культурного наследия. 
            Добро, мудрость и свет объединяют людей сильнее, чем что-либо.
        </blockquote>
        <p class="quote-source">— Миссия проекта «Голоса Единства»</p>
    </section>

    <!-- Project Goals Stats -->
    <section class="container fade-in">
        <div class="stats">
            <div class="stat-card">
                <span class="stat-number">10-15</span>
                <span class="stat-label">Народных сказок</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $regionsCount }}+</span>
                <span class="stat-label">Народов России</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">2025</span>
                <span class="stat-label">Год запуска</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">∞</span>
                <span class="stat-label">Бесплатный доступ</span>
            </div>
        </div>
    </section>

    <!-- Coming Soon Preview -->
    <section class="featured-section container fade-in">
        <h2 class="section-title">Что мы готовим</h2>
        <p class="section-subtitle">Аудиобиблиотека народных сказок скоро откроется</p>
        
        <div class="coming-preview">
            <div class="coming-preview-card">
                <div class="coming-preview-icon">
                    <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="25" stroke="#6b8cae" stroke-width="2" fill="none"/>
                        <path d="M25 20 L40 30 L25 40 Z" fill="#c9a86c"/>
                    </svg>
                </div>
                <h3>Профессиональная озвучка</h3>
                <p>Известные актёры, музыканты и общественные деятели озвучат сказки</p>
            </div>
            <div class="coming-preview-card">
                <div class="coming-preview-icon">
                    <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M30 10 L30 50" stroke="#c9a86c" stroke-width="2"/>
                        <path d="M30 10 Q15 12 10 15 L10 45 Q15 42 30 40" stroke="#6b8cae" stroke-width="2" fill="none"/>
                        <path d="M30 10 Q45 12 50 15 L50 45 Q45 42 30 40" stroke="#6b8cae" stroke-width="2" fill="none"/>
                    </svg>
                </div>
                <h3>Мудрость народов</h3>
                <p>Сказки из разных уголков России с добрым, объединяющим смыслом</p>
            </div>
            <div class="coming-preview-card">
                <div class="coming-preview-icon">
                    <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="20" stroke="#6b8cae" stroke-width="2" fill="none"/>
                        <circle cx="30" cy="30" r="12" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <circle cx="30" cy="30" r="4" fill="#c9a86c"/>
                        <line x1="30" y1="5" x2="30" y2="10" stroke="#8ba8c7" stroke-width="2"/>
                        <line x1="30" y1="50" x2="30" y2="55" stroke="#8ba8c7" stroke-width="2"/>
                        <line x1="5" y1="30" x2="10" y2="30" stroke="#8ba8c7" stroke-width="2"/>
                        <line x1="50" y1="30" x2="55" y2="30" stroke="#8ba8c7" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Открытый доступ</h3>
                <p>Бесплатно для всех — детей, семей, школ и культурных центров</p>
            </div>
        </div>
    </section>

    <!-- Regions Section -->
    @if($regions->count() > 0)
    <section class="regions-section container fade-in">
        <h2 class="section-title">Народы России</h2>
        <p class="section-subtitle">Культурное многообразие нашей страны</p>
        
        <div class="regions-grid">
            @foreach($regions as $region)
            <div class="region-card" style="--region-color: {{ $region->color }};">
                <h3 class="region-card-title">{{ $region->name }}</h3>
                <p class="region-card-people">{{ $region->people_name }}</p>
                <span class="region-card-count">Сказки готовятся</span>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Mission Section -->
    <section class="mission-section container fade-in">
        <div class="mission-grid">
            <div class="mission-content">
                <h2>Миссия проекта</h2>
                <p>
                    «Голоса Единства» — это обращение к светлой стороне каждого человека. 
                    Это подарок детям, семьям и всей стране. Это общая история, рассказанная 
                    множеством голосов — но говорящая об одном: мы вместе.
                </p>
                <ul class="mission-list">
                    <li>Собрать народные сказки из разных регионов России с добрым, объединяющим смыслом</li>
                    <li>Организовать профессиональную озвучку с участием известных людей</li>
                    <li>Создать открытую цифровую аудиобиблиотеку, доступную каждому</li>
                    <li>Показать богатство и многообразие культур России</li>
                </ul>
                <a href="{{ route('about') }}" class="btn btn-primary">Подробнее о проекте</a>
            </div>
            <div class="mission-visual">
                <div class="mission-visual-inner">
                    <video class="mission-video" autoplay muted loop playsinline>
                        <source src="/video/hero-video.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </section>

    <!-- Supported By Section -->
    <section class="supported-section container fade-in">
        <div class="supported-content">
            <p class="supported-label">При поддержке</p>
            <div class="supported-company">
                <div class="supported-logo">
                    <svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="25" cy="25" r="20" stroke="#c9a86c" stroke-width="2" fill="none"/>
                        <path d="M18 20 L25 15 L32 20 L32 35 L18 35 Z" stroke="#6b8cae" stroke-width="2" fill="none"/>
                        <circle cx="25" cy="27" r="4" fill="#c9a86c"/>
                    </svg>
                </div>
                <div class="supported-info">
                    <span class="supported-name">Тренинговая компания «Парадокс»</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section container fade-in">
        <div class="cta-box">
            <div class="cta-content">
                <h2 class="cta-title">Проект готовится к запуску</h2>
                <p class="cta-text">
                    Мы собираем народные сказки и приглашаем известных людей для озвучки. 
                    Скоро аудиобиблиотека откроется для всех — бесплатно и без регистрации.
                </p>
                <a href="{{ route('about') }}" class="btn btn-primary">
                    Узнать подробнее
                </a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Create hero sound wave
    document.addEventListener('DOMContentLoaded', () => {
        const heroWaveContainer = document.getElementById('heroSoundWave');
        if (heroWaveContainer) {
            const barCount = 80;
            
            for (let i = 0; i < barCount; i++) {
                const bar = document.createElement('div');
                bar.className = 'hero-wave-bar';
                
                // Создаём волнообразный паттерн - выше в центре
                const centerOffset = Math.abs(i - barCount / 2) / (barCount / 2);
                const baseHeight = 15 + (1 - centerOffset) * 70;
                const duration = 2 + Math.random() * 2;
                const delay = (i / barCount) * 2 + Math.random() * 0.5;
                
                bar.style.setProperty('--wave-height', baseHeight + 'px');
                bar.style.animationDuration = duration + 's';
                bar.style.animationDelay = delay + 's';
                
                heroWaveContainer.appendChild(bar);
            }
        }
    });
</script>
@endsection

