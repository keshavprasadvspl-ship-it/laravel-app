@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/live/post-2994.css">
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
        max-width: 1867px;
        margin: 0 auto;
        padding: 0 10px;
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
        padding: 25px 0 20px;
    }

    .archive-main-grid {
        display: grid;
        grid-template-columns: minmax(0, 80%) minmax(0, 20%);
        gap: 20px;
        align-items: start;
    }

    /* Left Column Content */
    .archive-title-heading {
        color: #000000;
        font-family: 'Teko', sans-serif;
        font-size: 36px;
        font-weight: 600;
        text-transform: capitalize;
        line-height: 1.0;
        margin: 0 0 4px 0;
        letter-spacing: normal;
    }

    .archive-subtitle-italic {
        color: #73001B;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        font-style: italic;
        margin: 8px 0 22px 0;
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

    /* Term Description Headings and Properties - Matching SD International 1:1 */
    .term-description-box h2 {
        font-family: 'Teko', sans-serif !important;
        font-size: 29px !important;
        font-weight: 600 !important;
        color: #951634 !important;
        margin: 22px 0 10px 0 !important;
        text-transform: none !important;
        letter-spacing: normal !important;
        line-height: 1.3 !important;
    }

    .term-description-box h3 {
        font-family: 'Teko', sans-serif !important;
        font-size: 29px !important;
        font-weight: 600 !important;
        color: #951634 !important;
        margin: 18px 0 8px 0 !important;
        text-transform: none !important;
        letter-spacing: normal !important;
        line-height: 1.3 !important;
    }

    .term-description-box b,
    .term-description-box strong {
        font-weight: 700 !important;
        color: #000000 !important;
    }

    .category-properties-title,
    .term-description-box b.properties-heading,
    .term-description-box strong.properties-heading,
    .term-description-box p.category-properties-title {
        display: block !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        color: #000000 !important;
        margin: 18px 0 8px 0 !important;
    }

    .term-description-box p {
        margin: 0 0 14px 0;
        line-height: 1.7;
    }

    .term-description-box ul {
        margin: 0 0 22.5px 24px;
        padding: 0;
    }

    .term-description-box ul li {
        margin-bottom: 6px;
        line-height: 1.6;
        color: #334155;
    }

    /* Sidebar Header on Category Archives */
    .archive-right-sidebar .elementor-element-5dcd9cb {
        margin: 0 !important;
    }
    .archive-right-sidebar .elementor-element-5dcd9cb .elementor-heading-title {
        color: #FFFFFF !important;
        background-color: #73001B !important;
        background-image: linear-gradient(180deg, #941533 0%, #74001B 100%) !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 19px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        padding: 10px 15px !important;
        margin: 0 !important;
        border-radius: 4px 4px 0 0 !important;
        letter-spacing: 0.5px !important;
        line-height: 1.3 !important;
    }

    /* 3. Section 3: Browse Related Products / Subcategories (Elementor Section 65c54ca) */
    .archive-products-section {
        padding: 0 0 40px;
        border-top: none;
    }

    .archive-products-section .archive-container {
        width: 100% !important;
        max-width: 1867px !important;
        margin: 0 auto !important;
        padding: 0 10px !important;
        box-sizing: border-box !important;
    }

    .category-section-heading {
        color: #951634 !important;
        font-family: 'Teko', sans-serif !important;
        font-size: 29px !important;
        font-weight: 600 !important;
        line-height: 29px !important;
        margin: 0 0 20px 0 !important;
        letter-spacing: normal !important;
        text-align: left !important;
    }

    /* 6-Column Grid matching WooCommerce columns-6 */
    .products-grid-columns-6 {
        display: grid !important;
        grid-template-columns: repeat(6, 1fr) !important;
        column-gap: 20px !important;
        row-gap: 40px !important;
        list-style: none !important;
        padding: 0 !important;
        margin: 0 0 40px 0 !important;
    }

    /* Subcategory Card (ul.products li.product-category) */
    .product-category-card {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        text-align: center !important;
        background: transparent !important;
        padding: 0 !important;
        border-radius: 0 !important;
        transition: none !important;
        border: none !important;
        overflow: visible !important;
        box-shadow: none !important;
    }

    .product-category-card:hover {
        transform: none !important;
        box-shadow: none !important;
        border: none !important;
    }

    .product-category-card a {
        text-decoration: none !important;
        color: inherit !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        width: 100% !important;
    }

    .cat-thumb-box {
        width: 100% !important;
        height: auto !important;
        aspect-ratio: 1 / 1 !important;
        margin-bottom: 0 !important;
        display: block !important;
        overflow: hidden !important;
        border-radius: 0 !important;
        background: transparent !important;
    }

    .cat-thumb-box img {
        width: 100% !important;
        height: 100% !important;
        aspect-ratio: 1 / 1 !important;
        object-fit: fill !important;
        display: block !important;
        border-radius: 0 !important;
        border: none !important;
        box-shadow: none !important;
        margin: 0 !important;
        transition: none !important;
    }

    .product-category-card:hover .cat-thumb-box img {
        transform: none !important;
    }

    .woocommerce-loop-category__title {
        font-family: 'Teko', sans-serif !important;
        font-size: 29px !important;
        font-weight: 600 !important;
        color: #951634 !important;
        margin: 8px 0 0 0 !important;
        line-height: 1.3 !important;
        text-align: center !important;
    }

    .woocommerce-loop-category__title mark.count {
        display: block !important;
        font-family: 'Teko', sans-serif !important;
        font-size: 21.75px !important;
        font-weight: 400 !important;
        color: #000000 !important;
        background: transparent !important;
        margin-top: 2px !important;
        text-transform: capitalize !important;
    }

    /* Regular Product Card (li.product) */
    .product-item-card {
        background: transparent !important;
        border: none !important;
        border-radius: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        text-align: center !important;
        transition: none !important;
        overflow: visible !important;
        box-shadow: none !important;
    }

    .product-item-card:hover {
        transform: none !important;
        box-shadow: none !important;
        border: none !important;
    }

    .product-thumb-wrap {
        width: 100% !important;
        height: auto !important;
        aspect-ratio: 1 / 1 !important;
        margin: 0 !important;
        display: block !important;
        overflow: hidden !important;
        background: transparent !important;
    }

    .product-thumb-wrap a {
        display: block !important;
        width: 100% !important;
        height: 100% !important;
    }

    .product-thumb-wrap img {
        width: 100% !important;
        height: 100% !important;
        aspect-ratio: 1 / 1 !important;
        object-fit: fill !important;
        display: block !important;
        border-radius: 0 !important;
        border: none !important;
        box-shadow: none !important;
        margin: 0 !important;
    }

    .product-category-label {
        font-family: 'Open Sans', sans-serif !important;
        font-size: 12.75px !important;
        font-weight: 400 !important;
        color: #000000 !important;
        text-transform: none !important;
        letter-spacing: normal !important;
        margin: 0 0 6.375px 0 !important;
        line-height: 16.575px !important;
        width: 100% !important;
        display: block !important;
        text-align: center !important;
    }

    .product-title-link {
        text-decoration: none !important;
        color: #951634 !important;
        display: block !important;
        width: 100% !important;
    }

    .product-loop-title {
        font-family: 'Teko', sans-serif !important;
        font-size: 29px !important;
        font-weight: 600 !important;
        color: #951634 !important;
        margin: 0 !important;
        line-height: 1.3 !important;
        text-align: center !important;
        transition: color 0.15s ease !important;
    }

    .product-title-link:hover .product-loop-title,
    .product-title-link:hover,
    .product-loop-title:hover {
        color: #64141f !important;
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

<div class="elementor elementor-2994 elementor-location-archive product archive-page-wrap">
    <!-- 1. Breadcrumb Bar -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-7b8eef9 elementor-section-full_width elementor-section-height-default category-breadcrumb-section" data-id="7b8eef9">
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
                        <a href="{{ url('/' . $category->parent->slug . '/') }}">{{ $category->parent->name }}</a>
                    @endif
                    <span class="delimiter">&#47;</span>
                    <span>{{ $category->name }}</span>
                @endif
            </nav>
        </div>
    </section>

    <!-- 2. Main Archive Section (2 Columns: Left 78%, Right 22%) -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-2af8bd7 elementor-section-full_width elementor-section-height-default archive-main-section" data-id="2af8bd7">
        <div class="archive-container">
            <div class="archive-main-grid">
                <!-- Left Column: Title, Subtitle, Inner Banner, Rich Description -->
                <div class="archive-left-col">
                    <div class="elementor-element elementor-element-f299dd6 elementor-widget elementor-widget-theme-archive-title elementor-page-title elementor-widget-heading">
                        <h1 class="elementor-heading-title elementor-size-default archive-title-heading">{{ $category->name }}</h1>
                    </div>
                    <div class="elementor-element elementor-element-6448fe1 elementor-widget elementor-widget-theme-archive-title elementor-page-title elementor-widget-heading">
                        <p class="elementor-heading-title elementor-size-default archive-subtitle-italic">Superior purity {{ $category->name }} by S D International</p>
                    </div>

                    <div class="term-description-box">
                        @php
                            $rawDesc = $category->description ?? '';
                            // Ensure Properties of ... or any list intro ending with : before <ul> is cleanly on its own line
                            $desc = preg_replace('/(<\/?span[^>]*>)?\s*(<b>|<strong>)\s*(Properties of [^<]+)(<\/b>|<\/strong>)/i', '$1<div class="category-properties-title">$3</div>', $rawDesc);
                            $desc = preg_replace('/(<b>|<strong>)([^<]+:)(<\/b>|<\/strong>)\s*(<ul>|<ol>)/i', '<p class="category-properties-title"><strong>$2</strong></p>$4', $desc);
                            // Wrap unwrapped text after h2 in p
                            $desc = preg_replace('/<\/h2>\s*(<span[^>]*>.*?<\/span>)\s*(<div class="category-properties-title">|<p class="category-properties-title">)/is', '</h2><p>$1</p>$2', $desc);
                            if (!str_contains($desc, '<p>') && (str_contains($desc, "\n") || str_contains($desc, "\r"))) {
                                $desc = wpautop($desc);
                            }
                            $hasColMd5 = str_contains($desc, 'col-md-5');
                        @endphp

                        @if($hasColMd5)
                            {{-- Inject the featured card into col-md-5 --}}
                            @php
                                $bannerReplacement = '<div class="col-md-5">
                                    <div class="category-featured-card">
                                        <img src="' . $category->featured_image_url . '" alt="' . e($category->name) . ' manufacturer, exporter, supplier in Mumbai- India" class="category-featured-img" onerror="this.onerror=null; this.src=\'' . ($category->slug === 'liquid-solvent-dyes' ? 'https://sdinternational.com/wp-content/uploads/2026/04/solvent-dyes-e1775805465464.jpg' : ($category->slug === 'other-products' ? 'https://sdinternational.com/wp-content/uploads/2022/05/other-product.jpg' : 'https://sdinternational.com/wp-content/uploads/2022/04/' . $category->slug . '.jpg')) . '\';">
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
                                    <img src="{{ $category->featured_image_url }}" alt="{{ $category->name }} manufacturer, exporter, supplier in Mumbai- India" class="category-featured-img" onerror="this.onerror=null; this.src='{{ $category->slug === 'liquid-solvent-dyes' ? 'https://sdinternational.com/wp-content/uploads/2026/04/solvent-dyes-e1775805465464.jpg' : ($category->slug === 'other-products' ? 'https://sdinternational.com/wp-content/uploads/2022/05/other-product.jpg' : 'https://sdinternational.com/wp-content/uploads/2022/04/' . $category->slug . '.jpg') }}';">
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
                <div class="archive-right-sidebar">
                    <div class="elementor-element elementor-element-5dcd9cb elementor-widget elementor-widget-heading">
                        <div class="elementor-widget-container">
                            <h3 class="elementor-heading-title">PRODUCTS RANGE</h3>
                        </div>
                    </div>
                    @include('partials.products_range_sidebar', ['currentSlug' => $category->slug])
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Section 3: Browse Related Products / Subcategories (Elementor Section 65c54ca) -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-65c54ca elementor-section-full_width elementor-section-height-default archive-products-section" data-id="65c54ca">
        <div class="archive-container">
            <div class="elementor-element elementor-element-b37d3d7 elementor-widget elementor-widget-heading">
                <h2 class="elementor-heading-title elementor-size-default category-section-heading">Browse related {{ $category->name }} chemical products offered by SD International</h2>
            </div>

            {{-- 3A. Subcategories Grid (shown when category has children, matching live image26.png 1:1) --}}
            @if($childCategories->isNotEmpty())
                <ul class="products-grid-columns-6">
                    @foreach($childCategories as $child)
                        <li class="product-category-card">
                            <a href="{{ url('/' . $child->slug . '/') }}">
                                <div class="cat-thumb-box">
                                    <img src="{{ $child->thumbnail_url }}" alt="{{ $child->name }}" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/2022/04/{{ $child->slug }}-120x120.jpg';">
                                </div>
                                <h2 class="woocommerce-loop-category__title">
                                    {{ $child->name }}
                                    <mark class="count">{{ $child->products_count ?? $child->products()->count() }} Products</mark>
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

            @if(method_exists($products, 'hasPages') && $products->hasPages())
                <div class="d-flex justify-content-center my-4">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @endif
            @endif

            <!-- 4. Industries We Serve (Elementor Inner Sections 1986e67 & a33570f) -->
            <div class="industries-section">
                <div class="elementor-element elementor-element-4ca5794 elementor-widget elementor-widget-heading">
                    <h4 class="elementor-heading-title elementor-size-default category-section-heading">Industries We Serve</h4>
                </div>
                <div class="industries-grid-5">
                    <!-- 1. Plastic & Polymers -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/plastic-polymers/') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/2020/07/plastic_polymer.jpg') }}" alt="Plastic & Polymers" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/2020/07/plastic_polymer.jpg';">
                            </div>
                            <h5 class="industry-title">Plastic &amp; Polymers</h5>
                        </a>
                    </div>
                    <!-- 2. Textiles -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/textiles/') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/2020/07/textiles.jpg') }}" alt="Textiles" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/2020/07/textiles.jpg';">
                            </div>
                            <h5 class="industry-title">Textiles</h5>
                        </a>
                    </div>
                    <!-- 3. Leather -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/leather/') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/2020/07/lather.jpg') }}" alt="Leather" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/2020/07/lather.jpg';">
                            </div>
                            <h5 class="industry-title">Leather</h5>
                        </a>
                    </div>
                    <!-- 4. Petroleum & Lubricants -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/petroleum-lubricants/') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/2020/07/petroleum_and_lubricant.jpg') }}" alt="Petroleum & Lubricants" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/2020/07/petroleum_and_lubricant.jpg';">
                            </div>
                            <h5 class="industry-title">Petroleum &amp; Lubricants</h5>
                        </a>
                    </div>
                    <!-- 5. Paper & Pulp -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/paper-pulp/') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/2020/07/paper_and_pulp.jpg') }}" alt="Paper & Pulp" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/2020/07/paper_and_pulp.jpg';">
                            </div>
                            <h5 class="industry-title">Paper &amp; Pulp</h5>
                        </a>
                    </div>
                    <!-- 6. Printing Inks -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/printing-inks/') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/2020/07/ink_industry.jpg') }}" alt="Printing Inks" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/2020/07/ink_industry.jpg';">
                            </div>
                            <h5 class="industry-title">Printing Inks</h5>
                        </a>
                    </div>
                    <!-- 7. Food Drug & Cosmetics -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/food-drug-cosmetics/') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/2020/07/food_drug_app-1.jpg') }}" alt="Food Drug & Cosmetics" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/2020/07/food_drug_app-1.jpg';">
                            </div>
                            <h5 class="industry-title">Food Drug &amp; Cosmetics</h5>
                        </a>
                    </div>
                    <!-- 8. Coatings -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/coating/') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/2020/07/coating_dyes.jpg') }}" alt="Coatings" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/2020/07/coating_dyes.jpg';">
                            </div>
                            <h5 class="industry-title">Coatings</h5>
                        </a>
                    </div>
                    <!-- 9. Wood Stains -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/wood-stains/') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/2020/07/wood_stain_treatment.jpg') }}" alt="Wood Stains" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/2020/07/wood_stain_treatment.jpg';">
                            </div>
                            <h5 class="industry-title">Wood Stains</h5>
                        </a>
                    </div>
                    <!-- 10. Smoke Dyes -->
                    <div class="industry-card-item">
                        <a href="{{ url('/applications/smoke-dyes/') }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset('uploads/2020/07/smoke-dyes.jpg') }}" alt="Smoke Dyes" onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/2020/07/smoke-dyes.jpg';">
                            </div>
                            <h5 class="industry-title">Smoke Dyes</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Why SD International & Market Area (Elementor Section 9ca7d48) -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-9ca7d48 elementor-section-full_width elementor-section-height-default features-market-section" data-id="9ca7d48">
        <div class="archive-container">
            <div class="features-market-grid">
                <!-- Left: Why SD International -->
                <div class="features-col elementor-column elementor-col-50">
                    <div class="elementor-element elementor-element-0d3d795 elementor-widget elementor-widget-heading">
                        <h4 class="elementor-heading-title elementor-size-default category-section-heading" style="margin-top: 0;">Why SD International</h4>
                    </div>
                    <div class="features-box-card elementor-element elementor-element-cee73bf elementor-widget elementor-widget-text-editor">
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
                <div class="market-col elementor-column elementor-col-50">
                    <div class="elementor-element elementor-element-47d6e5a elementor-widget elementor-widget-heading">
                        <h4 class="elementor-heading-title elementor-size-default category-section-heading" style="margin-top: 0;">Market Area of SD International</h4>
                    </div>
                    <div class="market-box-card elementor-element elementor-element-e847fbe elementor-widget elementor-widget-text-editor">
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
    </section>

    <!-- 5. Disclaimer & SEO keywords block (Elementor Section d6733c9) -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-d6733c9 elementor-section-full_width elementor-section-height-default seo-disclaimer-section" data-id="d6733c9">
        <div class="archive-container">
            <div class="seo-disclaimer-text elementor-element elementor-element-32a216c elementor-widget elementor-widget-text-editor">
                <p>Manufacturer, Supplier, Importer, Exporter, Dealer, Distributor &amp; Service Provider of Industrial Chemicals, Pharma Excipients, Pharma Raw material importer, Pharmaceutical, Active Pharmaceutical Ingredients, Bulk Drugs, Industrial Acid &amp; Salts, Agriculture Chemicals, Food chemicals, Phase Transfer Catalyst, Quats, Agriculture Chemicals, Fine Chemicals, Epoxy Coating chemicals, Construction Chemicals, Cosmetic Chemicals, Bulk Drugs, Oil field chemicals, Phase Transfer Catalyst, Water Treatment Chemicals, Swimming Pool Chemicals, Chlorinated Intermediates, Cosmetic Chemicals, Gujarat, India. Top chemicals &amp; pharmaceutical company in India. Industrial Chemicals, Surplus Chemicals, Intermediates in Vadodara, Industrial Acid, Specialty Chemicals, Pharmaceutical Chemicals, Active Pharma Ingredients, By-product/Waste Grade Chemicals Buyer &amp; Seller in India, Best &amp; Contract Manufacturer of Pharmaceuticals &amp; Chemicals, Top Chemical &amp; Pharma companies in India, Pharma Impurities for formulation manufacturer &amp; pharma companies, Chlorine Chemicals, Importer of Industrial &amp; Pharma Chemicals in India, ETP Chemicals, STP Chemicals, Buyer &amp; Seller Used Machinery for Pharma &amp; Chemicals Industries in India, Pharma Raw Materials, Surplus/Non-Moving Chemicals buyer &amp; Seller in India, Solvents (Distilled, Recovered &amp; Pure), Quats &amp; Phase transfer catalyst, Ashland pharma excipients dealer &amp; distributor in India, Detergent Chemicals, Detergent Raw materials, BASF Products, oil &amp; gas chemicals, Biocides &amp; Hygiene chemicals, hand sanitizer, disinfection &amp; sanitation spray (corona-covid virus spray), Pharmaceutical sanitization, lubrication additives.</p>
                <p><strong>Note :</strong> Please note that the information on this document is for illustration purposes only as information may vary with individual chemical compounds and their purity, concentration and applications subjects and therefore cannot be guaranteed as accurate. &copy; Copyright 2022 &copy; <strong>SD International</strong>. All Rights Reserved (Terms of Use). Recreation of any materials from the site is strictly prohibited without permission. SD International’s products are sold exclusively through SD International’s website. Use Terms | Privacy. Please contact us to discuss precise product specifications and requirements and obtain advice on which products are required to suit your exact application needs <strong>info@sdinternational.com</strong></p>
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
