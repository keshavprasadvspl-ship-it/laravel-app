<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>{{ $seo['title'] ?? 'SD International - Vat dyes manufacturer in india, solvent dyes manufacturer in india, Disperse dyes, food colours, organic pigments, Naphthols, fast bases & salts manufacturer in india' }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'Vat dyes manufacturer in india, solvent dyes manufacturer in india, Disperse dyes, food colours, organic pigments, Naphthols, fast bases & salts manufacturer in india' }}">
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
    <meta property="og:image" content="{{ $seo['og_image'] ?? asset('uploads/2020/07/logo.png') }}">

    <link rel="icon" type="image/png" href="{{ asset('uploads/2020/07/logo-64x19.png') }}">

    <!-- Google Fonts: Montserrat, Open Sans, Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- 1. Astra Theme & Addons -->
    <link rel="stylesheet" href="{{ asset('css/live/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/live/astra-addon-68597f61992401-66099668.css') }}">

    <!-- 2. Elementor Core & Pro Stylesheets (100% exact live site replica) -->
    <link rel="stylesheet" href="{{ asset('css/live/elementor-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/live/frontend-legacy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/live/frontend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/live/elementor-pro-frontend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/live/powerpack-frontend.min.css') }}">

    <!-- 3. Elementor Kits & Global Tokens -->
    <link rel="stylesheet" href="{{ asset('css/live/post-17.css') }}">
    <link rel="stylesheet" href="{{ asset('css/live/global.css') }}">

    <!-- 4. ElementsKit Widgets Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/live/ekiticons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/live/widget-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/live/widget-styles-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/live/responsive.css') }}">

    <!-- 5. Header 21 & Footer 61 Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/live/post-21.css') }}">
    <link rel="stylesheet" href="{{ asset('css/live/post-61.css') }}">

    <!-- 6. SD International Live Customizer Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/live/sd-custom-live.css') }}">

    <!-- 7. Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

    @stack('styles')

    <style>
        :root {
            /* Brand Identity Colors */
            --primary: #64141f;
            --primary-hover: #4e0f18;
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
            --border: #e2e8f0;
            --font-heading: 'Montserrat', sans-serif;
            --font-body: 'Open Sans', sans-serif;

            /* Elementor Global Color & Typography mappings */
            --e-global-color-primary: #64141f;
            --e-global-color-secondary: #000000;
            --e-global-color-text: #4b4f58;
            --e-global-color-accent: #64141f;
            --e-global-typography-primary-font-family: 'Montserrat', sans-serif;
            --e-global-typography-primary-font-weight: 600;
            --e-global-typography-secondary-font-family: 'Open Sans', sans-serif;
            --e-global-typography-secondary-font-weight: 400;
            --e-global-typography-text-font-family: 'Open Sans', sans-serif;
            --e-global-typography-text-font-weight: 400;
            --e-global-typography-accent-font-family: 'Montserrat', sans-serif;
            --e-global-typography-accent-font-weight: 600;
        }

        /* Essential Container Width across non-elementor views */
        .site-content > .container,
        #content > .container {
            max-width: 1240px;
            margin-left: auto;
            margin-right: auto;
            padding-left: clamp(16px, 2.5vw, 30px);
            padding-right: clamp(16px, 2.5vw, 30px);
            width: 100%;
            box-sizing: border-box;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: #ffffff;
            color: #4b4f58;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Header Top Bar (Gold Bar #C49F6A) */
        .elementor-element-850d87a {
            background-color: #C49F6A !important;
            padding: 6px 0 !important;
            min-height: 42px !important;
            display: flex !important;
            align-items: center !important;
            border-bottom: 1px solid rgba(0,0,0,0.06) !important;
        }
        .elementor-element-850d87a > .elementor-container {
            max-width: 1280px !important;
            width: 100% !important;
            margin: 0 auto !important;
            padding: 0 clamp(16px, 2vw, 30px) !important;
            display: flex !important;
            align-items: center !important;
        }
        .elementor-element-850d87a .elementor-row {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            justify-content: space-between !important;
            width: 100% !important;
            flex-wrap: wrap !important;
            gap: 10px !important;
        }
        .elementor-element-5a8a921 {
            width: auto !important;
            flex: 0 0 auto !important;
        }
        .elementor-element-5a8a921 ul.elementor-icon-list-items {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            gap: 18px !important;
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .elementor-element-5a8a921 .elementor-icon-list-item a {
            color: #ffffff !important;
            text-decoration: none !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
        }
        .elementor-element-d1a6b87 {
            width: auto !important;
            flex: 0 0 auto !important;
        }
        .elementor-element-d1a6b87 ul.elementor-icon-list-items {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            gap: 12px !important;
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .elementor-element-d1a6b87 .elementor-icon-list-item a {
            color: #ffffff !important;
            font-size: 15px !important;
            display: inline-flex !important;
            align-items: center !important;
        }
        .elementor-element-3d68fb3 {
            width: auto !important;
            flex: 0 0 auto !important;
        }
        .elementor-element-fa0359c {
            width: auto !important;
            flex: 0 0 auto !important;
            min-width: 240px !important;
        }
        .elementor-search-form__container {
            display: flex !important;
            align-items: center !important;
            background-color: #E7D8C2 !important;
            border-radius: 4px !important;
            overflow: hidden !important;
            height: 32px !important;
        }
        .elementor-search-form__input {
            background: transparent !important;
            border: none !important;
            outline: none !important;
            padding: 0 12px !important;
            font-size: 13px !important;
            color: #333333 !important;
            flex: 1 !important;
            height: 100% !important;
        }
        .elementor-search-form__submit {
            background: #64141F !important;
            color: #ffffff !important;
            border: none !important;
            outline: none !important;
            width: 34px !important;
            height: 100% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
        }

        /* Main Navigation Bar (Section 3397fd0b) */
        .elementor-element-3397fd0b {
            background-color: #ffffff !important;
            border-bottom: 1px solid #E1E1E1 !important;
            padding: 10px 0 !important;
            position: relative !important;
            z-index: 1000 !important;
        }
        .elementor-element-3397fd0b > .elementor-container {
            max-width: 1280px !important;
            width: 100% !important;
            margin: 0 auto !important;
            padding: 0 clamp(16px, 2vw, 30px) !important;
            box-sizing: border-box !important;
            display: flex !important;
            align-items: center !important;
        }
        .elementor-element-3397fd0b .elementor-row {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            justify-content: space-between !important;
            width: 100% !important;
            flex-wrap: nowrap !important;
        }

        /* Col 1: Logo */
        .elementor-element-3397fd0b .elementor-element-35fca2aa {
            width: auto !important;
            flex: 0 0 auto !important;
        }
        .elementor-element-3397fd0b .elementor-element-6318580 img {
            max-width: 210px !important;
            width: auto !important;
            height: 52px !important;
            object-fit: contain !important;
            display: block !important;
        }

        /* Col 2: Navigation Menu */
        .elementor-element-3397fd0b .elementor-element-3aa8b45e {
            width: auto !important;
            flex: 1 1 auto !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
        }
        .elementor-element-71fa8a5 {
            width: 100% !important;
        }
        .elementor-element-71fa8a5 .elementor-widget-container {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
        }

        /* Desktop Main Horizontal Navigation */
        .elementor-nav-menu--main {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            width: 100% !important;
        }
        .elementor-nav-menu--main ul.elementor-nav-menu {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            align-items: center !important;
            justify-content: flex-end !important;
            list-style: none !important;
            list-style-type: none !important;
            margin: 0 !important;
            padding: 0 !important;
            gap: 2px !important;
        }
        .elementor-nav-menu--main ul.elementor-nav-menu > li {
            display: inline-flex !important;
            align-items: center !important;
            list-style: none !important;
            list-style-type: none !important;
            margin: 0 !important;
            padding: 0 !important;
            position: relative !important;
        }
        .elementor-nav-menu--main ul.elementor-nav-menu > li::before,
        .elementor-nav-menu--main ul.elementor-nav-menu > li::after {
            display: none !important;
            content: none !important;
        }
        .elementor-nav-menu--main .elementor-item {
            display: inline-block !important;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.3px !important;
            color: #64141F !important;
            padding: 8px 9px !important;
            text-decoration: none !important;
            white-space: nowrap !important;
            transition: color 0.2s ease !important;
            background: transparent !important;
            border: none !important;
        }
        .elementor-nav-menu--main .elementor-item:hover,
        .elementor-nav-menu--main .elementor-item.elementor-item-active {
            color: #951634 !important;
            background: transparent !important;
        }

        /* Col 3: Enquiry Now Button */
        .elementor-element-3397fd0b .elementor-element-9d55ed1 {
            width: auto !important;
            flex: 0 0 auto !important;
            margin-left: 14px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
        }
        .elementor-element-f006f4c .elementor-button {
            background: linear-gradient(180deg, #951634 0%, #73001B 100%) !important;
            color: #ffffff !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            padding: 9px 20px !important;
            border-radius: 4px !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            white-space: nowrap !important;
            box-shadow: 0 3px 10px rgba(100,20,31,0.2) !important;
            transition: background 0.2s, transform 0.1s !important;
        }
        .elementor-element-f006f4c .elementor-button:hover {
            background: #3a3a3a !important;
            color: #ffffff !important;
        }

        /* Desktop Dropdown Submenus */
        .elementor-nav-menu--main .sub-menu {
            display: none !important;
            position: absolute !important;
            top: 100% !important;
            left: 0 !important;
            min-width: 220px !important;
            background: #ffffff !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12) !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            padding: 8px 0 !important;
            margin: 0 !important;
            list-style: none !important;
            z-index: 99999 !important;
            text-align: left !important;
        }
        .elementor-nav-menu--main li:hover > .sub-menu {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        .elementor-nav-menu--main .sub-menu li {
            display: block !important;
            list-style: none !important;
            margin: 0 !important;
            padding: 0 !important;
            position: relative !important;
            width: 100% !important;
        }
        .elementor-nav-menu--main .sub-menu li::before,
        .elementor-nav-menu--main .sub-menu li::after {
            display: none !important;
            content: none !important;
        }
        .elementor-nav-menu--main .sub-menu li a,
        .elementor-nav-menu--main .elementor-sub-item {
            display: block !important;
            padding: 8px 18px !important;
            color: #334155 !important;
            font-size: 13.5px !important;
            font-weight: 500 !important;
            text-transform: none !important;
            text-decoration: none !important;
            white-space: nowrap !important;
            transition: all 0.15s ease !important;
        }
        .elementor-nav-menu--main .sub-menu li a:hover {
            background: #fdf2f3 !important;
            color: #64141f !important;
            padding-left: 22px !important;
        }
        .elementor-nav-menu--main .sub-menu .sub-menu {
            top: 0 !important;
            left: 100% !important;
        }

        /* Responsive Breakpoint Controls */
        @media (min-width: 1025px) {
            .elementor-menu-toggle {
                display: none !important;
            }
            nav.elementor-nav-menu--dropdown {
                display: none !important;
            }
            .elementor-nav-menu--main {
                display: flex !important;
            }
        }

        @media (max-width: 1024px) {
            .elementor-element-3397fd0b .elementor-row {
                flex-wrap: nowrap !important;
                justify-content: space-between !important;
            }
            .elementor-element-3397fd0b .elementor-element-35fca2aa {
                max-width: 180px !important;
            }
            .elementor-element-3397fd0b .elementor-element-6318580 img {
                max-width: 150px !important;
                height: 40px !important;
            }
            .elementor-nav-menu--main {
                display: none !important;
            }
            .elementor-element-3397fd0b .elementor-element-3aa8b45e {
                flex: 0 0 auto !important;
                order: 3 !important;
            }
            .elementor-element-3397fd0b .elementor-element-9d55ed1 {
                flex: 0 0 auto !important;
                order: 2 !important;
                margin-left: auto !important;
                margin-right: 10px !important;
            }
            .elementor-element-f006f4c .elementor-button {
                padding: 7px 14px !important;
                font-size: 13px !important;
            }
            .elementor-menu-toggle {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                width: 38px !important;
                height: 38px !important;
                border: 1px solid #e2e8f0 !important;
                border-radius: 4px !important;
                background: #ffffff !important;
                color: #64141F !important;
                font-size: 20px !important;
                cursor: pointer !important;
            }
            .elementor-menu-toggle i.eicon-menu-bar::before {
                content: "\f0c9" !important;
                font-family: "Font Awesome 5 Free" !important;
                font-weight: 900 !important;
            }
            nav.elementor-nav-menu--dropdown {
                display: none;
                position: absolute !important;
                top: 100% !important;
                left: 0 !important;
                right: 0 !important;
                width: 100% !important;
                background: #ffffff !important;
                box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
                border-top: 2px solid #64141f !important;
                z-index: 999999 !important;
                padding: 15px 24px !important;
                box-sizing: border-box !important;
                max-height: 80vh !important;
                overflow-y: auto !important;
            }
            nav.elementor-nav-menu--dropdown.show-dropdown {
                display: block !important;
            }
            nav.elementor-nav-menu--dropdown ul.elementor-nav-menu {
                list-style: none !important;
                padding: 0 !important;
                margin: 0 !important;
                display: flex !important;
                flex-direction: column !important;
            }
            nav.elementor-nav-menu--dropdown ul.elementor-nav-menu > li {
                list-style: none !important;
                border-bottom: 1px solid #f1f5f9 !important;
                margin: 0 !important;
                padding: 4px 0 !important;
                text-align: left !important;
            }
            nav.elementor-nav-menu--dropdown ul.elementor-nav-menu > li::before,
            nav.elementor-nav-menu--dropdown ul.elementor-nav-menu > li::after {
                display: none !important;
                content: none !important;
            }
            nav.elementor-nav-menu--dropdown .elementor-item {
                display: block !important;
                color: #0f172a !important;
                font-size: 14px !important;
                font-weight: 600 !important;
                text-decoration: none !important;
                padding: 8px 0 !important;
                text-transform: uppercase !important;
                font-family: 'Montserrat', sans-serif !important;
            }
            nav.elementor-nav-menu--dropdown .elementor-item:hover {
                color: #64141f !important;
            }
            nav.elementor-nav-menu--dropdown .sub-menu {
                display: block !important;
                position: static !important;
                box-shadow: none !important;
                border: none !important;
                border-left: 2px solid #fecdd3 !important;
                padding-left: 14px !important;
                margin: 4px 0 8px 6px !important;
                background: transparent !important;
                list-style: none !important;
            }
            nav.elementor-nav-menu--dropdown .sub-menu li {
                list-style: none !important;
                border: none !important;
                padding: 3px 0 !important;
            }
            nav.elementor-nav-menu--dropdown .sub-menu li a {
                font-size: 13px !important;
                color: #475569 !important;
                text-transform: none !important;
                font-weight: 500 !important;
                display: block !important;
                text-decoration: none !important;
            }
            nav.elementor-nav-menu--dropdown .sub-menu li a:hover {
                color: #64141f !important;
            }
        }

        /* Global Form Controls & Inputs */
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label, .form-label {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-control, .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 11px 14px;
            font-size: 14.5px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            outline: none;
            box-sizing: border-box;
            font-family: inherit;
            background: #ffffff;
            color: #1e293b;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus, .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(100, 20, 31, 0.12);
        }

        /* Global Standard Buttons */
        .btn-submit, .btn-primary {
            background: var(--primary);
            color: #ffffff !important;
            border: none;
            border-radius: 6px;
            padding: 11px 22px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        .btn-submit:hover, .btn-primary:hover {
            background: var(--primary-hover);
            color: #ffffff !important;
        }
        .btn-outline {
            background: transparent;
            color: #334155 !important;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, border-color 0.2s;
        }
        .btn-outline:hover {
            background: #f8fafc;
            border-color: #94a3b8;
            color: #0f172a !important;
        }
        .btn-enquire, .btn-card-quote {
            background: var(--primary);
            color: #ffffff !important;
            border: none;
            border-radius: 4px;
            padding: 7px 14px;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }
        .btn-enquire:hover, .btn-card-quote:hover {
            background: var(--primary-hover);
            color: #ffffff !important;
        }

        /* Global Pagination Styles */
        .pagination-wrap {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            width: 100%;
        }
        .pagination-wrap nav {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            flex-wrap: wrap;
        }
        .pagination-wrap svg {
            width: 16px !important;
            height: 16px !important;
            max-width: 16px !important;
            max-height: 16px !important;
            display: inline-block !important;
        }
        .pagination-wrap .flex.justify-between.flex-1 {
            display: none !important;
        }
        .pagination-wrap span, .pagination-wrap a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #334155;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.2s;
        }
        .pagination-wrap a:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: var(--primary);
        }
        .pagination-wrap [aria-current="page"] span {
            background: var(--primary) !important;
            color: #ffffff !important;
            border-color: var(--primary) !important;
        }

        /* Sticky header */
        .elementor-element-3397fd0b.is-sticky {
            position: fixed !important;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
            background: #ffffff !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            animation: slideDown 0.3s ease;
        }
        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }

        /* Modal Enquiry Popup */
        #enquiryModalOverlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 999999;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        #enquiryModalOverlay.active {
            display: flex;
        }
        .enquiry-modal-content {
            background: #ffffff;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 8px;
            padding: 30px;
            position: relative;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        .enquiry-modal-close {
            position: absolute;
            top: 15px;
            right: 18px;
            font-size: 26px;
            background: none;
            border: none;
            cursor: pointer;
            color: #64141f;
            font-weight: 700;
        }

        /* WhatsApp Floating Button */
        .sd-whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #25d366;
            color: #ffffff;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.25);
            z-index: 99999;
            transition: transform 0.2s ease;
            text-decoration: none;
        }
        .sd-whatsapp-float:hover {
            transform: scale(1.1);
            color: #ffffff;
        }
    </style>
</head>
<body itemtype='https://schema.org/WebPage' itemscope='itemscope' class="{{ request()->is('/') ? 'home page-template-default page page-id-136 wp-custom-logo wp-theme-astra theme-astra woocommerce-no-js ast-desktop ast-plain-container ast-no-sidebar astra-3.7.10 ast-header-custom-item-inside ast-single-post ast-inherit-site-logo-transparent above-header-nav-padding-support ast-full-width-layout ast-sticky-header-shrink ast-inherit-site-logo-sticky elementor-default elementor-kit-17 elementor-page elementor-page-136 astra-addon-3.6.6' : 'not-home inner-page wp-custom-logo wp-theme-astra theme-astra ast-desktop ast-plain-container ast-no-sidebar astra-3.7.10 astra-addon-3.6.6' }}">

<a class="skip-link screen-reader-text" href="#content" role="link" title="Skip to content">Skip to content</a>

<div class="hfeed site" id="page">

    @if(session('success'))
    <div style="background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; padding:12px 18px; border-radius:6px; margin:15px; font-weight:600; text-align:center;">
        ✓ {{ session('success') }}
    </div>
    @endif

    <!-- Exact Header 21 -->
    <div data-elementor-type="header" data-elementor-id="21" class="elementor elementor-21 elementor-location-header">
		<div class="elementor-section-wrap">
					<section class="elementor-section elementor-top-section elementor-element elementor-element-850d87a elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="850d87a" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;ekit_has_onepagescroll_dot&quot;:&quot;yes&quot;}">
						<div class="elementor-container elementor-column-gap-default">
							<div class="elementor-row">
					<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-5a8a921" data-id="5a8a921" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-659825a elementor-icon-list--layout-inline elementor-mobile-align-center elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="659825a" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
					<ul class="elementor-icon-list-items elementor-inline-items">
							<li class="elementor-icon-list-item elementor-inline-item">
											<a href="tel:+9199206%2069561%20" target="_blank">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-phone-alt"></i>						</span>
										<span class="elementor-icon-list-text"> +91 99206 69561 </span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="mailto:info@sdinternational.com" target="_blank">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="far fa-envelope"></i>						</span>
										<span class="elementor-icon-list-text">info@sdinternational.com</span>
											</a>
									</li>
						</ul>
				</div>
				</div>
						</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-d1a6b87 elementor-hidden-phone" data-id="d1a6b87" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-7f0b87c elementor-icon-list--layout-inline elementor-align-center elementor-hidden-phone elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="7f0b87c" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
					<ul class="elementor-icon-list-items elementor-inline-items">
							<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://wa.link/owdi77" target="_blank">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-whatsapp"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://msng.link/o/?https%3A%2F%2Fu.wechat.com%2FIP3hcBw97OBITMw8MkO7zuQ=wc" target="_blank">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-weixin"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://msng.link/o/?+919920669561=sk" target="_blank">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-skype"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
						</ul>
				</div>
				</div>
						</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-3d68fb3 elementor-hidden-phone" data-id="3d68fb3" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-96d4d7e elementor-hidden-phone elementor-widget elementor-widget-html" data-id="96d4d7e" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="html.default">
				<div class="elementor-widget-container">
			<div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>		</div>
				</div>
						</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-fa0359c" data-id="fa0359c" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-18d08e4 elementor-search-form--skin-classic elementor-search-form--button-type-icon elementor-search-form--icon-search elementor-widget elementor-widget-search-form" data-id="18d08e4" data-element_type="widget" data-settings="{&quot;skin&quot;:&quot;classic&quot;,&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="search-form.default">
				<div class="elementor-widget-container">
					<form class="elementor-search-form" role="search" action="/products" method="get" style="position: relative;" id="headerSearchForm">
<div class="elementor-search-form__container">
<input placeholder="Search dyes, CAS#, pigments..." class="elementor-search-form__input" type="search" name="s" id="headerSearchInput" title="Search" value="{{ request('s') }}" autocomplete="off">
<button class="elementor-search-form__submit" type="submit" title="Search" aria-label="Search">
<i class="fa fa-search" aria-hidden="true"></i>
<span class="elementor-screen-only">Search</span>
</button>
</div>
<div id="liveSearchResults" style="display: none; position: absolute; top: calc(100% + 5px); left: 0; right: 0; background: white; border: 1px solid #cbd5e1; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); z-index: 99999; max-height: 400px; overflow-y: auto; text-align: left;"></div>
</form>
				</div>
				</div>
						</div>
					</div>
		</div>
								</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-3397fd0b elementor-section-content-middle elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="3397fd0b" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;sticky&quot;:&quot;top&quot;,&quot;animation&quot;:&quot;none&quot;,&quot;ekit_has_onepagescroll_dot&quot;:&quot;yes&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;],&quot;sticky_offset&quot;:0,&quot;sticky_effects_offset&quot;:0}">
						<div class="elementor-container elementor-column-gap-default">
							<div class="elementor-row">
					<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-35fca2aa" data-id="35fca2aa" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-6318580 elementor-widget elementor-widget-theme-site-logo elementor-widget-image" data-id="6318580" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="theme-site-logo.default">
				<div class="elementor-widget-container">
								<div class="elementor-image">
													<a href="/">
							<img width="300" height="91" src="/uploads/2020/07/logo.png" class="attachment-full size-full" alt="" srcset="/uploads/2020/07/logo.png 300w, /uploads/2020/07/logo-120x36.png 120w, /uploads/2020/07/logo-64x19.png 64w, /uploads/2020/07/logo-180x55.png 180w" sizes="(max-width: 300px) 100vw, 300px" />								</a>
														</div>
						</div>
				</div>
						</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-3aa8b45e" data-id="3aa8b45e" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-71fa8a5 elementor-nav-menu--stretch elementor-nav-menu__align-right elementor-nav-menu--indicator-chevron elementor-nav-menu--dropdown-tablet elementor-nav-menu__text-align-aside elementor-nav-menu--toggle elementor-nav-menu--burger elementor-widget elementor-widget-nav-menu" data-id="71fa8a5" data-element_type="widget" data-settings="{&quot;full_width&quot;:&quot;stretch&quot;,&quot;layout&quot;:&quot;horizontal&quot;,&quot;toggle&quot;:&quot;burger&quot;,&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="nav-menu.default">
				<div class="elementor-widget-container">
						<nav role="navigation" class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-none"><ul id="menu-1-71fa8a5" class="elementor-nav-menu"><li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-136 current_page_item menu-item-3324"><a href="/" aria-current="page" class="elementor-item elementor-item-active menu-link">Home</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2842"><a href="/about-us" class="elementor-item menu-link">About Us</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2977"><a href="#" class="elementor-item elementor-item-anchor menu-link">Products</a>
<ul class="sub-menu elementor-nav-menu--dropdown">
	<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-8520"><a href="/dyes" class="elementor-sub-item menu-link">DYES</a>
	<ul class="sub-menu elementor-nav-menu--dropdown">
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8503"><a href="/basic-dyes" class="elementor-sub-item menu-link">Basic Dyes</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8506"><a href="/disperse-dyes" class="elementor-sub-item menu-link">Disperse Dyes</a></li>
		<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-13834"><a href="#" class="elementor-sub-item elementor-item-anchor menu-link">Solvent Dyes</a>
		<ul class="sub-menu elementor-nav-menu--dropdown">
			<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8509"><a href="/powder-solvent-dyes" class="elementor-sub-item menu-link">Powder Solvent Dyes</a></li>
			<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13800"><a href="/liquid-solvent-dyes" class="elementor-sub-item menu-link">Liquid Solvent Dyes</a></li>
		</ul>
</li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8510"><a href="/vat-dyes" class="elementor-sub-item menu-link">Vat Dyes</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8502"><a href="/acid-dyes" class="elementor-sub-item menu-link">Acid Dyes</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8504"><a href="/cationic-dyes" class="elementor-sub-item menu-link">Cationic Dyes</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8505"><a href="/direct-dyes" class="elementor-sub-item menu-link">Direct Dyes</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8508"><a href="/reactive-dyes" class="elementor-sub-item menu-link">Reactive Dyes</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8507"><a href="/metal-complex-solvent-dyes" class="elementor-sub-item menu-link">Metal Complex Solvent Dyes</a></li>
	</ul>
</li>
	<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-10881"><a href="/f-d-c-colours" class="elementor-sub-item menu-link">F D &#038; C COLOURS</a></li>
	<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-10882"><a href="/pigments" class="elementor-sub-item menu-link">PIGMENTS</a>
	<ul class="sub-menu elementor-nav-menu--dropdown">
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8527"><a href="/organic-pigments" class="elementor-sub-item menu-link">Organic Pigments</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8526"><a href="/high-performance-pigments" class="elementor-sub-item menu-link">High Performance Pigments</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8525"><a href="/fluorescent-pigments" class="elementor-sub-item menu-link">Fluorescent Pigments</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-9534"><a href="/pu-foam-pigments" class="elementor-sub-item menu-link">Pu Foam Pigments</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13432"><a href="/ultra-marine-pigments" class="elementor-sub-item menu-link">Ultra Marine Pigments</a></li>
	</ul>
</li>
	<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-13186"><a href="/other-products" class="elementor-sub-item menu-link">Other Products</a>
	<ul class="sub-menu elementor-nav-menu--dropdown">
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13190"><a href="/naphthols" class="elementor-sub-item menu-link">Naphthols</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13188"><a href="/fast-colour-bases" class="elementor-sub-item menu-link">Fast Colour Bases</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13189"><a href="/fast-colour-salts" class="elementor-sub-item menu-link">Fast Colour Salts</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13191"><a href="/pyrazolone-intermediates" class="elementor-sub-item menu-link">Pyrazolone Intermediates</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13187"><a href="/auxiliaries" class="elementor-sub-item menu-link">Auxiliaries</a></li>
	</ul>
</li>
</ul>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2873"><a href="/applications" class="elementor-item menu-link">Applications</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2882"><a href="/certifications" class="elementor-item menu-link">Certifications</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2857"><a href="/sustainability" class="elementor-item menu-link">Sustainability</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9876"><a href="/contact" onclick="event.preventDefault(); openEnquiryModal();" class="elementor-item menu-link">Contact Us</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-13595"><a href="/blogs" class="elementor-item menu-link">Blogs</a></li>
</ul></nav>
					<div class="elementor-menu-toggle" role="button" tabindex="0" aria-label="Menu Toggle" aria-expanded="false">
			<i class="eicon-menu-bar" aria-hidden="true"></i>
			<span class="elementor-screen-only">Menu</span>
		</div>
			<nav class="elementor-nav-menu--dropdown elementor-nav-menu__container" role="navigation" aria-hidden="true"><ul id="menu-2-71fa8a5" class="elementor-nav-menu"><li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-136 current_page_item menu-item-3324"><a href="/" aria-current="page" class="elementor-item elementor-item-active menu-link">Home</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2842"><a href="/about-us" class="elementor-item menu-link">About Us</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2977"><a href="#" class="elementor-item elementor-item-anchor menu-link">Products</a>
<ul class="sub-menu elementor-nav-menu--dropdown">
	<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-8520"><a href="/dyes" class="elementor-sub-item menu-link">DYES</a>
	<ul class="sub-menu elementor-nav-menu--dropdown">
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8503"><a href="/basic-dyes" class="elementor-sub-item menu-link">Basic Dyes</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8506"><a href="/disperse-dyes" class="elementor-sub-item menu-link">Disperse Dyes</a></li>
		<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-13834"><a href="#" class="elementor-sub-item elementor-item-anchor menu-link">Solvent Dyes</a>
		<ul class="sub-menu elementor-nav-menu--dropdown">
			<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8509"><a href="/powder-solvent-dyes" class="elementor-sub-item menu-link">Powder Solvent Dyes</a></li>
			<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13800"><a href="/liquid-solvent-dyes" class="elementor-sub-item menu-link">Liquid Solvent Dyes</a></li>
		</ul>
</li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8510"><a href="/vat-dyes" class="elementor-sub-item menu-link">Vat Dyes</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8502"><a href="/acid-dyes" class="elementor-sub-item menu-link">Acid Dyes</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8504"><a href="/cationic-dyes" class="elementor-sub-item menu-link">Cationic Dyes</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8505"><a href="/direct-dyes" class="elementor-sub-item menu-link">Direct Dyes</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8508"><a href="/reactive-dyes" class="elementor-sub-item menu-link">Reactive Dyes</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8507"><a href="/metal-complex-solvent-dyes" class="elementor-sub-item menu-link">Metal Complex Solvent Dyes</a></li>
	</ul>
</li>
	<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-10881"><a href="/f-d-c-colours" class="elementor-sub-item menu-link">F D &#038; C COLOURS</a></li>
	<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-10882"><a href="/pigments" class="elementor-sub-item menu-link">PIGMENTS</a>
	<ul class="sub-menu elementor-nav-menu--dropdown">
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8527"><a href="/organic-pigments" class="elementor-sub-item menu-link">Organic Pigments</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8526"><a href="/high-performance-pigments" class="elementor-sub-item menu-link">High Performance Pigments</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-8525"><a href="/fluorescent-pigments" class="elementor-sub-item menu-link">Fluorescent Pigments</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-9534"><a href="/pu-foam-pigments" class="elementor-sub-item menu-link">Pu Foam Pigments</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13432"><a href="/ultra-marine-pigments" class="elementor-sub-item menu-link">Ultra Marine Pigments</a></li>
	</ul>
</li>
	<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-13186"><a href="/other-products" class="elementor-sub-item menu-link">Other Products</a>
	<ul class="sub-menu elementor-nav-menu--dropdown">
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13190"><a href="/naphthols" class="elementor-sub-item menu-link">Naphthols</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13188"><a href="/fast-colour-bases" class="elementor-sub-item menu-link">Fast Colour Bases</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13189"><a href="/fast-colour-salts" class="elementor-sub-item menu-link">Fast Colour Salts</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13191"><a href="/pyrazolone-intermediates" class="elementor-sub-item menu-link">Pyrazolone Intermediates</a></li>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-13187"><a href="/auxiliaries" class="elementor-sub-item menu-link">Auxiliaries</a></li>
	</ul>
</li>
</ul>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2873"><a href="/applications" class="elementor-item menu-link">Applications</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2882"><a href="/certifications" class="elementor-item menu-link">Certifications</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2857"><a href="/sustainability" class="elementor-item menu-link">Sustainability</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9876"><a href="/contact" onclick="event.preventDefault(); openEnquiryModal();" class="elementor-item menu-link">Contact Us</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-13595"><a href="/blogs" class="elementor-item menu-link">Blogs</a></li>
</ul></nav>
				</div>
				</div>
						</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-9d55ed1" data-id="9d55ed1" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-f006f4c elementor-align-right elementor-widget elementor-widget-button" data-id="f006f4c" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
			<a href="/contact" onclick="event.preventDefault(); openEnquiryModal();" class="elementor-button-link elementor-button elementor-size-sm" role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-text">Enquiry Now</span>
		</span>
					</a>
		</div>
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
			<div id="content" class="site-content">
		<div class="ast-container">
		

	<div id="primary" class="content-area primary">

		
					<main id="main" class="site-main">
				

    <!-- Main Content Area -->
    <div id="content" class="site-content">
        <div class="ast-container">
            <div id="primary" class="content-area primary">
                <main id="main" class="site-main">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Exact Footer 61 -->
    <div data-elementor-type="footer" data-elementor-id="61" class="elementor elementor-61 elementor-location-footer">
		<div class="elementor-section-wrap">
					<section class="elementor-section elementor-top-section elementor-element elementor-element-f9b6c5f elementor-section-stretched elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="f9b6c5f" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;,&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;ekit_has_onepagescroll_dot&quot;:&quot;yes&quot;}">
						<div class="elementor-container elementor-column-gap-default">
							<div class="elementor-row">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-49dfbb0" data-id="49dfbb0" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-31b24e0 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="31b24e0" data-element_type="section" data-settings="{&quot;ekit_has_onepagescroll_dot&quot;:&quot;yes&quot;}">
						<div class="elementor-container elementor-column-gap-default">
							<div class="elementor-row">
					<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-22dc827" data-id="22dc827" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-5b2a206 elementor-widget elementor-widget-heading" data-id="5b2a206" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<div class="elementor-heading-title elementor-size-default">Join the community</div>		</div>
				</div>
				<div class="elementor-element elementor-element-d2e2e15 elementor-widget elementor-widget-text-editor" data-id="d2e2e15" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
								<div class="elementor-text-editor elementor-clearfix">
				<p>Follow us and stay connected and updated.</p>					</div>
						</div>
				</div>
						</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-8746849" data-id="8746849" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-dfa0568 elementor-icon-list--layout-inline elementor-align-center elementor-tablet-align-center elementor-mobile-align-center elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="dfa0568" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
					<ul class="elementor-icon-list-items elementor-inline-items">
							<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://www.facebook.com/profile.php?id=61557321748434&#038;mibextid=ZbWKwL">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-facebook"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://x.com/internatio90966?t=SGLWhZiHrb3BLkbTG81Tcw&#038;s=09">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-twitter"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://youtube.com/@SDInternational172?si=542KqcRczxne1b6U">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-youtube"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://www.instagram.com/sdinternational8?utm_source=qr&#038;igsh=aWdlZzk4OXd1aXJx">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-instagram"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://www.linkedin.com/in/s-d-international-9096952b9">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-linkedin"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
						</ul>
				</div>
				</div>
						</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-2cfac5c" data-id="2cfac5c" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-cb98f69 elementor-widget elementor-widget-heading" data-id="cb98f69" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<div class="elementor-heading-title elementor-size-default">We’d love to hear from you</div>		</div>
				</div>
				<div class="elementor-element elementor-element-5011576 elementor-widget elementor-widget-text-editor" data-id="5011576" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
								<div class="elementor-text-editor elementor-clearfix">
				Fill out the form and we’ll be in touch as soon as possible.					</div>
						</div>
				</div>
						</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-dc7f42f" data-id="dc7f42f" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-f7ce502 elementor-align-right elementor-widget elementor-widget-button" data-id="f7ce502" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
			<a href="#elementor-action%3Aaction%3Dpopup%3Aopen%26settings%3DeyJpZCI6IjExNzE3IiwidG9nZ2xlIjpmYWxzZX0%3D" class="elementor-button-link elementor-button elementor-size-sm" role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-text">Enquire Now</span>
		</span>
					</a>
		</div>
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
		</div>
								</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-2c99f6d elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="2c99f6d" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;,&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;ekit_has_onepagescroll_dot&quot;:&quot;yes&quot;}">
						<div class="elementor-container elementor-column-gap-default">
							<div class="elementor-row">
					<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-6d77db1" data-id="6d77db1" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-82e8fb8 elementor-widget elementor-widget-heading" data-id="82e8fb8" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<div class="elementor-heading-title elementor-size-default"><a href="/dyes">DYES</a></div>		</div>
				</div>
				<div class="elementor-element elementor-element-07a1b9d elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="07a1b9d" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
					<ul class="elementor-icon-list-items">
							<li class="elementor-icon-list-item">
											<a href="/basic-dyes">

											<span class="elementor-icon-list-text">Basic Dyes </span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/disperse-dyes">

											<span class="elementor-icon-list-text">Disperse Dyes</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/solvent-dyes">

											<span class="elementor-icon-list-text">Solvent Dyes</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/vat-dyes">

											<span class="elementor-icon-list-text">Vat Dyes</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/acid-dyes">

											<span class="elementor-icon-list-text">Acid Dyes</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/cationic-dyes">

											<span class="elementor-icon-list-text">Cationic Dyes</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/direct-dyes">

											<span class="elementor-icon-list-text">Direct Dyes</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/reactive-dyes">

											<span class="elementor-icon-list-text">Reactive dyes</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/metal-complex-solvent-dyes">

											<span class="elementor-icon-list-text">Metal Complex Solvent Dyes </span>
											</a>
									</li>
						</ul>
				</div>
				</div>
						</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-0b538b5" data-id="0b538b5" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-194be36 elementor-widget elementor-widget-heading" data-id="194be36" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<div class="elementor-heading-title elementor-size-default"><a href="/f-d-c-colours">F D & C COLOURS</a></div>		</div>
				</div>
				<div class="elementor-element elementor-element-f69e79c elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="f69e79c" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
					<ul class="elementor-icon-list-items">
							<li class="elementor-icon-list-item">
											<a href="/tartrazine-dyes">

											<span class="elementor-icon-list-text">Tartrazine Dyes</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/sunset-yellow-f-d-c-colours">

											<span class="elementor-icon-list-text">Sunset Yellow F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/carmoisine-f-d-c-colours">

											<span class="elementor-icon-list-text">Carmoisine F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/ponceau-4r-f-d-c-colours">

											<span class="elementor-icon-list-text">Ponceau 4R F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/amaranth-f-d-c-colours">

											<span class="elementor-icon-list-text">Amaranth F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/altura-red-f-d-c-colours">

											<span class="elementor-icon-list-text">Altura Red F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/brilliant-blue-fcf-f-d-c-colours">

											<span class="elementor-icon-list-text">Brilliant Blue Fcf F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/indigo-carmine-f-d-c-colours">

											<span class="elementor-icon-list-text">Indigo Carmine F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/f-d-c-colours">

											<span class="elementor-icon-list-text">More Links</span>
											</a>
									</li>
						</ul>
				</div>
				</div>
						</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-04fd530" data-id="04fd530" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-aefce35 elementor-widget elementor-widget-heading" data-id="aefce35" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<div class="elementor-heading-title elementor-size-default"><a href="/pigments">PIGMENTS</a></div>		</div>
				</div>
				<div class="elementor-element elementor-element-ba90f06 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="ba90f06" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
					<ul class="elementor-icon-list-items">
							<li class="elementor-icon-list-item">
											<a href="/organic-pigments">

											<span class="elementor-icon-list-text">Organic Pigments</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/high-performance-pigments">

											<span class="elementor-icon-list-text">High Performance Pigments</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/fluorescent-pigments">

											<span class="elementor-icon-list-text">Fluorescent Pigments</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/pu-foam-pigments">

											<span class="elementor-icon-list-text">PU Foam Pigments</span>
											</a>
									</li>
						</ul>
				</div>
				</div>
						</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-0f6d2a0" data-id="0f6d2a0" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-89fb344 elementor-widget elementor-widget-heading" data-id="89fb344" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<div class="elementor-heading-title elementor-size-default"><a href="/other-products">OTHER PRODUCTS</a></div>		</div>
				</div>
				<div class="elementor-element elementor-element-1ab24ea elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="1ab24ea" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
					<ul class="elementor-icon-list-items">
							<li class="elementor-icon-list-item">
											<a href="/naphthols">

											<span class="elementor-icon-list-text">Naphthols</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/fast-colour-bases">

											<span class="elementor-icon-list-text">Fast Colour Bases</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/fast-colour-salts">

											<span class="elementor-icon-list-text">Fast Colour Salts</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/pyrazolone-intermediates">

											<span class="elementor-icon-list-text">Pyrazolone Intermediates</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="/auxiliaries">

											<span class="elementor-icon-list-text">Auxiliaries</span>
											</a>
									</li>
						</ul>
				</div>
				</div>
						</div>
					</div>
		</div>
								</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-095d978 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="095d978" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;ekit_has_onepagescroll_dot&quot;:&quot;yes&quot;}">
						<div class="elementor-container elementor-column-gap-default">
							<div class="elementor-row">
					<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-837d6dc" data-id="837d6dc" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-5c7e02c elementor-widget elementor-widget-text-editor" data-id="5c7e02c" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
								<div class="elementor-text-editor elementor-clearfix">
				<p class="copyLine">© 2020 S D International. all right reserved | Designed &amp; Marketed by <a href="https://newnessmarketing.com/"><b>Newness Marketing Technology</b></a></p>					</div>
						</div>
				</div>
						</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-2ba1fba" data-id="2ba1fba" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-1302f5a elementor-icon-list--layout-inline elementor-align-right elementor-list-item-link-inline elementor-widget elementor-widget-icon-list" data-id="1302f5a" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
					<ul class="elementor-icon-list-items elementor-inline-items">
							<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://www.linkedin.com/in/s-d-international-9096952b9">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-linkedin"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://www.facebook.com/profile.php?id=61557321748434&#038;mibextid=ZbWKwL">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="icon icon-facebook-2"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://x.com/internatio90966?t=SGLWhZiHrb3BLkbTG81Tcw&#038;s=09">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-twitter"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://www.instagram.com/sdinternational8?utm_source=qr&#038;igsh=aWdlZzk4OXd1aXJx">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-instagram"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://youtube.com/@SDInternational172?si=542KqcRczxne1b6U">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-youtube"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
						</ul>
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
			</div><!-- #page -->


</div>

<!-- WhatsApp Floating Button -->
<a href="https://wa.link/owdi77" target="_blank" class="sd-whatsapp-float" aria-label="WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Quote / Enquiry Modal Overlay -->
<div id="enquiryModalOverlay">
    <div class="enquiry-modal-content">
        <button type="button" class="enquiry-modal-close" onclick="closeEnquiryModal()">&times;</button>
        <h3 style="font-family:'Montserrat',sans-serif; color:#64141f; margin-bottom:8px; font-size:22px;">Get Best Quote</h3>
        <p style="font-size:13px; color:#64748b; margin-bottom:20px;">Fill out the form and our specialist team will be in touch shortly.</p>
        <form action="{{ route('inquiries.store') }}" method="POST">
            @csrf
            <div style="margin-bottom:14px;">
                <label style="display:block; font-size:13px; font-weight:600; margin-bottom:5px; color:#334155;">Your Name *</label>
                <input type="text" name="name" required style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:4px; font-size:14px;">
            </div>
            <div style="margin-bottom:14px;">
                <label style="display:block; font-size:13px; font-weight:600; margin-bottom:5px; color:#334155;">Your Email *</label>
                <input type="email" name="email" required style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:4px; font-size:14px;">
            </div>
            <div style="margin-bottom:14px;">
                <label style="display:block; font-size:13px; font-weight:600; margin-bottom:5px; color:#334155;">Phone / Mobile *</label>
                <input type="tel" name="phone" required style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:4px; font-size:14px;">
            </div>
            <div style="margin-bottom:14px;">
                <label style="display:block; font-size:13px; font-weight:600; margin-bottom:5px; color:#334155;">Product or Inquiry Details *</label>
                <textarea name="message" rows="4" required placeholder="Tell us about the dyes, pigments, or quantity you require..." style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:4px; font-size:14px;"></textarea>
            </div>
            <button type="submit" style="background:#64141f; color:#ffffff; border:none; padding:12px 28px; border-radius:4px; font-size:15px; font-weight:700; cursor:pointer; width:100%;">
                Submit Inquiry
            </button>
        </form>
    </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script>
// Sticky Header on Scroll
window.addEventListener('scroll', function() {
    var header = document.querySelector('.elementor-element-3397fd0b');
    if (header) {
        if (window.scrollY > 80) {
            header.classList.add('is-sticky');
        } else {
            header.classList.remove('is-sticky');
        }
    }
});

// Mobile menu toggle
var menuToggle = document.querySelector('.elementor-menu-toggle');
var mobileNav = document.querySelector('.elementor-nav-menu--dropdown.elementor-nav-menu__container');
if (menuToggle && mobileNav) {
    menuToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        var expanded = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', !expanded);
        mobileNav.classList.toggle('show-dropdown');
    });
}

// Modal open & close triggers
function openEnquiryModal() {
    var modal = document.getElementById('enquiryModalOverlay');
    if (modal) modal.classList.add('active');
}
function closeEnquiryModal() {
    var modal = document.getElementById('enquiryModalOverlay');
    if (modal) modal.classList.remove('active');
}

// Attach enquiry triggers to all enquiry buttons
document.querySelectorAll('a[href*="/contact"], .elementor-element-f006f4c a, .elementor-element-f7ce502 a').forEach(function(btn) {
    if (btn.textContent.trim().toLowerCase().includes('enquir') || btn.textContent.trim().toLowerCase().includes('quote')) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            openEnquiryModal();
        });
    }
});

// Live Search Autocomplete
(function() {
    var searchInput = document.getElementById('headerSearchInput');
    var resultsBox = document.getElementById('liveSearchResults');
    var debounceTimer = null;

    if (!searchInput || !resultsBox) return;

    searchInput.addEventListener('input', function() {
        var query = this.value.trim();
        clearTimeout(debounceTimer);

        if (query.length < 2) {
            resultsBox.style.display = 'none';
            resultsBox.innerHTML = '';
            return;
        }

        debounceTimer = setTimeout(function() {
            fetch('/api/products/search?q=' + encodeURIComponent(query))
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    if (!data || data.length === 0) {
                        resultsBox.innerHTML = '<div style="padding: 12px 16px; color: #64748b; font-size: 13px;">No matching products found.</div>';
                        resultsBox.style.display = 'block';
                        return;
                    }

                    var html = '';
                    data.forEach(function(item) {
                        html += '<a href="' + item.url + '" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 16px; border-bottom: 1px solid #f1f5f9; text-decoration: none; color: #1e293b; transition: background 0.15s;">' +
                            '<div>' +
                                '<div style="font-weight: 600; font-size: 13.5px; color: #64141f;">' + item.title + '</div>' +
                                (item.cas_number ? '<div style="font-size: 11.5px; color: #64748b;">CAS: ' + item.cas_number + '</div>' : '') +
                            '</div>' +
                            '<span style="font-size: 11px; background: #f1f5f9; padding: 3px 8px; border-radius: 4px; color: #475569;">' + item.category + '</span>' +
                        '</a>';
                    });

                    html += '<a href="/products?s=' + encodeURIComponent(query) + '" style="display: block; padding: 10px; text-align: center; background: #f8fafc; font-size: 12.5px; font-weight: 600; color: #64141f; text-decoration: none;">View All Results in Catalog →</a>';

                    resultsBox.innerHTML = html;
                    resultsBox.style.display = 'block';
                })
                .catch(function(err) {
                    console.error('Search autocomplete error:', err);
                });
        }, 220);
    });

    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
            resultsBox.style.display = 'none';
        }
    });

    searchInput.addEventListener('focus', function() {
        if (resultsBox.children.length > 0) {
            resultsBox.style.display = 'block';
        }
    });
})();
</script>

@stack('scripts')
</body>
</html>