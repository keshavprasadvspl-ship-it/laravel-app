@extends('layouts.app')

@section('content')
<style>
    /* ==========================================================================
       SD International - Country Landing Page Template
       Replicating Astra / Elementor Country Exports (e.g. /dyes/dyes-supplier-in-bangladesh)
       ========================================================================== */

    .country-hero-section {
        background: linear-gradient(135deg, #fdfbf7 0%, #f6f0e6 100%);
        border-bottom: 1px solid #ebdccb;
        padding: 38px 0 28px;
        margin-bottom: 30px;
    }

    .country-hero-title {
        font-family: 'Teko', 'Montserrat', sans-serif;
        font-size: 38px;
        font-weight: 600;
        color: #73001B;
        text-transform: capitalize;
        letter-spacing: 0.5px;
        margin: 0 0 8px;
        line-height: 1.15;
    }

    .country-hero-subtitle {
        font-family: 'Poppins', sans-serif;
        font-size: 14.5px;
        color: #555555;
        margin: 0;
    }

    .country-hero-breadcrumb {
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        color: #64748b;
        margin-top: 12px;
    }

    .country-hero-breadcrumb a {
        color: #73001B;
        text-decoration: none;
        font-weight: 500;
    }

    .country-hero-breadcrumb a:hover {
        text-decoration: underline;
    }

    .country-hero-breadcrumb .separator {
        margin: 0 8px;
        color: #94a3b8;
    }

    .country-page-wrap {
        max-width: 1240px;
        margin: 0 auto;
        padding: 10px 20px 70px;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        line-height: 1.75;
        color: #334155;
    }

    /* Headings */
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
    .country-page-wrap h5 { font-size: 19px; color: #1e293b; margin-top: 20px; }

    .country-page-wrap p {
        margin-bottom: 16px;
    }

    .country-page-wrap strong {
        color: #1e293b;
    }

    /* Product Sub-category lists */
    .country-page-wrap > ul:not(.country-products-grid) {
        margin: 10px 0 25px 20px;
        padding: 0;
    }

    .country-page-wrap > ul:not(.country-products-grid) li {
        margin-bottom: 6px;
    }

    .country-page-wrap > ul:not(.country-products-grid) a {
        color: #73001B;
        text-decoration: none;
        font-weight: 500;
    }

    .country-page-wrap > ul:not(.country-products-grid) a:hover {
        text-decoration: underline;
    }

    /* 6-Column Responsive Product Swatches Grid */
    .country-products-grid {
        display: grid !important;
        grid-template-columns: repeat(6, 1fr) !important;
        gap: 28px 18px !important;
        list-style: none !important;
        padding: 0 !important;
        margin: 25px 0 50px !important;
    }

    .country-products-grid > li {
        background: transparent !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        padding: 0 !important;
        margin: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        text-align: center !important;
        width: 100% !important;
        list-style: none !important;
    }

    .country-products-grid > li > a:first-child {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        margin-bottom: 10px !important;
        text-decoration: none !important;
    }

    .country-products-grid > li img {
        width: 120px !important;
        height: 120px !important;
        border-radius: 50% !important;
        object-fit: cover !important;
        background: #f8fafc !important;
        border: 1px solid #eef2f6 !important;
        display: block !important;
        margin: 0 auto !important;
        transition: transform 0.25s ease, box-shadow 0.25s ease !important;
    }

    .country-products-grid > li:hover img {
        transform: scale(1.06);
        box-shadow: 0 6px 18px rgba(115, 0, 27, 0.16);
    }

    .country-prod-cat {
        font-family: 'Open Sans', sans-serif !important;
        font-size: 11px !important;
        text-transform: uppercase !important;
        color: #7a7a7a !important;
        letter-spacing: 0.5px !important;
        display: block !important;
        margin-bottom: 4px !important;
        text-align: center !important;
    }

    .country-products-grid > li h2 {
        font-family: 'Open Sans', sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        color: #333333 !important;
        line-height: 1.35 !important;
        margin: 0 !important;
        text-transform: none !important;
        letter-spacing: normal !important;
        border: none !important;
        padding: 0 !important;
        text-align: center !important;
        transition: color 0.15s ease !important;
    }

    .country-products-grid > li a {
        text-decoration: none !important;
        color: inherit !important;
    }

    .country-products-grid > li a:hover h2 {
        color: #73001B !important;
    }

    /* Tables (Packaging / Payment) */
    .country-page-wrap table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0 35px;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        border: 1px solid #e2e8f0;
    }

    .country-page-wrap th,
    .country-page-wrap td {
        border: 1px solid #e2e8f0;
        padding: 12px 16px;
        font-size: 14.5px;
    }

    .country-page-wrap tr:nth-child(even) {
        background-color: #f8fafc;
    }

    .country-page-wrap td strong {
        color: #73001B;
    }

    /* Embedded Forms */
    .country-page-wrap section[data-element_type="section"] {
        background: #fdfbf7;
        border: 1px solid #ebdccb;
        border-radius: 8px;
        padding: 24px 28px;
        margin: 30px 0;
    }

    .country-page-wrap form p {
        margin-bottom: 12px;
    }

    .country-page-wrap input[type="text"],
    .country-page-wrap input[type="email"],
    .country-page-wrap input[type="tel"],
    .country-page-wrap textarea {
        width: 100%;
        max-width: 500px;
        padding: 10px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        font-family: inherit;
        font-size: 14px;
        box-sizing: border-box;
    }

    .country-page-wrap input[type="submit"] {
        background-color: #73001B;
        color: #ffffff;
        border: none;
        padding: 12px 32px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .country-page-wrap input[type="submit"]:hover {
        background-color: #961C0B;
    }

    /* Call & WhatsApp Buttons */
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
        margin: 10px 10px 10px 0 !important;
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

    /* Inter-country links block */
    .country-siblings-block {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 24px;
        margin-top: 40px;
    }

    .country-siblings-title {
        font-family: 'Teko', 'Montserrat', sans-serif;
        font-size: 26px;
        color: #73001B;
        font-weight: 600;
        margin: 0 0 14px;
        text-transform: uppercase;
    }

    .country-siblings-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px 12px;
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

    /* Responsive */
    @media (max-width: 1200px) {
        .country-products-grid {
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 22px 14px !important;
        }
    }

    @media (max-width: 768px) {
        .country-hero-title {
            font-size: 28px;
        }
        .country-products-grid {
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 16px 10px !important;
        }
        .country-page-wrap {
            padding-bottom: 40px;
        }
        .country-page-wrap table {
            display: block;
            overflow-x: auto;
        }
    }

    @media (max-width: 480px) {
        .country-products-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 14px 8px !important;
        }
        .country-products-grid > li img {
            width: 100px !important;
            height: 100px !important;
        }
    }
</style>

<div class="country-hero-section">
    <div class="container">
        <h1 class="country-hero-title">{{ $page->title }}</h1>
        <p class="country-hero-subtitle">Leading Manufacturer, Supplier & Global Exporter of High Grade Colorants and Industrial Chemicals</p>
        <div class="country-hero-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            @if(!empty($parentSection))
                <span class="separator">/</span>
                <a href="{{ url('/' . $parentSection['slug']) }}">{{ $parentSection['title'] }}</a>
            @endif
            <span class="separator">/</span>
            <span>{{ $page->title }}</span>
        </div>
    </div>
</div>

<div class="container">
    <article class="country-page-wrap">
        {!! $renderedContent !!}

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
@endsection
