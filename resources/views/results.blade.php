@extends('layouts.app')

@section('title', 'Результаты проекта — Голоса Единства')

@section('styles')
<style>
    /* Hide default elements */
    .footer, .header {
        display: none !important;
    }

    body {
        overflow: hidden;
    }

    /* Full-page container */
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

    /* Animated Background Gradient */
    .animated-bg {
        position: fixed;
        inset: 0;
        background: linear-gradient(
            45deg,
            var(--color-bg-dark) 0%,
            var(--color-bg-medium) 25%,
            var(--color-bg-dark) 50%,
            var(--color-bg-medium) 75%,
            var(--color-bg-dark) 100%
        );
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        z-index: -2;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Floating Particles */
    .particles {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: -1;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: var(--color-accent);
        border-radius: 50%;
        animation: floatParticle linear infinite;
        box-shadow: 0 0 10px var(--color-accent), 0 0 20px var(--color-accent);
    }

    @keyframes floatParticle {
        0% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
        }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% {
            transform: translateY(-100vh) rotate(720deg);
            opacity: 0;
        }
    }

    /* Glowing Lines */
    .glow-lines {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: -1;
        overflow: hidden;
    }

    .glow-line {
        position: absolute;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--color-accent), transparent);
        animation: glowLineMove 8s ease-in-out infinite;
        opacity: 0.3;
    }

    @keyframes glowLineMove {
        0%, 100% { transform: translateX(-100%); opacity: 0; }
        50% { transform: translateX(100vw); opacity: 0.5; }
    }

    /* Scroll Indicator */
    .scroll-indicator {
        position: fixed;
        right: 3rem;
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
        background: rgba(201, 168, 108, 0.2);
        cursor: pointer;
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        position: relative;
    }

    .scroll-dot::before {
        content: '';
        position: absolute;
        inset: -5px;
        border: 2px solid transparent;
        border-radius: 50%;
        transition: all 0.5s ease;
    }

    .scroll-dot.active {
        background: var(--color-accent);
        transform: scale(1.3);
        box-shadow: 0 0 20px var(--color-accent), 0 0 40px var(--color-accent);
    }

    .scroll-dot.active::before {
        border-color: rgba(201, 168, 108, 0.5);
        animation: dotPulse 2s ease-in-out infinite;
    }

    @keyframes dotPulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.5); opacity: 0; }
    }

    /* Hero Section */
    .hero-section {
        background: radial-gradient(ellipse at center, rgba(201, 168, 108, 0.1) 0%, transparent 70%);
    }

    .hero-content {
        text-align: center;
        max-width: 1000px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        background: rgba(201, 168, 108, 0.1);
        border: 1px solid rgba(201, 168, 108, 0.3);
        padding: 1rem 2rem;
        border-radius: 60px;
        margin-bottom: 3rem;
        font-size: 1rem;
        color: var(--color-accent);
        letter-spacing: 0.1em;
        text-transform: uppercase;
        opacity: 0;
        animation: heroFadeIn 1s ease-out 0.2s forwards;
        backdrop-filter: blur(10px);
    }

    .hero-badge::before {
        content: '';
        width: 8px;
        height: 8px;
        background: var(--color-accent);
        border-radius: 50%;
        animation: pulse 2s ease-in-out infinite;
        box-shadow: 0 0 10px var(--color-accent);
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.5); opacity: 0.5; }
    }

    .hero-title {
        font-family: var(--font-display);
        font-size: 6rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 2rem;
        opacity: 0;
        animation: heroTitleReveal 1.5s cubic-bezier(0.16, 1, 0.3, 1) 0.5s forwards;
    }

    .hero-title .word {
        display: inline-block;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-accent) 50%, var(--color-primary-light) 100%);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradientText 5s ease infinite;
    }

    @keyframes gradientText {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes heroTitleReveal {
        0% {
            opacity: 0;
            transform: translateY(100px) scale(0.8);
            filter: blur(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
            filter: blur(0);
        }
    }

    @keyframes heroFadeIn {
        to { opacity: 1; }
    }

    .hero-subtitle {
        font-size: 1.5rem;
        color: var(--color-text-muted);
        max-width: 700px;
        margin: 0 auto 4rem;
        opacity: 0;
        animation: heroFadeIn 1s ease-out 1s forwards;
        line-height: 1.6;
    }

    .scroll-hint {
        opacity: 0;
        animation: heroFadeIn 1s ease-out 1.5s forwards;
    }

    .scroll-hint-text {
        font-size: 0.85rem;
        color: var(--color-accent);
        margin-bottom: 1.5rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        animation: textGlow 2s ease-in-out infinite;
    }

    @keyframes textGlow {
        0%, 100% { text-shadow: 0 0 10px rgba(201, 168, 108, 0.5); }
        50% { text-shadow: 0 0 30px rgba(201, 168, 108, 0.8), 0 0 60px rgba(201, 168, 108, 0.4); }
    }

    .scroll-mouse {
        width: 30px;
        height: 50px;
        border: 2px solid var(--color-accent);
        border-radius: 20px;
        margin: 0 auto;
        position: relative;
        box-shadow: 0 0 20px rgba(201, 168, 108, 0.3);
    }

    .scroll-mouse::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 8px;
        width: 4px;
        height: 10px;
        background: var(--color-accent);
        border-radius: 4px;
        transform: translateX(-50%);
        animation: scrollWheel 2s ease-in-out infinite;
        box-shadow: 0 0 10px var(--color-accent);
    }

    @keyframes scrollWheel {
        0%, 100% { top: 8px; opacity: 1; }
        50% { top: 25px; opacity: 0.3; }
    }

    /* Stat Section */
    .stat-content {
        text-align: center;
        max-width: 1200px;
        position: relative;
    }

    .stat-content.hidden {
        opacity: 0;
    }

    .stat-content.visible {
        opacity: 1;
    }

    /* Custom Icons with Animations */
    .stat-icon-container {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto 2rem;
    }

    .stat-icon {
        width: 100%;
        height: 100%;
        position: relative;
        z-index: 2;
    }

    .stat-icon svg {
        width: 70px;
        height: 70px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        stroke: var(--color-accent);
        fill: none;
        stroke-width: 1.5;
        stroke-linecap: round;
        stroke-linejoin: round;
        filter: drop-shadow(0 0 20px rgba(201, 168, 108, 0.5));
    }

    .icon-ring {
        position: absolute;
        inset: 0;
        border: 2px solid rgba(201, 168, 108, 0.3);
        border-radius: 50%;
        animation: ringRotate 10s linear infinite;
    }

    .icon-ring::before {
        content: '';
        position: absolute;
        top: -4px;
        left: 50%;
        width: 8px;
        height: 8px;
        background: var(--color-accent);
        border-radius: 50%;
        box-shadow: 0 0 15px var(--color-accent);
    }

    .icon-ring-2 {
        inset: -15px;
        border-style: dashed;
        animation: ringRotate 15s linear infinite reverse;
        opacity: 0.5;
    }

    .icon-ring-3 {
        inset: -30px;
        border-style: dotted;
        animation: ringRotate 20s linear infinite;
        opacity: 0.3;
    }

    @keyframes ringRotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .icon-glow {
        position: absolute;
        inset: -20px;
        background: radial-gradient(circle, rgba(201, 168, 108, 0.4) 0%, transparent 70%);
        border-radius: 50%;
        animation: glowPulse 3s ease-in-out infinite;
    }

    @keyframes glowPulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.2); opacity: 0.8; }
    }

    .stat-label {
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.3em;
        color: var(--color-accent);
        margin-bottom: 1rem;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease 0.2s;
    }

    .visible .stat-label {
        opacity: 1;
        transform: translateY(0);
    }

    .stat-value-container {
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .stat-value {
        font-family: var(--font-display);
        font-size: 10rem;
        font-weight: 700;
        line-height: 1;
        background: linear-gradient(180deg, var(--color-text) 0%, var(--color-accent) 50%, var(--color-primary-light) 100%);
        background-size: 100% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: valueGradient 3s ease infinite;
        opacity: 0;
        transform: scale(0.5);
        transition: all 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.4s;
        filter: drop-shadow(0 0 60px rgba(201, 168, 108, 0.3));
    }

    @keyframes valueGradient {
        0%, 100% { background-position: 0% 0%; }
        50% { background-position: 0% 100%; }
    }

    .visible .stat-value {
        opacity: 1;
        transform: scale(1);
    }

    .stat-value-glow {
        position: absolute;
        inset: -20px;
        background: radial-gradient(ellipse at center, rgba(201, 168, 108, 0.2) 0%, transparent 70%);
        filter: blur(30px);
        z-index: -1;
        animation: valueGlow 2s ease-in-out infinite;
    }

    @keyframes valueGlow {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.1); }
    }

    .stat-suffix {
        font-size: 4rem;
        vertical-align: top;
        margin-left: 0.5rem;
    }

    .stat-prefix {
        font-size: 3rem;
        vertical-align: top;
        margin-right: 0.25rem;
        opacity: 0.7;
    }

    .stat-description {
        font-size: 1.6rem;
        color: var(--color-text-muted);
        margin-bottom: 2rem;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease 0.6s;
    }

    .visible .stat-description {
        opacity: 1;
        transform: translateY(0);
    }

    .stat-extra {
        display: inline-flex;
        align-items: center;
        gap: 2rem;
        background: rgba(35, 47, 66, 0.8);
        border: 1px solid var(--color-border);
        padding: 1.25rem 2.5rem;
        border-radius: 60px;
        font-size: 1.1rem;
        backdrop-filter: blur(10px);
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease 0.8s;
    }

    .visible .stat-extra {
        opacity: 1;
        transform: translateY(0);
    }

    .stat-extra-highlight {
        color: var(--color-accent);
        font-weight: 700;
        position: relative;
    }

    .stat-extra-highlight::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--color-accent);
        box-shadow: 0 0 10px var(--color-accent);
    }

    /* Progress Ring */
    .progress-ring-container {
        position: relative;
        width: 220px;
        height: 220px;
        margin: 2rem auto;
        opacity: 0;
        transform: scale(0.8) rotate(-90deg);
        transition: all 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.6s;
    }

    .visible .progress-ring-container {
        opacity: 1;
        transform: scale(1) rotate(0deg);
    }

    .progress-ring-bg {
        fill: none;
        stroke: var(--color-bg-card);
        stroke-width: 12;
    }

    .progress-ring-fill {
        fill: none;
        stroke: url(#progressGradient);
        stroke-width: 12;
        stroke-linecap: round;
        stroke-dasharray: 565;
        stroke-dashoffset: 565;
        transition: stroke-dashoffset 3s cubic-bezier(0.16, 1, 0.3, 1);
        filter: drop-shadow(0 0 15px rgba(201, 168, 108, 0.5));
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
        font-size: 3.5rem;
        font-weight: 700;
        color: var(--color-accent);
        text-shadow: 0 0 30px rgba(201, 168, 108, 0.5);
    }

    .progress-ring-label {
        font-size: 0.9rem;
        color: var(--color-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.2em;
    }

    /* Success Badge */
    .success-badge {
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        color: white;
        padding: 1rem 2rem;
        border-radius: 60px;
        font-weight: 700;
        font-size: 1.2rem;
        margin-top: 1.5rem;
        box-shadow: 0 10px 50px rgba(34, 197, 94, 0.4);
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) 1s;
        animation: successPulse 2s ease-in-out infinite;
    }

    .visible .success-badge {
        opacity: 1;
        transform: scale(1);
    }

    @keyframes successPulse {
        0%, 100% { box-shadow: 0 10px 50px rgba(34, 197, 94, 0.4); }
        50% { box-shadow: 0 10px 80px rgba(34, 197, 94, 0.6), 0 0 100px rgba(34, 197, 94, 0.3); }
    }

    .success-icon {
        width: 26px;
        height: 26px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: checkBounce 1s ease-in-out infinite;
    }

    @keyframes checkBounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

    .success-icon svg {
        width: 14px;
        height: 14px;
        stroke: #22c55e;
        stroke-width: 3;
    }

    /* Multi-stat Grid */
    .multi-stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        max-width: 1200px;
        width: 100%;
    }

    .mini-stat-card {
        background: rgba(35, 47, 66, 0.6);
        border: 1px solid var(--color-border);
        border-radius: 24px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        opacity: 0;
        transform: translateY(60px) scale(0.9);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .mini-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(201, 168, 108, 0.1), transparent);
        transition: left 0.8s ease;
    }

    .mini-stat-card:hover::before {
        left: 100%;
    }

    .mini-stat-card.visible {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .mini-stat-card:hover {
        transform: translateY(-10px) scale(1.03);
        border-color: var(--color-accent);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3), 0 0 40px rgba(201, 168, 108, 0.15);
    }

    .mini-stat-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-light) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 30px rgba(201, 168, 108, 0.3);
    }

    .mini-stat-icon svg {
        width: 28px;
        height: 28px;
        stroke: var(--color-bg-dark);
        fill: none;
        stroke-width: 2;
    }

    .mini-stat-value {
        font-family: var(--font-display);
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 0.5rem;
        text-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
    }

    .mini-stat-label {
        font-size: 0.9rem;
        color: var(--color-text-muted);
        line-height: 1.4;
    }

    /* Media Section */
    .media-section {
        background: radial-gradient(ellipse at center, rgba(107, 140, 174, 0.1) 0%, transparent 70%);
    }

    .media-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1.5rem;
        max-width: 1200px;
        width: 100%;
    }

    .media-card {
        background: rgba(35, 47, 66, 0.6);
        border: 1px solid var(--color-border);
        border-radius: 20px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        opacity: 0;
        transform: translateY(80px) scale(0.8);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .media-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(201, 168, 108, 0.1), transparent);
        transition: left 0.8s ease;
    }

    .media-card:hover::before {
        left: 100%;
    }

    .media-card.visible {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .media-card:hover {
        transform: translateY(-12px) scale(1.05);
        border-color: var(--color-accent);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4), 0 0 40px rgba(201, 168, 108, 0.2);
    }

    .media-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-light) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 40px rgba(201, 168, 108, 0.3);
        position: relative;
    }

    .media-icon::before {
        content: '';
        position: absolute;
        inset: -5px;
        border: 2px solid rgba(201, 168, 108, 0.5);
        border-radius: 50%;
        animation: iconRingPulse 2s ease-in-out infinite;
    }

    @keyframes iconRingPulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.2); opacity: 0; }
    }

    .media-icon svg {
        width: 32px;
        height: 32px;
        stroke: var(--color-bg-dark);
        fill: none;
        stroke-width: 2;
    }

    .media-count {
        font-family: var(--font-display);
        font-size: 3rem;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 0.5rem;
        text-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
    }

    .media-label {
        font-size: 0.9rem;
        color: var(--color-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Links Section */
    .links-section {
        background: radial-gradient(ellipse at center, rgba(201, 168, 108, 0.05) 0%, transparent 70%);
    }

    .links-content {
        max-width: 1100px;
        width: 100%;
    }

    .links-title {
        font-family: var(--font-display);
        font-size: 3rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 3rem;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-accent) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        opacity: 0;
        transform: translateY(50px);
        transition: all 1s ease;
    }

    .links-section.in-view .links-title {
        opacity: 1;
        transform: translateY(0);
    }

    .links-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
    }

    .link-card {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        background: rgba(35, 47, 66, 0.6);
        border: 1px solid var(--color-border);
        border-radius: 16px;
        padding: 1.5rem;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        opacity: 0;
        transform: translateX(-50px);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .link-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(201, 168, 108, 0.1) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .link-card:hover::before {
        opacity: 1;
    }

    .link-card.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .link-card:hover {
        border-color: var(--color-accent);
        transform: translateX(12px) scale(1.02);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3), 0 0 25px rgba(201, 168, 108, 0.1);
    }

    .link-status {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #22c55e, #4ade80);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 5px 20px rgba(34, 197, 94, 0.4);
        position: relative;
        z-index: 1;
    }

    .link-status svg {
        width: 22px;
        height: 22px;
        stroke: white;
        stroke-width: 3;
    }

    .link-info {
        flex: 1;
        position: relative;
        z-index: 1;
    }

    .link-name {
        font-weight: 700;
        font-size: 1.05rem;
        color: var(--color-text);
        margin-bottom: 0.3rem;
    }

    .link-url {
        font-size: 0.85rem;
        color: var(--color-primary-light);
    }

    .link-arrow {
        width: 24px;
        height: 24px;
        stroke: var(--color-text-muted);
        transition: all 0.4s ease;
        position: relative;
        z-index: 1;
    }

    .link-card:hover .link-arrow {
        stroke: var(--color-accent);
        transform: translateX(6px);
    }

    /* CTA Section */
    .cta-section {
        background: radial-gradient(ellipse at center, rgba(201, 168, 108, 0.15) 0%, transparent 60%);
    }

    .cta-content {
        text-align: center;
        max-width: 800px;
    }

    .cta-title {
        font-family: var(--font-display);
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--color-text) 0%, var(--color-accent) 50%, var(--color-primary-light) 100%);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradientText 5s ease infinite;
        opacity: 0;
        transform: translateY(50px);
        transition: all 1s ease;
    }

    .cta-section.in-view .cta-title {
        opacity: 1;
        transform: translateY(0);
    }

    .cta-text {
        font-size: 1.4rem;
        color: var(--color-text-muted);
        margin-bottom: 2.5rem;
        line-height: 1.6;
        opacity: 0;
        transform: translateY(30px);
        transition: all 1s ease 0.3s;
    }

    .cta-section.in-view .cta-text {
        opacity: 1;
        transform: translateY(0);
    }

    .cta-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
        opacity: 0;
        transform: translateY(30px);
        transition: all 1s ease 0.5s;
    }

    .cta-section.in-view .cta-buttons {
        opacity: 1;
        transform: translateY(0);
    }

    .btn {
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .btn:hover::before {
        left: 100%;
    }

    /* Confetti Container */
    .confetti-container {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 1000;
        overflow: hidden;
    }

    .confetti-piece {
        position: absolute;
        width: 10px;
        height: 20px;
        top: -20px;
        animation: confettiFall linear forwards;
    }

    @keyframes confettiFall {
        0% {
            transform: translateY(0) rotate(0deg) scale(1);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(1080deg) scale(0);
            opacity: 0;
        }
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .media-grid {
            grid-template-columns: repeat(3, 1fr);
        }
        
        .multi-stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .scroll-indicator {
            right: 1rem;
            gap: 0.75rem;
        }

        .scroll-dot {
            width: 10px;
            height: 10px;
        }

        .hero-title {
            font-size: 3rem;
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

        .stat-icon-container {
            width: 100px;
            height: 100px;
        }

        .stat-icon svg {
            width: 45px;
            height: 45px;
        }

        .media-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .media-card {
            padding: 1.5rem 1rem;
        }

        .media-count {
            font-size: 2.2rem;
        }

        .media-icon {
            width: 55px;
            height: 55px;
        }

        .multi-stat-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .mini-stat-card {
            padding: 1.5rem 1rem;
        }

        .mini-stat-value {
            font-size: 2rem;
        }

        .links-grid {
            grid-template-columns: 1fr;
        }

        .links-title {
            font-size: 2rem;
        }

        .cta-title {
            font-size: 2.5rem;
        }

        .cta-text {
            font-size: 1.1rem;
        }

        .progress-ring-container {
            width: 160px;
            height: 160px;
        }

        .progress-ring-value {
            font-size: 2.5rem;
        }

        .stat-extra {
            flex-direction: column;
            gap: 0.5rem;
            padding: 1rem 1.5rem;
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .media-grid {
            grid-template-columns: 1fr 1fr;
        }

        .multi-stat-grid {
            grid-template-columns: 1fr 1fr;
        }

        .stat-value {
            font-size: 4rem;
        }

        .mini-stat-value {
            font-size: 1.8rem;
        }

        .mini-stat-label {
            font-size: 0.8rem;
        }
    }
</style>
@endsection

@section('content')
<!-- Animated Background -->
<div class="animated-bg"></div>

<!-- Floating Particles -->
<div class="particles" id="particles"></div>

<!-- Glowing Lines -->
<div class="glow-lines" id="glowLines"></div>

<!-- Confetti Container -->
<div class="confetti-container" id="confetti"></div>

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
        <div class="scroll-dot" data-section="7"></div>
    </div>

    <!-- Hero -->
    <section class="result-section hero-section" data-index="0">
        <div class="hero-content">
            <div class="hero-badge">
                <span>Культурно-благотворительный проект</span>
            </div>
            <h1 class="hero-title">
                <span class="word">Результаты</span> <span class="word">проекта</span>
            </h1>
            <p class="hero-subtitle">Голоса Единства — всероссийская аудиобиблиотека народных сказок к Году единства народов России</p>
            <div class="scroll-hint">
                <div class="scroll-hint-text">Листайте вниз</div>
                <div class="scroll-mouse"></div>
            </div>
        </div>
    </section>

    <!-- Team -->
    <section class="result-section" data-index="1">
        <div class="stat-content hidden">
            <div class="stat-icon-container">
                <div class="icon-glow"></div>
                <div class="icon-ring"></div>
                <div class="icon-ring icon-ring-2"></div>
                <div class="icon-ring icon-ring-3"></div>
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
            </div>
            <div class="stat-label">Команда проекта</div>
            <div class="stat-value-container">
                <div class="stat-value-glow"></div>
                <div class="stat-value">
                    <span data-counter="26">0</span>
                </div>
            </div>
            <div class="stat-description">человек объединились для создания проекта</div>
        </div>
    </section>

    <!-- Fundraising -->
    <section class="result-section" data-index="2">
        <div class="stat-content hidden">
            <div class="stat-icon-container">
                <div class="icon-glow"></div>
                <div class="icon-ring"></div>
                <div class="icon-ring icon-ring-2"></div>
                <div class="icon-ring icon-ring-3"></div>
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 6v12"/>
                        <path d="M15 9.5c0-1.38-1.34-2.5-3-2.5s-3 1.12-3 2.5c0 1.38 1.34 2.5 3 2.5s3 1.12 3 2.5c0 1.38-1.34 2.5-3 2.5"/>
                    </svg>
                </div>
            </div>
            <div class="stat-label">Привлечено средств</div>
            <div class="stat-value-container">
                <div class="stat-value-glow"></div>
                <div class="stat-value">
                    <span data-counter="258118">0</span>
                    <span class="stat-suffix">₽</span>
                </div>
            </div>
            <div class="stat-description">из 250 000 ₽ цели</div>
            <div class="progress-ring-container">
                <svg width="220" height="220" style="transform: rotate(-90deg);">
                    <defs>
                        <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#22c55e"/>
                            <stop offset="50%" stop-color="#4ade80"/>
                            <stop offset="100%" stop-color="var(--color-accent)"/>
                        </linearGradient>
                    </defs>
                    <circle class="progress-ring-bg" cx="110" cy="110" r="90"/>
                    <circle class="progress-ring-fill" cx="110" cy="110" r="90" data-progress="103"/>
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

    <!-- Tales Stats -->
    <section class="result-section" data-index="3">
        <div class="stat-content hidden">
            <div class="stat-label" style="margin-bottom: 3rem; font-size: 1.2rem;">Сказки</div>
            <div class="multi-stat-grid">
                <div class="mini-stat-card">
                    <div class="mini-stat-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                        </svg>
                    </div>
                    <div class="mini-stat-value"><span class="stat-prefix">></span><span data-counter="150">0</span></div>
                    <div class="mini-stat-label">сказок прочитано</div>
                </div>
                <div class="mini-stat-card">
                    <div class="mini-stat-icon">
                        <svg viewBox="0 0 24 24">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </div>
                    <div class="mini-stat-value" data-counter="16">0</div>
                    <div class="mini-stat-label">сказок выпущено</div>
                </div>
                <div class="mini-stat-card">
                    <div class="mini-stat-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"/>
                            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>
                        </svg>
                    </div>
                    <div class="mini-stat-value" data-counter="3246">0</div>
                    <div class="mini-stat-label">прослушиваний</div>
                </div>
                <div class="mini-stat-card">
                    <div class="mini-stat-icon">
                        <svg viewBox="0 0 24 24">
                            <line x1="12" y1="20" x2="12" y2="10"/>
                            <line x1="18" y1="20" x2="18" y2="4"/>
                            <line x1="6" y1="20" x2="6" y2="16"/>
                        </svg>
                    </div>
                    <div class="mini-stat-value">293%</div>
                    <div class="mini-stat-label">от плана</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Stats -->
    <section class="result-section" data-index="4">
        <div class="stat-content hidden">
            <div class="stat-label" style="margin-bottom: 3rem; font-size: 1.2rem;">Мероприятия и охват</div>
            <div class="multi-stat-grid">
                <div class="mini-stat-card">
                    <div class="mini-stat-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div class="mini-stat-value"><span class="stat-prefix">></span><span data-counter="700">0</span></div>
                    <div class="mini-stat-label">посетителей мероприятия</div>
                </div>
                <div class="mini-stat-card">
                    <div class="mini-stat-icon">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                            <line x1="8" y1="21" x2="16" y2="21"/>
                            <line x1="12" y1="17" x2="12" y2="21"/>
                        </svg>
                    </div>
                    <div class="mini-stat-value"><span class="stat-prefix">></span><span data-counter="1000">0</span></div>
                    <div class="mini-stat-label">флаеров роздано</div>
                </div>
                <div class="mini-stat-card">
                    <div class="mini-stat-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 12v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6"/>
                            <polyline points="12 3 12 15"/>
                            <polyline points="8 7 12 3 16 7"/>
                            <rect x="4" y="12" width="16" height="2" rx="1"/>
                        </svg>
                    </div>
                    <div class="mini-stat-value"><span class="stat-prefix">></span><span data-counter="500">0</span></div>
                    <div class="mini-stat-label">подарков вручено</div>
                </div>
                <div class="mini-stat-card">
                    <div class="mini-stat-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                        </svg>
                    </div>
                    <div class="mini-stat-value"><span class="stat-prefix">></span><span data-counter="15">0</span></div>
                    <div class="mini-stat-label">благодарственных писем</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Media Coverage -->
    <section class="result-section media-section" data-index="5">
        <div class="stat-content hidden" style="max-width: 1200px;">
            <div class="stat-label" style="margin-bottom: 3rem; font-size: 1.2rem;">Медийное покрытие</div>
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
                    <div class="media-count" data-counter="5">0</div>
                    <div class="media-label">Интернет СМИ</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Links -->
    <section class="result-section links-section" data-index="6">
        <div class="links-content">
            <h2 class="links-title">Публикации в СМИ</h2>
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
    <section class="result-section cta-section" data-index="7">
        <div class="cta-content">
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
    // Create floating particles
    function createParticles() {
        const container = document.getElementById('particles');
        const colors = ['var(--color-accent)', 'var(--color-primary-light)', 'var(--color-primary)'];
        
        for (let i = 0; i < 50; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.width = (2 + Math.random() * 4) + 'px';
            particle.style.height = particle.style.width;
            particle.style.background = colors[Math.floor(Math.random() * colors.length)];
            particle.style.animationDuration = (10 + Math.random() * 20) + 's';
            particle.style.animationDelay = Math.random() * 20 + 's';
            container.appendChild(particle);
        }
    }

    // Create glowing lines
    function createGlowLines() {
        const container = document.getElementById('glowLines');
        
        for (let i = 0; i < 5; i++) {
            const line = document.createElement('div');
            line.className = 'glow-line';
            line.style.top = (10 + Math.random() * 80) + '%';
            line.style.width = (100 + Math.random() * 200) + 'px';
            line.style.animationDuration = (6 + Math.random() * 8) + 's';
            line.style.animationDelay = Math.random() * 10 + 's';
            container.appendChild(line);
        }
    }

    // Animate counter with dramatic effect
    function animateCounter(element, target, duration = 2500) {
        const startTime = performance.now();
        
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeProgress = 1 - Math.pow(1 - progress, 5);
            const current = Math.floor(target * easeProgress);
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
        
        setTimeout(() => {
            element.style.strokeDashoffset = offset;
        }, 500);
    }

    // Create confetti explosion
    function createConfetti() {
        const container = document.getElementById('confetti');
        const colors = ['#c9a86c', '#6b8cae', '#8ba8c7', '#dfc28a', '#22c55e', '#4ade80', '#fff'];
        
        for (let i = 0; i < 100; i++) {
            const piece = document.createElement('div');
            piece.className = 'confetti-piece';
            piece.style.left = (30 + Math.random() * 40) + '%';
            piece.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            piece.style.width = (8 + Math.random() * 8) + 'px';
            piece.style.height = (15 + Math.random() * 15) + 'px';
            piece.style.animationDuration = (2 + Math.random() * 3) + 's';
            piece.style.animationDelay = Math.random() * 0.5 + 's';
            piece.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
            container.appendChild(piece);
            
            setTimeout(() => piece.remove(), 5000);
        }
    }

    // Intersection Observer
    const container = document.getElementById('resultsContainer');
    const sections = container.querySelectorAll('.result-section');
    const dots = document.querySelectorAll('.scroll-dot');

    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const index = parseInt(entry.target.dataset.index);
                
                // Update dots
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });

                // Animate stat content
                const content = entry.target.querySelector('.stat-content');
                if (content && content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    content.classList.add('visible');
                    
                    // Animate counters
                    setTimeout(() => {
                        content.querySelectorAll('[data-counter]').forEach(counter => {
                            const target = parseInt(counter.dataset.counter);
                            animateCounter(counter, target, 2500);
                        });
                    }, 400);

                    // Animate progress ring
                    const progressRing = content.querySelector('[data-progress]');
                    if (progressRing) {
                        animateProgressRing(progressRing, parseInt(progressRing.dataset.progress));
                    }

                    // Trigger confetti on fundraising section
                    if (index === 2) {
                        setTimeout(createConfetti, 1800);
                    }
                }

                // Animate mini-stat cards
                const miniCards = entry.target.querySelectorAll('.mini-stat-card');
                miniCards.forEach((card, i) => {
                    setTimeout(() => {
                        card.classList.add('visible');
                        const counter = card.querySelector('[data-counter]');
                        if (counter) {
                            animateCounter(counter, parseInt(counter.dataset.counter), 1800);
                        }
                    }, i * 150);
                });

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
                        }, i * 120);
                    });
                }

                // Animate link cards
                if (entry.target.classList.contains('links-section')) {
                    entry.target.classList.add('in-view');
                    const cards = entry.target.querySelectorAll('.link-card');
                    cards.forEach((card, i) => {
                        setTimeout(() => card.classList.add('visible'), 250 + i * 80);
                    });
                }

                // Animate CTA section
                if (entry.target.classList.contains('cta-section')) {
                    entry.target.classList.add('in-view');
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
        
        if ((e.key === 'ArrowDown' || e.key === ' ') && currentIndex < sections.length - 1) {
            e.preventDefault();
            sections[currentIndex + 1].scrollIntoView({ behavior: 'smooth' });
        }
        if (e.key === 'ArrowUp' && currentIndex > 0) {
            e.preventDefault();
            sections[currentIndex - 1].scrollIntoView({ behavior: 'smooth' });
        }
    });

    // Initialize effects
    document.addEventListener('DOMContentLoaded', () => {
        createParticles();
        createGlowLines();
    });
</script>
@endsection
