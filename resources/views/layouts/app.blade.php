<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>{{ $seo['title'] ?? 'SD International - Vat & Solvent Dyes Manufacturer in India' }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'Leading manufacturer and exporter of Vat Dyes, Solvent Dyes, Disperse Dyes, Food Colours, Organic Pigments, Naphthols, Fast Bases and Salts in India.' }}">
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

    <!-- Font Awesome 5 Free -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Astra Theme & Elementor CSS (Exact 1:1 replica of live site) -->
    <link rel="stylesheet" href="{{ asset('css/astra.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/astra-inline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/astra-addon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elementor-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elementor-frontend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elementor-global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elementor-post-21.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elementor-post-61.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

    @stack('styles')

    <style>
        /* Essential compatibility overrides */
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
            color: #4b4f58;
            overflow-x: hidden;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
        }
        /* Mobile menu & dropdown functionality */
        .elementor-nav-menu--dropdown {
            display: none;
        }
        .elementor-nav-menu--dropdown.show-dropdown {
            display: block !important;
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
<body itemtype='https://schema.org/WebPage' itemscope='itemscope' class="home wp-singular page-template-default page page-id-136 wp-custom-logo wp-theme-astra theme-astra woocommerce-no-js ast-desktop ast-plain-container ast-no-sidebar astra-3.7.10 ast-header-custom-item-inside ast-single-post ast-inherit-site-logo-transparent above-header-nav-padding-support ast-full-width-layout ast-sticky-header-shrink ast-inherit-site-logo-sticky elementor-default elementor-kit-17 elementor-page elementor-page-136 astra-addon-3.6.6">

<a class="skip-link screen-reader-text" href="#content" role="link" title="Skip to content">Skip to content</a>

<div class="hfeed site" id="page">

    @if(session('success'))
<div style="background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; padding:12px 18px; border-radius:6px; margin:15px; font-weight:600; text-align:center;">
    ✓ {{ session('success') }}
</div>
@endif

    <!-- Header 21 (Exact Live Header) -->
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
					<form class="elementor-search-form" role="search" action="/" method="get">
									<div class="elementor-search-form__container">
								<input placeholder="Search..." class="elementor-search-form__input" type="search" name="search" title="Search" value="">
													<button class="elementor-search-form__submit" type="submit" title="Search" aria-label="Search">
													<i class="fa fa-search" aria-hidden="true"></i>
							<span class="elementor-screen-only">Search</span>
											</button>
											</div>
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
							<img width="300" height="91" src="/uploads/2020/07/logo-180x55.png" class="attachment-full size-full" alt="" srcset="/uploads/2020/07/logo.png 300w, /uploads/2020/07/logo-120x36.png 120w, /uploads/2020/07/logo-64x19.png 64w, /uploads/2020/07/logo-180x55.png 180w" sizes="(max-width: 300px) 100vw, 300px" />								</a>
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
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9876"><a href="/contact" class="elementor-item menu-link">Contact Us</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-13595"><a href="/blogs" class="elementor-item menu-link">blogs</a></li>
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
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9876"><a href="/contact" class="elementor-item menu-link">Contact Us</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-13595"><a href="/blogs" class="elementor-item menu-link">blogs</a></li>
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
			<a href="/contact" class="elementor-button-link elementor-button elementor-size-sm" role="button">
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
			<div id="content"

    <!-- Main Content Area -->
    <div id="content" class="site-content">
        @yield('content')
    </div>

    <!-- Footer 61 (Exact Live Footer) -->
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
											<a href="https://sdinternational.com/solvent-dyes/">

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
											<a href="https://sdinternational.com/tartrazine-dyes/">

											<span class="elementor-icon-list-text">Tartrazine Dyes</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="https://sdinternational.com/sunset-yellow-f-d-c-colours/">

											<span class="elementor-icon-list-text">Sunset Yellow F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="https://sdinternational.com/carmoisine-f-d-c-colours/">

											<span class="elementor-icon-list-text">Carmoisine F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="https://sdinternational.com/ponceau-4r-f-d-c-colours/">

											<span class="elementor-icon-list-text">Ponceau 4R F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="https://sdinternational.com/amaranth-f-d-c-colours/">

											<span class="elementor-icon-list-text">Amaranth F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="https://sdinternational.com/altura-red-f-d-c-colours/">

											<span class="elementor-icon-list-text">Altura Red F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="https://sdinternational.com/brilliant-blue-fcf-f-d-c-colours/">

											<span class="elementor-icon-list-text">Brilliant Blue Fcf F D & C Colours</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="https://sdinternational.com/indigo-carmine-f-d-c-colours/">

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
<script type="speculationrules">
{"prefetch":[{"source":"document","where":{"and":[{"href_matches":"\/*"},{"not":{"href_matches":["\/wp-*.php","\/wp-admin\/*","\/wp-content\/uploads\/*","\/wp-content\/*","\/wp-content\/plugins\/*","\/wp-content\/themes\/astra\/*","\/*\\?(.+)"]}},{"not":{"selector_matches":"a[rel~=\"nofollow\"]"}},{"not":{"selector_matches":".no-prefetch, .no-prefetch a"}}]},"eagerness":"conservative"}]}
</script>
		<!-- Click to Chat - https://holithemes.com/plugins/click-to-chat/  v4.45 -->
			<style id="ht-ctc-entry-animations">.ht_ctc_entry_animation{animation-duration:0.4s;animation-fill-mode:both;animation-delay:0s;animation-iteration-count:1;}			@keyframes ht_ctc_anim_corner {0% {opacity: 0;transform: scale(0);}100% {opacity: 1;transform: scale(1);}}.ht_ctc_an_entry_corner {animation-name: ht_ctc_anim_corner;animation-timing-function: cubic-bezier(0.25, 1, 0.5, 1);transform-origin: bottom var(--side, right);}
			</style>						<div class="ht-ctc ht-ctc-chat ctc-analytics ctc_wp_desktop style-2  ht_ctc_entry_animation ht_ctc_an_entry_corner " id="ht-ctc-chat"  
				style="display: none;  position: fixed; bottom: 15px; right: 15px;"   >
												<div class="ht_ctc_style ht_ctc_chat_style">
								<div  style="display: flex; justify-content: center; align-items: center;  " class="ctc-analytics ctc_s_2">
	<p class="ctc-analytics ctc_cta ctc_cta_stick ht-ctc-cta  ht-ctc-cta-hover " style="padding: 0px 16px; line-height: 1.6; font-size: 15px; background-color: #25D366; color: #ffffff; border-radius:10px; margin:0 10px;  display: none; order: 0; "></p>
	<svg style="pointer-events:none; display:block; height:50px; width:50px;" width="50px" height="50px" viewBox="0 0 1024 1024">
        <defs>
        <path id="htwasqicona-chat" d="M1023.941 765.153c0 5.606-.171 17.766-.508 27.159-.824 22.982-2.646 52.639-5.401 66.151-4.141 20.306-10.392 39.472-18.542 55.425-9.643 18.871-21.943 35.775-36.559 50.364-14.584 14.56-31.472 26.812-50.315 36.416-16.036 8.172-35.322 14.426-55.744 18.549-13.378 2.701-42.812 4.488-65.648 5.3-9.402.336-21.564.505-27.15.505l-504.226-.081c-5.607 0-17.765-.172-27.158-.509-22.983-.824-52.639-2.646-66.152-5.4-20.306-4.142-39.473-10.392-55.425-18.542-18.872-9.644-35.775-21.944-50.364-36.56-14.56-14.584-26.812-31.471-36.415-50.314-8.174-16.037-14.428-35.323-18.551-55.744-2.7-13.378-4.487-42.812-5.3-65.649-.334-9.401-.503-21.563-.503-27.148l.08-504.228c0-5.607.171-17.766.508-27.159.825-22.983 2.646-52.639 5.401-66.151 4.141-20.306 10.391-39.473 18.542-55.426C34.154 93.24 46.455 76.336 61.07 61.747c14.584-14.559 31.472-26.812 50.315-36.416 16.037-8.172 35.324-14.426 55.745-18.549 13.377-2.701 42.812-4.488 65.648-5.3 9.402-.335 21.565-.504 27.149-.504l504.227.081c5.608 0 17.766.171 27.159.508 22.983.825 52.638 2.646 66.152 5.401 20.305 4.141 39.472 10.391 55.425 18.542 18.871 9.643 35.774 21.944 50.363 36.559 14.559 14.584 26.812 31.471 36.415 50.315 8.174 16.037 14.428 35.323 18.551 55.744 2.7 13.378 4.486 42.812 5.3 65.649.335 9.402.504 21.564.504 27.15l-.082 504.226z"/>
        </defs>
        <linearGradient id="htwasqiconb-chat" gradientUnits="userSpaceOnUse" x1="512.001" y1=".978" x2="512.001" y2="1025.023">
            <stop offset="0" stop-color="#61fd7d"/>
            <stop offset="1" stop-color="#2bb826"/>
        </linearGradient>
        <use xlink:href="#htwasqicona-chat" overflow="visible" style="fill: url(#htwasqiconb-chat)" fill="url(#htwasqiconb-chat)"/>
        <g>
            <path style="fill: #FFFFFF;" fill="#FFF" d="M783.302 243.246c-69.329-69.387-161.529-107.619-259.763-107.658-202.402 0-367.133 164.668-367.214 367.072-.026 64.699 16.883 127.854 49.017 183.522l-52.096 190.229 194.665-51.047c53.636 29.244 114.022 44.656 175.482 44.682h.151c202.382 0 367.128-164.688 367.21-367.094.039-98.087-38.121-190.319-107.452-259.706zM523.544 808.047h-.125c-54.767-.021-108.483-14.729-155.344-42.529l-11.146-6.612-115.517 30.293 30.834-112.592-7.259-11.544c-30.552-48.579-46.688-104.729-46.664-162.379.066-168.229 136.985-305.096 305.339-305.096 81.521.031 158.154 31.811 215.779 89.482s89.342 134.332 89.312 215.859c-.066 168.243-136.984 305.118-305.209 305.118zm167.415-228.515c-9.177-4.591-54.286-26.782-62.697-29.843-8.41-3.062-14.526-4.592-20.645 4.592-6.115 9.182-23.699 29.843-29.053 35.964-5.352 6.122-10.704 6.888-19.879 2.296-9.176-4.591-38.74-14.277-73.786-45.526-27.275-24.319-45.691-54.359-51.043-63.543-5.352-9.183-.569-14.146 4.024-18.72 4.127-4.109 9.175-10.713 13.763-16.069 4.587-5.355 6.117-9.183 9.175-15.304 3.059-6.122 1.529-11.479-.765-16.07-2.293-4.591-20.644-49.739-28.29-68.104-7.447-17.886-15.013-15.466-20.645-15.747-5.346-.266-11.469-.322-17.585-.322s-16.057 2.295-24.467 11.478-32.113 31.374-32.113 76.521c0 45.147 32.877 88.764 37.465 94.885 4.588 6.122 64.699 98.771 156.741 138.502 21.892 9.45 38.982 15.094 52.308 19.322 21.98 6.979 41.982 5.995 57.793 3.634 17.628-2.633 54.284-22.189 61.932-43.615 7.646-21.427 7.646-39.791 5.352-43.617-2.294-3.826-8.41-6.122-17.585-10.714z"/>
        </g>
        </svg></div>
								</div>
							</div>
							<span class="ht_ctc_chat_data" data-settings="{&quot;number&quot;:&quot;919920669561&quot;,&quot;pre_filled&quot;:&quot;Hello S D International!\r\nName:\r\nLike to know more information about - &#039;Home&#039; - https:\/\/sdinternational.com\/&quot;,&quot;dis_m&quot;:&quot;show&quot;,&quot;dis_d&quot;:&quot;show&quot;,&quot;css&quot;:&quot;cursor: pointer; z-index: 99999999;&quot;,&quot;pos_d&quot;:&quot;position: fixed; bottom: 15px; right: 15px;&quot;,&quot;pos_m&quot;:&quot;position: fixed; bottom: 15px; right: 15px;&quot;,&quot;side_d&quot;:&quot;right&quot;,&quot;side_m&quot;:&quot;right&quot;,&quot;schedule&quot;:&quot;no&quot;,&quot;se&quot;:150,&quot;ani&quot;:&quot;no-animation&quot;,&quot;page_id&quot;:136,&quot;url_target_d&quot;:&quot;_blank&quot;,&quot;ga&quot;:&quot;yes&quot;,&quot;gtm&quot;:&quot;1&quot;,&quot;fb&quot;:&quot;yes&quot;,&quot;webhook_format&quot;:&quot;json&quot;,&quot;g_init&quot;:&quot;default&quot;,&quot;g_an_event_name&quot;:&quot;chat: {number}&quot;,&quot;gtm_event_name&quot;:&quot;Click to Chat&quot;,&quot;pixel_event_name&quot;:&quot;Click to Chat by HoliThemes&quot;}" data-rest="fc3eeb6d4d"></span>
						<div data-elementor-type="popup" data-elementor-id="11717" class="elementor elementor-11717 elementor-location-popup" data-elementor-settings="{&quot;timing&quot;:[]}">
		<div class="elementor-section-wrap">
					<section class="elementor-section elementor-top-section elementor-element elementor-element-124031e elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="124031e" data-element_type="section" data-settings="{&quot;ekit_has_onepagescroll_dot&quot;:&quot;yes&quot;}">
						<div class="elementor-container elementor-column-gap-default">
							<div class="elementor-row">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-9efcdef" data-id="9efcdef" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-1dae787 elementor-view-default elementor-widget elementor-widget-icon" data-id="1dae787" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="icon.default">
				<div class="elementor-widget-container">
					<div class="elementor-icon-wrapper">
			<div class="elementor-icon">
			<i aria-hidden="true" class="far fa-envelope"></i>			</div>
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-0271836 elementor-widget elementor-widget-heading" data-id="0271836" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h6 class="elementor-heading-title elementor-size-default"> Get Best Quote </h6>		</div>
				</div>
				<div class="elementor-element elementor-element-607e221 elementor-widget elementor-widget-text-editor" data-id="607e221" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
								<div class="elementor-text-editor elementor-clearfix">
				<p class="elementor-icon-box-description">Fill out the form and we’ll be in touch as soon as possible.</p>					</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-3a03ae4 pp-contact-form-7-button-custom elementor-widget elementor-widget-pp-contact-form-7" data-id="3a03ae4" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="pp-contact-form-7.default">
				<div class="elementor-widget-container">
							<div class="pp-contact-form pp-contact-form-7 placeholder-show">
										
<div class="wpcf7 no-js" id="wpcf7-f5893-o1" lang="en-US" dir="ltr" data-wpcf7-id="5893">
<div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div>
<form action="{{ route('inquiries.store') }}" method="POST" class="wpcf7-form init">
@csrf

<fieldset class="hidden-fields-container"><input type="hidden" name="_wpcf7" value="5893" /><input type="hidden" name="_wpcf7_version" value="6.1.7" /><input type="hidden" name="_wpcf7_locale" value="en_US" /><input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f5893-o1" /><input type="hidden" name="_wpcf7_container_post" value="0" /><input type="hidden" name="_wpcf7_posted_data_hash" value="" /><input type="hidden" name="_wpcf7_recaptcha_response" value="" />
</fieldset>
<p><span class="wpcf7-form-control-wrap" data-name="your-name"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Name" value="" type="text" name="your-name" /></span>
</p>
<p><span class="wpcf7-form-control-wrap" data-name="your-email"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email" value="" type="email" name="your-email" /></span>
</p>
<p><span class="wpcf7-form-control-wrap" data-name="tel-590"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" placeholder="Phone No" value="" type="tel" name="tel-590" /></span>
</p>
<p><span class="wpcf7-form-control-wrap" data-name="text-589"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Country" value="" type="text" name="text-589" /></span>
</p>
<p><span class="wpcf7-form-control-wrap" data-name="text-33"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="City" value="" type="text" name="text-33" /></span>
</p>
<p><span class="wpcf7-form-control-wrap" data-name="text-589"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Company Name" value="" type="text" name="text-589" /></span>
</p>
<p><span class="wpcf7-form-control-wrap" data-name="your-message"><textarea cols="32" rows="5" maxlength="2000" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Whether you have a question about Color, Pricing, Custom color, or anything else, our team is ready to answer all your questions" name="your-message"></textarea></span>
</p>
<p><span class="elementor-button-content-wrapper"><input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Send" /></span>
</p><p style="display: none !important;" class="akismet-fields-container" data-prefix="_wpcf7_ak_"><label>&#916;<textarea name="_wpcf7_ak_hp_textarea" cols="45" rows="8" maxlength="100"></textarea></label><input type="hidden" id="ak_js_1" name="_wpcf7_ak_js" value="219"/><script>
document.getElementById( "ak_js_1" ).setAttribute( "value", ( new Date() ).getTime() );
</script>
</p><div class="wpcf7-response-output" aria-hidden="true"></div>
</form>
</div>
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
			<script type="text/javascript">
		(function () {
			var c = document.body.className;
			c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
			document.body.className = c;
		})();
	</script>
	<link rel='stylesheet' id='odometer-css' href='https://sdinternational.com/wp-content/plugins/powerpack-elements/assets/lib/odometer/odometer-theme-default.css?ver=2.8.1' media='all' />
<link rel='stylesheet' id='elementor-post-11717-css' href='/uploads/elementor/css/post-11717.css?ver=1790878462' media='all' />
<link rel='stylesheet' id='e-animations-css' href='https://sdinternational.com/wp-content/plugins/elementor/assets/lib/animations/animations.min.css?ver=3.6.5' media='all' />
<script src="https://sdinternational.com/wp-content/plugins/elementskit/widgets/chart/assets/js/chart.js?ver=6.8.12" id="chart-kit-js-js"></script>

<script src="https://sdinternational.com/wp-content/themes/astra/assets/js/minified/style.min.js?ver=3.7.10" id="astra-theme-js-js"></script>


<script src="https://sdinternational.com/wp-includes/js/dist/hooks.min.js?ver=4d63a3d491d11ffd8ac6" id="wp-hooks-js"></script>
<script src="https://sdinternational.com/wp-includes/js/dist/i18n.min.js?ver=5e580eb46a90c2b997e6" id="wp-i18n-js"></script>
<script id="wp-i18n-js-after">
wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
</script>
<script src="https://sdinternational.com/wp-content/plugins/contact-form-7/includes/swv/js/index.js?ver=6.1.7" id="swv-js"></script>
<script id="contact-form-7-js-before">
var wpcf7 = {
    "api": {
        "root": "https:\/\/sdinternational.com\/wp-json\/",
        "namespace": "contact-form-7\/v1"
    },
    "cached": 1
};
</script>
<script src="https://sdinternational.com/wp-content/plugins/contact-form-7/includes/js/index.js?ver=6.1.7" id="contact-form-7-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.7.0-wc.6.4.2" id="jquery-blockui-js"></script>


<script src="https://sdinternational.com/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js?ver=2.1.4-wc.6.4.2" id="js-cookie-js"></script>
<script id="woocommerce-js-extra">
var woocommerce_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/?wc-ajax=%%endpoint%%"};
</script>
<script src="https://sdinternational.com/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=6.4.2" id="woocommerce-js"></script>


<script src="https://sdinternational.com/wp-includes/js/imagesloaded.min.js?ver=5.0.0" id="imagesloaded-js"></script>
<script id="astra-addon-js-js-extra">
var astraAddon = {"sticky_active":"","svgIconClose":"<span class=\"ast-icon icon-close\"><\/span>","header_main_stick":"0","header_above_stick":"0","header_below_stick":"0","stick_header_meta":"","header_main_stick_meta":"","header_above_stick_meta":"","header_below_stick_meta":"","sticky_header_on_devices":"desktop","sticky_header_style":"none","sticky_hide_on_scroll":"0","break_point":"921","tablet_break_point":"921","mobile_break_point":"544","header_main_shrink":"1","header_logo_width":"","responsive_header_logo_width":{"desktop":"180","tablet":"","mobile":""},"stick_origin_position":"","site_layout":"ast-full-width-layout","site_content_width":"1240","site_layout_padded_width":"1200","site_layout_box_width":"1200","header_builder_active":"","component_limit":"10","product_plus_minus_text":{"plus_qty":"Plus Quantity","minus_qty":"Minus Quantity"},"is_header_builder_active":""};
</script>
<script src="/uploads/astra-addon/astra-addon-68597f619bebc1-86784616.js?ver=3.6.6" id="astra-addon-js-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/astra-addon/addons/woocommerce/assets/js/minified/single-product-ajax-cart.min.js?ver=3.6.6" id="astra-single-product-ajax-cart-js"></script>


<script src="https://sdinternational.com/wp-content/plugins/elementskit-lite/widgets/init/assets/js/widget-scripts.js?ver=2.5.7" id="ekit-widget-scripts-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementskit/modules/parallax/assets/js/TweenMax.min.js?ver=2.2.3" id="tweenmax-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementskit/modules/parallax/assets/js/jquery.easing.1.3.js?ver=2.2.3" id="jquery-easing-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/powerpack-elements/assets/lib/tilt/tilt.jquery.min.js?ver=1.1.19" id="tilt-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementskit/modules/parallax/assets/js/anime.js?ver=2.2.3" id="animejs-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementskit/modules/parallax/assets/js/magician.js?ver=2.2.3" id="magicianjs-js"></script>

<script src="https://sdinternational.com/wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=3.15.0" id="wp-polyfill-js"></script>
<script id="wpcf7-recaptcha-js-before">
var wpcf7_recaptcha = {
    "sitekey": "6LcmWlccAAAAAIjteYwPGK3wOKi93YeCqpRoFCQ0",
    "actions": {
        "homepage": "homepage",
        "contactform": "contactform"
    }
};
</script>
<script src="https://sdinternational.com/wp-content/plugins/contact-form-7/modules/recaptcha/index.js?ver=6.1.7" id="wpcf7-recaptcha-js"></script>


<script src="https://sdinternational.com/wp-content/plugins/elementor-pro/assets/lib/smartmenus/jquery.smartmenus.min.js?ver=1.0.1" id="smartmenus-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min.js?ver=4.0.2" id="elementor-waypoints-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/powerpack-elements/assets/lib/odometer/odometer.min.js?ver=0.4.8" id="odometer-js"></script>


<script src="https://sdinternational.com/wp-content/plugins/powerpack-elements/assets/lib/slick/slick.min.js?ver=2.8.1" id="pp-slick-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/powerpack-elements/assets/lib/jquery-resize/jquery.resize.min.js?ver=0.5.3" id="jquery-resize-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementor-pro/assets/js/webpack-pro.runtime.min.js?ver=3.2.1" id="elementor-pro-webpack-runtime-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js?ver=3.6.5" id="elementor-webpack-runtime-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=3.6.5" id="elementor-frontend-modules-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementor-pro/assets/lib/sticky/jquery.sticky.min.js?ver=3.2.1" id="elementor-sticky-js"></script>


<script src="https://sdinternational.com/wp-includes/js/jquery/ui/core.min.js?ver=1.13.3" id="jquery-ui-core-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementor/assets/lib/swiper/swiper.min.js?ver=5.3.6" id="swiper-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementor/assets/lib/share-link/share-link.min.js?ver=3.6.5" id="share-link-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementor/assets/lib/dialog/dialog.min.js?ver=4.9.0" id="elementor-dialog-js"></script>
<script id="elementor-frontend-js-before">
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnTwitter":"Share on Twitter","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Extra","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Extra","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}}},
"version":"3.6.5","is_static":false,"experimentalFeatures":{"e_import_export":true,"e_hidden_wordpress_widgets":true,"landing-pages":true,"elements-color-picker":true,"favorite-widgets":true,"admin-top-bar":true,"form-submissions":true},"urls":{"assets":"https:\/\/sdinternational.com\/wp-content\/plugins\/elementor\/assets\/"},"settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description"},"post":{"id":136,"title":"SD%20International%20-%20Vat%20dyes%20manufacturer%20in%20india%2C%20solvent%20dyes%20manufacturer%20in%20india%2C%20Disperse%20dyes%2C%20food%20colours%2C%20organic%20pigments%2C%20Naphthols%2C%20fast%20bases%20%26%20salts%20manufacturer%20in%20india","excerpt":"","featuredImage":false}};
</script>
<script src="https://sdinternational.com/wp-content/plugins/elementor/assets/js/frontend.min.js?ver=3.6.5" id="elementor-frontend-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementor-pro/assets/js/preloaded-elements-handlers.min.js?ver=3.2.1" id="pro-preloaded-elements-handlers-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementskit-lite/widgets/init/assets/js/animate-circle.js?ver=2.5.7" id="animate-circle-js"></script>
<script id="elementskit-elementor-js-extra">
var ekit_config = {"ajaxurl":"https:\/\/sdinternational.com\/wp-admin\/admin-ajax.php","nonce":"44b8f1d29b"};
</script>
<script src="https://sdinternational.com/wp-content/plugins/elementskit-lite/widgets/init/assets/js/elementor.js?ver=2.5.7" id="elementskit-elementor-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementskit/widgets/init/assets/js/elementor.js?ver=2.2.3" id="elementskit-elementor-pro-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementskit/modules/sticky-content/assets/js/jquery.sticky.js?ver=2.2.3" id="elementskit-sticky-content-script-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementskit/modules/sticky-content/assets/js/init.js?ver=2.2.3" id="elementskit-sticky-content-script-init-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementskit/modules/parallax/assets/js/widget-init.js?ver=2.2.3" id="elementskit-parallax-widget-init-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementskit/modules/parallax/assets/js/section-init.js?ver=2.2.3" id="elementskit-parallax-section-init-js"></script>
<script src="https://sdinternational.com/wp-content/plugins/elementor/assets/js/preloaded-modules.min.js?ver=3.6.5" id="preloaded-modules-js"></script>
<script src="https://sdinternational.com/wp-includes/js/underscore.min.js?ver=1.13.7" id="underscore-js"></script>
<script id="wp-util-js-extra">
var _wpUtilSettings = {"ajax":{"url":"\/wp-admin\/admin-ajax.php"}};
</script>
<script src="https://sdinternational.com/wp-includes/js/wp-util.min.js?ver=6.8.12" id="wp-util-js"></script>


			<script>
			/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
			</script>
				</body>
<script>'undefined'=== typeof _trfq || (window._trfq = []);'undefined'=== typeof _trfd && (window._trfd=[]),_trfd.push({'tccl.baseHost':'secureserver.net'},{'ap':'cpsh-oh'},{'server':'bom1plzcpnl503353'},{'dcenter':'bom1'},{'cp_id':'9512740'},{'cp_cache':''},{'cp_cl':'8'}) // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.</script></html>

<!-- Page supported by LiteSpeed Cache 4.6 on 2026-10-29 17:42:14 -->

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

// Close modal on click outside
window.addEventListener('click', function(e) {
    var modal = document.getElementById('enquiryModalOverlay');
    if (e.target === modal) closeEnquiryModal();
});
</script>

@stack('scripts')
</body>
</html>