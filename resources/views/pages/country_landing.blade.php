@extends('layouts.app')

@section('content')
<style>
    /* ==========================================================================
       SD International - Country Landing Page Template
       Matching sdinternational.com/dyes/dyes-supplier-in-argentina/ 1:1
       ========================================================================== */

    .country-page-wrap {
        max-width: 1240px;
        margin: 0 auto;
        padding: 15px 20px 70px;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        line-height: 1.75;
        color: #334155;
    }

    /* Breadcrumbs */
    .country-top-breadcrumb {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 18px;
    }
    .country-top-breadcrumb a {
        color: #64141f;
        text-decoration: none;
    }
    .country-top-breadcrumb a:hover {
        text-decoration: underline;
    }
    .country-top-breadcrumb .separator {
        margin: 0 6px;
        color: #94a3b8;
    }

    /* 2-Column Header & Intro Section */
    .country-intro-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 280px;
        gap: 36px;
        align-items: start;
        margin-bottom: 35px;
    }

    .country-title-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 14px;
    }

    .country-page-title {
        font-family: 'Poppins', sans-serif !important;
        font-size: 28px !important;
        font-weight: 700 !important;
        color: #222222 !important;
        margin: 0 0 6px 0 !important;
        line-height: 1.25 !important;
        text-transform: none !important;
    }

    .country-page-subtitle {
        font-family: 'Poppins', sans-serif !important;
        font-size: 14.5px !important;
        font-weight: 500 !important;
        color: #444444 !important;
        margin: 0 !important;
    }

    .btn-get-quote {
        background-color: #64141f !important;
        color: #ffffff !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        padding: 9px 24px !important;
        border-radius: 4px !important;
        border: none !important;
        cursor: pointer !important;
        white-space: nowrap !important;
        box-shadow: 0 2px 6px rgba(100, 20, 31, 0.25) !important;
        transition: background-color 0.2s ease, transform 0.15s ease !important;
    }

    .btn-get-quote:hover {
        background-color: #8b1c2b !important;
        transform: translateY(-1px) !important;
    }

    .country-intro-body {
        font-family: 'Poppins', sans-serif;
        font-size: 14.5px;
        line-height: 1.75;
        color: #334155;
    }

    .country-intro-body p {
        margin-bottom: 14px;
    }

    .country-intro-body h5 {
        font-family: 'Poppins', sans-serif !important;
        font-size: 22px !important;
        font-weight: 700 !important;
        color: #64141f !important;
        margin: 24px 0 10px 0 !important;
        text-transform: none !important;
    }

    /* Products Range Sidebar Card */
    .country-sidebar-card {
        background-color: #f7f9fa;
        border: 1px solid #eef2f5;
        border-radius: 4px;
        padding: 24px 22px;
    }

    .country-sidebar-title {
        font-family: 'Poppins', sans-serif !important;
        font-size: 18px !important;
        font-weight: 700 !important;
        color: #64141f !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        margin: 0 0 12px 0 !important;
        line-height: 1.2 !important;
    }

    .country-sidebar-cat {
        font-family: 'Poppins', sans-serif !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        color: #64141f !important;
        text-transform: uppercase !important;
        margin: 0 0 14px 0 !important;
        line-height: 1.2 !important;
    }

    .country-sidebar-cat a {
        color: #64141f !important;
        text-decoration: none !important;
    }

    .country-sidebar-menu {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .country-sidebar-menu li {
        padding: 7px 0 !important;
        border-bottom: 1px solid #edf0f2 !important;
        margin: 0 !important;
    }

    .country-sidebar-menu li:last-child {
        border-bottom: none !important;
    }

    .country-sidebar-menu a {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        color: #334155 !important;
        font-size: 13.5px !important;
        font-weight: 500 !important;
        text-decoration: none !important;
        transition: color 0.15s ease, transform 0.15s ease !important;
    }

    .country-sidebar-menu a:hover {
        color: #64141f !important;
        transform: translateX(2px) !important;
    }

    .country-sidebar-arrow {
        color: #888888 !important;
        font-size: 16px !important;
        font-weight: bold !important;
        line-height: 1 !important;
    }

    /* Headings in Main Body */
    .country-page-wrap h1,
    .country-page-wrap h2,
    .country-page-wrap h3,
    .country-page-wrap h4,
    .country-page-wrap h5 {
        font-family: 'Teko', 'Montserrat', sans-serif;
        color: #73001B;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 30px 0 15px;
        line-height: 1.2;
    }

    .country-page-wrap h2 { font-size: 32px; border-bottom: 2px solid #73001B; padding-bottom: 6px; }
    .country-page-wrap h3 { font-size: 26px; }
    .country-page-wrap h4 { font-size: 22px; }

    /* 6-Column Responsive Product Swatches Grid */
    .country-products-grid {
        display: grid !important;
        grid-template-columns: repeat(6, 1fr) !important;
        gap: 28px 18px !important;
        list-style: none !important;
        margin: 35px 0 50px !important;
        padding: 0 !important;
    }

    .country-products-grid > li {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        text-align: center !important;
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .country-products-grid > li > a:first-child {
        display: block !important;
        width: 120px !important;
        height: 120px !important;
        border-radius: 50% !important;
        overflow: hidden !important;
        background: #f8fafc !important;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08) !important;
        border: 2px solid #eef2f6 !important;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease !important;
        margin-bottom: 12px !important;
    }

    .country-products-grid > li img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
        border-radius: 50% !important;
        transition: transform 0.3s ease !important;
    }

    .country-products-grid > li:hover > a:first-child {
        transform: translateY(-4px) scale(1.03) !important;
        box-shadow: 0 8px 22px rgba(115, 0, 27, 0.2) !important;
        border-color: #73001B !important;
    }

    .country-products-grid > li:hover img {
        transform: scale(1.08) !important;
    }

    .country-prod-cat {
        display: inline-block !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        color: #73001B !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        margin-bottom: 4px !important;
        background: #fbf3ee !important;
        padding: 2px 8px !important;
        border-radius: 12px !important;
    }

    .country-products-grid > li h2 {
        font-family: 'Poppins', sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        color: #1e293b !important;
        margin: 0 !important;
        padding: 0 !important;
        line-height: 1.35 !important;
        border: none !important;
        text-transform: none !important;
        letter-spacing: 0 !important;
        transition: color 0.2s ease !important;
    }

    .country-products-grid > li a {
        text-decoration: none !important;
        color: inherit !important;
    }

    .country-products-grid > li a:hover h2 {
        color: #73001B !important;
    }

    /* Call & WhatsApp CTAs */
    .country-page-wrap a[href^="tel:"] {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        padding: 10px 24px !important;
        background: #73001B !important;
        color: #ffffff !important;
        border-radius: 50px !important;
        text-decoration: none !important;
        font-weight: 600 !important;
        margin: 10px 0 !important;
        transition: background-color 0.2s !important;
    }
    .country-page-wrap a[href^="tel:"]:hover {
        background: #961C0B !important;
    }

    .country-page-wrap a[href*="wa.link"],
    .country-page-wrap a[href*="whatsapp"] {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        padding: 10px 24px !important;
        background: #25D366 !important;
        color: #ffffff !important;
        border-radius: 50px !important;
        text-decoration: none !important;
        font-weight: 600 !important;
        margin: 10px 0 !important;
        transition: background-color 0.2s !important;
    }
    .country-page-wrap a[href*="wa.link"]:hover,
    .country-page-wrap a[href*="whatsapp"]:hover {
        background: #20ba5a !important;
    }

    /* 15-Card Applications / Industries Grid */
    .country-industries-grid {
        display: grid !important;
        grid-template-columns: repeat(5, 1fr) !important;
        gap: 16px !important;
        margin: 25px 0 45px !important;
    }

    .country-industry-card {
        background: #ffffff !important;
        border: 1px solid #eef2f6 !important;
        border-radius: 6px !important;
        overflow: hidden !important;
        text-align: center !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease !important;
    }

    .country-industry-card:hover {
        transform: translateY(-4px) !important;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08) !important;
    }

    .country-industry-card a {
        text-decoration: none !important;
        color: inherit !important;
        display: block !important;
    }

    .country-industry-img {
        width: 100% !important;
        height: 120px !important;
        overflow: hidden !important;
        background: #f8fafc !important;
    }

    .country-industry-img img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
        border-radius: 0 !important;
        transition: transform 0.3s ease !important;
    }

    .country-industry-card:hover .country-industry-img img {
        transform: scale(1.06) !important;
    }

    .country-industry-btn {
        display: block !important;
        padding: 8px 10px !important;
        background: #73001B !important;
        color: #ffffff !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        text-decoration: none !important;
        transition: background-color 0.2s !important;
    }

    .country-industry-card:hover .country-industry-btn {
        background: #961C0B !important;
    }

    /* World Map and Export Destinations 2-Column Row */
    .country-destinations-row {
        display: grid !important;
        grid-template-columns: minmax(0, 1fr) 420px !important;
        gap: 32px !important;
        align-items: center !important;
        background: #fdfbf7 !important;
        border: 1px solid #ebdccb !important;
        border-radius: 8px !important;
        padding: 30px 28px !important;
        margin: 45px 0 !important;
    }

    .country-destinations-heading {
        font-family: 'Teko', 'Montserrat', sans-serif !important;
        font-size: 28px !important;
        color: #73001B !important;
        font-weight: 600 !important;
        margin: 0 0 8px 0 !important;
        line-height: 1.2 !important;
        text-transform: uppercase !important;
    }

    .country-destinations-sub {
        font-size: 14px !important;
        color: #64748b !important;
        margin-bottom: 16px !important;
        line-height: 1.6 !important;
    }

    .country-destinations-links a {
        display: inline-block !important;
        padding: 3px 10px !important;
        margin: 3px 2px !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 16px !important;
        color: #334155 !important;
        font-size: 13px !important;
        text-decoration: none !important;
        transition: all 0.2s !important;
    }

    .country-destinations-links a:hover,
    .country-destinations-links a.active {
        background: #73001B !important;
        color: #ffffff !important;
        border-color: #73001B !important;
    }

    .country-destinations-map img {
        width: 100% !important;
        max-width: 420px !important;
        height: auto !important;
        border-radius: 6px !important;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06) !important;
        display: block !important;
        margin: 0 auto !important;
    }

    /* Inter-country links block at footer */
    .country-siblings-block {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 24px;
        margin-top: 50px;
    }

    .country-siblings-title {
        font-size: 20px !important;
        margin: 0 0 6px !important;
    }

    .country-siblings-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        line-height: 1.8;
    }

    .country-siblings-grid a {
        display: inline-block;
        padding: 4px 12px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        color: #334155;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .country-siblings-grid a:hover,
    .country-siblings-grid a.active {
        background: #73001B;
        color: #ffffff;
        border-color: #73001B;
    }

    /* Modal Popup Overlay */
    .country-modal-overlay {
        position: fixed;
        inset: 0;
        z-index: 999999;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
        backdrop-filter: blur(2px);
    }

    .country-modal-box {
        background: #ffffff;
        border-radius: 8px;
        width: 100%;
        max-width: 520px;
        max-height: 90vh;
        overflow-y: auto;
        padding: 28px 24px;
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        animation: modalFadeIn 0.2s ease-out;
    }

    @keyframes modalFadeIn {
        from { opacity: 0; transform: scale(0.96) translateY(-10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    .country-modal-close {
        position: absolute;
        top: 14px;
        right: 18px;
        background: transparent;
        border: none;
        font-size: 26px;
        line-height: 1;
        color: #888888;
        cursor: pointer;
    }

    .country-modal-close:hover {
        color: #000000;
    }

    .modal-title {
        font-family: 'Poppins', sans-serif !important;
        font-size: 22px !important;
        font-weight: 700 !important;
        color: #64141f !important;
        margin: 0 0 4px 0 !important;
        text-align: center;
        text-transform: none !important;
    }

    .modal-sub {
        font-size: 13.5px;
        color: #64748b;
        text-align: center;
        margin-bottom: 20px;
    }

    .btn-modal-send {
        background-color: #64141f;
        color: #ffffff;
        border: none;
        border-radius: 50px;
        padding: 10px 36px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-modal-send:hover {
        background-color: #8b1c2b;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .country-products-grid {
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 22px 14px !important;
        }
    }

    @media (max-width: 900px) {
        .country-intro-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }
        .country-sidebar-card {
            margin-top: 10px;
        }
        .country-destinations-row {
            grid-template-columns: 1fr !important;
        }
        .country-industries-grid {
            grid-template-columns: repeat(3, 1fr) !important;
        }
    }

    @media (max-width: 600px) {
        .country-title-row {
            flex-direction: column;
            align-items: stretch;
        }
        .btn-get-quote {
            text-align: center;
        }
        .country-products-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 16px 10px !important;
        }
        .country-industries-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
</style>

<div class="container">
    <article class="country-page-wrap">
        <!-- Breadcrumbs matching Astra -->
        <div class="country-top-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            @if(!empty($parentSection))
                <span class="separator">/</span>
                <a href="{{ url('/' . $parentSection['slug']) }}">{{ $parentSection['title'] }}</a>
            @endif
            <span class="separator">/</span>
            <span>{{ $page->title }}</span>
        </div>

        <!-- 2-Column Top Section matching sdinternational.com/dyes/dyes-supplier-in-argentina/ -->
        <div class="country-intro-grid">
            <!-- Left Main Column -->
            <div class="country-intro-main">
                <div class="country-title-row">
                    <div class="country-title-col">
                        <h1 class="country-page-title">{{ $page->title }}</h1>
                        <p class="country-page-subtitle">Superior purity {{ $page->title }} by S D International</p>
                    </div>
                    <div class="country-quote-btn-col">
                        <button type="button" class="btn-get-quote" onclick="openCountryQuoteModal()">Get Best Quote</button>
                    </div>
                </div>

                @if(!empty($introHtml))
                    <div class="country-intro-body">
                        {!! $introHtml !!}
                    </div>
                @endif
            </div>

            <!-- Right Sidebar Column: PRODUCTS RANGE -->
            @if(!empty($sidebarData['items']))
            <aside class="country-intro-sidebar">
                <div class="country-sidebar-card">
                    <h4 class="country-sidebar-title">PRODUCTS RANGE</h4>
                    <h5 class="country-sidebar-cat">
                        <a href="{{ $sidebarData['category_url'] ?? '#' }}">{{ $sidebarData['category'] ?? 'DYES' }}</a>
                    </h5>
                    <ul class="country-sidebar-menu">
                        @foreach($sidebarData['items'] as $item)
                            <li>
                                <a href="{{ $item['url'] }}">
                                    <span class="country-sidebar-arrow">&rsaquo;</span>
                                    <span>{{ $item['title'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
            @endif
        </div>

        <!-- Main Product Content -->
        {!! $renderedContent !!}

        <!-- Global Export Markets & Destinations Block -->
        @if(!empty($siblingPages) && count($siblingPages) > 0)
        <div class="country-siblings-block">
            <h3 class="country-siblings-title">Global Export Markets & Destinations</h3>
            <p style="font-size: 13.5px; color: #64748b; margin-bottom: 14px;">SD International supplies and exports premium industrial dyes, pigments, and colorants to manufacturers and industrial facilities across over 50 countries worldwide:</p>
            <div class="country-siblings-grid">
                @foreach($siblingPages as $sib)
                    <a href="{{ url($sib['url']) }}" class="{{ $sib['is_current'] ? 'active' : '' }}">
                        {{ $sib['country_name'] }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </article>
</div>

<!-- Modal Popup for Get Best Quote -->
<div id="countryQuoteModal" class="country-modal-overlay" style="display: none;">
    <div class="country-modal-box">
        <button type="button" class="country-modal-close" onclick="closeCountryQuoteModal()">&times;</button>
        <div class="country-modal-header">
            <h3 class="modal-title">Get Best Quote</h3>
            <p class="modal-sub">Fill out the form and we’ll be in touch as soon as possible.</p>
        </div>
        <form action="{{ route('inquiries.store') }}" method="POST" class="country-modal-form">
            @csrf
            <input type="hidden" name="inquiry_type" value="quote">
            <input type="hidden" name="source" value="{{ $page->title }}">
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="tel" name="phone" class="form-control" placeholder="Phone No">
            </div>
            <div class="mb-3">
                <input type="text" name="country" class="form-control" placeholder="Country" value="Argentina">
            </div>
            <div class="mb-3">
                <input type="text" name="city" class="form-control" placeholder="City">
            </div>
            <div class="mb-3">
                <input type="text" name="company" class="form-control" placeholder="Company Name">
            </div>
            <div class="mb-3">
                <textarea name="message" class="form-control" rows="3" placeholder="Whether you have a question about Color, Pricing, Custom color, or anything else, our team is ready to answer all your questions"></textarea>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn-modal-send">Send</button>
            </div>
        </form>
    </div>
</div>

<script>
function openCountryQuoteModal() {
    var modal = document.getElementById('countryQuoteModal');
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeCountryQuoteModal() {
    var modal = document.getElementById('countryQuoteModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

document.addEventListener('click', function(e) {
    var modal = document.getElementById('countryQuoteModal');
    if (modal && e.target === modal) {
        closeCountryQuoteModal();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCountryQuoteModal();
    }
});
</script>
@endsection
