@extends('layouts.app')

@section('content')
<style>
    /* ==========================================================================
       SD International - Single Product Template (Elementor 2712)
       Replicated 1:1 from https://sdinternational.com/basic-blue-11-bluer-dyes/
       ========================================================================== */

    .product-page-wrap {
        background: #ffffff;
        color: #000000;
        font-family: 'Poppins', sans-serif;
        width: 100%;
        overflow-x: hidden;
    }

    .product-full-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0 30px;
        box-sizing: border-box;
    }

    /* 1. Full-Width Breadcrumb Bar */
    .product-breadcrumb-bar {
        background-color: #F6F6F6;
        padding: 12px 0;
        border-bottom: 1px solid #eeeeee;
    }

    .product-breadcrumb-nav {
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        color: #222222;
        margin: 0;
        line-height: 1.5;
    }

    .product-breadcrumb-nav a {
        color: #000000;
        text-decoration: none;
        transition: color 0.2s;
    }

    .product-breadcrumb-nav a:hover {
        color: #73001B;
    }

    .product-breadcrumb-nav .delim {
        margin: 0 6px;
        color: #666666;
    }

    /* 2. Main 2-Column Section (80% Left / 20% Right Sidebar) */
    .product-main-section {
        padding: 24px 0 35px;
    }

    .product-main-grid {
        display: grid;
        grid-template-columns: minmax(0, 80%) minmax(0, 20%);
        gap: 28px;
        align-items: start;
    }

    /* Left Column: Title & Subtitle */
    .single-product-h1 {
        font-family: 'Teko', 'Montserrat', sans-serif !important;
        font-size: 38px !important;
        font-weight: 600 !important;
        color: #000000 !important;
        line-height: 1.08 !important;
        margin: 0 0 4px 0 !important;
        letter-spacing: 0.3px;
    }

    .single-product-subtitle {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        font-style: italic;
        color: #73001B;
        margin: 0 0 18px 0;
        line-height: 1.4;
    }

    /* Short Description Rounded Card */
    .product-short-desc-card {
        background: #FAFAFA;
        border-radius: 14px;
        padding: 24px 28px;
        margin-bottom: 26px;
        font-family: 'Merriweather', Georgia, serif;
        font-size: 17px;
        line-height: 1.82;
        color: #000000;
    }

    .product-short-desc-card p {
        margin: 0 0 18px 0;
        color: #000000;
    }

    .product-short-desc-card p:last-child {
        margin-bottom: 0;
    }

    /* Inner 2-Column Row: Product Swatch Image + Enquiry & TOC */
    .product-media-toc-row {
        display: grid;
        grid-template-columns: 373px minmax(0, 1fr);
        gap: 26px;
        align-items: start;
        margin-bottom: 32px;
    }

    /* Interactive Zoomable Swatch Box */
    .product-gallery-stage {
        position: relative;
        width: 373px;
        max-width: 100%;
        aspect-ratio: 1 / 1;
        border-radius: 16px;
        overflow: hidden;
        background: #f5f5f5;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        cursor: zoom-in;
    }

    .product-gallery-stage img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.25s ease-out;
        transform-origin: center center;
    }

    .product-gallery-stage:hover img {
        transform: scale(1.22);
    }

    .product-zoom-trigger {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #ffffff;
        color: #111111;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18);
        transition: transform 0.2s, background 0.2s, color 0.2s;
        z-index: 5;
        padding: 0;
    }

    .product-zoom-trigger:hover {
        transform: scale(1.08);
        background: #73001B;
        color: #ffffff;
    }

    /* Right of Swatch: Compact Enquiry Button + Borderless Bulleted TOC */
    .product-enquiry-toc-col {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .btn-product-enquiry {
        display: inline-block;
        padding: 11px 32px;
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: #ffffff !important;
        background-image: linear-gradient(180deg, #951634 0%, #73001B 100%);
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(115, 0, 27, 0.28);
        transition: opacity 0.2s, transform 0.2s;
        margin-bottom: 22px;
    }

    .btn-product-enquiry:hover {
        opacity: 0.94;
        transform: translateY(-1px);
    }

    .product-toc-box {
        width: 100%;
    }

    .product-toc-heading {
        font-family: 'Poppins', sans-serif !important;
        font-size: 18px !important;
        font-weight: 700 !important;
        color: #000000 !important;
        margin: 0 0 12px 0 !important;
    }

    .product-toc-list {
        list-style-type: disc;
        margin: 0;
        padding-left: 18px;
    }

    .product-toc-list li {
        margin-bottom: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        line-height: 1.45;
        color: #111111;
    }

    .product-toc-list li a {
        color: #111111;
        text-decoration: none;
        transition: color 0.15s;
    }

    .product-toc-list li a:hover {
        color: #73001B;
        text-decoration: underline;
    }

    /* Rich Product Content Section (Matches Elementor 2712 & 11806) */
    .product-rich-content {
        margin-top: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        line-height: 1.78;
        color: #111111;
    }

    .product-rich-content h2,
    .product-rich-content h3,
    .product-rich-content h4 {
        font-family: 'Teko', 'Montserrat', sans-serif;
        font-size: 29px;
        font-weight: 600;
        color: #73001B;
        line-height: 1.15;
        margin: 26px 0 10px 0;
        scroll-margin-top: 90px;
        letter-spacing: 0.3px;
    }

    .product-rich-content p {
        margin: 0 0 14px 0;
        color: #111111;
    }

    .product-rich-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 12px 0 16px 0;
        background: #ffffff;
        font-size: 14.5px;
    }

    .product-rich-content table td,
    .product-rich-content table th {
        border: 1px solid #e2e8f0;
        padding: 12px 16px;
        color: #111111;
        text-align: left;
    }

    .product-rich-content table td:last-child {
        width: 150px;
    }

    .inline-enquiry-link {
        color: #73001B;
        text-decoration: underline;
        font-weight: 700;
        cursor: pointer;
    }

    .inline-enquiry-link:hover {
        color: #000000;
    }

    /* Gold Gradient CTA Callout Banner (Elementor Section 11806) */
    .product-gold-cta-banner {
        background: linear-gradient(180deg, #C7A46C 0%, #9E783B 100%);
        color: #ffffff;
        border-radius: 14px;
        padding: 22px 26px;
        margin: 24px 0 26px 0;
        font-family: 'Poppins', sans-serif;
        font-size: 19px;
        font-weight: 400;
        line-height: 1.55;
        box-shadow: 0 3px 10px rgba(158, 120, 59, 0.25);
    }

    .product-gold-cta-banner a {
        color: #ffffff;
        font-weight: 600;
        text-decoration: none;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.65);
    }

    .product-gold-cta-banner a:hover {
        border-bottom-style: solid;
    }

    /* Authentic Red Adobe-style Download PDF Button */
    .sd-download-pdf-btn {
        display: inline-flex;
        align-items: center;
        vertical-align: middle;
        margin-left: 8px;
        background: linear-gradient(180deg, #C62828 0%, #8B0000 100%);
        color: #ffffff !important;
        text-decoration: none !important;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 3px 8px rgba(139, 0, 0, 0.32);
        border: 1px solid #7f0000;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .sd-download-pdf-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(139, 0, 0, 0.42);
        color: #ffffff !important;
    }

    .sd-pdf-icon-box {
        background: #ffffff;
        color: #B71C1C;
        padding: 5px 8px;
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 800;
        line-height: 1;
        gap: 2px;
        border-right: 1px solid #e5e7eb;
    }

    .sd-pdf-label {
        padding: 8px 16px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.2px;
        color: #ffffff;
    }

    /* Right Sidebar: Products Range Bellows Accordion */
    .bellows-sidebar-header {
        background-image: linear-gradient(180deg, #941533 0%, #74001B 100%);
        color: #ffffff;
        padding: 12px 18px;
        font-family: 'Poppins', sans-serif;
        font-size: 17px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 3px 3px 0 0;
        letter-spacing: 0.4px;
    }

    .bellows-sidebar-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-top: none;
        border-radius: 0 0 3px 3px;
        overflow: hidden;
    }

    .bellows-tree-root {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .bellows-tree-item {
        border-bottom: 1px solid #eeeeee;
    }

    .bellows-tree-item:last-child {
        border-bottom: none;
    }

    .bellows-header-row {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 500;
        color: #333333;
        cursor: pointer;
        background: #ffffff;
        transition: background 0.2s, color 0.2s;
    }

    .bellows-header-row:hover {
        background: #fafafa;
        color: #73001B;
    }

    .bellows-header-row a {
        color: inherit;
        text-decoration: none;
        flex: 1;
    }

    .bellows-chevron {
        display: inline-block;
        font-size: 13px;
        font-weight: 700;
        color: #333333;
        transition: transform 0.2s ease;
        width: 14px;
        text-align: center;
    }

    .bellows-chevron.open {
        transform: rotate(180deg);
    }

    .bellows-sub-tree {
        list-style: none;
        margin: 0;
        padding: 4px 0 8px 0;
        background: #fcfcfc;
        border-top: 1px solid #f1f5f9;
    }

    .bellows-sub-tree li a {
        display: block;
        padding: 7px 16px 7px 34px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: #475569;
        text-decoration: none;
        transition: background 0.15s, color 0.15s;
    }

    .bellows-sub-tree li a:hover {
        color: #73001B;
        background: #f8fafc;
    }

    .bellows-sub-tree li a.active {
        color: #73001B;
        font-weight: 600;
        background: #fff1f2;
        border-left: 3px solid #73001B;
        padding-left: 31px;
    }

    /* 3. Browse Related Products (Full-Width 6-Column Grid, 12 Products) */
    .related-products-section {
        padding: 15px 0 35px;
    }

    .section-teko-heading {
        font-family: 'Teko', 'Montserrat', sans-serif;
        font-size: 31px;
        font-weight: 600;
        color: #73001B;
        margin: 0 0 22px 0;
        line-height: 1.15;
        letter-spacing: 0.3px;
        scroll-margin-top: 90px;
    }

    .related-grid-6 {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 22px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .related-prod-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background: #ffffff;
        transition: transform 0.2s;
    }

    .related-prod-card:hover {
        transform: translateY(-3px);
    }

    .related-prod-thumb {
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        margin-bottom: 10px;
        background: #f8fafc;
        display: block;
    }

    .related-prod-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }

    .related-prod-card:hover .related-prod-thumb img {
        transform: scale(1.04);
    }

    .related-prod-cat {
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        color: #222222;
        margin-bottom: 4px;
        line-height: 1.3;
    }

    .related-prod-title {
        font-family: 'Teko', 'Montserrat', sans-serif;
        font-size: 22px;
        font-weight: 600;
        color: #73001B;
        line-height: 1.18;
        margin: 0;
        text-decoration: none;
        display: block;
        scroll-margin-top: 90px;
    }

    .related-prod-title:hover {
        color: #000000;
    }

    /* 4. Industries We Serve (15 Cards in 3 Rows of 5) */
    .product-industries-section {
        padding: 30px 0 35px;
        border-top: 1px solid #f0f0f0;
    }

    .industries-grid-5 {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 22px;
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
        box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.35);
        margin-bottom: 10px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        box-sizing: border-box;
    }

    .industry-image-wrap:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    }

    .industry-image-wrap img {
        width: 100%;
        height: 205px;
        aspect-ratio: 5 / 4;
        object-fit: cover;
        display: block;
    }

    .industry-title {
        font-family: 'Poppins', sans-serif !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        color: #000000 !important;
        margin: 0 !important;
        text-align: center;
        line-height: 1.3;
        transition: color 0.2s;
    }

    .industry-card-item a:hover .industry-title {
        color: #73001B !important;
    }

    /* 5. Why SD International & Market Area (64% / 36% Bordered Boxes) */
    .why-market-section {
        padding: 25px 0 30px;
    }

    .why-market-grid {
        display: grid;
        grid-template-columns: minmax(0, 64%) minmax(0, 36%);
        gap: 24px;
        align-items: start;
    }

    .why-market-box {
        background: #ffffff;
        border: 1px solid #dddddd;
        padding: 24px 28px;
        box-sizing: border-box;
    }

    .why-market-box h3 {
        font-family: 'Teko', 'Montserrat', sans-serif;
        font-size: 29px;
        font-weight: 600;
        color: #73001B;
        margin: 0 0 14px 0;
        line-height: 1.15;
        scroll-margin-top: 90px;
    }

    .why-sd-list {
        margin: 0 0 18px 20px;
        padding: 0;
    }

    .why-sd-list li {
        font-family: 'Poppins', sans-serif;
        font-size: 14.5px;
        line-height: 1.75;
        color: #111111;
        margin-bottom: 4px;
    }

    .why-market-box p {
        font-family: 'Poppins', sans-serif;
        font-size: 14.5px;
        line-height: 1.75;
        color: #111111;
        margin: 0 0 14px 0;
    }

    .why-market-box p:last-child {
        margin-bottom: 0;
    }

    /* 6. SEO Keywords & Legal Disclaimer */
    .product-seo-disclaimer-section {
        padding: 10px 0 35px;
        border-top: 1px solid #f0f0f0;
    }

    .seo-keywords-text {
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        line-height: 1.75;
        color: #222222;
        margin: 0 0 14px 0;
    }

    .legal-note-text {
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        line-height: 1.75;
        color: #222222;
        margin: 0;
    }

    /* Lightbox Modal for Product Image Zoom */
    .product-lightbox-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.88);
        z-index: 100000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }

    .product-lightbox-content {
        position: relative;
        max-width: 90vw;
        max-height: 88vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .product-lightbox-content img {
        max-width: 85vw;
        max-height: 78vh;
        border-radius: 10px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5);
        background: #ffffff;
    }

    .product-lightbox-caption {
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        margin-top: 14px;
        text-align: center;
    }

    .product-lightbox-close {
        position: fixed;
        top: 20px;
        right: 26px;
        background: rgba(255, 255, 255, 0.16);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.35);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        font-size: 26px;
        line-height: 1;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .product-lightbox-close:hover {
        background: #73001B;
    }

    /* Enquiry Modal */
    .product-quote-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.65);
        z-index: 99999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .product-quote-modal-dialog {
        background: #ffffff;
        width: 100%;
        max-width: 520px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        animation: prodModalFadeIn 0.2s ease-out;
    }

    @keyframes prodModalFadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .product-quote-modal-header {
        background-image: linear-gradient(180deg, #951634 0%, #73001B 100%);
        color: #ffffff;
        padding: 16px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-quote-modal-header h3 {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        font-weight: 600;
        color: #ffffff;
    }

    .product-quote-modal-close {
        background: transparent;
        border: none;
        color: #ffffff;
        font-size: 26px;
        line-height: 1;
        cursor: pointer;
        padding: 0;
    }

    .product-quote-modal-body {
        padding: 22px;
    }

    .prod-quote-group {
        margin-bottom: 13px;
    }

    .prod-quote-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 5px;
    }

    .prod-quote-group input,
    .prod-quote-group textarea {
        width: 100%;
        padding: 9px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        font-size: 14px;
        font-family: inherit;
        box-sizing: border-box;
    }

    .prod-quote-group input:focus,
    .prod-quote-group textarea:focus {
        outline: none;
        border-color: #73001B;
        box-shadow: 0 0 0 2px rgba(115, 0, 27, 0.14);
    }

    /* Responsive Breakpoints */
    @media (max-width: 1180px) {
        .product-media-toc-row {
            grid-template-columns: 310px minmax(0, 1fr);
        }
        .product-gallery-stage {
            width: 310px;
        }
        .related-grid-6 {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 991px) {
        .product-main-grid {
            grid-template-columns: 1fr;
        }
        .product-media-toc-row {
            grid-template-columns: 1fr;
        }
        .product-gallery-stage {
            width: 100%;
            max-width: 380px;
        }
        .related-grid-6 {
            grid-template-columns: repeat(3, 1fr);
        }
        .industries-grid-5 {
            grid-template-columns: repeat(3, 1fr);
        }
        .why-market-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .product-full-container {
            padding: 0 15px;
        }
        .single-product-h1 {
            font-size: 30px;
        }
        .product-short-desc-card {
            padding: 18px 18px;
            font-size: 15px;
        }
        .product-gold-cta-banner {
            font-size: 16px;
            padding: 18px 18px;
        }
        .related-grid-6 {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }
        .industries-grid-5 {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }
        .industry-image-wrap img {
            height: 145px;
        }
        .why-market-box {
            padding: 18px;
        }
    }
</style>

@php
    $activeCatSlug = $primaryCat ? $primaryCat->slug : '';
    $activeParentSlug = ($primaryCat && $primaryCat->parent) ? $primaryCat->parent->slug : '';

    $isDyesActive = ($activeCatSlug === 'dyes' || $activeParentSlug === 'dyes' || in_array($activeCatSlug, ['basic-dyes', 'disperse-dyes', 'solvent-dyes', 'vat-dyes', 'acid-dyes', 'cationic-dyes', 'direct-dyes', 'reactive-dyes', 'metal-complex-solvent-dyes', 'powder-solvent-dyes', 'liquid-solvent-dyes']));
    $isFdcActive = ($activeCatSlug === 'f-d-c-colours' || $activeParentSlug === 'f-d-c-colours' || str_contains($activeCatSlug, 'f-d-c') || str_contains($activeCatSlug, 'lake'));
    $isPigmentsActive = ($activeCatSlug === 'pigments' || $activeParentSlug === 'pigments' || in_array($activeCatSlug, ['organic-pigments', 'high-performance-pigments', 'fluorescent-pigments', 'pu-foam-pigments', 'ultramarine-pigments']));
    $isOtherActive = ($activeCatSlug === 'other-products' || $activeParentSlug === 'other-products' || in_array($activeCatSlug, ['naphthols', 'fast-colour-bases', 'fast-colour-salts', 'pyrazolone-intermediates', 'auxiliaries']));

    // Format short description into clean 2 paragraphs matching live site
    $shortDescRaw = trim(strip_tags($product->short_description ?? ''));
    if ($shortDescRaw !== '' && !str_contains($product->short_description, '<p>')) {
        $shortDescHtml = preg_replace(
            '/\s+(SD International is one of the leading)/i',
            "</p><p>$1",
            e($shortDescRaw)
        );
        $shortDescHtml = '<p>' . $shortDescHtml . '</p>';
    } elseif ($shortDescRaw !== '') {
        $shortDescHtml = $product->short_description;
    } else {
        $shortDescHtml = '<p>Buy high purity ' . e($product->title) . ' from SD International &ndash; leading manufacturer, supplier, and exporter of ' . e($product->title) . '. SD International offers ' . e($product->title) . ' well known for using superior purity chemicals from trusted vendors to meet International Industry standards.</p>'
            . '<p>SD International is one of the leading Dyes &amp; Chemicals exporters of high grade and superior quality products in India to an industry-wide customer base.</p>';
    }

    $productImgFallback = $product->image_url
        ? (str_starts_with($product->image_url, 'http') ? $product->image_url : 'https://sdinternational.com/wp-content' . (str_starts_with($product->image_url, '/') ? '' : '/') . $product->image_url)
        : 'https://sdinternational.com/wp-content/uploads/woocommerce-placeholder-120x120.png';

    $industriesList = [
        ['title' => 'Plastic & Polymers', 'url' => '/applications/plastic-polymers', 'path' => 'uploads/2020/07/plastic_polymer.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/2020/07/plastic_polymer.jpg'],
        ['title' => 'Textiles', 'url' => '/applications/textiles', 'path' => 'uploads/2020/07/textiles.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/2020/07/textiles.jpg'],
        ['title' => 'Leather', 'url' => '/applications/leather', 'path' => 'uploads/2020/07/lather.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/2020/07/lather.jpg'],
        ['title' => 'Petroleum & Lubricants', 'url' => '/applications/petroleum-lubricants', 'path' => 'uploads/2020/07/petroleum_and_lubricant.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/2020/07/petroleum_and_lubricant.jpg'],
        ['title' => 'Paper & Pulp', 'url' => '/applications/paper-pulp', 'path' => 'uploads/2020/07/paper_and_pulp.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/2020/07/paper_and_pulp.jpg'],
        ['title' => 'Printing Inks', 'url' => '/applications/printing-inks', 'path' => 'uploads/2020/07/ink_industry.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/2020/07/ink_industry.jpg'],
        ['title' => 'Food Drug & Cosmetics', 'url' => '/applications/food-drug-cosmetics', 'path' => 'uploads/2020/07/food_drug_app-1.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/2020/07/food_drug_app-1.jpg'],
        ['title' => 'Coatings', 'url' => '/applications/coating', 'path' => 'uploads/2020/07/coating_dyes.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/2020/07/coating_dyes.jpg'],
        ['title' => 'Wood Stains', 'url' => '/applications/wood-stains', 'path' => 'uploads/2020/07/wood_stain_treatment.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/2020/07/wood_stain_treatment.jpg'],
        ['title' => 'Smoke Dyes', 'url' => '/applications/smoke-dyes', 'path' => 'uploads/2020/07/smoke-dyes.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/2020/07/smoke-dyes.jpg'],
        ['title' => 'Pigment Intermediates', 'url' => '/applications/pigment-intermediates', 'path' => 'uploads/applications/pigmanets_intermediates_app.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/applications/pigmanets_intermediates_app.jpg'],
        ['title' => 'Wax', 'url' => '/applications/wax', 'path' => 'uploads/applications/wax.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/applications/wax.jpg'],
        ['title' => 'Rubber', 'url' => '/applications/rubber', 'path' => 'uploads/applications/rubberq.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/applications/rubberq.jpg'],
        ['title' => 'Glass', 'url' => '/applications/glass', 'path' => 'uploads/applications/glass.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/applications/glass.jpg'],
        ['title' => 'Intermediates', 'url' => '/applications/intermediates', 'path' => 'uploads/applications/interm.jpg', 'live' => 'https://sdinternational.com/wp-content/uploads/applications/interm.jpg'],
    ];
@endphp

<div class="product-page-wrap">
    <!-- 1. Full-Width Breadcrumb Bar -->
    <section class="product-breadcrumb-bar">
        <div class="product-full-container">
            <nav class="product-breadcrumb-nav" aria-label="Breadcrumb">
                @foreach($breadcrumbs as $label => $link)
                    @if(!$loop->last)
                        <a href="{{ $link }}">{{ $label }}</a>
                        <span class="delim">/</span>
                    @else
                        <span>{{ $label }}</span>
                    @endif
                @endforeach
            </nav>
        </div>
    </section>

    <!-- 2. Main Product Content (80%) & Right Sidebar (20%) -->
    <section class="product-main-section">
        <div class="product-full-container">
            <div class="product-main-grid">
                <!-- Left Main Column -->
                <main class="product-left-main">
                    <h1 class="single-product-h1">{{ $product->title }}</h1>
                    <p class="single-product-subtitle">Suppliers and Exporter of {{ $product->title }}</p>

                    <!-- Short Description Rounded Card -->
                    <div class="product-short-desc-card">
                        {!! $shortDescHtml !!}
                    </div>

                    <!-- Inner 2-Column Split: Swatch Image (with Zoom & Lightbox) + Enquiry Now & TOC -->
                    <div class="product-media-toc-row">
                        <div class="product-gallery-stage" id="productGalleryStage" onclick="openProductLightbox()">
                            <img id="productMainImage"
                                 src="{{ $product->thumbnail_url }}"
                                 alt="{{ $product->title }}"
                                 onerror="this.onerror=null; this.src='{{ $productImgFallback }}';">
                            <button type="button"
                                    class="product-zoom-trigger"
                                    title="Zoom Image"
                                    aria-label="Zoom product image"
                                    onclick="event.stopPropagation(); openProductLightbox();">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </div>

                        <div class="product-enquiry-toc-col">
                            <button type="button"
                                    class="btn-product-enquiry"
                                    onclick="openProductQuoteModal('{{ addslashes($product->title) }}', '{{ $product->slug }}')">
                                Enquiry Now
                            </button>

                            <div class="product-toc-box">
                                <h2 class="product-toc-heading">Table of Contents</h2>
                                <ul class="product-toc-list">
                                    @foreach($tocItems as $item)
                                        <li><a href="#{{ $item['id'] }}">{{ $item['label'] }}</a></li>
                                    @endforeach
                                    @if($relatedProducts->isNotEmpty())
                                        <li><a href="#related-products">Browse Related Products offered by SD International</a></li>
                                        @foreach($relatedProducts as $rel)
                                            <li><a href="#related-prod-{{ $rel->id }}">{{ $rel->title }}</a></li>
                                        @endforeach
                                    @endif
                                    <li><a href="#industries-we-serve">Industries We Serve</a></li>
                                    <li><a href="#why-sd-international">Why SD International</a></li>
                                    <li><a href="#market-area-sd">Market Area of SD International</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Full Rich Product Content (Intro, Gold CTA Banner, Latest Price, Specs + PDF, Properties, Applications) -->
                    <div class="product-rich-content">
                        {!! $renderedContent !!}
                    </div>
                </main>

                <!-- Right Sidebar: PRODUCTS RANGE Bellows Accordion -->
                <div class="product-right-sidebar">
                    @include('partials.products_range_sidebar', ['currentSlug' => $product->slug])
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Browse Related Products offered by SD International (12 Products, 2 Rows x 6 Columns) -->
    @if($relatedProducts->isNotEmpty())
    <section class="related-products-section">
        <div class="product-full-container">
            <h2 id="related-products" class="section-teko-heading">Browse Related Products offered by SD International</h2>
            <ul class="related-grid-6">
                @foreach($relatedProducts as $rel)
                    @php
                        $relCatLabel = $rel->related_cat_label ?: ($rel->categories->first()?->name ?? 'Dyes & Chemicals');
                        $relFallback = $rel->image_url
                            ? (str_starts_with($rel->image_url, 'http') ? $rel->image_url : 'https://sdinternational.com/wp-content' . (str_starts_with($rel->image_url, '/') ? '' : '/') . $rel->image_url)
                            : 'https://sdinternational.com/wp-content/uploads/woocommerce-placeholder-120x120.png';
                    @endphp
                    <li class="related-prod-card" id="related-prod-{{ $rel->id }}">
                        <a href="{{ $rel->url }}" class="related-prod-thumb">
                            <img src="{{ $rel->thumbnail_url }}"
                                 alt="{{ $rel->title }}"
                                 onerror="this.onerror=null; this.src='{{ $relFallback }}';">
                        </a>
                        <span class="related-prod-cat">{{ $relCatLabel }}</span>
                        <a href="{{ $rel->url }}" class="related-prod-title">{{ $rel->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    @endif

    <!-- 4. Industries We Serve (15 Cards in 3 Rows of 5) -->
    <section class="product-industries-section">
        <div class="product-full-container">
            <h2 id="industries-we-serve" class="section-teko-heading">Industries We Serve</h2>
            <div class="industries-grid-5">
                @foreach($industriesList as $ind)
                    <div class="industry-card-item">
                        <a href="{{ url($ind['url']) }}">
                            <div class="industry-image-wrap">
                                <img src="{{ asset($ind['path']) }}"
                                     alt="{{ $ind['title'] }}"
                                     onerror="this.onerror=null; this.src='{{ $ind['live'] }}';">
                            </div>
                            <h5 class="industry-title">{{ $ind['title'] }}</h5>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 5. Why SD International & Market Area of SD International (64% / 36% Bordered Boxes) -->
    <section class="why-market-section">
        <div class="product-full-container">
            <div class="why-market-grid">
                <!-- Left Box: Why SD International -->
                <div class="why-market-box">
                    <h3 id="why-sd-international">Why SD International</h3>
                    <ul class="why-sd-list">
                        <li>ISO 9001:2015 Certified and Govt. of India Recognised Two Star Export House.</li>
                        <li>One of the leading exporters of dye and pigment chemicals.</li>
                        <li>More than 30 years of rich industry experience.</li>
                        <li>Wide product range of high purity chemicals.</li>
                        <li>Leading exporter of dyeing and auxiliaries&rsquo; chemicals.</li>
                        <li>Focus is to create trustworthy and responsive relationships.</li>
                        <li>Reliable and dependable service.</li>
                        <li>Great Value, quality products, and huge range in stocks.</li>
                        <li>Chemicals and services we provide achieve consistent standards and exceed your expectations.</li>
                        <li>Vast knowledge of colour and colouration allows us to tailor our products to your needs.</li>
                    </ul>
                    <p>
                        SD International is committed to customer fulfilment by delivering best quality chemical substances and compounds at competitive market prices. We offer these product categories to companies in the sector of plastics, paints and printing inks, textile, food colouring, pharmaceuticals, wood, leather factories, and paper mills across markets to several destinations including India and Indian Subcontinent, East Asia, South East Asia and the Middle East.
                    </p>
                </div>

                <!-- Right Box: Market Area of SD International -->
                <div class="why-market-box">
                    <h3 id="market-area-sd">Market Area of SD International</h3>
                    <p>SD International supply and export to listed Countries</p>
                    <p>
                        <strong>China</strong> &ndash; <strong>Ningbo</strong> &ndash; <strong>Shanghai</strong>&ndash;<strong>Guangzhou</strong> | Bangladesh | Brazil | Egypt | Gambia | Germany | Ghana | Guinea | Conakry | Honduras | Indonesia | Israel | Italy | Japan | Mali | Mauritania | Mexico | Myanmar | Netherlands | Poland | Peru | Singapore | South Korea | Taiwan | UAE | Uganda | UK | USA | Vietnam | Argentina | Malaysia | Thailand | Turkey | Iran | Spain | Kenya
                    </p>
                    <p>
                        Thank you for visiting SD International &rsquo;s website. Do you have any questions or Need any help with Our products and their applications to your requirements? Contact Us at <a href="tel:+919920669561" style="color: #73001B; font-weight: 600; text-decoration: none;">+91 99206 69561</a> or <a href="javascript:void(0)" class="inline-enquiry-link" onclick="openProductQuoteModal('{{ addslashes($product->title) }}', '{{ $product->slug }}')">Enquiry Form</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. SEO Keywords & Legal Disclaimer -->
    <section class="product-seo-disclaimer-section">
        <div class="product-full-container">
            <p class="seo-keywords-text">
                Manufacturer, Supplier, Importer, Exporter, Dealer, Distributor &amp; Service Provider of Industrial Chemicals, Pharma Excipients, Pharma Raw material importer, Pharmaceutical, Active Pharmaceutical Ingredients, Bulk Drugs, Industrial Acid &amp; Salts, Agriculture Chemicals, Food chemicals, Phase Transfer Catalyst, Quats, Agriculture Chemicals, Fine Chemicals, Epoxy Coating chemicals, Construction Chemicals, Cosmetic Chemicals, Bulk Drugs, Oil field chemicals, Phase Transfer Catalyst, Water Treatment Chemicals, Swimming Pool Chemicals, Chlorinated Intermediates, Cosmetic Chemicals, Gujarat, India. Top chemicals &amp; pharmaceutical company in India. Industrial Chemicals, Surplus Chemicals, Intermediates in Vadodara, Industrial Acid, Specialty Chemicals, Pharmaceutical Chemicals, Active Pharma Ingredients, By-product/Waste Grade Chemicals Buyer &amp; Seller in India, Best &amp; Contract Manufacturer of Pharmaceuticals &amp; Chemicals, Top Chemical &amp; Pharma companies in India, Pharma Impurities for formulation manufacturer &amp; pharma companies, Chlorine Chemicals, Importer of Industrial &amp; Pharma Chemicals in India, ETP Chemicals, STP Chemicals, Buyer &amp; Seller Used Machinery for Pharma &amp; Chemicals Industries in India, Pharma Raw Materials, Surplus/Non-Moving Chemicals buyer &amp; seller in India, Solvents (Distilled, Recovered &amp; Pure), Quats &amp; Phase transfer catalyst, Ashland pharma excipients dealer &amp; distributor in India, Detergent Chemicals, Detergent Raw materials, BASF Products, oil &amp; gas chemicals, Biocides &amp; Hygiene chemicals, hand sanitizer, disinfection &amp; sanitation spray (corona-covid virus spray), Pharmaceutical sanitization, lubrication additives.
            </p>
            <p class="legal-note-text">
                <strong>Note :</strong> Please note that the information on this document is for illustration purposes only as information may vary with individual chemical compounds and their purity, concentration and applications subjects and therefore cannot be guaranteed as accurate. &copy; Copyright {{ date('Y') }} &copy; SD International. All Rights Reserved (Terms of Use). Recreation of any materials from the site is strictly prohibited without permission. SD International&rsquo;s products are sold exclusively through SD International&rsquo;s website. Use Terms | Privacy. Please contact us to discuss precise product specifications and requirements and obtain advice on which products are required to suit your exact application needs info@sdinternational.com
            </p>
        </div>
    </section>
</div>

<!-- Full-Screen Image Lightbox Modal -->
<div id="productLightboxModal" class="product-lightbox-backdrop" onclick="closeProductLightbox()">
    <button type="button" class="product-lightbox-close" aria-label="Close lightbox" onclick="closeProductLightbox()">&times;</button>
    <div class="product-lightbox-content" onclick="event.stopPropagation()">
        <img id="productLightboxImg" src="{{ $product->thumbnail_url }}" alt="{{ $product->title }}">
        <div class="product-lightbox-caption">{{ $product->title }}</div>
    </div>
</div>

<!-- Product Quotation / Enquiry Modal -->
<div id="productQuoteModal" class="product-quote-modal-backdrop" onclick="closeProductQuoteModalOnBackdrop(event)">
    <div class="product-quote-modal-dialog" onclick="event.stopPropagation()">
        <div class="product-quote-modal-header">
            <h3>Request Product Quotation</h3>
            <button type="button" class="product-quote-modal-close" aria-label="Close" onclick="closeProductQuoteModal()">&times;</button>
        </div>
        <div class="product-quote-modal-body">
            <form id="productQuoteForm" onsubmit="submitProductQuote(event)">
                @csrf
                <input type="hidden" name="product_name" id="modalProdName" value="{{ $product->title }}">
                <input type="hidden" name="product_slug" id="modalProdSlug" value="{{ $product->slug }}">
                <input type="hidden" name="cas_number" value="{{ $product->cas_number }}">

                <div class="prod-quote-group">
                    <label>Product Selected</label>
                    <input type="text" id="displayProdName" value="{{ $product->title }}" readonly style="background: #f8fafc; font-weight: 600; color: #73001B;">
                </div>
                <div class="prod-quote-group">
                    <label for="prodQuoteName">Your Full Name *</label>
                    <input type="text" id="prodQuoteName" name="name" required placeholder="e.g. Rajesh Sharma">
                </div>
                <div class="prod-quote-group">
                    <label for="prodQuoteCompany">Company / Organization</label>
                    <input type="text" id="prodQuoteCompany" name="company" placeholder="e.g. Global Textiles Ltd.">
                </div>
                <div class="prod-quote-group">
                    <label for="prodQuoteEmail">Business Email *</label>
                    <input type="email" id="prodQuoteEmail" name="email" required placeholder="name@company.com">
                </div>
                <div class="prod-quote-group">
                    <label for="prodQuotePhone">Phone / WhatsApp Number *</label>
                    <input type="tel" id="prodQuotePhone" name="phone" required placeholder="+91 99206 69561">
                </div>
                <div class="prod-quote-group">
                    <label for="prodQuoteQuantity">Required Quantity (Kg / Tons)</label>
                    <input type="text" id="prodQuoteQuantity" name="quantity" placeholder="e.g. 500 Kg, 2 MT">
                </div>
                <div class="prod-quote-group">
                    <label for="prodQuoteMessage">Specifications / Application Notes</label>
                    <textarea id="prodQuoteMessage" name="message" rows="3" placeholder="Mention destination port, COA/MSDS requirement, or customisation needs."></textarea>
                </div>

                <div id="prodQuoteFormStatus" style="display: none; padding: 10px 12px; margin-bottom: 12px; font-size: 13.5px; border-radius: 4px;"></div>

                <button type="submit" id="btnSubmitProdQuote" class="btn-product-enquiry" style="width: 100%; margin-bottom: 0;">
                    Send Inquiry Now
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Sidebar Bellows Accordion Toggle
    function toggleProdSidebarAccordion(id) {
        var el = document.getElementById(id);
        var chev = document.getElementById('chev-' + id);
        if (!el) return;
        if (el.style.display === 'none' || el.style.display === '') {
            el.style.display = 'block';
            if (chev) chev.classList.add('open');
        } else {
            el.style.display = 'none';
            if (chev) chev.classList.remove('open');
        }
    }

    // Interactive Cursor Pan-Zoom on Product Swatch
    (function() {
        var stage = document.getElementById('productGalleryStage');
        var img = document.getElementById('productMainImage');
        if (!stage || !img) return;
        stage.addEventListener('mousemove', function(e) {
            var rect = stage.getBoundingClientRect();
            var x = ((e.clientX - rect.left) / rect.width) * 100;
            var y = ((e.clientY - rect.top) / rect.height) * 100;
            img.style.transformOrigin = x + '% ' + y + '%';
        });
        stage.addEventListener('mouseleave', function() {
            img.style.transformOrigin = 'center center';
        });
    })();

    // Full-Screen Image Lightbox
    function openProductLightbox() {
        var modal = document.getElementById('productLightboxModal');
        var mainImg = document.getElementById('productMainImage');
        var lbImg = document.getElementById('productLightboxImg');
        if (mainImg && lbImg) lbImg.src = mainImg.src;
        if (modal) modal.style.display = 'flex';
    }

    function closeProductLightbox() {
        var modal = document.getElementById('productLightboxModal');
        if (modal) modal.style.display = 'none';
    }

    // Product Quotation Modal
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

    // Also alias global openQuoteModal in case any external trigger calls it
    window.openQuoteModal = openProductQuoteModal;

    // Keyboard Escape handler for modals
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeProductLightbox();
            closeProductQuoteModal();
        }
    });

    // Smooth Scroll for TOC Anchor Links
    document.querySelectorAll('.product-toc-list a[href^="#"]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            var targetId = this.getAttribute('href').slice(1);
            var targetEl = document.getElementById(targetId);
            if (targetEl) {
                e.preventDefault();
                targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // AJAX Form Submission to /inquiries
    async function submitProductQuote(e) {
        e.preventDefault();
        var form = document.getElementById('productQuoteForm');
        var statusBox = document.getElementById('prodQuoteFormStatus');
        var submitBtn = document.getElementById('btnSubmitProdQuote');
        if (!form) return;

        var formData = new FormData(form);
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending Inquiry...';

        statusBox.style.display = 'block';
        statusBox.style.background = '#eff6ff';
        statusBox.style.color = '#1e40af';
        statusBox.textContent = 'Submitting your inquiry, please wait...';

        try {
            var response = await fetch('{{ route("inquiries.store") }}', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });
            var data = await response.json();

            if (response.ok && data.success) {
                statusBox.style.background = '#dcfce7';
                statusBox.style.color = '#166534';
                statusBox.textContent = data.message || 'Thank you! Your quotation request has been sent successfully.';
                form.reset();
                setTimeout(function() {
                    closeProductQuoteModal();
                    statusBox.style.display = 'none';
                }, 3200);
            } else {
                statusBox.style.background = '#fee2e2';
                statusBox.style.color = '#991b1b';
                statusBox.textContent = data.message || 'Submission failed. Please check the fields and try again.';
            }
        } catch (err) {
            statusBox.style.background = '#fee2e2';
            statusBox.style.color = '#991b1b';
            statusBox.textContent = 'Network error. Please try again or reach us at +91 99206 69561.';
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Send Inquiry Now';
        }
    }
</script>
@endpush
