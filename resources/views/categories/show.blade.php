@extends('layouts.app')

@section('content')
<style>
    /* ==========================================================================
       SD International - Product Archive / Category Template (Elementor 2994)
       Replicated 1:1 from https://sdinternational.com/dyes/
       ========================================================================== */

    /* Universal container matching live Astra full-width layout */
    .archive-page-wrap {
        background: #ffffff;
        color: #000000;
        font-family: 'Poppins', sans-serif;
        width: 100%;
        overflow-x: hidden;
    }

    .archive-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0 30px;
        box-sizing: border-box;
    }

    /* 1. Breadcrumb Bar (Elementor Section 7b8eef9) */
    .category-breadcrumb-section {
        background-color: #F6F6F6;
        padding: 12px 0;
        border-bottom: 1px solid #eef2f6;
    }

    .woocommerce-breadcrumb {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #000000;
        margin: 0;
    }

    .woocommerce-breadcrumb a {
        color: #000000;
        text-decoration: none;
        transition: color 0.2s;
    }

    .woocommerce-breadcrumb a:hover {
        color: #73001B;
    }

    .woocommerce-breadcrumb .delimiter {
        margin: 0 6px;
        color: #64748b;
    }

    /* 2. Main Archive Section (Elementor Section 2af8bd7) */
    .archive-main-section {
        padding: 25px 0 40px;
    }

    .archive-main-grid {
        display: grid;
        grid-template-columns: minmax(0, 80%) minmax(0, 20%);
        gap: 25px;
        align-items: start;
    }

    /* Left Column Content */
    .archive-title-heading {
        color: #000000;
        font-family: 'Teko', 'Montserrat', sans-serif;
        font-size: 38px;
        font-weight: 600;
        text-transform: capitalize;
        line-height: 1.1;
        margin: 0 0 4px 0;
        letter-spacing: 0.5px;
    }

    .archive-subtitle-italic {
        color: #73001B;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        font-style: italic;
        margin: 0 0 22px 0;
    }

    /* Term Description & Inner 2-Col Banner (Elementor Inner Section 13303) */
    .term-description-box {
        color: #000000;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        line-height: 1.7;
    }

    .category-inner-banner-row {
        display: grid;
        grid-template-columns: minmax(0, 42%) minmax(0, 58%);
        gap: 25px;
        margin-bottom: 24px;
        align-items: start;
    }

    .term-description-box .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .term-description-box .col-md-5 {
        flex: 0 0 42%;
        max-width: 42%;
        padding-right: 15px;
        padding-left: 15px;
        box-sizing: border-box;
    }

    .term-description-box .col-md-7 {
        flex: 0 0 58%;
        max-width: 58%;
        padding-right: 15px;
        padding-left: 15px;
        box-sizing: border-box;
    }

    .category-featured-card {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .category-featured-img {
        width: 100%;
        max-width: 100%;
        height: auto;
        aspect-ratio: 600 / 400;
        border-radius: 20px 0px 20px 0px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        object-fit: cover;
        display: block;
    }

    .btn-category-enquiry {
        width: 100%;
        max-width: 100%;
        margin-top: 14px;
        padding: 11px 18px;
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: #ffffff;
        background-color: transparent;
        background-image: linear-gradient(180deg, #951634 0%, #73001B 100%);
        border: none;
        border-radius: 3px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: opacity 0.2s, transform 0.2s;
        box-shadow: 0 2px 6px rgba(115, 0, 27, 0.25);
    }

    .btn-category-enquiry:hover {
        opacity: 0.95;
        transform: translateY(-1px);
        color: #ffffff;
    }

    .category-intro-text {
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        line-height: 1.7;
        color: #1e293b;
    }

    .term-description-box h2 {
        font-family: 'Montserrat', sans-serif;
        font-size: 22px;
        font-weight: 700;
        color: #1e293b;
        margin: 24px 0 10px 0;
    }

    .term-description-box h3 {
        font-family: 'Montserrat', sans-serif;
        font-size: 19px;
        font-weight: 700;
        color: #1e293b;
        margin: 22px 0 10px 0;
    }

    .term-description-box p {
        margin: 0 0 14px 0;
        line-height: 1.7;
    }

    .term-description-box ul {
        margin: 0 0 18px 24px;
        padding: 0;
    }

    .term-description-box ul li {
        margin-bottom: 6px;
        line-height: 1.6;
        color: #334155;
    }

    /* Right Column: Products Range Bellows Accordion */
    .bellows-sidebar-header {
        background-image: linear-gradient(180deg, #941533 0%, #74001B 100%);
        color: #ffffff;
        padding: 12px 18px;
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 4px 4px 0 0;
        letter-spacing: 0.5px;
    }

    .bellows-sidebar-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 4px 4px;
        margin-bottom: 25px;
        overflow: hidden;
    }

    .bellows-tree-root {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .bellows-tree-item {
        border-bottom: 1px solid #f1f5f9;
    }

    .bellows-tree-item:last-child {
        border-bottom: none;
    }

    .bellows-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        cursor: pointer;
        background: #ffffff;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .bellows-header-row:hover {
        background: #fdf2f3;
        color: #73001B;
    }

    .bellows-header-row a {
        color: inherit;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
    }

    .bellows-toggle-indicator {
        font-size: 18px;
        font-weight: bold;
        line-height: 1;
        color: #64748b;
        user-select: none;
    }

    .bellows-sub-tree {
        list-style: none;
        margin: 0;
        padding: 6px 0 10px 0;
        background: #fcfcfd;
        border-top: 1px solid #f1f5f9;
    }

    .bellows-sub-tree li {
        margin: 0;
    }

    .bellows-sub-tree li a {
        display: block;
        padding: 6px 16px 6px 26px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: #475569;
        text-decoration: none;
        transition: color 0.15s, background 0.15s;
    }

    .bellows-sub-tree li a:hover {
        color: #73001B;
        background: #f8fafc;
    }

    .bellows-sub-tree li a.active {
        color: #73001B;
        font-weight: 600;
        background: #fdf2f3;
        border-left: 3px solid #73001B;
    }

    /* 3. Section 3: Browse Related Products / Subcategories (Elementor Section 65c54ca) */
    .archive-products-section {
        padding: 10px 0 40px;
        border-top: 1px solid #eef2f6;
    }

    .category-section-heading {
        color: #73001B;
        font-family: 'Teko', 'Montserrat', sans-serif;
        font-size: 29px;
        font-weight: 600;
        margin: 25px 0 20px 0;
        letter-spacing: 0.3px;
    }

    /* 6-Column Grid matching WooCommerce columns-6 */
    .products-grid-columns-6 {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 20px;
        list-style: none;
        padding: 0;
        margin: 0 0 35px 0;
    }

    /* Subcategory Card (ul.products li.product-category) */
    .product-category-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background: #ffffff;
        padding: 0 0 12px 0;
        border-radius: 6px;
        transition: transform 0.2s, box-shadow 0.2s;
        border: 1px solid transparent;
        overflow: hidden;
    }

    .product-category-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        border-color: #f1f5f9;
    }

    .product-category-card a {
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }

    .cat-thumb-box {
        width: 100%;
        height: auto;
        aspect-ratio: 1 / 1;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 0;
        background: #f8fafc;
    }

    .cat-thumb-box img {
        width: 100%;
        height: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }

    .product-category-card:hover .cat-thumb-box img {
        transform: scale(1.05);
    }

    .woocommerce-loop-category__title {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
        line-height: 1.35;
        text-align: center;
    }

    .woocommerce-loop-category__title mark.count {
        display: block;
        font-size: 12px;
        font-weight: 400;
        color: #64748b;
        background: transparent;
        margin-top: 4px;
    }

    /* Regular Product Card (li.product) */
    .product-item-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 0 0 14px 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
    }

    .product-item-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
    }

    .product-thumb-wrap {
        width: 100%;
        height: auto;
        aspect-ratio: 1 / 1;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f8fafc;
    }

    .product-thumb-wrap img {
        width: 100%;
        height: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        display: block;
        border-radius: 0;
    }

    .product-category-label {
        font-size: 11px;
        font-weight: 500;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
        display: block;
    }

    .product-title-link {
        text-decoration: none;
        color: inherit;
    }

    .product-loop-title {
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: #0f172a;
        margin: 0;
        line-height: 1.35;
        transition: color 0.15s;
    }

    .product-title-link:hover .product-loop-title {
        color: #73001B;
    }

    /* 4. Industries We Serve (Elementor Inner Sections 1986e67 & a33570f) */
    .industries-section {
        margin-top: 35px;
        padding-top: 25px;
        border-top: 1px solid #eef2f6;
    }

    .industries-grid-5 {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .industry-card-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .industry-card-item a {
        text-decoration: none;
        color: inherit;
        display: block;
        width: 100%;
    }

    .industry-image-wrap {
        width: 100%;
        overflow: hidden;
        border: 6px solid #FFFFFF;
        box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.5);
        margin-bottom: 8px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .industry-image-wrap:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
    }

    .industry-image-wrap img {
        width: 100%;
        height: 205px;
        aspect-ratio: 5 / 4;
        object-fit: cover;
        display: block;
    }

    .industry-title {
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
        text-align: center;
        line-height: 1.3;
        transition: color 0.2s;
    }

    .industry-card-item a:hover .industry-title {
        color: #73001B;
    }

    /* 5. Why SD International & Market Area (Elementor Section 9ca7d48) */
    .features-market-section {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #eef2f6;
    }

    .features-market-grid {
        display: grid;
        grid-template-columns: 64% 36%;
        gap: 25px;
    }

    .features-box-card, .market-box-card {
        padding: 16px 20px;
        border: 1px solid #ffffff;
        box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.5);
        background: #ffffff;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.65;
        color: #1e293b;
    }

    .features-box-card ul {
        margin: 0 0 0 20px;
        padding: 0;
    }

    .features-box-card ul li {
        margin-bottom: 8px;
        color: #334155;
    }

    .market-box-card p {
        margin: 0 0 14px 0;
        color: #334155;
    }

    .market-countries-list {
        line-height: 1.8;
        font-size: 14.5px;
    }

    /* 6. Disclaimer & SEO keywords block (Elementor Section d6733c9) */
    .seo-disclaimer-section {
        margin-top: 40px;
        padding: 25px 0 40px 0;
        border-top: 1px solid #eef2f6;
    }

    .seo-disclaimer-text {
        font-family: 'Poppins', sans-serif;
        font-size: 10px;
        font-weight: 400;
        line-height: 1.7;
        color: #64748b;
    }

    .seo-disclaimer-text p {
        margin: 0 0 10px 0;
    }

    /* Modal Dialog for Quotation / Enquiry */
    .quote-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 99999;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .quote-modal-card {
        background: #ffffff;
        width: 100%;
        max-width: 520px;
        border-radius: 8px;
        padding: 30px;
        position: relative;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        max-height: 90vh;
        overflow-y: auto;
    }

    .quote-modal-close {
        position: absolute;
        top: 15px;
        right: 18px;
        background: transparent;
        border: none;
        font-size: 26px;
        font-weight: bold;
        color: #64748b;
        cursor: pointer;
        line-height: 1;
    }

    .quote-modal-close:hover {
        color: #73001B;
    }

    .quote-form-group {
        margin-bottom: 14px;
        text-align: left;
    }

    .quote-form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 5px;
    }

    .quote-form-group input,
    .quote-form-group textarea {
        width: 100%;
        padding: 9px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        font-size: 14px;
        font-family: inherit;
        box-sizing: border-box;
    }

    .quote-form-group input:focus,
    .quote-form-group textarea:focus {
        outline: none;
        border-color: #73001B;
        box-shadow: 0 0 0 2px rgba(115, 0, 27, 0.12);
    }

    /* Responsive Queries */
    @media (max-width: 1024px) {
        .archive-main-grid {
            grid-template-columns: 1fr;
        }

        .products-grid-columns-6 {
            grid-template-columns: repeat(4, 1fr);
        }

        .industries-grid-5 {
            grid-template-columns: repeat(3, 1fr);
        }

        .features-market-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .archive-container {
            padding: 0 15px;
        }

        .products-grid-columns-6 {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .industries-grid-5 {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .category-inner-banner-row {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .category-featured-img,
        .btn-category-enquiry {
            max-width: 100%;
        }

        .archive-title-heading {
            font-size: 32px;
        }

        .category-section-heading {
            font-size: 24px;
        }
    }
</style>

<div class="archive-page-wrap">
    <!-- 1. Breadcrumb Bar -->
    <section class="category-breadcrumb-section">
        <div class="archive-container">
            <nav class="woocommerce-breadcrumb">
                @if(!empty($breadcrumbs))
                    @foreach($breadcrumbs as $title => $link)
                        @if(!$loop->last)
                            <a href="{{ $link }}">{{ $title }}</a>
                            <span class="delimiter">&#47;</span>
                        @else
                            <span>{{ $title }}</span>
                        @endif
                    @endforeach
                @else
                    <a href="{{ url('/') }}">Home</a>
                    @if($category->parent)
                        <span class="delimiter">&#47;</span>
                        <a href="{{ url('/' . $category->parent->slug) }}">{{ $category->parent->name }}</a>
                    @endif
                    <span class="delimiter">&#47;</span>
                    <span>{{ $category->name }}</span>
                @endif
            </nav>
        </div>
    </section>

    <!-- 2. Main Archive Section (2 Columns: Left 78%, Right 22%) -->
    <section class="archive-main-section">
        <div class="archive-container">
            <div class="archive-main-grid">
                <!-- Left Column: Title, Subtitle, Inner Banner, Rich Description -->
                <div class="archive-left-col">
                    <h1 class="archive-title-heading">{{ $category->name }}</h1>
                    <p class="archive-subtitle-italic">Superior purity {{ $category->name }} by S D International</p>

                    <div class="term-description-box">
                        @php
                            $desc = $category->description ?? '';
                            $hasColMd5 = str_contains($desc, 'col-md-5');
                        @endphp

                        @if($hasColMd5)
                            {{-- Inject the featured card into col-md-5 --}}
                            @php
                                $bannerReplacement = '<div class="col-md-5">
                                    <div class="category-featured-card">
                                        <img src="' . $category->featured_image_url . '" alt="' . e($category->name) . ' manufacturer, exporter, supplier in Mumbai- India" class="category-featured-img" onerror="this.onerror=null; this.src=\'' . ($category->slug === 'other-products' ? 'https://sdinternational.com/wp-content/uploads/2022/05/other-product.jpg' : 'https://sdinternational.com/wp-content/uploads/2022/04/' . $category->slug . '.jpg') . '\';">
                                        <button type="button" class="btn-category-enquiry" onclick="openCategoryQuoteModal(\'' . addslashes($category->name) . '\', \'' . $category->slug . '\')">
                                            Enquiry Now
                                        </button>
                                    </div>
                                </div>';
                                $renderedDesc = preg_replace('/<div class="col-md-5">\s*<\/div>/i', $bannerReplacement, $desc);
                            @endphp
                            {!! $renderedDesc !!}
                        @else
                            {{-- Standard fallback layout with banner on top left and text on right --}}
                            <div class="category-inner-banner-row">
                                <div class="category-featured-card">
                                    <img src="{{ $category->featured_image_url }}" alt="{{ $category->name }} manufacturer, exporter, supplier in Mumbai- India" class="category-featured-img" onerror="this.onerror=null; this.src='{{ $category->slug === 'other-products' ? 'https://sdinternational.com/wp-content/uploads/2022/05/other-product.jpg' : 'https://sdinternational.com/wp-content/uploads/2022/04/' . $category->slug . '.jpg' }}';">
                                    <button type="button" class="btn-category-enquiry" onclick="openCategoryQuoteModal('{{ addslashes($category->name) }}', '{{ $category->slug }}')">
                                        Enquiry Now
                                    </button>
                                </div>
                                <div class="category-intro-text">
                                    {!! $desc !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Column: Products Range Bellows Accordion -->
                <aside class="archive-right-sidebar">
                    <div class="bellows-sidebar-header">
                        Products Range
                    </div>
                    <div class="bellows-sidebar-card">
                        <ul class="bellows-tree-root">
                            <!-- DYES -->
                            <li class="bellows-tree-item">
                                <div class="bellows-header-row" onclick="toggleArchiveAccordion('cat-dyes')">
                                    <a href="{{ url('/dyes') }}">DYES</a>
                                    <span id="indicator-cat-dyes" class="bellows-toggle-indicator">{{ ($category->slug === 'dyes' || ($category->parent && $category->parent->slug === 'dyes') || in_array($category->slug, ['basic-dyes', 'disperse-dyes', 'solvent-dyes', 'vat-dyes', 'acid-dyes', 'cationic-dyes', 'direct-dyes', 'reactive-dyes', 'metal-complex-solvent-dyes', 'powder-solvent-dyes'])) ? '−' : '+' }}</span>
                                </div>
                                <ul id="cat-dyes" class="bellows-sub-tree" style="display: {{ ($category->slug === 'dyes' || ($category->parent && $category->parent->slug === 'dyes') || in_array($category->slug, ['basic-dyes', 'disperse-dyes', 'solvent-dyes', 'vat-dyes', 'acid-dyes', 'cationic-dyes', 'direct-dyes', 'reactive-dyes', 'metal-complex-solvent-dyes', 'powder-solvent-dyes'])) ? 'block' : 'none' }};">
                                    <li><a href="{{ url('/basic-dyes') }}" class="{{ $category->slug === 'basic-dyes' ? 'active' : '' }}">Basic Dyes</a></li>
                                    <li><a href="{{ url('/disperse-dyes') }}" class="{{ $category->slug === 'disperse-dyes' ? 'active' : '' }}">Disperse Dyes</a></li>
                                    <li><a href="{{ url('/solvent-dyes') }}" class="{{ $category->slug === 'solvent-dyes' ? 'active' : '' }}">Solvent Dyes</a></li>
                                    <li><a href="{{ url('/vat-dyes') }}" class="{{ $category->slug === 'vat-dyes' ? 'active' : '' }}">Vat Dyes</a></li>
                                    <li><a href="{{ url('/acid-dyes') }}" class="{{ $category->slug === 'acid-dyes' ? 'active' : '' }}">Acid Dyes</a></li>
                                    <li><a href="{{ url('/cationic-dyes') }}" class="{{ $category->slug === 'cationic-dyes' ? 'active' : '' }}">Cationic Dyes</a></li>
                                    <li><a href="{{ url('/direct-dyes') }}" class="{{ $category->slug === 'direct-dyes' ? 'active' : '' }}">Direct Dyes</a></li>
                                    <li><a href="{{ url('/reactive-dyes') }}" class="{{ $category->slug === 'reactive-dyes' ? 'active' : '' }}">Reactive Dyes</a></li>
                                    <li><a href="{{ url('/metal-complex-solvent-dyes') }}" class="{{ $category->slug === 'metal-complex-solvent-dyes' ? 'active' : '' }}">Metal Complex Solvent Dyes</a></li>
                                    <li><a href="{{ url('/powder-solvent-dyes') }}" class="{{ $category->slug === 'powder-solvent-dyes' ? 'active' : '' }}">Powder Solvent Dyes</a></li>
                                </ul>
                            </li>

                            <!-- F D & C COLOURS -->
                            <li class="bellows-tree-item">
                                <div class="bellows-header-row" onclick="toggleArchiveAccordion('cat-fdc')">
                                    <a href="{{ url('/fd-c-colours') }}">F D &amp; C COLOURS</a>
                                    <span id="indicator-cat-fdc" class="bellows-toggle-indicator">{{ ($category->slug === 'fd-c-colours' || str_contains($category->slug, 'f-d-c') || str_contains($category->slug, 'colours')) ? '−' : '+' }}</span>
                                </div>
                                <ul id="cat-fdc" class="bellows-sub-tree" style="display: {{ ($category->slug === 'fd-c-colours' || str_contains($category->slug, 'f-d-c') || str_contains($category->slug, 'colours')) ? 'block' : 'none' }};">
                                    <li><a href="{{ url('/tartrazine-dyes') }}" class="{{ $category->slug === 'tartrazine-dyes' ? 'active' : '' }}">Tartrazine Dyes</a></li>
                                    <li><a href="{{ url('/sunset-yellow-f-d-c-colours') }}" class="{{ $category->slug === 'sunset-yellow-f-d-c-colours' ? 'active' : '' }}">Sunset Yellow F D &amp; C Colours</a></li>
                                    <li><a href="{{ url('/carmoisine-f-d-c-colours') }}" class="{{ $category->slug === 'carmoisine-f-d-c-colours' ? 'active' : '' }}">Carmoisine F D &amp; C Colours</a></li>
                                    <li><a href="{{ url('/ponceau-4r-f-d-c-colours') }}" class="{{ $category->slug === 'ponceau-4r-f-d-c-colours' ? 'active' : '' }}">Ponceau 4R F D &amp; C Colours</a></li>
                                    <li><a href="{{ url('/amaranth-f-d-c-colours') }}" class="{{ $category->slug === 'amaranth-f-d-c-colours' ? 'active' : '' }}">Amaranth F D &amp; C Colours</a></li>
                                    <li><a href="{{ url('/altura-red-f-d-c-colours') }}" class="{{ $category->slug === 'altura-red-f-d-c-colours' ? 'active' : '' }}">Allura Red F D &amp; C Colours</a></li>
                                    <li><a href="{{ url('/brilliant-blue-fcf-f-d-c-colours') }}" class="{{ $category->slug === 'brilliant-blue-fcf-f-d-c-colours' ? 'active' : '' }}">Brilliant Blue Fcf F D &amp; C Colours</a></li>
                                    <li><a href="{{ url('/indigo-carmine-f-d-c-colours') }}" class="{{ $category->slug === 'indigo-carmine-f-d-c-colours' ? 'active' : '' }}">Indigo Carmine F D &amp; C Colours</a></li>
                                </ul>
                            </li>

                            <!-- PIGMENTS -->
                            <li class="bellows-tree-item">
                                <div class="bellows-header-row" onclick="toggleArchiveAccordion('cat-pigments')">
                                    <a href="{{ url('/pigments') }}">PIGMENTS</a>
                                    <span id="indicator-cat-pigments" class="bellows-toggle-indicator">{{ ($category->slug === 'pigments' || ($category->parent && $category->parent->slug === 'pigments') || str_contains($category->slug, 'pigment')) ? '−' : '+' }}</span>
                                </div>
                                <ul id="cat-pigments" class="bellows-sub-tree" style="display: {{ ($category->slug === 'pigments' || ($category->parent && $category->parent->slug === 'pigments') || str_contains($category->slug, 'pigment')) ? 'block' : 'none' }};">
                                    <li><a href="{{ url('/organic-pigments') }}" class="{{ $category->slug === 'organic-pigments' ? 'active' : '' }}">Organic Pigments</a></li>
                                    <li><a href="{{ url('/high-performance-pigments') }}" class="{{ $category->slug === 'high-performance-pigments' ? 'active' : '' }}">High Performance Pigments</a></li>
                                    <li><a href="{{ url('/fluorescent-pigments') }}" class="{{ $category->slug === 'fluorescent-pigments' ? 'active' : '' }}">Fluorescent Pigments</a></li>
                                    <li><a href="{{ url('/pu-foam-pigments') }}" class="{{ $category->slug === 'pu-foam-pigments' ? 'active' : '' }}">Pu Foam Pigments</a></li>
                                    <li><a href="{{ url('/ultra-marine-pigments') }}" class="{{ $category->slug === 'ultra-marine-pigments' ? 'active' : '' }}">Ultramarine Pigments</a></li>
                                </ul>
                            </li>

                            <!-- OTHER PRODUCTS -->
                            <li class="bellows-tree-item">
                                <div class="bellows-header-row" onclick="toggleArchiveAccordion('cat-other')">
                                    <a href="{{ url('/other-products') }}">OTHER PRODUCTS</a>
                                    <span id="indicator-cat-other" class="bellows-toggle-indicator">{{ ($category->slug === 'other-products' || ($category->parent && $category->parent->slug === 'other-products') || in_array($category->slug, ['naphthols', 'fast-colour-bases', 'fast-colour-salts', 'pyrazolone-intermediates', 'auxiliaries'])) ? '−' : '+' }}</span>
                                </div>
                                <ul id="cat-other" class="bellows-sub-tree" style="display: {{ ($category->slug === 'other-products' || ($category->parent && $category->parent->slug === 'other-products') || in_array($category->slug, ['naphthols', 'fast-colour-bases', 'fast-colour-salts', 'pyrazolone-intermediates', 'auxiliaries'])) ? 'block' : 'none' }};">
                                    <li><a href="{{ url('/naphthols') }}" class="{{ $category->slug === 'naphthols' ? 'active' : '' }}">Naphthols</a></li>
                                    <li><a href="{{ url('/fast-colour-bases') }}" class="{{ $category->slug === 'fast-colour-bases' ? 'active' : '' }}">Fast Colour Bases</a></li>
                                    <li><a href="{{ url('/fast-colour-salts') }}" class="{{ $category->slug === 'fast-colour-salts' ? 'active' : '' }}">Fast Colour Salts</a></li>
                                    <li><a href="{{ url('/pyrazolone-intermediates') }}" class="{{ $category->slug === 'pyrazolone-intermediates' ? 'active' : '' }}">Pyrazolone Intermediates</a></li>
                                    <li><a href="{{ url('/auxiliaries') }}" class="{{ $category->slug === 'auxiliaries' ? 'active' : '' }}">Auxiliaries</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <!-- 3. Section 3: Browse Related Products / Subcategories (Elementor Section 65c54ca) -->
    <section class="archive-products-section">
        <div class="archive-container">
            <h2 class="category-section-heading">Browse related {{ $category->name }} chemical products offered by SD International</h2>

            {{-- 3A. Subcategories Grid (shown when category has children, matching dyes_live.html) --}}
            @if($childCategories->isNotEmpty())
                <ul class="products-grid-columns-6">
                    @foreach($childCategories as $child)
                        <li class="product-category-card">
                            <a href="{{ url('/' . $child->slug) }}">
                                <div class="cat-thumb-box">
                                    <img src="{{ $child->thumbnail_url }}" alt="{{ $child->name }}" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/2022/04/{{ $child->slug }}-120x120.jpg';">
                                </div>
                                <h2 class="woocommerce-loop-category__title">
                                    {{ $child->name }}
                                    <mark class="count">{{ $child->products_count }} Products</mark>
                                </h2>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif

            {{-- 3B. Products Grid (shown when subcategories are empty or on product loop) --}}
            @if($products->isNotEmpty() && $childCategories->isEmpty())
                <ul class="products-grid-columns-6">
                    @foreach($products as $product)
                        <li class="product-item-card">
                            <div class="product-thumb-wrap">
                                <a href="{{ $product->url }}">
                                    <img src="{{ $product->thumbnail_url }}" alt="{{ $product->title }}" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/woocommerce-placeholder-120x120.png';">
                                </a>
                            </div>
                            <span class="product-category-label">{{ $category->name }}</span>
                            <a href="{{ $product->url }}" class="product-title-link">
                                <h2 class="product-loop-title">{{ $product->title }}</h2>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="d-flex justify-content-center my-4">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @endif

            <!-- 4. Industries We Serve (Elementor Inner Sections 1986e67 & a33570f) -->
            <div class="industries-section">
                <h4 class="category-section-heading">Industries We Serve</h4>
                <div class="industries-grid-5">
                    <!-- 1. Plastic & Polymers -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/plastic-polymers') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/applications/plastics.jpg') }}" alt="Plastic & Polymers" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/plastics.jpg';">
                            </div>
                            <h5 class="industry-title">Plastic &amp; Polymers</h5>
                        </a>
                    </div>
                    <!-- 2. Textiles -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/textiles') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/applications/textile.jpg') }}" alt="Textiles" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/textile.jpg';">
                            </div>
                            <h5 class="industry-title">Textiles</h5>
                        </a>
                    </div>
                    <!-- 3. Leather -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/leather') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/applications/lather.jpg') }}" alt="Leather" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/lather.jpg';">
                            </div>
                            <h5 class="industry-title">Leather</h5>
                        </a>
                    </div>
                    <!-- 4. Petroleum & Lubricants -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/petroleum-lubricants') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/applications/petro.jpg') }}" alt="Petroleum & Lubricants" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/petro.jpg';">
                            </div>
                            <h5 class="industry-title">Petroleum &amp; Lubricants</h5>
                        </a>
                    </div>
                    <!-- 5. Paper & Pulp -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/paper-pulp') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/applications/papper.jpg') }}" alt="Paper & Pulp" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/papper.jpg';">
                            </div>
                            <h5 class="industry-title">Paper &amp; Pulp</h5>
                        </a>
                    </div>
                    <!-- 6. Printing Inks -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/printing-inks') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/applications/ink.jpg') }}" alt="Printing Inks" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/ink.jpg';">
                            </div>
                            <h5 class="industry-title">Printing Inks</h5>
                        </a>
                    </div>
                    <!-- 7. Food Drug & Cosmetics -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/food-drug-cosmetics') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/applications/food_drug_cos.jpg') }}" alt="Food Drug & Cosmetics" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/food_drug_cos.jpg';">
                            </div>
                            <h5 class="industry-title">Food Drug &amp; Cosmetics</h5>
                        </a>
                    </div>
                    <!-- 8. Coatings -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/coating') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/applications/coatings.jpg') }}" alt="Coatings" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/coatings.jpg';">
                            </div>
                            <h5 class="industry-title">Coatings</h5>
                        </a>
                    </div>
                    <!-- 9. Wood Stains -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/wood-stains') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/applications/wood_stain.jpg') }}" alt="Wood Stains" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/wood_stain.jpg';">
                            </div>
                            <h5 class="industry-title">Wood Stains</h5>
                        </a>
                    </div>
                    <!-- 10. Smoke Dyes -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/smoke-dyes') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/applications/smoke.jpg') }}" alt="Smoke Dyes" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/applications/smoke.jpg';">
                            </div>
                            <h5 class="industry-title">Smoke Dyes</h5>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 5. Why SD International & Market Area (Elementor Section 9ca7d48) -->
            <div class="features-market-section">
                <div class="features-market-grid">
                    <!-- Left: Why SD International -->
                    <div class="features-col">
                        <h4 class="category-section-heading" style="margin-top: 0;">Why SD International</h4>
                        <div class="features-box-card">
                            <ul>
                                <li>More than 50 years of rich industry experience.</li>
                                <li>Wide product range of high purity chemicals.</li>
                                <li>Leading exporter of dyeing and auxiliaries’ chemicals.</li>
                                <li>Focus is to create trustworthy and responsive relationships.</li>
                                <li>Reliable and dependable service.</li>
                                <li>Great Value, quality products, and huge range in stocks.</li>
                                <li>Chemicals and services we provide achieve consistent standards and exceed your expectations.</li>
                                <li>Strong logistics support with an extensive network of worldwide agents to make deliveries safe and on time.</li>
                                <li>Continuous development through research &amp; development.</li>
                                <li>Customer service is an integral part of our business.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Right: Market Area of SD International -->
                    <div class="market-col">
                        <h4 class="category-section-heading" style="margin-top: 0;">Market Area of SD International</h4>
                        <div class="market-box-card">
                            <p class="market-countries-list">
                                China | Turkey | USA | Germany | Brazil | UAE | Bangladesh | Egypt | Gambia | Ghana | Guinea | Conakry | Honduras | Indonesia | Israel | Italy | Japan | Mali | Mauritania | Mexico | Myanmar | Netherlands | Poland | Peru | Singapore | South Korea | Taiwan | Uganda | UK | Vietnam | Argentina | Malaysia | Thailand | Iran | Spain | Kenya
                            </p>
                            <p style="margin-bottom: 0;">
                                Thank you for visiting <strong>SD International’s</strong> website. Do you have any questions or Need any help with Our products and their applications to your requirements? Contact Us at <strong>+91 99206 69561</strong> or Enquiry Form.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. Disclaimer & SEO keywords block (Elementor Section d6733c9) -->
            <div class="seo-disclaimer-section">
                <div class="seo-disclaimer-text">
                    <p>Manufacturer, Supplier, Importer, Exporter, Dealer, Distributor &amp; Service Provider of Industrial Chemicals, Pharma Excipients, Pharma Raw material importer, Pharmaceutical, Active Pharmaceutical Ingredients, Bulk Drugs, Industrial Acid &amp; Salts, Agriculture Chemicals, Food chemicals, Phase Transfer Catalyst, Quats, Agriculture Chemicals, Fine Chemicals, Epoxy Coating chemicals, Construction Chemicals, Cosmetic Chemicals, Bulk Drugs, Oil field chemicals, Phase Transfer Catalyst, Water Treatment Chemicals, Swimming Pool Chemicals, Chlorinated Intermediates, Cosmetic Chemicals, Gujarat, India. Top chemicals &amp; pharmaceutical company in India. Industrial Chemicals, Surplus Chemicals, Intermediates in Vadodara, Industrial Acid, Specialty Chemicals, Pharmaceutical Chemicals, Active Pharma Ingredients, By-product/Waste Grade Chemicals Buyer &amp; Seller in India, Best &amp; Contract Manufacturer of Pharmaceuticals &amp; Chemicals, Top Chemical &amp; Pharma companies in India, Pharma Impurities for formulation manufacturer &amp; pharma companies, Chlorine Chemicals, Importer of Industrial &amp; Pharma Chemicals in India, ETP Chemicals, STP Chemicals, Buyer &amp; Seller Used Machinery for Pharma &amp; Chemicals Industries in India, Pharma Raw Materials, Surplus/Non-Moving Chemicals buyer &amp; Seller in India, Solvents (Distilled, Recovered &amp; Pure), Quats &amp; Phase transfer catalyst, Ashland pharma excipients dealer &amp; distributor in India, Detergent Chemicals, Detergent Raw materials, BASF Products, oil &amp; gas chemicals, Biocides &amp; Hygiene chemicals, hand sanitizer, disinfection &amp; sanitation spray (corona-covid virus spray), Pharmaceutical sanitization, lubrication additives.</p>
                    <p><strong>Note :</strong> Please note that the information on this document is for illustration purposes only as information may vary with individual chemical compounds and their purity, concentration and applications subjects and therefore cannot be guaranteed as accurate. &copy; Copyright 2022 &copy; <strong>SD International</strong>. All Rights Reserved (Terms of Use). Recreation of any materials from the site is strictly prohibited without permission. SD International’s products are sold exclusively through SD International’s website. Use Terms | Privacy. Please contact us to discuss precise product specifications and requirements and obtain advice on which products are required to suit your exact application needs <strong>info@sdinternational.com</strong></p>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Dialog for Quotation / Enquiry -->
<div id="categoryQuoteModal" class="quote-modal-overlay" onclick="closeCategoryQuoteModalOnBackdrop(event)">
    <div class="quote-modal-card">
        <button type="button" class="quote-modal-close" onclick="closeCategoryQuoteModal()">&times;</button>
        <h3 style="font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: 700; color: #73001B; margin: 0 0 6px 0;">Request Product Quotation</h3>
        <p style="font-size: 13.5px; color: #666666; margin: 0 0 20px 0;">Submit your inquiry and our commercial sales desk will respond within 24 hours.</p>

        <form id="categoryQuoteForm" onsubmit="submitCategoryQuote(event)">
            @csrf
            <input type="hidden" id="modalCategoryName" name="product_name" value="{{ $category->name }}">
            <input type="hidden" id="modalCategorySlug" name="product_slug" value="{{ $category->slug }}">

            <div class="quote-form-group">
                <label>Category / Product</label>
                <input type="text" id="displayCategoryName" value="{{ $category->name }}" disabled style="background: #f1f5f9; font-weight: 600;">
            </div>

            <div class="quote-form-group">
                <label for="catQuoteName">Full Name *</label>
                <input type="text" id="catQuoteName" name="name" required placeholder="Your name">
            </div>

            <div class="quote-form-group">
                <label for="catQuoteEmail">Business Email *</label>
                <input type="email" id="catQuoteEmail" name="email" required placeholder="name@company.com">
            </div>

            <div class="quote-form-group">
                <label for="catQuotePhone">Phone / WhatsApp Number *</label>
                <input type="tel" id="catQuotePhone" name="phone" required placeholder="+91 99206 69561">
            </div>

            <div class="quote-form-group">
                <label for="catQuoteQuantity">Required Quantity (Kg / Tons)</label>
                <input type="text" id="catQuoteQuantity" name="quantity" placeholder="e.g. 500 Kg, 2 MT">
            </div>

            <div class="quote-form-group">
                <label for="catQuoteMessage">Specifications / Application Notes</label>
                <textarea id="catQuoteMessage" name="message" rows="3" placeholder="Please mention destination port, grade requirements, or target delivery date."></textarea>
            </div>

            <div id="catQuoteFormStatus" style="display: none; padding: 10px; margin-bottom: 12px; font-size: 13.5px; border-radius: 4px;"></div>

            <button type="submit" id="btnSubmitCatQuote" class="btn-category-enquiry" style="width: 100%; max-width: 100%; margin-top: 5px;">
                Send Inquiry Now
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Accordion Toggle for Bellows Sidebar
    function toggleArchiveAccordion(id) {
        const el = document.getElementById(id);
        const indicator = document.getElementById('indicator-' + id);
        if (!el) return;
        if (el.style.display === 'none' || el.style.display === '') {
            el.style.display = 'block';
            if (indicator) indicator.textContent = '−';
        } else {
            el.style.display = 'none';
            if (indicator) indicator.textContent = '+';
        }
    }

    // Modal Handlers
    function openCategoryQuoteModal(categoryTitle, categorySlug) {
        const modal = document.getElementById('categoryQuoteModal');
        const modalName = document.getElementById('modalCategoryName');
        const modalSlug = document.getElementById('modalCategorySlug');
        const displayName = document.getElementById('displayCategoryName');

        if (categoryTitle) {
            if (modalName) modalName.value = categoryTitle;
            if (displayName) displayName.value = categoryTitle;
        }
        if (categorySlug && modalSlug) {
            modalSlug.value = categorySlug;
        }

        if (modal) modal.style.display = 'flex';
    }

    function closeCategoryQuoteModal() {
        const modal = document.getElementById('categoryQuoteModal');
        if (modal) modal.style.display = 'none';
    }

    function closeCategoryQuoteModalOnBackdrop(e) {
        if (e.target && e.target.id === 'categoryQuoteModal') {
            closeCategoryQuoteModal();
        }
    }

    // AJAX Form Submission
    async function submitCategoryQuote(e) {
        e.preventDefault();
        const form = document.getElementById('categoryQuoteForm');
        const statusBox = document.getElementById('catQuoteFormStatus');
        const submitBtn = document.getElementById('btnSubmitCatQuote');

        if (!form) return;

        const formData = new FormData(form);
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending Inquiry...';

        statusBox.style.display = 'block';
        statusBox.style.background = '#eff6ff';
        statusBox.style.color = '#1e40af';
        statusBox.textContent = 'Submitting your inquiry, please wait...';

        try {
            const response = await fetch('{{ route("inquiries.store") }}', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
                statusBox.style.background = '#dcfce7';
                statusBox.style.color = '#166534';
                statusBox.textContent = data.message || 'Thank you! Your quotation request has been sent successfully.';
                form.reset();
                setTimeout(() => {
                    closeCategoryQuoteModal();
                    statusBox.style.display = 'none';
                }, 3500);
            } else {
                statusBox.style.background = '#fee2e2';
                statusBox.style.color = '#991b1b';
                statusBox.textContent = data.message || 'Submission failed. Please check the fields and try again.';
            }
        } catch (err) {
            statusBox.style.background = '#fee2e2';
            statusBox.style.color = '#991b1b';
            statusBox.textContent = 'Network error. Please try again or reach out to us at +91 99206 69561.';
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Send Inquiry Now';
        }
    }
</script>
@endpush
