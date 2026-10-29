<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags (Rank Math Equivalent) -->
    <title>{{ $seo['title'] ?? 'SD International - Vat & Solvent Dyes Manufacturer in India' }}</title>
    <meta name="description" content="{{ $seo['description'] ?? '' }}">
    @if(!empty($seo['keywords']))
    <meta name="keywords" content="{{ $seo['keywords'] }}">
    @endif
    <meta name="robots" content="{{ $seo['robots'] ?? 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large' }}">
    <link rel="canonical" href="{{ $seo['canonical'] ?? url()->current() }}">

    <!-- Open Graph Meta -->
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="{{ $seo['og_type'] ?? 'website' }}">
    <meta property="og:title" content="{{ $seo['title'] ?? 'SD International' }}">
    <meta property="og:description" content="{{ $seo['description'] ?? '' }}">
    <meta property="og:url" content="{{ $seo['canonical'] ?? url()->current() }}">
    <meta property="og:site_name" content="S D International">
    <meta property="og:image" content="{{ $seo['og_image'] ?? 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png' }}">

    <!-- Twitter Card Meta -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo['title'] ?? 'SD International' }}">
    <meta name="twitter:description" content="{{ $seo['description'] ?? '' }}">
    <meta name="twitter:image" content="{{ $seo['og_image'] ?? 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png' }}">

    <link rel="icon" type="image/png" href="{{ asset('uploads/2020/07/logo-64x19.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- JSON-LD Structured Data Schema -->
    @if(!empty($breadcrumbSchema))
    <script type="application/ld+json">
    {!! $breadcrumbSchema !!}
    </script>
    @endif

    @if(!empty($productSchema))
    <script type="application/ld+json">
    {!! $productSchema !!}
    </script>
    @endif

    @if(!empty($schema))
    <script type="application/ld+json">
    {!! $schema !!}
    </script>
    @endif

    <style>
        :root {
            --primary: #64141f;
            --primary-gradient: linear-gradient(180deg, #951634 0%, #73001B 100%);
            --primary-dark: #6A0015;
            --primary-accent: #820024;
            --gold-gradient: linear-gradient(180deg, #C49F6A 0%, #966F37 100%);
            --gold-light: #D2AF77;
            --cream-bg: #F0EAD7;
            --crimson-bg: #961A2B;
            --btn-hover: #3a3a3a;
            --text-dark: #000000;
            --text-main: #333333;
            --text-muted: #555555;
            --bg-light: #f8fafc;
            --border-color: #e2e8f0;
            --font-heading: 'Montserrat', sans-serif;
            --font-body: 'Open Sans', sans-serif;
        }

        html {
            font-size: 93.75%;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-body);
            font-weight: 400;
            font-size: 15px;
            font-size: 1rem;
            color: var(--text-main);
            background-color: #ffffff;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: 400;
            color: #000000;
            line-height: 1.3;
        }

        h1 { font-size: 25px; font-size: 1.6666666666667rem; font-weight: 400; }
        h2 { font-size: 20px; font-size: 1.3333333333333rem; font-weight: 400; }
        h3 { font-size: 20px; font-size: 1.3333333333333rem; font-weight: 400; }
        h4, h5, h6 { font-size: 20px; font-size: 1.3333333333333rem; }

        a {
            color: var(--primary);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        a:hover {
            color: #3a3a3a;
        }

        /* Buttons - matching live site exactly */
        button, input[type="button"], input[type="submit"], input[type="reset"] {
            border-style: solid;
            border-top-width: 0;
            border-right-width: 0;
            border-left-width: 0;
            border-bottom-width: 0;
            color: #ffffff;
            border-color: #64141f;
            background-color: #64141f;
            border-radius: 2px;
            padding-top: 10px;
            padding-right: 40px;
            padding-bottom: 10px;
            padding-left: 40px;
            font-family: inherit;
            font-weight: inherit;
            line-height: 1;
        }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 clamp(16px, 2.5vw, 30px);
            width: 100%;
        }

        .container-fluid {
            width: 100%;
            padding: 0 clamp(16px, 2.5vw, 40px);
        }

        /* Top Bar - Full Width */
        .top-bar {
            background: var(--gold-gradient);
            border-bottom: 1px solid rgba(0,0,0,0.08);
            font-size: 13px;
            font-size: 0.8666666666667rem;
            padding: 8px 0;
            color: #ffffff;
            width: 100%;
        }
        .top-bar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 clamp(16px, 2.5vw, 30px);
        }
        .top-bar-left, .top-bar-right {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }
        .top-bar a {
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }
        .top-bar a:hover {
            color: var(--cream-bg);
            text-decoration: underline;
        }

        /* Main Header - Full Width */
        .site-header {
            background: #ffffff;
            border-bottom: 1px solid #E1E1E1;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            width: 100%;
        }
        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px clamp(16px, 2.5vw, 30px);
            max-width: 1240px;
            margin: 0 auto;
            width: 100%;
        }
        .site-logo img {
            max-width: 180px;
            max-height: 55px;
            width: auto;
            display: block;
        }

        /* Navigation */
        .main-nav {
            display: flex;
            align-items: center;
            gap: 24px;
            list-style: none;
        }
        .nav-item {
            position: relative;
        }
        .nav-link {
            font-family: var(--font-body);
            font-size: 15px;
            font-size: 1rem;
            font-weight: 400;
            color: #000000;
            padding: 10px 0;
            display: flex;
            align-items: center;
            gap: 4px;
            text-transform: none;
            letter-spacing: 0;
        }
        .nav-link:hover, .nav-item:hover > .nav-link {
            color: var(--primary);
        }

        /* Dropdown & Mega Menu */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 250px;
            background: #ffffff;
            box-shadow: 0 10px 35px rgba(0,0,0,0.12);
            border-top: 2px solid var(--primary);
            list-style: none;
            padding: 10px 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.25s ease;
            border-radius: 0 0 6px 6px;
            z-index: 100;
        }
        .mega-dropdown {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            width: 960px;
            max-width: 95vw;
            background: #ffffff;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            border-top: 2px solid var(--primary);
            padding: 28px 32px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.25s ease;
            border-radius: 0 0 8px 8px;
            z-index: 1000;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }
        .nav-item:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .nav-item:hover .mega-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }
        .mega-col-title {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding-bottom: 8px;
            margin-bottom: 12px;
            border-bottom: 2px solid #f1f5f9;
        }
        .mega-col-title a {
            color: var(--primary);
        }
        .mega-col-links {
            list-style: none;
        }
        .mega-col-links li {
            margin-bottom: 6px;
        }
        .mega-col-links a {
            color: #334155;
            font-size: 13px;
            display: block;
            padding: 4px 0;
            transition: all 0.15s ease;
        }
        .mega-col-links a:hover {
            color: var(--primary);
            padding-left: 5px;
        }
        .mega-highlight-link {
            font-weight: 700 !important;
            color: var(--primary) !important;
            margin-top: 8px;
            display: inline-block;
        }

        /* Top Bar Search & Translate */
        .top-search-form {
            display: inline-flex;
            align-items: center;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 20px;
            padding: 2px 10px;
        }
        .top-search-input {
            border: none;
            outline: none;
            font-size: 12px;
            background: transparent;
            width: 140px;
            padding: 4px;
        }
        .top-search-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--primary);
            font-size: 13px;
            padding: 0 4px;
        }
        #google_translate_element {
            display: inline-block;
            font-size: 12px;
        }
        .goog-te-gadget-simple {
            background-color: transparent !important;
            border: none !important;
            font-size: 12px !important;
        }

        /* Header CTA */
        .btn-enquire {
            background: #64141f;
            color: #ffffff !important;
            padding: 10px 40px;
            border-radius: 2px;
            font-family: var(--font-heading);
            font-weight: inherit;
            font-size: 15px;
            font-size: 1rem;
            text-transform: none;
            letter-spacing: 0;
            transition: all 0.25s ease;
            border-style: solid;
            border-width: 0;
            border-color: #64141f;
            cursor: pointer;
            display: inline-block;
            line-height: 1;
        }
        .btn-enquire:hover {
            background: #3a3a3a;
            border-color: #3a3a3a;
            color: #ffffff !important;
        }

        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--primary);
        }

        /* Breadcrumbs */
        .breadcrumb-bar {
            background: #f8fafc;
            padding: 14px 0;
            border-bottom: 1px solid #edf2f7;
            font-size: 13.5px;
        }
        .breadcrumb-list {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
            flex-wrap: wrap;
        }
        .breadcrumb-item a {
            color: #64748b;
        }
        .breadcrumb-item a:hover {
            color: var(--primary);
        }
        .breadcrumb-separator {
            color: #94a3b8;
            font-size: 12px;
        }
        .breadcrumb-item.active {
            color: #1e293b;
            font-weight: 600;
        }

        /* Footer - Full Width */
        .site-footer {
            background: var(--primary-gradient);
            color: #ffffff;
            padding-top: 60px;
            margin-top: 0;
            width: 100%;
        }
        .footer-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 clamp(16px, 2.5vw, 30px);
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 40px;
            padding-bottom: 50px;
        }
        .footer-col h4 {
            color: #ffffff;
            font-size: 21px;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
            letter-spacing: 0;
        }
        .footer-col h4::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 35px;
            height: 2px;
            background: var(--gold-light);
        }
        .footer-links {
            list-style: none;
        }
        .footer-links li {
            margin-bottom: 10px;
        }
        .footer-links a {
            color: #ffffff;
            opacity: 0.88;
            font-size: 14px;
            transition: all 0.2s ease;
        }
        .footer-links a:hover {
            color: var(--cream-bg);
            opacity: 1;
            padding-left: 4px;
        }
        .footer-contact p {
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 14px;
            color: #ffffff;
            opacity: 0.92;
        }
        .footer-contact a {
            color: #ffffff;
        }
        .footer-contact a:hover {
            color: var(--cream-bg);
        }

        /* Copyright Bar - Full Width */
        .site-copyright-bar {
            background: var(--gold-light);
            color: #000000;
            padding: 16px 0;
            font-size: 14px;
            font-size: 0.9333333333333rem;
            font-weight: 400;
            width: 100%;
        }
        .copyright-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 clamp(16px, 2.5vw, 30px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .copyright-inner p {
            color: #000000;
            margin: 0;
        }
        .copyright-socials {
            display: flex;
            gap: 16px;
            align-items: center;
        }
        .copyright-socials a {
            color: #000000;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .copyright-socials a:hover {
            opacity: 0.7;
        }

        /* WhatsApp Floating Widget */
        .whatsapp-float {
            position: fixed;
            bottom: 25px;
            right: 25px;
            background-color: #25d366;
            color: white;
            border-radius: 50px;
            text-align: center;
            font-size: 15px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            z-index: 999;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            transition: all 0.3s ease;
        }
        .whatsapp-float:hover {
            background-color: #1ebe5d;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        /* Modal Popup */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            z-index: 10000;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active {
            display: flex;
        }
        .modal-card {
            background: #ffffff;
            width: 90%;
            max-width: 520px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            animation: modalFadeIn 0.3s ease;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .modal-header {
            background: var(--primary-gradient);
            color: white;
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-header h3 {
            color: white;
            font-size: 18px;
        }
        .modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            line-height: 1;
        }
        .modal-body {
            padding: 24px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #374151;
        }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 14px;
            font-family: inherit;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(100,20,31,0.1);
        }
        .btn-submit {
            width: 100%;
            background: #64141f;
            color: white;
            border-style: solid;
            border-width: 0;
            border-color: #64141f;
            padding: 10px 40px;
            font-size: 15px;
            font-size: 1rem;
            font-weight: inherit;
            font-family: inherit;
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.25s ease;
            line-height: 1;
        }
        .btn-submit:hover {
            background: #3a3a3a;
            border-color: #3a3a3a;
            color: white;
        }

        /* Pagination Styling */
        nav[aria-label="Pagination Navigation"] svg,
        .pagination-wrap svg,
        nav svg {
            width: 18px !important;
            height: 18px !important;
            display: inline-block;
            vertical-align: middle;
        }
        nav[aria-label="Pagination Navigation"] > div:first-child {
            margin-bottom: 12px;
            font-size: 13.5px;
            color: #64748b;
        }
        nav[aria-label="Pagination Navigation"] span,
        nav[aria-label="Pagination Navigation"] a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
            .main-nav {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: white;
                flex-direction: column;
                padding: 20px;
                border-top: 1px solid #eee;
                box-shadow: 0 10px 20px rgba(0,0,0,0.1);
                align-items: flex-start;
                gap: 12px;
            }
            .main-nav.active {
                display: flex;
            }
            .mobile-toggle {
                display: block;
            }
            .dropdown-menu {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: none;
                box-shadow: none;
                border-top: none;
                border-left: 2px solid var(--primary);
                padding-left: 10px;
            }
        }
        @media (max-width: 640px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }
            .top-bar-inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Top Bar - 100% Full Width -->
    <div class="top-bar">
        <div class="top-bar-inner">
            <div class="top-bar-left">
                <span>📍 Mumbai, Maharashtra, India</span>
                <a href="tel:+919920669561">📞 +91 99206 69561</a>
                <a href="mailto:info@sdinternational.com">✉️ info@sdinternational.com</a>
            </div>
            <div class="top-bar-right">
                <a href="https://api.whatsapp.com/send?phone=919920669561" target="_blank" title="WhatsApp">💬 WhatsApp</a>
                <a href="skype:sdinternational?chat" target="_blank" title="Skype">📞 Skype</a>
                <div id="google_translate_element"></div>
                <form action="{{ url('/products') }}" method="GET" class="top-search-form">
                    <input type="text" name="q" class="top-search-input" placeholder="Search chemicals...">
                    <button type="submit" class="top-search-btn" aria-label="Search">🔍</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header - 100% Full Width -->
    <header class="site-header">
        <div class="header-inner">
            <a href="{{ url('/') }}" class="site-logo">
                <img src="{{ asset('uploads/2020/07/logo-180x55.png') }}" alt="SD International Logo" width="180" height="55">
            </a>

            <button class="mobile-toggle" onclick="toggleMenu()" aria-label="Toggle navigation">☰</button>

            <ul class="main-nav" id="mainMenu">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/about-us') }}" class="nav-link">About Us</a>
                </li>
                <li class="nav-item has-mega">
                    <a href="{{ url('/products') }}" class="nav-link">Products ▾</a>
                    <div class="mega-dropdown">
                        <!-- Column 1: DYES -->
                        <div>
                            <div class="mega-col-title"><a href="{{ url('/products') }}?category=dyes">DYES</a></div>
                            <ul class="mega-col-links">
                                <li><a href="{{ url('/basic-dyes') }}">Basic Dyes</a></li>
                                <li><a href="{{ url('/disperse-dyes') }}">Disperse Dyes</a></li>
                                <li><a href="{{ url('/powder-solvent-dyes') }}">Powder Solvent Dyes</a></li>
                                <li><a href="{{ url('/liquid-solvent-dyes') }}">Liquid Solvent Dyes</a></li>
                                <li><a href="{{ url('/metal-complex-solvent-dyes') }}">Metal Complex Solvent Dyes</a></li>
                                <li><a href="{{ url('/vat-dyes') }}">Vat Dyes</a></li>
                                <li><a href="{{ url('/acid-dyes') }}">Acid Dyes</a></li>
                                <li><a href="{{ url('/cationic-dyes') }}">Cationic Dyes</a></li>
                                <li><a href="{{ url('/direct-dyes') }}">Direct Dyes</a></li>
                                <li><a href="{{ url('/reactive-dyes') }}">Reactive Dyes</a></li>
                            </ul>
                        </div>

                        <!-- Column 2: F D & C COLOURS -->
                        <div>
                            <div class="mega-col-title"><a href="{{ url('/f-d-c-colours') }}">F D & C COLOURS</a></div>
                            <ul class="mega-col-links">
                                <li><a href="{{ url('/tartrazine-dyes') }}">Tartrazine Dyes</a></li>
                                <li><a href="{{ url('/sunset-yellow') }}">Sunset Yellow</a></li>
                                <li><a href="{{ url('/carmoisine') }}">Carmoisine</a></li>
                                <li><a href="{{ url('/ponceau-4r') }}">Ponceau 4R</a></li>
                                <li><a href="{{ url('/amaranth') }}">Amaranth</a></li>
                                <li><a href="{{ url('/allura-red') }}">Allura Red</a></li>
                                <li><a href="{{ url('/brilliant-blue-fcf') }}">Brilliant Blue FCF</a></li>
                                <li><a href="{{ url('/indigo-carmine') }}">Indigo Carmine</a></li>
                                <li><a href="{{ url('/f-d-c-colours') }}" class="mega-highlight-link">View All Food Colours →</a></li>
                            </ul>
                        </div>

                        <!-- Column 3: PIGMENTS -->
                        <div>
                            <div class="mega-col-title"><a href="{{ url('/products') }}?category=pigments">PIGMENTS</a></div>
                            <ul class="mega-col-links">
                                <li><a href="{{ url('/organic-pigments') }}">Organic Pigments</a></li>
                                <li><a href="{{ url('/high-performance-pigments') }}">High Performance Pigments</a></li>
                                <li><a href="{{ url('/fluorescent-pigments') }}">Fluorescent Pigments</a></li>
                                <li><a href="{{ url('/pu-foam-pigments') }}">Pu Foam Pigments</a></li>
                                <li><a href="{{ url('/ultra-marine-pigments') }}">Ultra Marine Pigments</a></li>
                            </ul>
                        </div>

                        <!-- Column 4: OTHER PRODUCTS -->
                        <div>
                            <div class="mega-col-title"><a href="{{ url('/products') }}">OTHER PRODUCTS</a></div>
                            <ul class="mega-col-links">
                                <li><a href="{{ url('/naphthols') }}">Naphthols</a></li>
                                <li><a href="{{ url('/fast-colour-bases') }}">Fast Colour Bases</a></li>
                                <li><a href="{{ url('/fast-colour-salts') }}">Fast Colour Salts</a></li>
                                <li><a href="{{ url('/pyrazolone-intermediates') }}">Pyrazolone Intermediates</a></li>
                                <li><a href="{{ url('/auxiliaries') }}">Auxiliaries</a></li>
                                <li><a href="{{ url('/products') }}" class="mega-highlight-link">All 600+ Products Catalog →</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/applications') }}" class="nav-link">Applications</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/certifications') }}" class="nav-link">Certifications</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/sustainability') }}" class="nav-link">Sustainability</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/blogs') }}" class="nav-link">Blogs</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/contact-us') }}" class="nav-link">Contact Us</a>
                </li>
            </ul>

            <div class="header-action">
                <button type="button" class="btn-enquire" onclick="openQuoteModal()">Enquire Now</button>
            </div>
        </div>
    </header>

    <!-- Optional Breadcrumb Bar -->
    @if(!empty($breadcrumbs))
    <div class="breadcrumb-bar">
        <div class="container">
            <ul class="breadcrumb-list">
                @foreach($breadcrumbs as $title => $url)
                    @if(!$loop->last)
                        <li class="breadcrumb-item"><a href="{{ $url }}">{{ $title }}</a></li>
                        <li class="breadcrumb-separator">/</li>
                    @else
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- Main Content Yield -->
    <main>
        @yield('content')
    </main>

    <!-- Floating WhatsApp Widget -->
    <a href="https://api.whatsapp.com/send?phone=919920669561&text=Hello%20SD%20International,%20I%20am%20interested%20in%20your%20products." class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.364 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592z"/>
        </svg>
        <span>Chat on WhatsApp</span>
    </a>

    <!-- Universal Quote / Inquiry Modal -->
    <div class="modal-overlay" id="quoteModal">
        <div class="modal-card">
            <div class="modal-header">
                <h3 id="modalTitle">Get Latest Price & Specifications</h3>
                <button type="button" class="modal-close" onclick="closeQuoteModal()">&times;</button>
            </div>
            <div class="modal-body">
                <form id="inquiryForm" action="{{ url('/inquiries') }}" method="POST" onsubmit="submitInquiry(event)">
                    @csrf
                    <input type="hidden" name="product_name" id="modalProductName" value="">
                    <input type="hidden" name="product_slug" id="modalProductSlug" value="">

                    <div class="form-group">
                        <label for="inq_name">Your Name *</label>
                        <input type="text" name="name" id="inq_name" class="form-control" placeholder="Full Name" required>
                    </div>

                    <div class="form-group">
                        <label for="inq_email">Email Address *</label>
                        <input type="email" name="email" id="inq_email" class="form-control" placeholder="name@company.com" required>
                    </div>

                    <div class="form-group">
                        <label for="inq_phone">Phone / WhatsApp *</label>
                        <input type="tel" name="phone" id="inq_phone" class="form-control" placeholder="+91 99206 69561" required>
                    </div>

                    <div class="form-group">
                        <label for="inq_message">Message / Quantity Requirements</label>
                        <textarea name="message" id="inq_message" rows="3" class="form-control" placeholder="Please specify desired quantity, packaging, or technical specs..."></textarea>
                    </div>

                    <div id="inquiryFeedback" style="display:none; margin-bottom: 12px; padding: 10px; border-radius: 4px;"></div>

                    <button type="submit" class="btn-submit" id="inquiryBtn">Submit Inquiry</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Site Footer - Full Width -->
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-grid">
                <div class="footer-col">
                    <div style="background: #ffffff; padding: 10px 16px; border-radius: 6px; display: inline-block; margin-bottom: 18px; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                        <img src="{{ asset('uploads/2020/07/logo-180x55.png') }}" alt="SD International" style="max-height: 42px; width: auto; display: block;">
                    </div>
                    <p style="font-size: 13.5px; line-height: 1.7; color: #9ca3af; margin-bottom: 15px;">
                        S D International is one of India's premier manufacturers and global exporters of Vat Dyes, Solvent Dyes, Disperse Dyes, Organic Pigments, Food Colours, Naphthols, and chemical intermediates.
                    </p>
                    <div style="font-size: 13px; color: #cbd5e1; line-height: 1.6;">
                        <p><strong>Corporate Office:</strong><br>
                        701, Ashok Heights, Off Old Nagardas Road, Near Saraswati Towers, Gundavali Hill, Andheri East, Mumbai - 400069, Maharashtra, India.</p>
                        <p style="margin-top: 8px;"><strong>Executive Contacts:</strong><br>
                        Mr. Jagdeep Mehta (Chairman & Managing Director)<br>
                        Mr. Dhruv Mehta (Sales & Marketing Director)</p>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Dyes Range</h4>
                    <ul class="footer-links">
                        <li><a href="{{ url('/vat-dyes') }}">Vat Dyes</a></li>
                        <li><a href="{{ url('/basic-dyes') }}">Basic Dyes</a></li>
                        <li><a href="{{ url('/disperse-dyes') }}">Disperse Dyes</a></li>
                        <li><a href="{{ url('/solvent-dyes') }}">Solvent Dyes</a></li>
                        <li><a href="{{ url('/reactive-dyes') }}">Reactive Dyes</a></li>
                        <li><a href="{{ url('/acid-dyes') }}">Acid Dyes</a></li>
                        <li><a href="{{ url('/cationic-dyes') }}">Cationic Dyes</a></li>
                        <li><a href="{{ url('/direct-dyes') }}">Direct Dyes</a></li>
                        <li><a href="{{ url('/metal-complex-solvent-dyes') }}">Metal Complex Dyes</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>F D & C & Pigments</h4>
                    <ul class="footer-links">
                        <li><a href="{{ url('/f-d-c-colours') }}">F D & C Colours</a></li>
                        <li><a href="{{ url('/organic-pigments') }}">Organic Pigments</a></li>
                        <li><a href="{{ url('/high-performance-pigments') }}">High Performance Pigments</a></li>
                        <li><a href="{{ url('/fluorescent-pigments') }}">Fluorescent Pigments</a></li>
                        <li><a href="{{ url('/pu-foam-pigments') }}">PU Foam Pigments</a></li>
                        <li><a href="{{ url('/ultra-marine-pigments') }}">Ultra Marine Pigments</a></li>
                        <li><a href="{{ url('/applications') }}">Target Applications</a></li>
                        <li><a href="{{ url('/certifications') }}">ISO Certifications</a></li>
                    </ul>
                </div>

                <div class="footer-col footer-contact">
                    <h4>Other Products & Support</h4>
                    <ul class="footer-links" style="margin-bottom: 16px;">
                        <li><a href="{{ url('/naphthols') }}">Naphthols</a></li>
                        <li><a href="{{ url('/fast-colour-bases') }}">Fast Colour Bases</a></li>
                        <li><a href="{{ url('/fast-colour-salts') }}">Fast Colour Salts</a></li>
                        <li><a href="{{ url('/pyrazolone-intermediates') }}">Pyrazolone Intermediates</a></li>
                        <li><a href="{{ url('/auxiliaries') }}">Textile Auxiliaries</a></li>
                    </ul>
                    <p>
                        📞 <a href="tel:+919920669561">+91 99206 69561</a> / <a href="tel:+919820454441">+91 98204 54441</a>
                    </p>
                    <p>
                        ☎️ <span>022 2683 6000 / 7000</span>
                    </p>
                    <p>
                        ✉️ <a href="mailto:info@sdinternational.com">info@sdinternational.com</a>
                    </p>
                    <p>
                        🌐 <a href="https://sdinternational.com">www.sdinternational.com</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Full-Width Warm Gold Copyright Bar (Matching Live Site) -->
    <div class="site-copyright-bar">
        <div class="copyright-inner">
            <p>&copy; {{ date('Y') }} S D International. all right reserved | Designed & Marketed by Newness Marketing Technology</p>
            <div class="copyright-socials">
                <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer">🔗 LinkedIn</a>
                <a href="https://facebook.com" target="_blank" rel="noopener noreferrer">🌐 Facebook</a>
                <a href="https://twitter.com" target="_blank" rel="noopener noreferrer">🐦 Twitter</a>
                <a href="https://instagram.com" target="_blank" rel="noopener noreferrer">📸 Instagram</a>
            </div>
        </div>
    </div>

    <!-- Google Translate Script -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script>
        function toggleMenu() {
            var menu = document.getElementById('mainMenu');
            menu.classList.toggle('active');
        }

        function openQuoteModal(productName = '', productSlug = '') {
            document.getElementById('modalProductName').value = productName;
            document.getElementById('modalProductSlug').value = productSlug;
            if (productName) {
                document.getElementById('modalTitle').innerText = 'Enquire for ' + productName;
            } else {
                document.getElementById('modalTitle').innerText = 'Get Latest Price & Specifications';
            }
            document.getElementById('quoteModal').classList.add('active');
        }

        function closeQuoteModal() {
            document.getElementById('quoteModal').classList.remove('active');
            document.getElementById('inquiryFeedback').style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('quoteModal');
            if (event.target == modal) {
                closeQuoteModal();
            }
        }

        function submitInquiry(e) {
            e.preventDefault();
            var form = e.target;
            var btn = form.querySelector('button[type="submit"]') || document.getElementById('inquiryBtn');
            var originalBtnText = btn ? btn.innerText : 'Submit';
            if (btn) {
                btn.disabled = true;
                btn.innerText = 'Submitting...';
            }

            var formData = new FormData(form);

            fetch('{{ url('/inquiries') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Thank you! Your inquiry has been submitted. Our export sales team will reach out promptly.');
                    form.reset();
                    if (document.getElementById('quoteModal').classList.contains('active')) {
                        closeQuoteModal();
                    }
                } else {
                    alert('Error submitting inquiry. Please verify your details.');
                }
            })
            .catch(error => {
                alert('Server error. Please reach out to us directly at info@sdinternational.com or +91 99206 69561');
            })
            .finally(() => {
                if (btn) {
                    btn.disabled = false;
                    btn.innerText = originalBtnText;
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
