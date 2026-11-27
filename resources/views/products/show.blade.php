@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/live/post-2712.css">
<style>
    /* Elementor 2712 Layout & Theme Overrides */
    .elementor-2712 {
        background-color: #ffffff;
        color: #000000;
        font-family: 'Poppins', sans-serif;
        width: 100%;
        overflow-x: hidden;
    }

    .elementor-2712 .elementor-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
        box-sizing: border-box;
    }

    .elementor-2712 .elementor-row {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }

    .elementor-2712 .elementor-col-100 { width: 100%; }
    .elementor-2712 .elementor-col-66 { width: 66.666%; }
    .elementor-2712 .elementor-col-50 { width: 50%; }
    .elementor-2712 .elementor-col-33 { width: 33.333%; }
    .elementor-2712 .elementor-col-20 { width: 20%; }

    @media (max-width: 1024px) {
        .elementor-2712 .elementor-col-66,
        .elementor-2712 .elementor-col-33 {
            width: 100% !important;
        }
        .elementor-2712 .elementor-col-50 {
            width: 50%;
        }
        .elementor-2712 .elementor-col-20 {
            width: 33.333%;
        }
    }

    @media (max-width: 767px) {
        .elementor-2712 .elementor-col-50,
        .elementor-2712 .elementor-col-20 {
            width: 100% !important;
        }
    }

    /* Breadcrumbs styling */
    .elementor-element-340ce43 {
        background-color: #F6F6F6;
        padding: 12px 0;
        border-bottom: 1px solid #eeeeee;
    }
    .elementor-element-9d5a440 .woocommerce-breadcrumb {
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        color: #000000;
        margin: 0;
        line-height: 1.5;
    }
    .elementor-element-9d5a440 .woocommerce-breadcrumb a {
        color: #000000;
        text-decoration: none;
        transition: color 0.2s;
    }
    .elementor-element-9d5a440 .woocommerce-breadcrumb a:hover {
        color: #73001B;
    }

    /* Headings */
    .elementor-element-03a0b17 {
        margin: 0 0 0px 0 !important;
    }
    .elementor-element-03a0b17 > .elementor-widget-container {
        margin: 0 0 0px 0 !important;
    }
    .elementor-element-03a0b17 .elementor-heading-title {
        color: #000000 !important;
        font-family: "Teko", sans-serif !important;
        font-size: 36px !important;
        font-weight: 600 !important;
        text-transform: capitalize !important;
        margin: 0 0 18px 0 !important;
        line-height: 1.2 !important;
    }

    .elementor-element-73fd0fa {
        margin: 0 0 20px 0 !important;
    }
    .elementor-element-73fd0fa > .elementor-widget-container {
        margin: 0 0 0px 0 !important;
    }
    .elementor-element-73fd0fa .elementor-heading-title {
        color: #73001B !important;
        font-family: "Poppins", sans-serif !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        margin: 0 0 20px 0 !important;
        line-height: 1.4 !important;
    }

    /* Short Description - Exact SD International Parity (Merriweather 18px, transparent, borderless) */
    .elementor-element-e21bf1e > .elementor-widget-container {
        margin: 0 0 20px 0 !important;
        padding: 0 !important;
        background-color: transparent !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }
    .elementor-element-e21bf1e .woocommerce-product-details__short-description {
        font-family: 'Merriweather', serif !important;
        font-size: 18px !important;
        font-weight: 400 !important;
        line-height: 1.85 !important;
        color: #0a0909 !important;
        background-color: transparent !important;
        border: none !important;
        border-radius: 0 !important;
        padding: 0 !important;
        margin: 0 0 20px 0 !important;
        box-shadow: none !important;
    }
    .elementor-element-e21bf1e .woocommerce-product-details__short-description p {
        font-family: 'Merriweather', serif !important;
        font-size: 18px !important;
        font-weight: 400 !important;
        line-height: 1.85 !important;
        color: #0a0909 !important;
        margin: 0 0 20px 0 !important;
    }
    .elementor-element-e21bf1e .woocommerce-product-details__short-description img {
        max-width: 100%;
        height: auto;
        border: none !important;
        border-radius: 0 !important;
        margin: 8px 0;
        display: block;
    }

    /* Product Swatch Image with Curved Corners */
    .elementor-element-0bba525 .product-image-frame {
        position: relative;
        overflow: hidden;
        border-radius: 20px 0px 20px 0px;
        border: 1px solid #eeeeee;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        background: #ffffff;
        cursor: pointer;
    }
    .elementor-element-0bba525 .product-image-frame img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.3s ease;
    }
    .elementor-element-0bba525 .product-image-frame:hover img {
        transform: scale(1.03);
    }
    .product-zoom-icon-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 34px;
        height: 34px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        color: #73001B;
    }

    /* Enquiry Button */
    .elementor-element-5032e29 .elementor-button {
        display: inline-block;
        width: 100%;
        text-align: center;
        background-color: #73001B !important;
        color: #ffffff !important;
        font-family: "Poppins", sans-serif !important;
        font-size: 16px !important;
        font-weight: 600 !important;
        padding: 12px 24px !important;
        border-radius: 6px !important;
        border: none !important;
        cursor: pointer !important;
        transition: background-color 0.2s, transform 0.1s !important;
        box-shadow: 0 4px 12px rgba(115, 0, 27, 0.25) !important;
        margin-bottom: 18px !important;
    }
    .elementor-element-5032e29 .elementor-button:hover {
        background-color: #550014 !important;
        color: #ffffff !important;
    }

    /* Table of Contents Box */
    .pp-toc {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .pp-toc__header-title {
        font-family: "Poppins", sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: #000000;
        margin: 0 0 10px 0;
        padding-bottom: 8px;
        border-bottom: 1px solid #edf2f7;
    }
    .pp-toc__list {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .pp-toc__list-item {
        font-family: "Poppins", sans-serif;
        font-size: 13.5px;
        margin-bottom: 6px;
    }
    .pp-toc__list-item a {
        color: #4a5568;
        text-decoration: none;
        transition: color 0.15s;
    }
    .pp-toc__list-item a:hover {
        color: #73001B;
    }

    /* Products Range Sidebar Header */
    .elementor-element-e64c1d7 .elementor-heading-title {
        background-color: #73001B !important;
        color: #ffffff !important;
        font-family: "Poppins", sans-serif !important;
        font-size: 19px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        padding: 10px 15px !important;
        margin: 0 !important;
        border-radius: 4px 4px 0 0 !important;
    }
    .sidebar-tree-container {
        border: none !important;
        background: transparent !important;
        padding: 0 !important;
        margin-bottom: 30px !important;
    }

    /* Section 2: Related Products & Industries */
    .elementor-element-4cf059b {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #eeeeee;
    }
    .elementor-element-7961484 .elementor-heading-title,
    .elementor-element-e2186c9 .elementor-heading-title {
        color: #73001B !important;
        font-family: "Teko", sans-serif !important;
        font-size: 32px !important;
        font-weight: 600 !important;
        margin: 0 0 20px 0 !important;
    }

    /* 6-Column Product Grid */
    .related-products-grid-6 {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        column-gap: 20px;
        row-gap: 40px;
        list-style: none;
        padding: 0;
        margin: 0 0 40px 0;
    }
    @media (max-width: 1200px) {
        .related-products-grid-6 { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 768px) {
        .related-products-grid-6 { grid-template-columns: repeat(2, 1fr); column-gap: 15px; row-gap: 25px; }
    }
    .related-product-card {
        background: transparent;
        border: none;
        border-radius: 0;
        padding: 0;
        text-align: center;
        transition: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: none;
    }
    .related-product-card:hover {
        transform: none;
        box-shadow: none;
    }
    .related-product-card img {
        width: 100%;
        max-width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: fill;
        border-radius: 0;
        margin-bottom: 0;
        border: none;
        box-shadow: none;
        display: block;
    }
    .related-product-cat {
        font-family: 'Open Sans', sans-serif;
        font-size: 12.75px;
        font-weight: 400;
        color: #000000;
        text-transform: none;
        letter-spacing: normal;
        margin: 0 0 6.375px 0;
        line-height: 16.575px;
        width: 100%;
        display: block;
        text-align: center;
    }
    .related-product-title {
        font-family: 'Teko', sans-serif;
        font-size: 29px;
        font-weight: 600;
        color: #951634 !important;
        text-decoration: none;
        line-height: 1.3;
        margin: 0;
        text-align: center;
        display: block;
    }
    #related-products {
        color: #951634 !important;
        font-family: 'Teko', sans-serif !important;
        font-size: 29px !important;
        font-weight: 600 !important;
        line-height: 29px !important;
    }

    /* Industries We Serve 5-Column Grid */
    .industries-grid-5 {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        margin-bottom: 40px;
    }
    @media (max-width: 992px) {
        .industries-grid-5 { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 576px) {
        .industries-grid-5 { grid-template-columns: repeat(2, 1fr); }
    }
    .industry-card-item {
        text-align: center;
        text-decoration: none;
        display: block;
        color: inherit;
    }
    .industry-card-item img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #eeeeee;
        margin-bottom: 8px;
        transition: transform 0.2s;
    }
    .industry-card-item:hover img {
        transform: scale(1.03);
    }
    .industry-card-item h5 {
        font-family: "Poppins", sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        color: #222222;
        margin: 0;
    }

    /* Section 3: Why SD & Market Area */
    .elementor-element-4136403 {
        padding: 30px 0;
        border-top: 1px solid #eeeeee;
    }
    .why-market-heading {
        color: #73001B !important;
        font-family: "Teko", sans-serif !important;
        font-size: 28px !important;
        font-weight: 600 !important;
        margin: 0 0 12px 0 !important;
    }
    .why-market-list {
        font-family: "Poppins", sans-serif;
        font-size: 13.5px;
        line-height: 1.7;
        color: #444444;
        padding-left: 20px;
    }

    /* Section 4: SEO Disclaimer */
    .elementor-element-a2e20fd {
        padding: 20px 0 40px 0;
        font-family: "Poppins", sans-serif;
        font-size: 12px;
        line-height: 1.6;
        color: #888888;
        border-top: 1px solid #eeeeee;
    }

    /* Lightbox Modal */
    .product-lightbox-modal {
        display: none;
        position: fixed;
        z-index: 999999;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.85);
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }
    .product-lightbox-modal.active {
        display: flex;
    }
    .product-lightbox-modal img {
        max-width: 90vw;
        max-height: 85vh;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .product-lightbox-close {
        position: absolute;
        top: 20px; right: 25px;
        color: #ffffff;
        font-size: 36px;
        font-weight: 700;
        cursor: pointer;
        line-height: 1;
    }

    /* Quotation Modal */
    .product-quote-modal-wrap {
        display: none;
        position: fixed;
        z-index: 999999;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.65);
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }
    .product-quote-card {
        background: #ffffff;
        border-radius: 8px;
        width: 100%;
        max-width: 520px;
        padding: 25px;
        position: relative;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    }
</style>

@php
    $prodImage = $product->image_url ?: 'https://sdinternational.com/wp-content/uploads/woocommerce-placeholder-120x120.png';
    if (!str_starts_with($prodImage, 'http')) {
        $prodImage = asset($prodImage);
    }
    $industriesList = [
        ['title' => 'Plastic & Polymers', 'url' => '/applications/plastic-polymers', 'img' => 'uploads/2020/07/plastic-polymer.jpg'],
        ['title' => 'Textiles', 'url' => '/applications/textiles', 'img' => 'uploads/2020/07/textiles.jpg'],
        ['title' => 'Leather', 'url' => '/applications/leather', 'img' => 'uploads/2020/07/lather.jpg'],
        ['title' => 'Petroleum & Lubricants', 'url' => '/applications/petroleum-lubricants', 'img' => 'uploads/2020/07/petroleum.jpg'],
        ['title' => 'Paper & Pulp', 'url' => '/applications/paper-pulp', 'img' => 'uploads/2020/07/paper_and_pulp.jpg'],
        ['title' => 'Printing Inks', 'url' => '/applications/printing-inks', 'img' => 'uploads/2020/07/ink_and_paint.jpg'],
        ['title' => 'Food Drug & Cosmetics', 'url' => '/applications/food-drug-cosmetics', 'img' => 'uploads/2020/07/cosmetic.jpg'],
        ['title' => 'Coatings', 'url' => '/applications/coating', 'img' => 'uploads/2020/07/coating_dyes.jpg'],
        ['title' => 'Wood Stains', 'url' => '/applications/wood-stains', 'img' => 'uploads/2020/07/wood_stain.jpg'],
        ['title' => 'Smoke Dyes', 'url' => '/applications/smoke-dyes', 'img' => 'uploads/2020/07/smoke-dyes.jpg'],
        ['title' => 'Pigment Intermediates', 'url' => '/applications/pigment-intermediates', 'img' => 'uploads/2020/07/textiles.jpg'],
        ['title' => 'Wax', 'url' => '/applications/wax', 'img' => 'uploads/applications/wax.jpg'],
        ['title' => 'Rubber', 'url' => '/applications/rubber', 'img' => 'uploads/applications/rubberq.jpg'],
        ['title' => 'Glass', 'url' => '/applications/glass', 'img' => 'uploads/applications/glass.jpg'],
        ['title' => 'Intermediates', 'url' => '/applications/intermediates', 'img' => 'uploads/applications/intermediates.jpg'],
    ];
@endphp

<div class="elementor elementor-2712 elementor-location-single product">
    <div class="elementor-section-wrap">

        <!-- SECTION 0: Full-Width Breadcrumbs (Elementor 340ce43) -->
        <section class="elementor-section elementor-top-section elementor-element elementor-element-340ce43 elementor-section-full_width elementor-section-height-default" data-id="340ce43">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-row">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-09d53d4">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-element-9d5a440 elementor-widget elementor-widget-woocommerce-breadcrumb">
                                    <div class="elementor-widget-container">
                                        <nav class="woocommerce-breadcrumb">
                                            @foreach($breadcrumbs as $name => $link)
                                                @if(!$loop->last)
                                                    <a href="{{ $link }}">{{ $name }}</a> /
                                                @else
                                                    <span>{{ $name }}</span>
                                                @endif
                                            @endforeach
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 1: Main Product Details & Products Range Sidebar (Elementor d5e1b5c) -->
        <section class="elementor-section elementor-top-section elementor-element elementor-element-d5e1b5c elementor-section-full_width elementor-section-stretched elementor-section-height-default" data-id="d5e1b5c">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-row">
                    <!-- Left Column (66% Width) -->
                    <div class="elementor-column elementor-col-66 elementor-top-column elementor-element elementor-element-91a9eb7">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <!-- Product H1 Title -->
                                <div class="elementor-element elementor-element-03a0b17 elementor-widget elementor-widget-woocommerce-product-title elementor-page-title elementor-widget-heading">
                                    <div class="elementor-widget-container">
                                        <h1 class="product_title entry-title elementor-heading-title elementor-size-default">
                                            {{ $product->title }}
                                        </h1>
                                    </div>
                                </div>

                                <!-- Product Subtitle -->
                                <div class="elementor-element elementor-element-73fd0fa elementor-widget elementor-widget-woocommerce-product-title elementor-page-title elementor-widget-heading">
                                    <div class="elementor-widget-container">
                                        <p class="product_title entry-title elementor-heading-title elementor-size-default">
                                            {{ $product->subtitle ?: "Suppliers and Exporter of " . $product->title }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Short Description -->
                                <div class="elementor-element elementor-element-e21bf1e elementor-widget elementor-widget-woocommerce-product-short-description">
                                    <div class="elementor-widget-container">
                                        <div class="woocommerce-product-details__short-description">
                                            {!! $product->short_description ?: $product->content !!}
                                        </div>
                                    </div>
                                </div>

                                <!-- Inner Section: Image Left (50%) + Enquiry & TOC Right (50%) -->
                                <section class="elementor-section elementor-inner-section elementor-element elementor-element-55dd4da elementor-section-boxed elementor-section-height-default" data-id="55dd4da">
                                    <div class="elementor-container elementor-column-gap-default">
                                        <div class="elementor-row">
                                            <!-- Product Swatch Image (50%) -->
                                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-7db0e45">
                                                <div class="elementor-column-wrap elementor-element-populated">
                                                    <div class="elementor-widget-wrap">
                                                        <div class="elementor-element elementor-element-0bba525 elementor-widget elementor-widget-woocommerce-product-images">
                                                            <div class="elementor-widget-container">
                                                                <div class="product-image-frame" onclick="openProductLightbox('{{ $prodImage }}')">
                                                                    <img src="{{ $prodImage }}"
                                                                         alt="{{ $product->title }}"
                                                                         onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/woocommerce-placeholder-120x120.png';">
                                                                    <div class="product-zoom-icon-badge" title="Click to Zoom">
                                                                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Enquiry Button & Table of Contents (50%) -->
                                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-e7a198d">
                                                <div class="elementor-column-wrap elementor-element-populated">
                                                    <div class="elementor-widget-wrap">
                                                        <!-- Enquiry Button -->
                                                        <div class="elementor-element elementor-element-5032e29 elementor-widget elementor-widget-button">
                                                            <div class="elementor-widget-container">
                                                                <button type="button" class="elementor-button elementor-size-md" onclick="openProductQuoteModal('{{ addslashes($product->title) }}', '{{ $product->slug }}')">
                                                                    Enquiry Now
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <!-- Table of Contents -->
                                                        <div class="elementor-element elementor-element-2acfc1c elementor-widget elementor-widget-pp-table-of-contents">
                                                            <div class="elementor-widget-container">
                                                                <div class="pp-toc">
                                                                    <h3 class="pp-toc__header-title">Table of Contents</h3>
                                                                    <ul class="pp-toc__list">
                                                                        @if(!empty($tocItems))
                                                                            @foreach($tocItems as $item)
                                                                                <li class="pp-toc__list-item"><a href="#{{ $item['id'] }}">{{ $item['label'] }}</a></li>
                                                                            @endforeach
                                                                        @else
                                                                            <li class="pp-toc__list-item"><a href="#related-products">Browse Related Products</a></li>
                                                                            <li class="pp-toc__list-item"><a href="#industries-we-serve">Industries We Serve</a></li>
                                                                            <li class="pp-toc__list-item"><a href="#why-sd-international">Why SD International</a></li>
                                                                            <li class="pp-toc__list-item"><a href="#market-area-sd">Market Area of SD International</a></li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!-- Additional Rich Specifications/TDS if present -->
                                @if(!empty($renderedContent) && strlen(strip_tags($renderedContent)) > 200)
                                    <div class="product-rich-extra-specs" style="margin-top: 25px; font-family: 'Poppins', sans-serif;">
                                        {!! $renderedContent !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (33% Width): PRODUCTS RANGE Sidebar -->
                    <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-26cd99a">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-element-e64c1d7 elementor-widget elementor-widget-heading">
                                    <div class="elementor-widget-container">
                                        <h3 class="elementor-heading-title elementor-size-default">Products Range</h3>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-bb74f12 elementor-widget elementor-widget-shortcode">
                                    <div class="elementor-widget-container">
                                        <div class="sidebar-tree-container">
                                            @include('partials.products_range_sidebar', ['currentSlug' => $product->slug])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: Browse Related Products & Industries We Serve (Elementor 4cf059b) -->
        <section class="elementor-section elementor-top-section elementor-element elementor-element-4cf059b elementor-section-full_width elementor-section-stretched elementor-section-height-default" data-id="4cf059b">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-row">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-513f4f2">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <!-- Browse Related Products Heading -->
                                <div class="elementor-element elementor-element-7961484 elementor-widget elementor-widget-heading">
                                    <div class="elementor-widget-container">
                                        <h2 id="related-products" class="elementor-heading-title elementor-size-default">
                                            Browse Related Products offered by SD International
                                        </h2>
                                    </div>
                                </div>

                                <!-- 12 Related Products in 6-Column Grid -->
                                <div class="elementor-element elementor-element-f9a736d elementor-widget elementor-widget-pp-woo-products">
                                    <div class="elementor-widget-container">
                                        <ul class="related-products-grid-6">
                                            @foreach($relatedProducts as $rel)
                                                @php
                                                    $relImg = $rel->image_url ?: 'https://sdinternational.com/wp-content/uploads/woocommerce-placeholder-120x120.png';
                                                    if (!str_starts_with($relImg, 'http')) {
                                                        $relImg = asset($relImg);
                                                    }
                                                    $relCat = $rel->categories->first()?->name ?? 'Dyes & Chemicals';
                                                @endphp
                                                <li class="related-product-card">
                                                    <a href="/{{ $rel->slug }}/" style="text-decoration:none; display:flex; flex-direction:column; align-items:center;">
                                                        <img src="{{ $relImg }}"
                                                             alt="{{ $rel->title }}"
                                                             onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/woocommerce-placeholder-120x120.png';">
                                                        <span class="related-product-cat">{{ $relCat }}</span>
                                                        <span class="related-product-title">{{ $rel->title }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <!-- Industries We Serve Heading -->
                                <div class="elementor-element elementor-element-e2186c9 elementor-widget elementor-widget-heading">
                                    <div class="elementor-widget-container">
                                        <h2 id="industries-we-serve" class="elementor-heading-title elementor-size-default">
                                            Industries We Serve
                                        </h2>
                                    </div>
                                </div>

                                <!-- Industries We Serve Grid (15 Items) -->
                                <div class="industries-grid-5">
                                    @foreach($industriesList as $ind)
                                        <a href="{{ $ind['url'] }}/" class="industry-card-item">
                                            <img src="/{{ $ind['img'] }}"
                                                 alt="{{ $ind['title'] }}"
                                                 onerror="this.onerror=null; this.src='https://sdinternational.com/wp-content/uploads/{{ basename($ind['img']) }}';">
                                            <h5>{{ $ind['title'] }}</h5>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 3: Why SD International & Market Area (Elementor 4136403) -->
        <section class="elementor-section elementor-top-section elementor-element elementor-element-4136403 elementor-section-full_width elementor-section-height-default" data-id="4136403">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-row">
                    <!-- Column 1: Why SD International -->
                    <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-213bb47">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-element-8a76c5a elementor-widget elementor-widget-heading">
                                    <div class="elementor-widget-container">
                                        <h4 id="why-sd-international" class="why-market-heading">Why SD International</h4>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-241ebbc elementor-widget elementor-widget-text-editor">
                                    <div class="elementor-widget-container">
                                        <ul class="why-market-list">
                                            <li>More than 30 years of rich industry experience.</li>
                                            <li>Wide product range of high purity chemicals.</li>
                                            <li>Leading exporter of dyeing and auxiliaries chemicals.</li>
                                            <li>Focus is to create trustworthy and responsive relationships.</li>
                                            <li>Reliable and dependable service.</li>
                                            <li>Great Value, quality products, and huge range in stocks.</li>
                                            <li>Chemicals and services we provide achieve consistent standards and exceed your expectations.</li>
                                            <li>Strong logistics support with an extensive network of worldwide agents to make deliveries safe and on time.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Market Area of SD International -->
                    <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-acdac98">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-element-edcd751 elementor-widget elementor-widget-heading">
                                    <div class="elementor-widget-container">
                                        <h4 id="market-area-sd" class="why-market-heading">Market Area of SD International</h4>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-fd3064d elementor-widget elementor-widget-text-editor">
                                    <div class="elementor-widget-container">
                                        <p style="font-family:'Poppins',sans-serif; font-size:13.5px; line-height:1.7; color:#444444; margin-bottom:12px;">
                                            SD International supply and export to listed Countries:
                                        </p>
                                        <p style="font-family:'Poppins',sans-serif; font-size:13px; line-height:1.6; color:#555555; background:#f9fafb; padding:12px; border-radius:6px; border:1px solid #edf2f7; font-weight:500;">
                                            China | Ningbo | Shanghai | Guangzhou | Bangladesh | Brazil | Colombia | South Korea | Mexico | Turkey | Germany | Poland | Russia | Singapore | South Korea | Taiwan | UAE | Uganda | USA | Vietnam | Argentina | Bolivia | Chile | Italy | Spain | Kenya
                                        </p>
                                        <p style="font-family:'Poppins',sans-serif; font-size:13px; line-height:1.6; color:#666666; margin-top:10px;">
                                            If your country or region is not mentioned above, please reach out directly to our global commercial desk at <a href="tel:+919920669561" style="color:#73001B; font-weight:600;">+91 99206 69561</a> or submit your export requirements online.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 4: Bottom SEO Disclaimer (Elementor a2e20fd) -->
        <section class="elementor-section elementor-top-section elementor-element elementor-element-a2e20fd elementor-section-full_width elementor-section-height-default" data-id="a2e20fd">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-row">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-37bae79">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-element-9ac6f25 elementor-widget elementor-widget-text-editor">
                                    <div class="elementor-widget-container">
                                        <p style="margin:0;">
                                            Manufacturer, Supplier, Importer, Exporter, Dealer, Distributor & Service Provider of {{ $product->title }} in Mumbai, Maharashtra, India to various domestic and international locations including UAE, Saudi Arabia, Qatar, Oman, Egypt, Nigeria, Kenya, South Africa, Bangladesh, Vietnam, Indonesia, Thailand, Malaysia, Brazil, Argentina, USA, UK, Germany, Italy, Spain and European markets. All trademarks, logos and trade names belong to their respective owners.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

<!-- Image Lightbox Modal -->
<div id="productLightbox" class="product-lightbox-modal" onclick="closeProductLightbox()">
    <span class="product-lightbox-close" onclick="closeProductLightbox()">&times;</span>
    <img id="productLightboxImg" src="" alt="Product Full View" onclick="event.stopPropagation()">
</div>

<!-- Product Quotation Modal -->
<div id="productQuoteModal" class="product-quote-modal-wrap" onclick="closeProductQuoteModalOnBackdrop(event)">
    <div class="product-quote-card">
        <button type="button" class="product-lightbox-close" style="color:#222; top:12px; right:15px;" onclick="closeProductQuoteModal()">&times;</button>
        <h3 style="font-family:'Teko',sans-serif; font-size:26px; color:#73001B; margin:0 0 6px 0;">Request Product Quotation</h3>
        <p style="font-size:13px; color:#666; margin:0 0 16px 0;">Submit your inquiry for <strong id="displayProdName" style="color:#000;">{{ $product->title }}</strong> and our commercial desk will reply promptly.</p>

        <form id="productQuoteForm" onsubmit="submitProductQuote(event)">
            @csrf
            <input type="hidden" name="product_name" id="modalProdName" value="{{ $product->title }}">
            <input type="hidden" name="product_slug" id="modalProdSlug" value="{{ $product->slug }}">

            <div style="margin-bottom:12px;">
                <label style="display:block; font-size:12px; font-weight:600; color:#333; margin-bottom:4px;">Full Name *</label>
                <input type="text" name="name" required style="width:100%; height:40px; border:1px solid #ddd; border-radius:4px; padding:0 12px; font-size:14px; box-sizing:border-box;">
            </div>
            <div style="display:flex; gap:10px; margin-bottom:12px;">
                <div style="flex:1;">
                    <label style="display:block; font-size:12px; font-weight:600; color:#333; margin-bottom:4px;">Email Address *</label>
                    <input type="email" name="email" required style="width:100%; height:40px; border:1px solid #ddd; border-radius:4px; padding:0 12px; font-size:14px; box-sizing:border-box;">
                </div>
                <div style="flex:1;">
                    <label style="display:block; font-size:12px; font-weight:600; color:#333; margin-bottom:4px;">Phone / WhatsApp *</label>
                    <input type="text" name="phone" required style="width:100%; height:40px; border:1px solid #ddd; border-radius:4px; padding:0 12px; font-size:14px; box-sizing:border-box;">
                </div>
            </div>
            <div style="display:flex; gap:10px; margin-bottom:12px;">
                <div style="flex:1;">
                    <label style="display:block; font-size:12px; font-weight:600; color:#333; margin-bottom:4px;">Country *</label>
                    <input type="text" name="country" required style="width:100%; height:40px; border:1px solid #ddd; border-radius:4px; padding:0 12px; font-size:14px; box-sizing:border-box;">
                </div>
                <div style="flex:1;">
                    <label style="display:block; font-size:12px; font-weight:600; color:#333; margin-bottom:4px;">Company Name</label>
                    <input type="text" name="company" style="width:100%; height:40px; border:1px solid #ddd; border-radius:4px; padding:0 12px; font-size:14px; box-sizing:border-box;">
                </div>
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:12px; font-weight:600; color:#333; margin-bottom:4px;">Inquiry / Quantity Details</label>
                <textarea name="message" rows="3" placeholder="Provide destination port, quantity (kg/MT), packing requirement..." style="width:100%; border:1px solid #ddd; border-radius:4px; padding:8px 12px; font-size:13.5px; box-sizing:border-box; font-family:inherit;"></textarea>
            </div>

            <div id="prodQuoteFormStatus" style="display:none; padding:10px; border-radius:4px; font-size:13px; margin-bottom:12px;"></div>

            <button type="submit" id="btnSubmitProdQuote" style="width:100%; height:44px; background:#73001B; color:#fff; font-size:15px; font-weight:600; border:none; border-radius:4px; cursor:pointer;">
                Submit Inquiry
            </button>
        </form>
    </div>
</div>

<script>
    function openProductLightbox(src) {
        var modal = document.getElementById('productLightbox');
        var img = document.getElementById('productLightboxImg');
        if (img && src) img.src = src;
        if (modal) modal.classList.add('active');
    }
    function closeProductLightbox() {
        var modal = document.getElementById('productLightbox');
        if (modal) modal.classList.remove('active');
    }
    function openProductQuoteModal(title, slug) {
        var modal = document.getElementById('productQuoteModal');
        var modalName = document.getElementById('modalProdName');
        var modalSlug = document.getElementById('modalProdSlug');
        var displayName = document.getElementById('displayProdName');
        if (title) {
            if (modalName) modalName.value = title;
            if (displayName) displayName.value = title;
        }
        if (slug && modalSlug) modalSlug.value = slug;
        if (modal) modal.style.display = 'flex';
    }
    function closeProductQuoteModal() {
        var modal = document.getElementById('productQuoteModal');
        if (modal) modal.style.display = 'none';
    }
    function closeProductQuoteModalOnBackdrop(e) {
        if (e.target && e.target.id === 'productQuoteModal') {
            closeProductQuoteModal();
        }
    }
    async function submitProductQuote(e) {
        e.preventDefault();
        var form = document.getElementById('productQuoteForm');
        var statusBox = document.getElementById('prodQuoteFormStatus');
        var btn = document.getElementById('btnSubmitProdQuote');
        if (!form) return;
        var formData = new FormData(form);
        btn.disabled = true;
        btn.textContent = 'Submitting...';
        statusBox.style.display = 'block';
        statusBox.style.background = '#eff6ff';
        statusBox.style.color = '#1e40af';
        statusBox.textContent = 'Sending your inquiry, please wait...';
        try {
            var response = await fetch('/inquiries', {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                body: formData
            });
            var data = await response.json();
            if (response.ok && data.success) {
                statusBox.style.background = '#dcfce7';
                statusBox.style.color = '#166534';
                statusBox.textContent = data.message || 'Thank you! Your quotation request has been sent.';
                form.reset();
                setTimeout(function() {
                    closeProductQuoteModal();
                    statusBox.style.display = 'none';
                }, 2500);
            } else {
                statusBox.style.background = '#fee2e2';
                statusBox.style.color = '#991b1b';
                statusBox.textContent = data.message || 'Failed to submit. Please check fields.';
            }
        } catch(err) {
            statusBox.style.background = '#fee2e2';
            statusBox.style.color = '#991b1b';
            statusBox.textContent = 'Network error. Please try again.';
        } finally {
            btn.disabled = false;
            btn.textContent = 'Submit Inquiry';
        }
    }
</script>
@endsection
