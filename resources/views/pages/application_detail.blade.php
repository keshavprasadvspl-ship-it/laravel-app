@extends('layouts.app')

@section('content')
<style>
    /* Application Detail Page Styling */
    .app-breadcrumb-bar {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 14px 0;
        font-size: 13.5px;
        font-family: 'Open Sans', sans-serif;
    }
    .app-breadcrumb-list {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        list-style: none;
        margin: 0;
        padding: 0;
        color: #64748b;
    }
    .app-breadcrumb-list a {
        color: #64748b;
        text-decoration: none;
        transition: color 0.15s;
    }
    .app-breadcrumb-list a:hover {
        color: #73001B;
    }
    .app-breadcrumb-list .sep {
        color: #cbd5e1;
    }
    .app-breadcrumb-list .active {
        color: #1e293b;
        font-weight: 600;
    }

    /* Page Hero */
    .app-hero-section {
        background: linear-gradient(135deg, #fdf8f8 0%, #fef2f2 100%);
        border-bottom: 1px solid #fecaca;
        padding: 40px 0 35px;
        margin-bottom: 35px;
        text-align: center;
    }
    .app-hero-title {
        font-family: 'Teko', 'Montserrat', sans-serif;
        font-size: 38px;
        font-weight: 600;
        color: #73001B;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0 0 10px;
    }
    .app-hero-subtitle {
        font-family: 'Open Sans', sans-serif;
        font-size: 15px;
        color: #64748b;
        max-width: 720px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Application Products & Content Area */
    .app-content-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px 60px;
    }

    .app-products-wrap h2 {
        font-family: 'Teko', 'Montserrat', sans-serif;
        font-size: 30px;
        font-weight: 600;
        color: #73001B;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 30px 0 20px;
        padding-bottom: 8px;
        border-bottom: 2px solid #73001B;
    }

    /* 6-Column Responsive Product Grid */
    .app-products-wrap ul.products,
    .app-products-wrap ul.products-grid-columns-6 {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 20px;
        list-style: none;
        padding: 0;
        margin: 25px 0 45px;
    }

    .app-products-wrap ul.products > li,
    .app-products-wrap ul.products-grid-columns-6 > li {
        background: #ffffff;
        border: 1px solid #eef2f6;
        border-radius: 8px;
        padding: 0 0 14px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .app-products-wrap ul.products > li:hover,
    .app-products-wrap ul.products-grid-columns-6 > li:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        border-color: #fecaca;
    }

    /* Thumbnails */
    .app-products-wrap ul.products > li img,
    .app-products-wrap ul.products-grid-columns-6 > li img {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        display: block;
        background: #f8fafc;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Links & Typography */
    .app-products-wrap ul.products > li a,
    .app-products-wrap ul.products-grid-columns-6 > li a {
        text-decoration: none;
        color: inherit;
        display: block;
        width: 100%;
    }

    .app-products-wrap ul.products > li h2,
    .app-products-wrap ul.products-grid-columns-6 > li h2 {
        font-family: 'Open Sans', sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        color: #1e293b !important;
        line-height: 1.4 !important;
        margin: 10px 10px 4px !important;
        border-bottom: none !important;
        padding-bottom: 0 !important;
        text-transform: none !important;
        letter-spacing: normal !important;
        transition: color 0.15s ease;
    }

    .app-products-wrap ul.products > li a:hover h2,
    .app-products-wrap ul.products-grid-columns-6 > li a:hover h2 {
        color: #73001B !important;
    }

    /* Category text inside li */
    .app-products-wrap ul.products > li > span.cat-label,
    .app-products-wrap ul.products-grid-columns-6 > li > span.cat-label {
        font-family: 'Open Sans', sans-serif;
        font-size: 11px;
        text-transform: uppercase;
        color: #94a3b8;
        letter-spacing: 0.5px;
        margin-top: 6px;
    }

    /* Industries We Serve Section */
    .app-industries-section {
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        padding: 45px 0 20px;
        margin-top: 50px;
    }

    .app-section-heading {
        font-family: 'Teko', 'Montserrat', sans-serif;
        font-size: 29px;
        font-weight: 600;
        color: #73001B;
        margin: 0 0 25px 0;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .app-industries-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 30px;
    }

    .app-industry-card {
        background: #ffffff;
        border: 1px solid #eef2f6;
        border-radius: 6px;
        overflow: hidden;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .app-industry-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .app-industry-card a {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .app-industry-card .ind-img-wrap {
        width: 100%;
        height: 125px;
        overflow: hidden;
        background: #f1f5f9;
    }

    .app-industry-card .ind-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }

    .app-industry-card:hover .ind-img-wrap img {
        transform: scale(1.05);
    }

    .app-industry-card .ind-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        color: #1e293b;
        margin: 10px 8px 12px;
        line-height: 1.35;
        transition: color 0.2s;
    }

    .app-industry-card:hover .ind-title {
        color: #73001B;
    }

    /* Responsive Breakpoints */
    @media (max-width: 1200px) {
        .app-products-wrap ul.products,
        .app-products-wrap ul.products-grid-columns-6 {
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }
        .app-industries-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .app-hero-title {
            font-size: 28px;
        }
        .app-products-wrap ul.products,
        .app-products-wrap ul.products-grid-columns-6 {
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        .app-industries-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
    }

    @media (max-width: 480px) {
        .app-products-wrap ul.products,
        .app-products-wrap ul.products-grid-columns-6 {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .app-industries-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }
        .app-industry-card .ind-img-wrap {
            height: 95px;
        }
    }
</style>

<!-- 1. Breadcrumbs Bar -->
<nav class="app-breadcrumb-bar" aria-label="breadcrumb">
    <div class="container">
        <ul class="app-breadcrumb-list">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="sep">/</li>
            <li><a href="{{ url('/applications') }}">Applications</a></li>
            <li class="sep">/</li>
            <li class="active">{{ $page->title }}</li>
        </ul>
    </div>
</nav>

<!-- 2. Hero Section -->
<section class="app-hero-section">
    <div class="container">
        <h1 class="app-hero-title">{{ $page->title }}</h1>
        <p class="app-hero-subtitle">
            SD International manufactures, supplies, and exports premier industrial colorants, dyes, and pigment solutions tailored for {{ strtolower($page->title) }}.
        </p>
    </div>
</section>

<!-- 3. Main Products & Content -->
<main class="app-content-container">
    <div class="app-products-wrap">
        {!! $content !!}
    </div>

    <!-- 4. Industries We Serve Grid -->
    <div class="app-industries-section">
        <h4 class="app-section-heading">Industries We Serve</h4>
        <div class="app-industries-grid">
            <!-- 1. Plastic & Polymers -->
            <div class="app-industry-card">
                <a href="{{ url('/applications/plastic-polymers') }}">
                    <div class="ind-img-wrap">
                        <img src="{{ asset('uploads/applications/plastics.jpg') }}" alt="Plastic & Polymers" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/plastics.jpg';">
                    </div>
                    <div class="ind-title">Plastic &amp; Polymers</div>
                </a>
            </div>
            <!-- 2. Textiles -->
            <div class="app-industry-card">
                <a href="{{ url('/applications/textiles') }}">
                    <div class="ind-img-wrap">
                        <img src="{{ asset('uploads/applications/textile.jpg') }}" alt="Textiles" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/textile.jpg';">
                    </div>
                    <div class="ind-title">Textiles</div>
                </a>
            </div>
            <!-- 3. Leather -->
            <div class="app-industry-card">
                <a href="{{ url('/applications/leather') }}">
                    <div class="ind-img-wrap">
                        <img src="{{ asset('uploads/applications/lather.jpg') }}" alt="Leather" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/lather.jpg';">
                    </div>
                    <div class="ind-title">Leather</div>
                </a>
            </div>
            <!-- 4. Petroleum & Lubricants -->
            <div class="app-industry-card">
                <a href="{{ url('/applications/petroleum-lubricants') }}">
                    <div class="ind-img-wrap">
                        <img src="{{ asset('uploads/applications/petro.jpg') }}" alt="Petroleum & Lubricants" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/petro.jpg';">
                    </div>
                    <div class="ind-title">Petroleum &amp; Lubricants</div>
                </a>
            </div>
            <!-- 5. Paper & Pulp -->
            <div class="app-industry-card">
                <a href="{{ url('/applications/paper-pulp') }}">
                    <div class="ind-img-wrap">
                        <img src="{{ asset('uploads/applications/papper.jpg') }}" alt="Paper & Pulp" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/papper.jpg';">
                    </div>
                    <div class="ind-title">Paper &amp; Pulp</div>
                </a>
            </div>
            <!-- 6. Printing Inks -->
            <div class="app-industry-card">
                <a href="{{ url('/applications/printing-inks') }}">
                    <div class="ind-img-wrap">
                        <img src="{{ asset('uploads/applications/ink.jpg') }}" alt="Printing Inks" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/ink.jpg';">
                    </div>
                    <div class="ind-title">Printing Inks</div>
                </a>
            </div>
            <!-- 7. Food Drug & Cosmetics -->
            <div class="app-industry-card">
                <a href="{{ url('/applications/food-drug-cosmetics') }}">
                    <div class="ind-img-wrap">
                        <img src="{{ asset('uploads/applications/food_drug_cos.jpg') }}" alt="Food Drug & Cosmetics" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/food_drug_cos.jpg';">
                    </div>
                    <div class="ind-title">Food Drug &amp; Cosmetics</div>
                </a>
            </div>
            <!-- 8. Coatings -->
            <div class="app-industry-card">
                <a href="{{ url('/applications/coating') }}">
                    <div class="ind-img-wrap">
                        <img src="{{ asset('uploads/applications/coatings.jpg') }}" alt="Coatings" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/coatings.jpg';">
                    </div>
                    <div class="ind-title">Coatings</div>
                </a>
            </div>
            <!-- 9. Wood Stains -->
            <div class="app-industry-card">
                <a href="{{ url('/applications/wood-stains') }}">
                    <div class="ind-img-wrap">
                        <img src="{{ asset('uploads/applications/wood_stain.jpg') }}" alt="Wood Stains" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/wood_stain.jpg';">
                    </div>
                    <div class="ind-title">Wood Stains</div>
                </a>
            </div>
            <!-- 10. Smoke Dyes -->
            <div class="app-industry-card">
                <a href="{{ url('/applications/smoke-dyes') }}">
                    <div class="ind-img-wrap">
                        <img src="{{ asset('uploads/applications/smoke.jpg') }}" alt="Smoke Dyes" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/smoke.jpg';">
                    </div>
                    <div class="ind-title">Smoke Dyes</div>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection
