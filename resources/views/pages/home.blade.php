@extends('layouts.app')

@section('content')
<style>
    /* ==========================================================================
       Hero Banner Carousel Slider
       ========================================================================== */
    .hero-slider-wrap {
        position: relative;
        overflow: hidden;
        background: #0f172a;
        min-height: 520px;
    }
    .hero-slider {
        position: relative;
        width: 100%;
        height: 540px;
    }
    .hero-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.8s ease-in-out, transform 0.8s ease-in-out;
        transform: scale(1.03);
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
    }
    .hero-slide.active {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
        z-index: 2;
    }
    .hero-slide-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(100, 20, 31, 0.88) 0%, rgba(20, 20, 30, 0.75) 60%, rgba(0, 0, 0, 0.4) 100%);
    }
    .hero-slide-content {
        position: relative;
        z-index: 5;
        max-width: 820px;
        color: #ffffff;
        padding: 40px 0;
    }
    .hero-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.35);
        color: #ffffff;
        padding: 6px 18px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 18px;
        backdrop-filter: blur(4px);
    }
    .hero-slide-title {
        font-size: 30px;
        font-size: 2rem;
        font-weight: 400;
        font-family: var(--font-heading);
        color: #ffffff;
        line-height: 1.18;
        margin-bottom: 18px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }
    .hero-slide-desc {
        font-size: 15px;
        font-size: 1rem;
        color: #f1f5f9;
        margin-bottom: 30px;
        line-height: 1.6;
        max-width: 680px;
    }
    .hero-slide-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    .btn-slide-primary {
        background-color: #64141f;
        color: #ffffff !important;
        font-family: inherit;
        font-weight: inherit;
        padding: 10px 40px;
        border-radius: 2px;
        font-size: 15px;
        font-size: 1rem;
        text-transform: none;
        letter-spacing: 0;
        box-shadow: none;
        transition: all 0.25s ease;
        border-style: solid;
        border-width: 0;
        border-color: #64141f;
        line-height: 1;
        display: inline-block;
    }
    .btn-slide-primary:hover {
        background-color: #3a3a3a;
        border-color: #3a3a3a;
        color: #ffffff !important;
    }
    .btn-slide-secondary {
        background: transparent;
        color: #ffffff !important;
        font-family: inherit;
        font-weight: inherit;
        padding: 10px 40px;
        border-radius: 2px;
        font-size: 15px;
        font-size: 1rem;
        text-transform: none;
        letter-spacing: 0;
        border: 2px solid #ffffff;
        transition: all 0.25s ease;
        line-height: 1;
        display: inline-block;
    }
    .btn-slide-secondary:hover {
        background: rgba(255,255,255,0.2);
    }
    .slider-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0,0,0,0.4);
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
        width: 46px;
        height: 46px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        cursor: pointer;
        z-index: 10;
        transition: all 0.2s ease;
    }
    .slider-arrow:hover {
        background: var(--primary);
        border-color: var(--primary);
    }
    .slider-arrow.prev { left: 25px; }
    .slider-arrow.next { right: 25px; }
    .slider-dots {
        position: absolute;
        bottom: 25px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 10;
    }
    .slider-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255,255,255,0.4);
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .slider-dot.active {
        background: #ffffff;
        width: 32px;
        border-radius: 10px;
    }

    /* Floating Search Bar */
    .hero-search-overlay {
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border-radius: 8px;
        padding: 18px 24px;
        max-width: 900px;
        margin: -40px auto 0;
        position: relative;
        z-index: 20;
        border: 1px solid #e2e8f0;
    }
    .hero-search-form {
        display: flex;
        gap: 12px;
        align-items: center;
    }
    .hero-search-input {
        flex: 1;
        padding: 12px 16px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        font-size: 15px;
        outline: none;
    }
    .hero-search-input:focus {
        border-color: var(--primary);
    }
    .hero-search-btn {
        background-color: #64141f;
        color: white;
        border-style: solid;
        border-width: 0;
        border-color: #64141f;
        padding: 10px 40px;
        border-radius: 2px;
        font-weight: inherit;
        font-family: inherit;
        text-transform: none;
        font-size: 15px;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.25s ease;
        line-height: 1;
    }
    .hero-search-btn:hover {
        background-color: #3a3a3a;
        border-color: #3a3a3a;
    }

    /* ==========================================================================
       4 Feature Cards with Live Gold Banner Background
       ========================================================================== */
    .features-section {
        padding: 65px 0;
        background: var(--gold-gradient);
        position: relative;
    }
    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }
    .feature-card {
        background: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 40px 24px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        transition: all 0.3s ease;
    }
    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(0,0,0,0.2);
    }
    .feature-icon-wrap {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        transition: transform 0.3s ease;
    }
    .feature-card:hover .feature-icon-wrap {
        transform: scale(1.1);
    }
    .feature-icon-wrap img {
        max-width: 65px;
        max-height: 65px;
        object-fit: contain;
    }
    .feature-title {
        font-size: 20px;
        font-size: 1.3333333333333rem;
        font-weight: 400;
        font-family: var(--font-heading);
        color: #000000;
        margin-bottom: 12px;
    }
    .feature-text {
        font-size: 15px;
        font-size: 1rem;
        color: #475569;
        line-height: 1.6;
    }

    /* ==========================================================================
       Company Overview Section ("A Leading Company Where we define colours")
       ========================================================================== */
    .company-overview-section {
        padding: 70px 0;
        background: #f8fafc;
        border-top: 1px solid #eef2f6;
        border-bottom: 1px solid #eef2f6;
    }
    .company-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: center;
    }
    .company-image-wrap {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    .company-image-wrap img {
        width: 100%;
        height: 420px;
        object-fit: cover;
        display: block;
    }
    .company-experience-badge {
        position: absolute;
        bottom: 25px;
        right: 25px;
        background: var(--primary-gradient);
        color: white;
        padding: 16px 24px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 6px 20px rgba(0,0,0,0.25);
    }
    .company-experience-badge strong {
        font-size: 32px;
        display: block;
        line-height: 1;
        font-family: var(--font-heading);
    }
    .company-experience-badge span {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .company-subtitle {
        color: var(--primary);
        font-weight: 400;
        text-transform: none;
        letter-spacing: 0;
        font-size: 15px;
        font-size: 1rem;
        margin-bottom: 10px;
        display: block;
    }
    .company-title {
        font-size: 30px;
        font-size: 2rem;
        font-weight: 400;
        font-family: var(--font-heading);
        color: #000000;
        margin-bottom: 20px;
        line-height: 1.25;
    }
    .company-desc {
        color: #475569;
        font-size: 15px;
        font-size: 1rem;
        line-height: 1.75;
        margin-bottom: 25px;
    }
    .company-points {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 30px;
    }
    .point-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 15px;
        font-size: 1rem;
        font-weight: 400;
        color: #1e293b;
    }
    .point-item svg {
        color: #16a34a;
        flex-shrink: 0;
    }

    /* ==========================================================================
       Product Categories Grid
       ========================================================================== */
    .categories-section {
        padding: 80px 0;
        background: #ffffff;
    }
    .section-header {
        text-align: center;
        max-width: 760px;
        margin: 0 auto 50px;
    }
    .section-subtitle {
        color: var(--primary);
        font-weight: 400;
        text-transform: none;
        letter-spacing: 0;
        font-size: 15px;
        font-size: 1rem;
        margin-bottom: 8px;
        display: block;
    }
    .section-title {
        font-size: 30px;
        font-size: 2rem;
        font-weight: 400;
        font-family: var(--font-heading);
        color: #000000;
        margin-bottom: 14px;
    }
    .section-description {
        color: #64748b;
        font-size: 15px;
        font-size: 1rem;
        line-height: 1.6;
    }
    .cat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }
    .cat-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
        padding: 24px;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
    }
    .cat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--primary-gradient);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .cat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        border-color: #cbd5e1;
    }
    .cat-card:hover::before {
        opacity: 1;
    }
    .cat-title {
        font-size: 20px;
        font-size: 1.3333333333333rem;
        font-weight: 400;
        font-family: var(--font-heading);
        color: #000000;
        margin-bottom: 10px;
    }
    .cat-desc {
        color: #64748b;
        font-size: 15px;
        font-size: 1rem;
        line-height: 1.55;
        margin-bottom: 18px;
    }
    .cat-link {
        font-size: 15px;
        font-size: 1rem;
        font-weight: 400;
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .cat-link:hover {
        color: #3a3a3a;
        gap: 10px;
    }

    /* ==========================================================================
       Top In-Demand Products Catalog
       ========================================================================== */
    .products-section {
        padding: 80px 0;
        background: #f8fafc;
    }
    .prod-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }
    .prod-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .prod-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.07);
    }
    .prod-image-wrap {
        height: 200px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }
    .prod-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .prod-card:hover .prod-image-wrap img {
        transform: scale(1.05);
    }
    .prod-body {
        padding: 18px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .prod-title {
        font-size: 15px;
        font-size: 1rem;
        font-weight: 400;
        color: #1e293b;
        margin-bottom: 8px;
        line-height: 1.4;
    }
    .prod-cas {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 14px;
        font-family: monospace;
        background: #f1f5f9;
        display: inline-block;
        padding: 3px 8px;
        border-radius: 4px;
    }
    .prod-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 12px;
        border-top: 1px solid #f1f5f9;
    }
    .btn-card-quote {
        background-color: #64141f;
        color: white !important;
        font-size: 15px;
        font-size: 1rem;
        padding: 10px 40px;
        border-radius: 2px;
        font-weight: inherit;
        cursor: pointer;
        border-style: solid;
        border-width: 0;
        border-color: #64141f;
        transition: all 0.25s ease;
        line-height: 1;
    }
    .btn-card-quote:hover {
        background-color: #3a3a3a;
        border-color: #3a3a3a;
    }

    /* ==========================================================================
       Sustainability Banner
       ========================================================================== */
    .sustainability-banner {
        background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), url('{{ asset("uploads/2020/07/sustainability-1024x683.jpg") }}') center/cover no-repeat;
        color: white;
        padding: 100px 0;
        text-align: center;
    }
    .sustainability-banner h2 {
        color: white;
        font-size: 30px;
        font-size: 2rem;
        font-weight: 400;
        font-family: var(--font-heading);
        margin-bottom: 16px;
    }
    .sustainability-banner p {
        color: #e2e8f0;
        font-size: 15px;
        font-size: 1rem;
        max-width: 780px;
        margin: 0 auto 35px;
        line-height: 1.6;
    }
    .btn-explore {
        background-color: #64141f;
        color: white !important;
        font-family: inherit;
        font-weight: inherit;
        padding: 10px 40px;
        border-radius: 2px;
        font-size: 15px;
        font-size: 1rem;
        text-transform: none;
        letter-spacing: 0;
        display: inline-block;
        border-style: solid;
        border-width: 0;
        border-color: #64141f;
        box-shadow: none;
        transition: all 0.25s ease;
        line-height: 1;
    }
    .btn-explore:hover {
        background-color: #3a3a3a;
        border-color: #3a3a3a;
        color: white !important;
    }

    /* ==========================================================================
       Some Interesting Facts (Counters - Matching Live Site Elementor #F0EAD7)
       ========================================================================== */
    .facts-section {
        background: var(--cream-bg);
        color: #000000;
        padding: 75px 0;
    }
    .facts-inner-flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 50px;
    }
    .facts-title-col {
        min-width: 220px;
        text-align: right;
    }
    .facts-title-sub {
        font-size: 20px;
        font-size: 1.3333333333333rem;
        font-weight: 400;
        font-family: var(--font-heading);
        color: #000000;
        line-height: 1.25;
    }
    .facts-title-main {
        font-size: 25px;
        font-size: 1.6666666666667rem;
        font-weight: 400;
        font-family: var(--font-heading);
        color: var(--primary);
        line-height: 1.25;
    }
    .facts-divider-v {
        width: 1px;
        height: 100px;
        background: #94a3b8;
    }
    .facts-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
        flex: 1;
        text-align: center;
    }
    .fact-card {
        padding: 10px;
    }
    .fact-icon-wrap {
        width: 70px;
        height: 70px;
        margin: 0 auto 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .fact-icon-wrap img {
        max-width: 55px;
        max-height: 55px;
        object-fit: contain;
    }
    .fact-number {
        font-size: 40px;
        font-size: 2.6666666666667rem;
        font-weight: 400;
        color: var(--primary);
        font-family: var(--font-heading);
        margin-bottom: 6px;
        line-height: 1;
    }
    .fact-num-line {
        width: 50px;
        height: 2px;
        background: #000000;
        margin: 8px auto 12px;
    }
    .fact-label {
        font-size: 15px;
        font-size: 1rem;
        color: #000000;
        font-weight: 400;
    }

    /* ==========================================================================
       Customer Testimonials Carousel (Matching Live Site Elementor #961A2B)
       ========================================================================== */
    .testimonials-section {
        padding: 85px 0;
        background: var(--crimson-bg);
        color: #ffffff;
    }
    .testimonials-section .section-title {
        color: #ffffff;
    }
    .testimonials-section .section-subtitle {
        color: var(--cream-bg);
    }
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }
    .testimonial-card {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 8px;
        padding: 28px 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.3s ease;
    }
    .testimonial-card:hover {
        transform: translateY(-4px);
        background: rgba(255, 255, 255, 0.14);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .testimonial-stars {
        color: #FFD700;
        font-size: 16px;
        margin-bottom: 14px;
    }
    .testimonial-text {
        font-size: 14px;
        color: #ffffff;
        line-height: 1.65;
        font-style: italic;
        margin-bottom: 22px;
        opacity: 0.95;
    }
    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .testimonial-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--gold-light);
    }
    .author-name {
        font-size: 15px;
        font-weight: 700;
        color: #ffffff;
    }
    .author-role {
        font-size: 12px;
        color: var(--cream-bg);
        text-transform: uppercase;
        font-weight: 600;
    }

    /* ==========================================================================
       Pre-Footer Community & Enquire Banner (Matching Live Site Elementor Banner)
       ========================================================================== */
    .prefooter-banner {
        background: var(--gold-gradient);
        padding: 55px 0;
        width: 100%;
        border-top: 1px solid rgba(0,0,0,0.06);
    }
    .prefooter-grid {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 30px;
    }
    .prefooter-col {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .prefooter-title {
        font-size: 20px;
        font-size: 1.3333333333333rem;
        font-weight: 400;
        color: #000000;
        margin: 0;
        font-family: var(--font-heading);
    }
    .prefooter-socials {
        display: flex;
        gap: 12px;
        align-items: center;
    }
    .prefooter-social-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #ffffff;
        color: var(--primary-accent);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .prefooter-social-btn:hover {
        background: var(--primary-accent);
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(150,26,43,0.25);
    }
    .prefooter-action {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    .btn-prefooter-enquire {
        background-color: #64141f;
        color: #ffffff;
        padding: 10px 40px;
        border-radius: 2px;
        font-size: 15px;
        font-size: 1rem;
        font-weight: inherit;
        text-transform: none;
        letter-spacing: 0;
        border-style: solid;
        border-width: 0;
        border-color: #64141f;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: none;
        text-decoration: none;
        display: inline-block;
        line-height: 1;
    }
    .btn-prefooter-enquire:hover {
        background-color: #3a3a3a;
        border-color: #3a3a3a;
        color: #ffffff;
    }

    /* Responsive Queries */
    @media (max-width: 1024px) {
        .features-grid, .cat-grid, .prod-grid, .testimonials-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .facts-grid {
            grid-template-columns: repeat(3, 1fr);
        }
        .company-grid {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 768px) {
        .facts-inner-flex {
            flex-direction: column;
            text-align: center;
            gap: 25px;
        }
        .facts-title-col {
            text-align: center;
        }
        .facts-divider-v {
            display: none;
        }
        .prefooter-grid {
            flex-direction: column;
            text-align: center;
            align-items: center;
        }
        .prefooter-socials {
            justify-content: center;
        }
        .prefooter-action {
            justify-content: center;
        }
    }
    @media (max-width: 640px) {
        .hero-slide-title { font-size: 32px; }
        .hero-slider { height: 460px; }
        .features-grid, .cat-grid, .prod-grid, .testimonials-grid, .facts-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- ==========================================================================
     1. Hero Banner Slider (Interactive 4-Slide Swiper matching WP)
     ========================================================================== -->
<div class="hero-slider-wrap">
    <div class="hero-slider" id="heroSlider">
        <!-- Slide 1: VAT DYES -->
        <div class="hero-slide active" style="background-image: url('{{ asset('uploads/2020/10/vat-dyes-banner_img.jpg') }}');">
            <div class="hero-slide-overlay"></div>
            <div class="container hero-slide-content">
                <span class="hero-badge">Leader in Color Chemistry</span>
                <h1 class="hero-slide-title">Premier Manufacturer of Vat Dyes</h1>
                <p class="hero-slide-desc">
                    Engineered for superior fastness, brilliant depth, and maximum chemical stability across high-performance textile dyeing and printing applications.
                </p>
                <div class="hero-slide-actions">
                    <a href="{{ url('/vat-dyes') }}" class="btn-slide-primary">Explore Vat Dyes</a>
                    <button type="button" class="btn-slide-secondary" onclick="openQuoteModal('Vat Dyes')">Request Quotation</button>
                </div>
            </div>
        </div>

        <!-- Slide 2: Solvent Dyes -->
        <div class="hero-slide" style="background-image: url('{{ asset('uploads/2020/10/solvent-dyes-banner-1920_700.jpg') }}');">
            <div class="hero-slide-overlay"></div>
            <div class="container hero-slide-content">
                <span class="hero-badge">Precision Solubility</span>
                <h2 class="hero-slide-title">High Heat Stability Solvent Dyes</h2>
                <p class="hero-slide-desc">
                    Powder, liquid, and metal complex solvent dyes tailored for plastics, polymer masterbatches, printing inks, wood stains, and fuel colorants.
                </p>
                <div class="hero-slide-actions">
                    <a href="{{ url('/solvent-dyes') }}" class="btn-slide-primary">Explore Solvent Dyes</a>
                    <button type="button" class="btn-slide-secondary" onclick="openQuoteModal('Solvent Dyes')">Get Bulk Rates</button>
                </div>
            </div>
        </div>

        <!-- Slide 3: Disperse Dyes -->
        <div class="hero-slide" style="background-image: url('{{ asset('uploads/2020/10/disperse-dyes-1920_700.jpg') }}');">
            <div class="hero-slide-overlay"></div>
            <div class="container hero-slide-content">
                <span class="hero-badge">Polyester & Synthetic Blends</span>
                <h2 class="hero-slide-title">Advanced Disperse Dyes</h2>
                <p class="hero-slide-desc">
                    Exceptional sublimation fastness and level dispersion properties for modern synthetic fibres, microfibres, and high-temperature exhaust dyeing.
                </p>
                <div class="hero-slide-actions">
                    <a href="{{ url('/disperse-dyes') }}" class="btn-slide-primary">Explore Disperse Dyes</a>
                    <button type="button" class="btn-slide-secondary" onclick="openQuoteModal('Disperse Dyes')">Request Lab Sample</button>
                </div>
            </div>
        </div>

        <!-- Slide 4: F D & C Colors -->
        <div class="hero-slide" style="background-image: url('{{ asset('uploads/2020/10/F-D-c-Banner-1.jpg') }}');">
            <div class="hero-slide-overlay"></div>
            <div class="container hero-slide-content">
                <span class="hero-badge">Food, Pharma & Cosmetics</span>
                <h2 class="hero-slide-title">Certified F D & C Colours</h2>
                <p class="hero-slide-desc">
                    Tartrazine, Sunset Yellow, Carmoisine, Allura Red, Brilliant Blue, and certified colors manufactured to US-FDA and European Pharmacopoeia standards.
                </p>
                <div class="hero-slide-actions">
                    <a href="{{ url('/f-d-c-colours') }}" class="btn-slide-primary">Explore Food Colours</a>
                    <button type="button" class="btn-slide-secondary" onclick="openQuoteModal('F D & C Colours')">Download COA / Specs</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Arrows -->
    <button class="slider-arrow prev" onclick="prevSlide()" aria-label="Previous Slide">&#10094;</button>
    <button class="slider-arrow next" onclick="nextSlide()" aria-label="Next Slide">&#10095;</button>

    <!-- Indicators -->
    <div class="slider-dots" id="sliderDots">
        <span class="slider-dot active" onclick="goToSlide(0)"></span>
        <span class="slider-dot" onclick="goToSlide(1)"></span>
        <span class="slider-dot" onclick="goToSlide(2)"></span>
        <span class="slider-dot" onclick="goToSlide(3)"></span>
    </div>
</div>

<!-- Quick Product Search Overlay -->
<div class="container">
    <div class="hero-search-overlay">
        <form action="{{ url('/products') }}" method="GET" class="hero-search-form">
            <input type="text" name="q" class="hero-search-input" placeholder="Search by Product Name, CAS No (e.g. 0633-03-04), or C.I. Number..." required>
            <button type="submit" class="hero-search-btn">Search Catalog</button>
        </form>
    </div>
</div>

<!-- ==========================================================================
     2. 4 Feature Cards (Icons directly matching WP)
     ========================================================================== -->
<section class="features-section">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon-wrap">
                    <img src="{{ asset('uploads/icons/color_management.png') }}" alt="Color Management">
                </div>
                <h3 class="feature-title">Color Management</h3>
                <p class="feature-text">
                    Colour management is a process where the colour characteristics are known precisely and utilised in colour reproduction.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrap">
                    <img src="{{ asset('uploads/icons/scientist.png') }}" alt="Research & Test Lab">
                </div>
                <h3 class="feature-title">Research & Test Lab</h3>
                <p class="feature-text">
                    STAGNANT gets STALE. Our team keeps on developing new shades and chemical assays as per global market demand.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrap">
                    <img src="{{ asset('uploads/icons/contract_manufacturing.png') }}" alt="Contract Manufacturing">
                </div>
                <h3 class="feature-title">Contract Manufacturing</h3>
                <p class="feature-text">
                    We do Contract manufacturing where production activities are customized according to technical orders and exact buyer specs.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrap">
                    <img src="{{ asset('uploads/icons/thirst.png') }}" alt="Quality Guaranteed">
                </div>
                <h3 class="feature-title">Quality Guaranteed</h3>
                <p class="feature-text">
                    Quality makes a company successful. We ensure rigorous quality checks on every product before dispatch to satisfy customer needs.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     3. Company Overview ("A Leading Company Where we define colours")
     ========================================================================== -->
<section class="company-overview-section">
    <div class="container">
        <div class="company-grid">
            <div class="company-image-wrap">
                <img src="{{ asset('uploads/2020/10/pic_home.jpg') }}" alt="SD International Laboratory & Facility">
                <div class="company-experience-badge">
                    <strong>25+</strong>
                    <span>Years Experience</span>
                </div>
            </div>

            <div>
                <span class="company-subtitle">About S D International</span>
                <h2 class="company-title">A Leading Company Where we define colours</h2>
                <p class="company-desc">
                    S D International is one of the leading manufacturers and Exporters in the Dyes & chemicals industry with having vast experience serving more than 50 countries around the world. We Satisfy our Customers by offering end to end solutions with our wide range of products. We are the ISO Certified 9001:2015 Company. Our products mainly go into vast Applications such as textiles, plastics, food, drugs, cosmetics, paper, printing inks, paints, wax, coatings, etc.
                </p>

                <div class="company-points">
                    <div class="point-item">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>ISO 9001:2015 Certified Quality</span>
                    </div>
                    <div class="point-item">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Exporting to 50+ Countries</span>
                    </div>
                    <div class="point-item">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>600+ Products Ready Stock</span>
                    </div>
                    <div class="point-item">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Custom Color Shade Matching</span>
                    </div>
                </div>

                <div style="display:flex; gap:16px; flex-wrap:wrap;">
                    <a href="{{ url('/about-us') }}" style="background-color:#64141f; color:white !important; padding:10px 40px; border-radius:2px; font-size:15px; font-size:1rem; border-style:solid; border-width:0; border-color:#64141f; line-height:1; display:inline-block; transition:all 0.25s ease;">Read More About Us</a>
                    <button type="button" style="background-color:transparent; color:#64141f !important; padding:10px 40px; border-radius:2px; font-size:15px; font-size:1rem; border-style:solid; border-width:1px; border-color:#64141f; line-height:1; cursor:pointer; transition:all 0.25s ease;" onclick="openQuoteModal()">Contact Sales Director</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     4. Product Line Categories Grid
     ========================================================================== -->
<section class="categories-section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Our Product Line</span>
            <h2 class="section-title">High Purity Dyes & Chemical Solutions</h2>
            <p class="section-description">
                Tailored for high performance across textile dyeing, plastic masterbatches, inks, coatings, leather, and food manufacturing.
            </p>
        </div>

        <div class="cat-grid">
            @foreach($featuredCategories as $cat)
            <div class="cat-card">
                <div>
                    <h3 class="cat-title">{{ $cat->name }}</h3>
                    <p class="cat-desc">
                        {{ \Illuminate\Support\Str::limit(strip_tags($cat->description ?: "High quality {$cat->name} engineered for superior fastness, dispersion, and brilliant tinting strength."), 110) }}
                    </p>
                </div>
                <div>
                    <a href="{{ url('/' . $cat->slug) }}" class="cat-link">View Products →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==========================================================================
     5. Top In-Demand Featured Products
     ========================================================================== -->
<section class="products-section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Top In-Demand Products</span>
            <h2 class="section-title">Featured Industrial Chemicals</h2>
            <p class="section-description">
                Direct from factory manufacturer with ready stock for worldwide shipment.
            </p>
        </div>

        <div class="prod-grid">
            @foreach($featuredProducts as $prod)
            <div class="prod-card">
                <a href="{{ url('/' . $prod->slug) }}" class="prod-image-wrap">
                    @if($prod->image_url)
                        <img src="{{ asset(ltrim($prod->image_url, '/')) }}" alt="{{ $prod->title }}">
                    @else
                        <img src="{{ asset('uploads/2020/07/logo.png') }}" alt="{{ $prod->title }}" style="max-height: 40px; width:auto; opacity: 0.6;">
                    @endif
                </a>
                <div class="prod-body">
                    <div>
                        <a href="{{ url('/' . $prod->slug) }}" class="prod-title">{{ $prod->title }}</a>
                        @if($prod->cas_number)
                            <div class="prod-cas">CAS: {{ $prod->cas_number }}</div>
                        @endif
                    </div>
                    <div class="prod-footer">
                        <a href="{{ url('/' . $prod->slug) }}" style="font-size: 13px; font-weight: 600;">Details →</a>
                        <button type="button" class="btn-card-quote" onclick="openQuoteModal('{{ addslashes($prod->title) }}', '{{ $prod->slug }}')">Get Quote</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 45px;">
            <a href="{{ url('/products') }}" style="background-color:#64141f; color:white !important; padding:10px 40px; border-radius:2px; font-size:15px; font-size:1rem; border-style:solid; border-width:0; border-color:#64141f; line-height:1; display:inline-block; transition:all 0.25s ease; text-decoration:none;">View Complete 600+ Products Catalog →</a>
        </div>
    </div>
</section>

<!-- ==========================================================================
     6. Sustainability Banner (Exact WP Section)
     ========================================================================== -->
<section class="sustainability-banner">
    <div class="container">
        <h2>Sustainability</h2>
        <p>
            The economic-environment-social structure of sustainability is closely knit into the philosophy of SD International.
        </p>
        <a href="{{ url('/sustainability') }}" class="btn-explore">EXPLORE</a>
    </div>
</section>

<!-- ==========================================================================
     7. Some Interesting Facts (Counters with exact WP layout & numbers)
     ========================================================================== -->
<section class="facts-section">
    <div class="container">
        <div class="facts-inner-flex">
            <div class="facts-title-col">
                <div class="facts-title-sub">Some Interesting</div>
                <div class="facts-title-main">Facts</div>
            </div>
            <div class="facts-divider-v"></div>
            <div class="facts-grid">
                <div class="fact-card">
                    <div class="fact-icon-wrap">
                        <img src="{{ asset('uploads/2020/07/chemistry.png') }}" alt="Chemistry Icon">
                    </div>
                    <div class="fact-number">700 +</div>
                    <div class="fact-num-line"></div>
                    <div class="fact-label">Dyes & Chemicals</div>
                </div>

                <div class="fact-card">
                    <div class="fact-icon-wrap">
                        <img src="{{ asset('uploads/2020/07/bring.png') }}" alt="Happy Clients Icon">
                    </div>
                    <div class="fact-number">300 +</div>
                    <div class="fact-num-line"></div>
                    <div class="fact-label">Happy Clients</div>
                </div>

                <div class="fact-card">
                    <div class="fact-icon-wrap">
                        <img src="{{ asset('uploads/2020/07/maps-and-flags.png') }}" alt="Countries Map Icon">
                    </div>
                    <div class="fact-number">50</div>
                    <div class="fact-num-line"></div>
                    <div class="fact-label">Countries around the world</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     8. Customer Testimonials (4 real reviews matching WP)
     ========================================================================== -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Real Buyer Experiences</span>
            <h2 class="section-title">Customer Testimonials</h2>
            <p class="section-description">
                Trusted by manufacturing plants, textile mills, and chemical importers across 5 continents.
            </p>
        </div>

        <div class="testimonials-grid">
            <!-- Review 1: Mitch Skolnik -->
            <div class="testimonial-card">
                <div>
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">
                        "We were treated like royalty. You guys rock! Great job, I will definitely be ordering again! I would also like to say thank you to all your staff."
                    </p>
                </div>
                <div class="testimonial-author">
                    <img src="{{ asset('uploads/2020/08/mitch.jpg') }}" alt="Mitch Skolnik" class="testimonial-avatar">
                    <div>
                        <div class="author-name">Mitch Skolnik</div>
                        <div class="author-role">Buyer</div>
                    </div>
                </div>
            </div>

            <!-- Review 2: Sayeed Ahmad -->
            <div class="testimonial-card">
                <div>
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">
                        "I have gotten at least 50 times the value from basic dyes. We’re loving it. It’s really wonderful. Wow what great color bank, I love it!"
                    </p>
                </div>
                <div class="testimonial-author">
                    <img src="{{ asset('uploads/2020/08/sayeed.jpg') }}" alt="Sayeed Ahmad" class="testimonial-avatar">
                    <div>
                        <div class="author-name">Sayeed Ahmad</div>
                        <div class="author-role">Buyer</div>
                    </div>
                </div>
            </div>

            <!-- Review 3: Kenny Sing -->
            <div class="testimonial-card">
                <div>
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">
                        "We’ve used s d international’s products for the last five years. It’s just amazing. Great job, I will definitely be ordering again! Absolutely wonderful!"
                    </p>
                </div>
                <div class="testimonial-author">
                    <img src="{{ asset('uploads/2020/08/ishtiaq-1.jpg') }}" alt="Kenny Sing" class="testimonial-avatar">
                    <div>
                        <div class="author-name">Kenny Sing</div>
                        <div class="author-role">Buyer</div>
                    </div>
                </div>
            </div>

            <!-- Review 4: Daniel Deepak -->
            <div class="testimonial-card">
                <div>
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Your company is truly upstanding and is behind its product 100%. It’s just amazing. S d international impressed me on multiple levels. I use s d international products often."
                    </p>
                </div>
                <div class="testimonial-author">
                    <img src="{{ asset('uploads/2020/08/daniel.jpg') }}" alt="Daniel Deepak" class="testimonial-avatar">
                    <div>
                        <div class="author-name">Daniel Deepak</div>
                        <div class="author-role">Buyer</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     9. Target Applications / Industries
     ========================================================================== -->
<section class="company-overview-section" style="background:#ffffff;">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Target Applications</span>
            <h2 class="section-title">Industries We Serve</h2>
            <p class="section-description">
                Engineered to meet the exact technical standards of global manufacturing leaders.
            </p>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
            <div style="border-radius:8px; padding:26px; background:#f8fafc; border-left:4px solid var(--primary);">
                <h3 style="font-size:20px; font-size:1.3333333333333rem; font-weight:400; font-family:'Montserrat',sans-serif; margin-bottom:10px;">🧵 Textiles & Apparel</h3>
                <p style="font-size:14px; color:#475569; line-height:1.6;">
                    Vat, disperse, and reactive dyes delivering exceptional light, wash, and sublimation fastness for cotton, polyester, nylon, and synthetic blends.
                </p>
            </div>
            <div style="border-radius:8px; padding:26px; background:#f8fafc; border-left:4px solid var(--primary);">
                <h3 style="font-size:20px; font-size:1.3333333333333rem; font-weight:400; font-family:'Montserrat',sans-serif; margin-bottom:10px;">🧴 Plastics & Polymers</h3>
                <p style="font-size:14px; color:#475569; line-height:1.6;">
                    Solvent dyes and high-performance pigments with high heat stability and excellent dispersion for PVC, polystyrene, acrylic, and masterbatches.
                </p>
            </div>
            <div style="border-radius:8px; padding:26px; background:#f8fafc; border-left:4px solid var(--primary);">
                <h3 style="font-size:20px; font-size:1.3333333333333rem; font-weight:400; font-family:'Montserrat',sans-serif; margin-bottom:10px;">🖋️ Printing Inks & Coatings</h3>
                <p style="font-size:14px; color:#475569; line-height:1.6;">
                    Micro-milled organic pigments and soluble dyes for flexographic, gravure, offset, digital inkjet inks, and automotive paints.
                </p>
            </div>
            <div style="border-radius:8px; padding:26px; background:#f8fafc; border-left:4px solid var(--primary);">
                <h3 style="font-size:20px; font-size:1.3333333333333rem; font-weight:400; font-family:'Montserrat',sans-serif; margin-bottom:10px;">📜 Paper & Pulp</h3>
                <p style="font-size:14px; color:#475569; line-height:1.6;">
                    Basic dyes, direct dyes, and optical brighteners offering high substantivity and two-sidedness prevention for kraft, writing, and tissue papers.
                </p>
            </div>
            <div style="border-radius:8px; padding:26px; background:#f8fafc; border-left:4px solid var(--primary);">
                <h3 style="font-size:20px; font-size:1.3333333333333rem; font-weight:400; font-family:'Montserrat',sans-serif; margin-bottom:10px;">👞 Leather Finishing</h3>
                <p style="font-size:14px; color:#475569; line-height:1.6;">
                    Acid and metal-complex dyes delivering deep penetration, level dyeing, and high resistance to water and dry cleaning.
                </p>
            </div>
            <div style="border-radius:8px; padding:26px; background:#f8fafc; border-left:4px solid var(--primary);">
                <h3 style="font-size:20px; font-size:1.3333333333333rem; font-weight:400; font-family:'Montserrat',sans-serif; margin-bottom:10px;">🍔 Food, Pharma & Cosmetics</h3>
                <p style="font-size:14px; color:#475569; line-height:1.6;">
                    US-FDA and European standard F D & C approved food colours with highest purity assays for confectionery, beverages, and cosmetics.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     10. Pre-Footer Community & Enquire Banner (Matching Live Site Elementor)
     ========================================================================== -->
<section class="prefooter-banner">
    <div class="container">
        <div class="prefooter-grid">
            <div class="prefooter-col">
                <h3 class="prefooter-title">Join the community</h3>
                <div class="prefooter-socials">
                    <a href="https://facebook.com" target="_blank" rel="noopener" class="prefooter-social-btn" title="Facebook" aria-label="Facebook">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://twitter.com" target="_blank" rel="noopener" class="prefooter-social-btn" title="Twitter" aria-label="Twitter">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="https://linkedin.com" target="_blank" rel="noopener" class="prefooter-social-btn" title="LinkedIn" aria-label="LinkedIn">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                    <a href="https://instagram.com" target="_blank" rel="noopener" class="prefooter-social-btn" title="Instagram" aria-label="Instagram">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            <div class="prefooter-action">
                <h3 class="prefooter-title">We’d love to hear from you</h3>
                <button type="button" class="btn-prefooter-enquire" onclick="openQuoteModal('General Inquiry')">Enquire Now</button>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Hero Slider Carousel Script
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slider-dot');
    let slideInterval = null;

    function showSlide(index) {
        if (index >= slides.length) currentSlide = 0;
        else if (index < 0) currentSlide = slides.length - 1;
        else currentSlide = index;

        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === currentSlide);
        });
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentSlide);
        });
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    function goToSlide(i) {
        showSlide(i);
        resetTimer();
    }

    function startTimer() {
        slideInterval = setInterval(nextSlide, 5000);
    }

    function resetTimer() {
        clearInterval(slideInterval);
        startTimer();
    }

    startTimer();

    // Pause on hover
    const sliderWrap = document.querySelector('.hero-slider-wrap');
    if (sliderWrap) {
        sliderWrap.addEventListener('mouseenter', () => clearInterval(slideInterval));
        sliderWrap.addEventListener('mouseleave', () => startTimer());
    }
</script>
@endpush
