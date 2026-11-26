@extends('layouts.app')

@section('content')
<style>
    /* Application Detail Page Styling - Matching sdinternational.com/applications/plastic-polymers/ */
    .app-content-container {
        max-width: 1240px;
        margin: 0 auto;
        padding: 35px 20px 60px;
        min-height: 50vh;
    }

    /* Headings */
    .elementor-heading-title,
    .app-products-wrap > h2,
    .app-products-wrap .elementor-heading-title {
        font-family: 'Montserrat', sans-serif !important;
        font-size: 28px !important;
        font-weight: 700 !important;
        color: #73001B !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        margin: 15px 0 25px !important;
        padding: 0 !important;
        border: none !important;
        line-height: 1.2 !important;
    }

    /* 6-Column Responsive Product Grid */
    .pp-woocommerce ul.products,
    .app-products-wrap ul.products,
    .app-products-wrap ul.products-grid-columns-6 {
        display: grid !important;
        grid-template-columns: repeat(6, 1fr) !important;
        gap: 28px 18px !important;
        list-style: none !important;
        padding: 0 !important;
        margin: 20px 0 50px !important;
    }

    /* Individual Product Card */
    .pp-woocommerce ul.products > li.product,
    .app-products-wrap ul.products > li,
    .app-products-wrap ul.products-grid-columns-6 > li {
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
        overflow: visible !important;
        transition: none !important;
    }

    .pp-woo-product-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        width: 100%;
    }

    /* Circular Thumbnail */
    .pp-woo-products-thumbnail-wrap,
    .app-products-wrap ul.products > li > a:first-child {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        margin-bottom: 12px !important;
        text-decoration: none !important;
    }

    .pp-woo-products-thumbnail-wrap img,
    .app-products-wrap ul.products > li img,
    .app-products-wrap ul.products-grid-columns-6 > li img,
    .attachment-shop_catalog {
        width: 120px !important;
        height: 120px !important;
        border-radius: 250px !important;
        object-fit: cover !important;
        background: #f8fafc !important;
        border: 1px solid #eef2f6 !important;
        display: block !important;
        margin: 0 auto !important;
        transition: transform 0.25s ease, box-shadow 0.25s ease !important;
    }

    .pp-woocommerce ul.products > li.product:hover img,
    .app-products-wrap ul.products > li:hover img {
        transform: scale(1.06);
        box-shadow: 0 6px 18px rgba(115, 0, 27, 0.16);
    }

    /* Product Summary */
    .pp-woo-products-summary-wrap {
        text-align: center;
        width: 100%;
        padding: 0 4px;
    }

    /* Category Label */
    .pp-woo-product-category,
    .app-products-wrap ul.products > li > span.cat-label {
        font-family: 'Open Sans', sans-serif !important;
        font-size: 11px !important;
        text-transform: uppercase !important;
        color: #7a7a7a !important;
        letter-spacing: 0.5px !important;
        display: block !important;
        margin-bottom: 5px !important;
        text-align: center !important;
    }

    /* Product Title */
    .woocommerce-loop-product__title,
    .app-products-wrap ul.products > li h2,
    .app-products-wrap ul.products-grid-columns-6 > li h2 {
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

    .pp-loop-product__link,
    .woocommerce-LoopProduct-link,
    .app-products-wrap ul.products > li a {
        text-decoration: none !important;
        color: inherit !important;
    }

    .pp-loop-product__link:hover .woocommerce-loop-product__title,
    .app-products-wrap ul.products > li a:hover h2 {
        color: #73001B !important;
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
        .pp-woocommerce ul.products,
        .app-products-wrap ul.products,
        .app-products-wrap ul.products-grid-columns-6 {
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 22px 14px !important;
        }
        .app-industries-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .pp-woocommerce ul.products,
        .app-products-wrap ul.products,
        .app-products-wrap ul.products-grid-columns-6 {
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 18px 12px !important;
        }
        .app-industries-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
    }

    @media (max-width: 480px) {
        .pp-woocommerce ul.products,
        .app-products-wrap ul.products,
        .app-products-wrap ul.products-grid-columns-6 {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 14px 10px !important;
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

<!-- Main Products & Content -->
<main class="app-content-container">
    <div class="app-products-wrap">
        {!! $content !!}
    </div>
</main>
@endsection
