@extends('layouts.app')

@push('styles')
<style>
    /* Product Show Template 2712 Styles */
    .product-breadcrumb-wrap {
        background: #f6f6f6;
        padding: 14px 0;
        border-bottom: 1px solid #eaeaea;
    }
    .product-breadcrumb-container {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #333333;
    }
    .product-breadcrumb-container a {
        color: #000000;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .product-breadcrumb-container a:hover {
        color: #64141f;
    }
    .product-breadcrumb-container .separator {
        margin: 0 8px;
        color: #888888;
    }

    /* Main Section */
    .single-product-container {
        max-width: 1240px;
        margin: 35px auto 50px;
        padding: 0 20px;
    }
    .single-product-row {
        display: flex;
        flex-wrap: wrap;
        gap: 35px;
    }
    .product-main-column {
        flex: 1 1 720px;
        min-width: 0;
    }
    .product-sidebar-column {
        flex: 0 0 320px;
        max-width: 320px;
    }

    /* Titles & Subtitles */
    .single-product-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 26px;
        font-weight: 700;
        color: #000000;
        line-height: 1.35;
        margin: 0 0 8px 0;
    }
    .single-product-subtitle {
        font-family: 'Montserrat', sans-serif;
        font-size: 18px;
        font-weight: 600;
        color: #64141f;
        line-height: 1.4;
        margin: 0 0 16px 0;
    }
    .single-product-short-desc {
        font-family: 'Merriweather', serif;
        font-size: 16px;
        color: #444444;
        line-height: 1.75;
        margin-bottom: 22px;
    }

    /* Badges */
    .product-badge-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 25px;
    }
    .product-badge-pill {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        padding: 6px 12px;
        font-size: 13.5px;
        color: #334155;
    }
    .product-badge-pill strong {
        color: #0f172a;
    }

    /* Inner 2-column: Image & Actions */
    .product-media-action-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 35px;
    }
    .product-image-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 320px;
        text-align: center;
    }
    .product-image-box img {
        max-width: 100%;
        max-height: 290px;
        object-fit: contain;
        transition: transform 0.3s ease;
    }
    .product-image-box:hover img {
        transform: scale(1.03);
    }
    .product-action-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .btn-enquiry-primary {
        background: #64141f;
        color: #ffffff !important;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 28px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        display: block;
        width: 100%;
        text-align: center;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(100, 20, 31, 0.25);
        transition: all 0.25s ease;
        margin-bottom: 12px;
    }
    .btn-enquiry-primary:hover {
        background: #000000;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
    }
    .btn-whatsapp-action {
        background: #25d366;
        color: #ffffff !important;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 15px;
        text-transform: uppercase;
        padding: 12px 24px;
        border-radius: 4px;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background 0.25s ease;
        margin-bottom: 18px;
    }
    .btn-whatsapp-action:hover {
        background: #1ebe5d;
    }

    /* Table of Contents */
    .toc-container {
        background: #f9f9f9;
        border: 1px solid #e5e5e5;
        border-radius: 4px;
        padding: 16px 20px;
    }
    .toc-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: #000000;
        margin: 0 0 12px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .toc-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .toc-list li {
        margin-bottom: 8px;
        font-size: 13.5px;
        line-height: 1.4;
    }
    .toc-list a {
        color: #64141f;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .toc-list a:hover {
        color: #000000;
        text-decoration: underline;
    }

    /* Specifications Table */
    .product-section-block {
        margin-top: 35px;
        padding-top: 25px;
        border-top: 1px solid #eaeaea;
    }
    .block-heading {
        font-family: 'Montserrat', sans-serif;
        font-size: 21px;
        font-weight: 700;
        color: #000000;
        margin: 0 0 18px 0;
        position: relative;
    }
    .block-heading::after {
        content: "";
        display: block;
        width: 50px;
        height: 3px;
        background: #64141f;
        margin-top: 6px;
    }
    .tds-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        margin-bottom: 25px;
    }
    .tds-table th, .tds-table td {
        padding: 11px 16px;
        border: 1px solid #e2e8f0;
    }
    .tds-table th {
        background: #f8fafc;
        color: #0f172a;
        font-weight: 700;
        width: 32%;
        text-align: left;
    }
    .tds-table td {
        color: #334155;
    }
    .tds-table tr:nth-child(even) td {
        background: #fafbfc;
    }

    /* Product Content */
    .product-rich-text {
        font-family: 'Open Sans', sans-serif;
        font-size: 15px;
        color: #333333;
        line-height: 1.8;
    }
    .product-rich-text h2, .product-rich-text h3 {
        font-family: 'Montserrat', sans-serif;
        color: #111111;
        margin: 25px 0 12px 0;
    }
    .product-rich-text ul, .product-rich-text ol {
        padding-left: 20px;
        margin-bottom: 20px;
    }
    .product-rich-text li {
        margin-bottom: 8px;
    }

    /* Sidebar Bellows Accordion */
    .bellows-sidebar-header {
        background: #64141f;
        color: #ffffff;
        padding: 14px 20px;
        font-family: 'Montserrat', sans-serif;
        font-size: 17px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-radius: 4px 4px 0 0;
    }
    .bellows-sidebar-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 4px 4px;
        margin-bottom: 30px;
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
        padding: 12px 18px;
        font-family: 'Poppins', sans-serif;
        font-size: 14.5px;
        font-weight: 600;
        color: #1e293b;
        cursor: pointer;
        background: #ffffff;
        transition: background 0.2s ease, color 0.2s ease;
    }
    .bellows-header-row:hover {
        background: #f8fafc;
        color: #64141f;
    }
    .bellows-header-row a {
        color: inherit;
        text-decoration: none;
        flex-grow: 1;
    }
    .bellows-toggle-indicator {
        font-size: 16px;
        font-weight: bold;
        color: #64141f;
        width: 20px;
        text-align: center;
    }
    .bellows-sub-tree {
        list-style: none;
        margin: 0;
        padding: 0;
        background: #fcfcfc;
        border-top: 1px solid #f1f5f9;
    }
    .bellows-sub-tree li {
        border-bottom: 1px dashed #f1f5f9;
    }
    .bellows-sub-tree li:last-child {
        border-bottom: none;
    }
    .bellows-sub-tree a {
        display: block;
        padding: 9px 18px 9px 32px;
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        color: #475569;
        text-decoration: none;
        transition: color 0.2s ease, padding-left 0.2s ease;
    }
    .bellows-sub-tree a:hover,
    .bellows-sub-tree a.active {
        color: #64141f;
        padding-left: 36px;
        font-weight: 600;
    }

    /* Fast Consultation Sidebar Box */
    .sidebar-lead-card {
        background: #fdf2f3;
        border: 1px solid #fecdd3;
        border-radius: 6px;
        padding: 22px;
        text-align: center;
        margin-bottom: 25px;
    }
    .sidebar-lead-card h4 {
        font-family: 'Montserrat', sans-serif;
        font-size: 17px;
        font-weight: 700;
        color: #64141f;
        margin: 0 0 8px 0;
    }
    .sidebar-lead-card p {
        font-size: 13px;
        color: #555555;
        line-height: 1.5;
        margin: 0 0 15px 0;
    }
    .sidebar-lead-card .phone-link {
        font-size: 16px;
        font-weight: 700;
        color: #64141f;
        text-decoration: none;
        display: block;
        margin-bottom: 12px;
    }

    /* Related Products Section */
    .browse-related-section {
        background: #ffffff;
        padding: 50px 0 20px;
        border-top: 1px solid #eaeaea;
    }
    .browse-related-heading {
        font-family: 'Montserrat', sans-serif;
        font-size: 26px;
        font-weight: 700;
        color: #111111;
        text-align: center;
        margin: 0 0 35px 0;
    }
    .related-products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 22px;
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .related-product-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 16px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .related-product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    .related-product-card img {
        max-height: 130px;
        width: 100%;
        object-fit: contain;
        margin-bottom: 12px;
    }
    .related-product-card h3 {
        font-family: 'Montserrat', sans-serif;
        font-size: 14.5px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 6px 0;
        line-height: 1.35;
    }
    .related-product-card h3 a {
        color: inherit;
        text-decoration: none;
    }
    .related-product-card h3 a:hover {
        color: #64141f;
    }
    .related-product-card .cas-badge {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 14px;
    }
    .btn-view-product {
        background: #64141f;
        color: #ffffff !important;
        font-size: 12.5px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
        transition: background 0.2s ease;
    }
    .btn-view-product:hover {
        background: #000000;
    }

    /* Some Interesting Facts Section */
    .facts-section-block {
        background: #fdfbf7;
        border-top: 1px solid #f2ece1;
        border-bottom: 1px solid #f2ece1;
        padding: 50px 0;
        margin: 45px 0;
    }
    .facts-inner-container {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .facts-header {
        text-align: center;
        margin-bottom: 35px;
    }
    .facts-header h2 {
        font-family: 'Montserrat', sans-serif;
        font-size: 28px;
        margin: 0;
    }
    .facts-header .facts-accent {
        color: #64141f;
        font-weight: 700;
    }
    .facts-header .facts-dark {
        color: #111111;
        font-weight: 700;
    }
    .facts-counter-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }
    .facts-counter-card {
        background: #ffffff;
        border: 1px solid #fae8d8;
        border-radius: 8px;
        padding: 30px 20px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: transform 0.25s ease;
    }
    .facts-counter-card:hover {
        transform: translateY(-4px);
    }
    .facts-counter-card img {
        width: 64px;
        height: 64px;
        object-fit: contain;
        margin-bottom: 14px;
    }
    .facts-counter-number-wrap {
        display: flex;
        justify-content: center;
        align-items: baseline;
        gap: 2px;
        margin-bottom: 8px;
    }
    .facts-counter-number {
        font-family: 'Montserrat', sans-serif;
        font-size: 38px;
        font-weight: 700;
        color: #64141f;
        line-height: 1;
    }
    .facts-counter-suffix {
        font-family: 'Montserrat', sans-serif;
        font-size: 32px;
        font-weight: 700;
        color: #64141f;
        line-height: 1;
    }
    .facts-counter-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: #333333;
        text-transform: capitalize;
    }

    /* Industries We Serve Section */
    .industries-section-block {
        max-width: 1240px;
        margin: 45px auto 60px;
        padding: 0 20px;
    }
    .industries-header {
        font-family: 'Montserrat', sans-serif;
        font-size: 26px;
        font-weight: 700;
        color: #111111;
        text-align: center;
        margin: 0 0 35px 0;
    }
    .industries-cards-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
    }
    .industry-app-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        overflow: hidden;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .industry-app-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.08);
    }
    .industry-app-card a {
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .industry-app-card img {
        width: 100%;
        height: 130px;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }
    .industry-app-card:hover img {
        transform: scale(1.05);
    }
    .industry-app-card .app-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 13.5px;
        font-weight: 700;
        color: #111111;
        padding: 12px 8px;
        line-height: 1.3;
        transition: color 0.2s ease;
    }
    .industry-app-card:hover .app-title {
        color: #64141f;
    }

    /* Why SD International & Market Area (2 Columns) */
    .why-market-section-block {
        background: #f9fbfd;
        border-top: 1px solid #e2e8f0;
        padding: 50px 0;
    }
    .why-market-grid {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }
    .why-market-col h4 {
        font-family: 'Montserrat', sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 16px 0;
        position: relative;
    }
    .why-market-col h4::after {
        content: "";
        display: block;
        width: 45px;
        height: 3px;
        background: #64141f;
        margin-top: 6px;
    }
    .why-market-col ul {
        list-style: none;
        padding: 0;
        margin: 0 0 18px 0;
    }
    .why-market-col ul li {
        font-family: 'Open Sans', sans-serif;
        font-size: 14.5px;
        color: #334155;
        line-height: 1.6;
        margin-bottom: 10px;
        position: relative;
        padding-left: 24px;
    }
    .why-market-col ul li::before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #64141f;
        font-weight: bold;
    }
    .why-market-col p {
        font-family: 'Open Sans', sans-serif;
        font-size: 14px;
        color: #475569;
        line-height: 1.75;
        margin-bottom: 14px;
    }

    /* Disclaimer Section */
    .product-disclaimer-wrap {
        max-width: 1240px;
        margin: 40px auto 30px;
        padding: 20px;
        background: #ffffff;
        border-top: 1px solid #eaeaea;
        font-family: 'Open Sans', sans-serif;
        font-size: 12.5px;
        color: #777777;
        line-height: 1.7;
    }
    .product-disclaimer-wrap p {
        margin-bottom: 12px;
    }

    /* Modal Overlay & Card */
    .quote-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.65);
        z-index: 999999;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .quote-modal-card {
        background: #ffffff;
        border-radius: 8px;
        max-width: 520px;
        width: 100%;
        padding: 30px;
        position: relative;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        max-height: 90vh;
        overflow-y: auto;
    }
    .quote-modal-close {
        position: absolute;
        top: 16px;
        right: 18px;
        font-size: 24px;
        font-weight: 700;
        color: #888888;
        cursor: pointer;
        line-height: 1;
        background: transparent;
        border: none;
    }
    .quote-modal-close:hover {
        color: #64141f;
    }
    .quote-form-group {
        margin-bottom: 14px;
    }
    .quote-form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 5px;
    }
    .quote-form-group input,
    .quote-form-group textarea,
    .quote-form-group select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        font-size: 14px;
        font-family: inherit;
        box-sizing: border-box;
    }
    .quote-form-group input:focus,
    .quote-form-group textarea:focus {
        border-color: #64141f;
        outline: none;
    }

    /* Mobile Responsiveness */
    @media (max-width: 991px) {
        .single-product-row {
            flex-direction: column;
        }
        .product-sidebar-column {
            max-width: 100%;
            flex: 1 1 100%;
        }
        .product-media-action-grid {
            grid-template-columns: 1fr;
        }
        .facts-counter-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .industries-cards-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .why-market-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }
    }
    @media (max-width: 575px) {
        .single-product-title {
            font-size: 21px;
        }
        .single-product-subtitle {
            font-size: 16px;
        }
        .industries-cards-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
@php
    $primaryCat = $product->categories->first();
@endphp

<!-- Section 1: Breadcrumbs -->
<div class="product-breadcrumb-wrap">
    <div class="product-breadcrumb-container">
        <a href="/">Home</a>
        <span class="separator">/</span>
        @if($primaryCat)
            <a href="/{{ $primaryCat->slug }}">{{ $primaryCat->name }}</a>
            <span class="separator">/</span>
        @else
            <a href="/products">Products</a>
            <span class="separator">/</span>
        @endif
        <span>{{ $product->title }}</span>
    </div>
</div>

<!-- Section 2: Main Product Information & Right Sidebar -->
<div class="single-product-container">
    <div class="single-product-row">
        <!-- Main Product Column (Left 72%) -->
        <main class="product-main-column">
            <h1 class="single-product-title">{{ $product->title }}</h1>
            <h3 class="single-product-subtitle">Suppliers and Exporter of {{ $product->title }}</h3>

            <div class="product-badge-group">
                @if($product->cas_number)
                    <div class="product-badge-pill">CAS No: <strong>{{ $product->cas_number }}</strong></div>
                @endif
                @if($product->ci_number)
                    <div class="product-badge-pill">C.I. Number: <strong>{{ $product->ci_number }}</strong></div>
                @endif
                @if($product->relative_name)
                    <div class="product-badge-pill">Relative Name: <strong>{{ $product->relative_name }}</strong></div>
                @endif
                @if($product->molecular_weight)
                    <div class="product-badge-pill">Mol Weight: <strong>{{ $product->molecular_weight }}</strong></div>
                @endif
                @if($product->physical_appearance)
                    <div class="product-badge-pill">Appearance: <strong>{{ $product->physical_appearance }}</strong></div>
                @endif
            </div>

            <div class="single-product-short-desc">
                @if($product->short_description)
                    {!! $product->short_description !!}
                @else
                    <p>
                        Buy high purity <strong>{{ $product->title }}</strong> from S D International — premier manufacturer, exporter, and global supplier in Mumbai, India. Backed by rigorous quality control, modern manufacturing standards, and swift worldwide delivery.
                    </p>
                @endif
            </div>

            <!-- Inner Grid: Image & Action / TOC -->
            <div class="product-media-action-grid">
                <div class="product-image-box">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->title }} - SD International">
                    @else
                        <img src="https://sdinternational.com/wp-content/uploads/2020/07/logo.png" alt="{{ $product->title }}" style="max-height: 80px; opacity: 0.85;">
                    @endif
                </div>

                <div class="product-action-card">
                    <div>
                        <button type="button" class="btn-enquiry-primary" onclick="openQuoteModal('{{ addslashes($product->title) }}', '{{ $product->slug }}')">
                            Enquiry Now
                        </button>
                        <a href="https://api.whatsapp.com/send?phone=919920669561&text=Hello%20SD%20International,%20I%20am%20interested%20in%20{{ urlencode($product->title) }}%20(CAS%20{{ $product->cas_number }}).%20Please%20share%20pricing%20and%20COA." class="btn-whatsapp-action" target="_blank" rel="noopener noreferrer">
                            <span>💬 Contact on WhatsApp</span>
                        </a>
                    </div>

                    <div class="toc-container">
                        <div class="toc-title">
                            <span>📑 Table of Contents</span>
                        </div>
                        <ul class="toc-list">
                            <li><a href="#specifications">1. Technical Data Sheet (TDS)</a></li>
                            <li><a href="#description">2. Product Applications & Overview</a></li>
                            <li><a href="#related-products">3. Browse Related Products</a></li>
                            <li><a href="#interesting-facts">4. Some Interesting Facts</a></li>
                            <li><a href="#industries">5. Industries We Serve</a></li>
                            <li><a href="#why-sd">6. Why SD International</a></li>
                            <li><a href="#market-area">7. Market Area & Export Reach</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Technical Specifications Table -->
            <div id="specifications" class="product-section-block">
                <h2 class="block-heading">Technical Specifications (TDS)</h2>
                <table class="tds-table">
                    <tbody>
                        <tr>
                            <th>Product Name</th>
                            <td><strong>{{ $product->title }}</strong></td>
                        </tr>
                        @if($product->cas_number)
                        <tr>
                            <th>CAS Registry Number</th>
                            <td>{{ $product->cas_number }}</td>
                        </tr>
                        @endif
                        @if($product->ci_number)
                        <tr>
                            <th>Colour Index (C.I.)</th>
                            <td>{{ $product->ci_number }}</td>
                        </tr>
                        @endif
                        @if($product->relative_name)
                        <tr>
                            <th>Relative / Commercial Name</th>
                            <td>{{ $product->relative_name }}</td>
                        </tr>
                        @endif
                        @if($product->molecular_weight)
                        <tr>
                            <th>Molecular Weight</th>
                            <td>{{ $product->molecular_weight }}</td>
                        </tr>
                        @endif
                        @if($product->physical_appearance)
                        <tr>
                            <th>Physical Appearance</th>
                            <td>{{ $product->physical_appearance }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Category / Classification</th>
                            <td>{{ $primaryCat ? $primaryCat->name : 'Industrial Chemical / Dyes & Pigments' }}</td>
                        </tr>
                        <tr>
                            <th>Quality Assurance</th>
                            <td>ISO 9001:2015 Certified Manufacturing Facility</td>
                        </tr>
                        <tr>
                            <th>Standard Packaging</th>
                            <td>25 Kg HDPE Bags / Fibre Drums / Custom Export Palletized Cargo</td>
                        </tr>
                        <tr>
                            <th>Export Dispatch Port</th>
                            <td>Nhava Sheva (JNPT) Mumbai, India / Air Cargo Mumbai</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Product Description / Applications -->
            <div id="description" class="product-section-block">
                <h2 class="block-heading">Product Overview & Applications</h2>
                <div class="product-rich-text">
                    @if($product->description)
                        {!! $product->description !!}
                    @else
                        <p>
                            <strong>{{ $product->title }}</strong> manufactured and supplied by <strong>S D International</strong> complies with international chemical quality specifications. Specially engineered for consistent purity, high coloring strength, superior light and heat fastness, and compatibility with diversified industrial processing formulations.
                        </p>
                        <h3>Key Features & Industrial Value</h3>
                        <ul>
                            <li>Strict batch-to-batch consistency verified through comprehensive spectroscopic analysis.</li>
                            <li>High concentration and rapid dispersibility in standard industrial carrier systems.</li>
                            <li>Excellent thermal, chemical, and atmospheric fastness.</li>
                            <li>Full compliance with REACH and export environmental safety guidelines.</li>
                        </ul>
                    @endif
                </div>
            </div>
        </main>

        <!-- Sidebar Column (Right 28%) -->
        <aside class="product-sidebar-column">
            <!-- Products Range Accordion Header -->
            <div class="bellows-sidebar-header">
                Products Range
            </div>

            <!-- Bellows Accordion Body -->
            <div class="bellows-sidebar-card">
                <ul class="bellows-tree-root">
                    <!-- DYES -->
                    <li class="bellows-tree-item">
                        <div class="bellows-header-row" onclick="toggleAccordion('bellows-dyes')">
                            <a href="/dyes/">DYES</a>
                            <span id="indicator-bellows-dyes" class="bellows-toggle-indicator">−</span>
                        </div>
                        <ul id="bellows-dyes" class="bellows-sub-tree" style="display: block;">
                            <li><a href="/basic-dyes/" class="{{ request()->is('basic-dyes*') ? 'active' : '' }}">Basic Dyes</a></li>
                            <li><a href="/disperse-dyes/" class="{{ request()->is('disperse-dyes*') ? 'active' : '' }}">Disperse Dyes</a></li>
                            <li><a href="/solvent-dyes/" class="{{ request()->is('solvent-dyes*') ? 'active' : '' }}">Solvent Dyes</a></li>
                            <li><a href="/vat-dyes/" class="{{ request()->is('vat-dyes*') ? 'active' : '' }}">Vat Dyes</a></li>
                            <li><a href="/acid-dyes/" class="{{ request()->is('acid-dyes*') ? 'active' : '' }}">Acid Dyes</a></li>
                            <li><a href="/cationic-dyes/" class="{{ request()->is('cationic-dyes*') ? 'active' : '' }}">Cationic Dyes</a></li>
                            <li><a href="/direct-dyes/" class="{{ request()->is('direct-dyes*') ? 'active' : '' }}">Direct Dyes</a></li>
                            <li><a href="/reactive-dyes/" class="{{ request()->is('reactive-dyes*') ? 'active' : '' }}">Reactive Dyes</a></li>
                            <li><a href="/metal-complex-solvent-dyes/" class="{{ request()->is('metal-complex-solvent-dyes*') ? 'active' : '' }}">Metal Complex Solvent Dyes</a></li>
                        </ul>
                    </li>

                    <!-- FD & C COLOURS -->
                    <li class="bellows-tree-item">
                        <div class="bellows-header-row">
                            <a href="/f-d-c-colours/">FD &amp; C COLOURS</a>
                            <span style="color: #888; font-size: 14px;">→</span>
                        </div>
                    </li>

                    <!-- PIGMENTS -->
                    <li class="bellows-tree-item">
                        <div class="bellows-header-row" onclick="toggleAccordion('bellows-pigments')">
                            <a href="/pigments/">PIGMENTS</a>
                            <span id="indicator-bellows-pigments" class="bellows-toggle-indicator">+</span>
                        </div>
                        <ul id="bellows-pigments" class="bellows-sub-tree" style="display: none;">
                            <li><a href="/organic-pigments/">Organic Pigments</a></li>
                            <li><a href="/high-performance-pigments/">High Performance Pigments</a></li>
                            <li><a href="/fluorescent-pigments/">Fluorescent Pigments</a></li>
                            <li><a href="/pu-foam-pigments/">Pu Foam Pigments</a></li>
                            <li><a href="/ultra-marine-pigments/">Ultramarine Pigments</a></li>
                        </ul>
                    </li>

                    <!-- OTHER PRODUCTS -->
                    <li class="bellows-tree-item">
                        <div class="bellows-header-row" onclick="toggleAccordion('bellows-other')">
                            <a href="/other-products/">OTHER PRODUCTS</a>
                            <span id="indicator-bellows-other" class="bellows-toggle-indicator">+</span>
                        </div>
                        <ul id="bellows-other" class="bellows-sub-tree" style="display: none;">
                            <li><a href="/naphthols/">Naphthols</a></li>
                            <li><a href="/fast-colour-bases/">Fast Colour Bases</a></li>
                            <li><a href="/fast-colour-salts/">Fast Colour Salts</a></li>
                            <li><a href="/pyrazolone-intermediates/">Pyrazolone Intermediates</a></li>
                            <li><a href="/auxiliaries/">Auxiliaries</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Quick Inquiry Box in Sidebar -->
            <div class="sidebar-lead-card">
                <h4>Need Custom Specifications?</h4>
                <p>Speak directly with our technical laboratory and export desk in Mumbai.</p>
                <a href="tel:+919920669561" class="phone-link">📞 +91 99206 69561</a>
                <button type="button" class="btn-enquiry-primary" onclick="openQuoteModal('{{ addslashes($product->title) }}', '{{ $product->slug }}')">
                    Request Quotation
                </button>
            </div>
        </aside>
    </div>
</div>

<!-- Section 3: Related Products -->
@if($relatedProducts->isNotEmpty())
<section id="related-products" class="browse-related-section">
    <h2 class="browse-related-heading">Browse Related Products offered by SD International</h2>
    <div class="related-products-grid">
        @foreach($relatedProducts as $rel)
        <div class="related-product-card">
            <a href="/{{ $rel->slug }}">
                @if($rel->image_url)
                    <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" loading="lazy">
                @else
                    <img src="https://sdinternational.com/wp-content/uploads/2020/07/logo.png" alt="{{ $rel->title }}" style="max-height: 50px; opacity: 0.7; padding: 25px 0;">
                @endif
            </a>
            <div>
                <h3><a href="/{{ $rel->slug }}">{{ $rel->title }}</a></h3>
                @if($rel->cas_number)
                    <div class="cas-badge">CAS: {{ $rel->cas_number }}</div>
                @endif
            </div>
            <div>
                <a href="/{{ $rel->slug }}" class="btn-view-product">View Product</a>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

<!-- Section 3B: Some Interesting Facts (Elementor Template 2824) -->
<section id="interesting-facts" class="facts-section-block">
    <div class="facts-inner-container">
        <div class="facts-header">
            <h2>
                <span class="facts-accent">Some Interesting</span>
                <span class="facts-dark">Facts</span>
            </h2>
        </div>
        <div class="facts-counter-grid">
            <div class="facts-counter-card">
                <img src="/uploads/2020/07/chemistry.png" alt="Dyes & Chemicals">
                <div class="facts-counter-number-wrap">
                    <span class="facts-counter-number pp-counter-number" data-from="0" data-to="700" data-speed="1500">700</span>
                    <span class="facts-counter-suffix">+</span>
                </div>
                <div class="facts-counter-title">Dyes &amp; Chemicals</div>
            </div>

            <div class="facts-counter-card">
                <img src="/uploads/2020/07/bring.png" alt="Happy Clients">
                <div class="facts-counter-number-wrap">
                    <span class="facts-counter-number pp-counter-number" data-from="0" data-to="300" data-speed="1500">300</span>
                    <span class="facts-counter-suffix">+</span>
                </div>
                <div class="facts-counter-title">Happy Clients</div>
            </div>

            <div class="facts-counter-card">
                <img src="/uploads/2020/07/maps-and-flags.png" alt="Countries around the world">
                <div class="facts-counter-number-wrap">
                    <span class="facts-counter-number pp-counter-number" data-from="0" data-to="50" data-speed="1500">50</span>
                </div>
                <div class="facts-counter-title">Countries around the world</div>
            </div>
        </div>
    </div>
</section>

<!-- Section 3C: Industries We Serve -->
<section id="industries" class="industries-section-block">
    <h2 class="industries-header">Industries We Serve</h2>
    <div class="industries-cards-grid">
        <div class="industry-app-card">
            <a href="/applications/plastic-polymers/">
                <img src="/uploads/applications/plastics.jpg" alt="Plastic & Polymers" loading="lazy">
                <div class="app-title">Plastic &amp; Polymers</div>
            </a>
        </div>
        <div class="industry-app-card">
            <a href="/applications/textiles/">
                <img src="/uploads/applications/textile.jpg" alt="Textiles" loading="lazy">
                <div class="app-title">Textiles</div>
            </a>
        </div>
        <div class="industry-app-card">
            <a href="/applications/leather/">
                <img src="/uploads/applications/lather.jpg" alt="Leather" loading="lazy">
                <div class="app-title">Leather</div>
            </a>
        </div>
        <div class="industry-app-card">
            <a href="/applications/petroleum-lubricants/">
                <img src="/uploads/applications/petro.jpg" alt="Petroleum & Lubricants" loading="lazy">
                <div class="app-title">Petroleum &amp; Lubricants</div>
            </a>
        </div>
        <div class="industry-app-card">
            <a href="/applications/paper-pulp/">
                <img src="/uploads/applications/papper.jpg" alt="Paper & Pulp" loading="lazy">
                <div class="app-title">Paper &amp; Pulp</div>
            </a>
        </div>

        <div class="industry-app-card">
            <a href="/applications/printing-inks/">
                <img src="/uploads/applications/ink.jpg" alt="Printing Inks" loading="lazy">
                <div class="app-title">Printing Inks</div>
            </a>
        </div>
        <div class="industry-app-card">
            <a href="/applications/food-drug-cosmetics/">
                <img src="/uploads/applications/food_drug_cos.jpg" alt="Food Drug & Cosmetics" loading="lazy">
                <div class="app-title">Food Drug &amp; Cosmetics</div>
            </a>
        </div>
        <div class="industry-app-card">
            <a href="/applications/coatings/">
                <img src="/uploads/applications/coatings.jpg" alt="Coatings" loading="lazy">
                <div class="app-title">Coatings</div>
            </a>
        </div>
        <div class="industry-app-card">
            <a href="/applications/wood-stains/">
                <img src="/uploads/applications/wood_stain.jpg" alt="Wood Stains" loading="lazy">
                <div class="app-title">Wood Stains</div>
            </a>
        </div>
        <div class="industry-app-card">
            <a href="/applications/smoke-dyes/">
                <img src="/uploads/applications/smoke.jpg" alt="Smoke Dyes" loading="lazy">
                <div class="app-title">Smoke Dyes</div>
            </a>
        </div>

        <div class="industry-app-card">
            <a href="/applications/pigment-intermediates/">
                <img src="/uploads/applications/pigmanets_intermediates_app.jpg" alt="Pigment Intermediates" loading="lazy">
                <div class="app-title">Pigment Intermediates</div>
            </a>
        </div>
        <div class="industry-app-card">
            <a href="/applications/wax/">
                <img src="/uploads/applications/wax.jpg" alt="Wax" loading="lazy">
                <div class="app-title">Wax</div>
            </a>
        </div>
        <div class="industry-app-card">
            <a href="/applications/rubber/">
                <img src="/uploads/applications/rubberq.jpg" alt="Rubber" loading="lazy">
                <div class="app-title">Rubber</div>
            </a>
        </div>
        <div class="industry-app-card">
            <a href="/applications/glass/">
                <img src="/uploads/applications/glass.jpg" alt="Glass" loading="lazy">
                <div class="app-title">Glass</div>
            </a>
        </div>
        <div class="industry-app-card">
            <a href="/applications/intermediates/">
                <img src="/uploads/applications/interm.jpg" alt="Intermediates" loading="lazy">
                <div class="app-title">Intermediates</div>
            </a>
        </div>
    </div>
</section>

<!-- Section 4: Why SD International & Market Area -->
<section id="why-sd" class="why-market-section-block">
    <div class="why-market-grid">
        <div class="why-market-col">
            <h4>Why SD International</h4>
            <ul>
                <li>More than 50 years of rich industry experience.</li>
                <li>Wide product range of high purity chemicals.</li>
                <li>Leading exporter of dyeing and auxiliaries' chemicals.</li>
                <li>Focus is to create trustworthy and responsive relationships.</li>
                <li>Reliable and dependable service with batch-to-batch consistency.</li>
                <li>Great value, premium quality products, and huge range in stock.</li>
                <li>Chemicals and services we provide achieve consistent standards and exceed your expectations.</li>
                <li>Vast knowledge of colour and colouration allows us to tailor our products to your exact needs.</li>
            </ul>
            <p>
                SD International is committed to customer fulfilment by delivering best quality chemical substances and compounds at competitive market prices. We offer these product categories to companies in the sector of plastics, paints and printing inks, textile, food colouring, pharmaceuticals, wood, leather factories, and paper mills across markets to several destinations worldwide.
            </p>
        </div>

        <div id="market-area" class="why-market-col">
            <h4>Market Area of SD International</h4>
            <p><strong>SD International supply and export to listed Countries:</strong></p>
            <p>
                <strong>China</strong> – <strong>Ningbo</strong> – <strong>Shanghai</strong> – <strong>Guangzhou</strong> | Bangladesh | Brazil | Egypt | Gambia | Germany | Ghana | Guinea | Conakry | Honduras | Indonesia | Israel | Italy | Japan | Mali | Mauritania | Mexico | Myanmar | Netherlands | Poland | Peru | Singapore | South Korea | Taiwan | UAE | Uganda | UK | USA | Vietnam | Argentina | Malaysia | Thailand | Turkey | Iran | Spain | Kenya
            </p>
            <p>
                Thank you for visiting SD International's website. Do you have any questions or need any help with our products and their applications to your requirements? Contact us at <strong>+91 99206 69561</strong> or use our Enquiry Form.
            </p>
        </div>
    </div>
</section>

<!-- Section 5: Disclaimer & Keywords Block -->
<div class="product-disclaimer-wrap">
    <p>
        <strong>Manufacturer, Supplier, Importer, Exporter, Dealer, Distributor &amp; Service Provider of Industrial Chemicals:</strong> Industrial Chemicals, Pharma Excipients, Pharma Raw material importer, Pharmaceutical, Active Pharmaceutical Ingredients, Bulk Drugs, Industrial Acid &amp; Salts, Agriculture Chemicals, Food chemicals, Phase Transfer Catalyst, Quats, Fine Chemicals, Epoxy Coating chemicals, Construction Chemicals, Cosmetic Chemicals, Oil field chemicals, Water Treatment Chemicals, Swimming Pool Chemicals, Chlorinated Intermediates, Gujarat, Mumbai, India.
    </p>
    <p>
        <strong>Note :</strong> Please note that the information on this document is for illustration purposes only as information may vary with individual chemical compounds and their purity, concentration and application subjects and therefore cannot be guaranteed as accurate. &copy; Copyright 2026 &copy; SD International. All Rights Reserved. Please contact us to discuss precise product specifications and requirements: <a href="mailto:info@sdinternational.com" style="color: #64141f; text-decoration: none;">info@sdinternational.com</a>
    </p>
</div>

<!-- Modal Dialog for Quotation / Enquiry -->
<div id="quoteModal" class="quote-modal-overlay" onclick="closeQuoteModalOnBackdrop(event)">
    <div class="quote-modal-card">
        <button type="button" class="quote-modal-close" onclick="closeQuoteModal()">&times;</button>
        <h3 style="font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: 700; color: #64141f; margin: 0 0 6px 0;">Request Product Quotation</h3>
        <p style="font-size: 13.5px; color: #666666; margin: 0 0 20px 0;">Submit your inquiry and our commercial sales desk will respond within 24 hours.</p>

        <form id="productQuoteForm" onsubmit="submitProductQuote(event)">
            @csrf
            <input type="hidden" id="modalProductName" name="product_name" value="{{ $product->title }}">
            <input type="hidden" id="modalProductSlug" name="product_slug" value="{{ $product->slug }}">

            <div class="quote-form-group">
                <label>Product</label>
                <input type="text" id="displayProductName" value="{{ $product->title }}" disabled style="background: #f1f5f9; font-weight: 600;">
            </div>

            <div class="quote-form-group">
                <label for="quoteName">Full Name *</label>
                <input type="text" id="quoteName" name="name" required placeholder="Your name">
            </div>

            <div class="quote-form-group">
                <label for="quoteEmail">Business Email *</label>
                <input type="email" id="quoteEmail" name="email" required placeholder="name@company.com">
            </div>

            <div class="quote-form-group">
                <label for="quotePhone">Phone / WhatsApp Number *</label>
                <input type="tel" id="quotePhone" name="phone" required placeholder="+91 99206 69561">
            </div>

            <div class="quote-form-group">
                <label for="quoteQuantity">Required Quantity (Kg / Tons)</label>
                <input type="text" id="quoteQuantity" name="quantity" placeholder="e.g. 500 Kg, 2 MT">
            </div>

            <div class="quote-form-group">
                <label for="quoteMessage">Specifications / Application Notes</label>
                <textarea id="quoteMessage" name="message" rows="3" placeholder="Please mention destination port, grade requirements, or target delivery date."></textarea>
            </div>

            <div id="quoteFormStatus" style="display: none; padding: 10px; margin-bottom: 12px; font-size: 13.5px; border-radius: 4px;"></div>

            <button type="submit" id="btnSubmitQuote" class="btn-enquiry-primary" style="margin-bottom: 0;">
                Send Inquiry Now
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Accordion Toggle for Bellows Sidebar
    function toggleAccordion(id) {
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
    function openQuoteModal(productTitle, productSlug) {
        const modal = document.getElementById('quoteModal');
        const modalName = document.getElementById('modalProductName');
        const modalSlug = document.getElementById('modalProductSlug');
        const displayName = document.getElementById('displayProductName');
        const statusBox = document.getElementById('quoteFormStatus');

        if (productTitle && displayName) {
            displayName.value = productTitle;
            if (modalName) modalName.value = productTitle;
            if (modalSlug) modalSlug.value = productSlug;
        }
        if (statusBox) statusBox.style.display = 'none';
        if (modal) modal.style.display = 'flex';
    }

    function closeQuoteModal() {
        const modal = document.getElementById('quoteModal');
        if (modal) modal.style.display = 'none';
    }

    function closeQuoteModalOnBackdrop(e) {
        if (e.target && e.target.id === 'quoteModal') {
            closeQuoteModal();
        }
    }

    async function submitProductQuote(e) {
        e.preventDefault();
        const form = document.getElementById('productQuoteForm');
        const btn = document.getElementById('btnSubmitQuote');
        const statusBox = document.getElementById('quoteFormStatus');
        const formData = new FormData(form);

        btn.disabled = true;
        btn.textContent = 'Submitting Inquiry...';

        try {
            const res = await fetch('/inquiries', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData
            });

            const data = await res.json();
            if (res.ok) {
                statusBox.style.display = 'block';
                statusBox.style.background = '#ecfdf5';
                statusBox.style.color = '#065f46';
                statusBox.style.border = '1px solid #a7f3d0';
                statusBox.textContent = data.message || 'Thank you! Your inquiry has been received. Our team will contact you shortly.';
                form.reset();
                setTimeout(() => { closeQuoteModal(); }, 3500);
            } else {
                statusBox.style.display = 'block';
                statusBox.style.background = '#fef2f2';
                statusBox.style.color = '#991b1b';
                statusBox.style.border = '1px solid #fecaca';
                statusBox.textContent = data.message || 'Please check the required fields and try again.';
            }
        } catch (err) {
            statusBox.style.display = 'block';
            statusBox.style.background = '#fef2f2';
            statusBox.style.color = '#991b1b';
            statusBox.style.border = '1px solid #fecaca';
            statusBox.textContent = 'An error occurred while submitting. Please contact us via WhatsApp or Phone.';
        } finally {
            btn.disabled = false;
            btn.textContent = 'Send Inquiry Now';
        }
    }
</script>
@endpush
