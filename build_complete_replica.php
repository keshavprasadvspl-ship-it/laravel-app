<?php
$live = file_get_contents(__DIR__ . '/live_homepage.html');

// Helper to replace URLs
function localizeUrls($str) {
    // 1. First, replace all CSS stylesheet URLs to /css/live/
    $cssMap = [
        'astra/assets/css/minified/style.min.css' => '/css/live/style.min.css',
        'click-to-chat-for-whatsapp/new/inc/assets/css/main.css' => '/css/live/main.css',
        'wp-includes/css/dist/block-library/style.min.css' => '/css/live/wp-block-library.min.css',
        'ajax-search-for-woocommerce/assets/css/style.min.css' => '/css/live/ajax-search.min.css',
        'woocommerce-blocks/build/wc-blocks-vendors-style.css' => '/css/live/wc-blocks-vendors-style.css',
        'woocommerce-blocks/build/wc-blocks-style.css' => '/css/live/wc-blocks-style.css',
        'contact-form-7/includes/css/styles.css' => '/css/live/styles.css',
        'astra/assets/css/minified/compatibility/contact-form-7-main.min.css' => '/css/live/contact-form-7-main.min.css',
        'astra/assets/css/minified/compatibility/woocommerce/woocommerce-layout.min.css' => '/css/live/woocommerce-layout.min.css',
        'astra/assets/css/minified/compatibility/woocommerce/woocommerce-smallscreen.min.css' => '/css/live/woocommerce-smallscreen.min.css',
        'astra/assets/css/minified/compatibility/woocommerce/woocommerce.min.css' => '/css/live/woocommerce.min.css',
        'astra-addon/astra-addon-68597f61992401-66099668.css' => '/css/live/astra-addon-68597f61992401-66099668.css',
        'elementor/assets/lib/eicons/css/elementor-icons.min.css' => '/css/live/elementor-icons.min.css',
        'elementor/assets/css/frontend-legacy.min.css' => '/css/live/frontend-legacy.min.css',
        'elementor/assets/css/frontend.min.css' => '/css/live/frontend.min.css',
        'elementor-pro/assets/css/frontend.min.css' => '/css/live/elementor-pro-frontend.min.css',
        'powerpack-elements/assets/css/min/frontend.min.css' => '/css/live/powerpack-frontend.min.css',
        'wpforms-lite/assets/css/wpforms-full.min.css' => '/css/live/wpforms-full.min.css',
        'elementor/css/post-17.css' => '/css/live/post-17.css',
        'elementor/css/global.css' => '/css/live/global.css',
        'elementor/css/post-136.css' => '/css/live/post-136.css',
        'elementor/css/post-21.css' => '/css/live/post-21.css',
        'elementor/css/post-61.css' => '/css/live/post-61.css',
        'elementor/css/post-11717.css' => '/css/live/post-11717.css',
        'elementskit-lite/modules/elementskit-icon-pack/assets/css/ekiticons.css' => '/css/live/ekiticons.css',
        'elementskit/modules/parallax/assets/css/style.css' => '/css/live/style.css',
        'elementskit-lite/widgets/init/assets/css/widget-styles.css' => '/css/live/widget-styles.css',
        'elementskit/widgets/init/assets/css/widget-styles-pro.css' => '/css/live/widget-styles-pro.css',
        'elementskit-lite/widgets/init/assets/css/responsive.css' => '/css/live/responsive.css',
        'bellows-accordion-menu/assets/css/bellows.min.css' => '/css/live/bellows.min.css',
        'bellows-accordion-menu/assets/css/fontawesome/css/font-awesome.min.css' => '/css/live/font-awesome.min.css',
        'bellows-accordion-menu/assets/css/skins/vanilla.css' => '/css/live/vanilla.css',
        'mailin/css/mailin-front.css' => '/css/live/mailin-front.css',
        'elementor/assets/lib/font-awesome/css/fontawesome.min.css' => '/css/live/fontawesome.min.css',
        'elementor/assets/lib/font-awesome/css/solid.min.css' => '/css/live/solid.min.css',
        'elementor/assets/lib/font-awesome/css/regular.min.css' => '/css/live/regular.min.css',
        'elementor/assets/lib/font-awesome/css/brands.min.css' => '/css/live/brands.min.css',
        'powerpack-elements/assets/lib/odometer/odometer-theme-default.css' => '/css/live/odometer-theme-default.css',
        'elementor/assets/lib/animations/animations.min.css' => '/css/live/animations.min.css',
    ];
    foreach ($cssMap as $pattern => $local) {
        $str = preg_replace('#https?://(?:www\.)?sdinternational\.com/[^"\'\s>]*' . preg_quote($pattern, '#') . '[^"\'\s>]*#i', $local, $str);
    }
    
    // Also catch any already converted /uploads/elementor/css/ or /uploads/astra-addon/
    $str = preg_replace('#/uploads/elementor/css/([a-zA-Z0-9_-]+)\.css[^"\'\s>]*#i', '/css/live/$1.css', $str);
    $str = preg_replace('#/uploads/astra-addon/([a-zA-Z0-9_-]+)\.css[^"\'\s>]*#i', '/css/live/$1.css', $str);
    
    // 2. Replace JS script URLs with local /js/live/...
    $jsFiles = [
        'jquery.min.js', 'jquery-migrate.min.js', 'flexibility.min.js', 'jarallax.js',
        'mailin-front.js', 'chart.js', 'style.min.js', 'app.js', 'hooks.min.js', 'i18n.min.js',
        'index.js', 'jquery.blockUI.min.js', 'add-to-cart.min.js', 'js.cookie.min.js',
        'woocommerce.min.js', 'cart-fragments.min.js', 'imagesloaded.min.js',
        'astra-addon-68597f619bebc1-86784616.js', 'single-product-ajax-cart.min.js',
        'frontend-script.js', 'widget-scripts.js', 'TweenMax.min.js', 'jquery.easing.1.3.js',
        'tilt.jquery.min.js', 'anime.js', 'magician.js', 'wp-polyfill.min.js', 'bellows.min.js',
        'jquery.smartmenus.min.js', 'waypoints.min.js', 'odometer.min.js', 'frontend.min.js',
        'slick.min.js', 'jquery.resize.min.js', 'webpack-pro.runtime.min.js', 'webpack.runtime.min.js',
        'frontend-modules.min.js', 'jquery.sticky.min.js', 'core.min.js', 'swiper.min.js',
        'share-link.min.js', 'dialog.min.js', 'preloaded-elements-handlers.min.js',
        'animate-circle.js', 'elementor.js', 'jquery.sticky.js', 'init.js', 'widget-init.js',
        'section-init.js', 'preloaded-modules.min.js', 'underscore.min.js', 'wp-util.min.js'
    ];
    foreach ($jsFiles as $js) {
        $str = preg_replace('#https?://(?:www\.)?sdinternational\.com/[^"\'\s>]*' . preg_quote($js, '#') . '[^"\'\s>]*#i', '/js/live/' . $js, $str);
    }
    
    // 3. Replace remaining WP uploads URLs (images, documents) with local /uploads/
    $str = preg_replace('#https?://(?:www\.)?sdinternational\.com/wp-content/uploads/#i', '/uploads/', $str);
    
    // 4. Remove WP feed and meta links that do not exist
    $str = preg_replace('#<link[^>]+(?:/feed/|/xmlrpc\.php|/wp-json/)[^>]*>#i', '', $str);
    
    // 5. Replace navigation and page links
    $linkMap = [
        'https://sdinternational.com/' => '/',
        'https://sdinternational.com/about-us/' => '/about-us',
        'https://sdinternational.com/products/' => '/products',
        'https://sdinternational.com/applications/' => '/applications',
        'https://sdinternational.com/certifications/' => '/certifications',
        'https://sdinternational.com/sustainability/' => '/sustainability',
        'https://sdinternational.com/contact-us/' => '/contact-us',
        'https://sdinternational.com/blogs/' => '/blogs',
        'https://sdinternational.com/request-quote/' => '/request-quote',
        'https://sdinternational.com/product-category/' => '/products?category=',
        'https://sdinternational.com/product/' => '/products/',
        '/product-category/' => '/products?category=',
        '/solvent-dyes/' => '/products?category=solvent-dyes',
    ];
    foreach ($linkMap as $from => $to) {
        $str = str_replace($from, $to, $str);
    }
    
    // Replace {{id}} with @{{id}} so Blade does not treat it as PHP
    $str = str_replace('{{id}}', '@{{id}}', $str);

    return $str;
}

// 1. HEAD
$headStart = strpos($live, '<head>') + 6;
$headEnd = strpos($live, '</head>');
$headContent = substr($live, $headStart, $headEnd - $headStart);
$headContent = localizeUrls($headContent);

// Add custom perfection CSS tweaks into head
$headFixes = '
<style id="sd-perfection-css">
/* CRITICAL: Force all elements to be 100% visible (no missing content) */
.elementor-invisible,
[data-animation].elementor-invisible {
    visibility: visible !important;
    opacity: 1 !important;
}

/* Guarantee 100% Horizontal Nav Row without bullet points */
ul.elementor-nav-menu,
ul.elementor-nav-menu > li,
.elementor-nav-menu--main ul,
.elementor-nav-menu--main li {
    list-style: none !important;
    list-style-type: none !important;
}
ul.elementor-nav-menu > li::marker,
ul.elementor-nav-menu > li::before,
ul.elementor-nav-menu > li::after {
    display: none !important;
    content: none !important;
}
@media (min-width: 1025px) {
    .elementor-nav-menu--main {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-end !important;
    }
    .elementor-nav-menu--main ul.elementor-nav-menu {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        align-items: center !important;
        justify-content: flex-end !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .elementor-nav-menu--main ul.elementor-nav-menu > li {
        display: inline-flex !important;
        align-items: center !important;
    }
    .elementor-menu-toggle {
        display: none !important;
    }
    .elementor-nav-menu--dropdown {
        display: none !important;
    }
    .elementor-element-3397fd0b .elementor-container,
    .elementor-element-3397fd0b .elementor-row {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: space-between !important;
        flex-wrap: nowrap !important;
    }
    .elementor-element-35fca2aa {
        width: 20% !important;
        flex: 0 0 20% !important;
    }
    .elementor-element-3aa8b45e {
        width: 67% !important;
        flex: 0 0 67% !important;
    }
    .elementor-element-9d55ed1 {
        width: 13% !important;
        flex: 0 0 13% !important;
    }
}

/* CRITICAL: Fix Left and Right Margins/Padding across the whole homepage */
html, body {
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow-x: hidden !important;
}

#page.hfeed.site {
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow-x: hidden !important;
}

/* Remove Astra theme container width constraint on full-width Elementor homepage */
.home #content,
.home .site-content,
.home .site-content > .ast-container,
.home #primary,
.home #main,
.home article.post-136,
.home .entry-content,
.home .elementor-136,
.home .elementor-inner,
.home .elementor-section-wrap {
    max-width: 100% !important;
    width: 100% !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    box-sizing: border-box !important;
}

/* Full Width & Stretched Sections span 100% of viewport width */
.elementor-section.elementor-section-stretched,
.elementor-section.elementor-section-full_width {
    width: 100% !important;
    max-width: 100% !important;
    left: 0 !important;
    right: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    box-sizing: border-box !important;
}

/* Boxed sections: exactly 1240px max-width, perfectly centered, modest 15px padding */
.elementor-section.elementor-section-boxed > .elementor-container {
    max-width: 1240px !important;
    width: 100% !important;
    margin-left: auto !important;
    margin-right: auto !important;
    padding-left: 15px !important;
    padding-right: 15px !important;
    box-sizing: border-box !important;
}

/* Full Width Sections Inner Container */
.elementor-section.elementor-section-full_width > .elementor-container {
    max-width: 100% !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
}

/* Section 1: Hero Slider */
.elementor-element-6dada31 {
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
}
.elementor-element-6dada31 .elementor-slides-wrapper.swiper-container {
    height: 540px !important;
    width: 100% !important;
    position: relative !important;
    overflow: hidden !important;
}
.elementor-element-6dada31 .swiper-slide {
    height: 540px !important;
    width: 100% !important;
    position: relative !important;
}
.elementor-element-6dada31 .swiper-slide-bg {
    position: absolute !important;
    inset: 0 !important;
    background-size: cover !important;
    background-position: center !important;
}
.elementor-element-6dada31 .swiper-slide-inner {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    height: 100% !important;
    text-decoration: none !important;
}
.elementor-element-6dada31 .elementor-slide-heading {
    color: #ffffff !important;
    font-family: "Montserrat", sans-serif !important;
    font-size: 50px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 2px !important;
    text-shadow: 0 2px 10px rgba(0,0,0,0.5) !important;
}

/* Section 2: 4 Feature Boxes */
.elementor-element-7bc0d733 {
    background: linear-gradient(180deg, #C49F6A 0%, #966F37 100%) !important;
    padding: 30px 0 !important;
    width: 100% !important;
}
.elementor-element-7bc0d733 > .elementor-container {
    max-width: 1240px !important;
    width: 100% !important;
    margin: 0 auto !important;
    padding: 0 15px !important;
}
.elementor-element-7bc0d733 .elementor-row {
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    gap: 15px !important;
    width: 100% !important;
    align-items: stretch !important;
}
.elementor-element-7bc0d733 .elementor-column.elementor-col-25 {
    width: 25% !important;
    flex: 1 1 25% !important;
    max-width: 25% !important;
    display: flex !important;
}
.elementor-element-7bc0d733 .elementor-column-wrap {
    width: 100% !important;
    display: flex !important;
}
.elementor-element-7bc0d733 .elementor-widget-wrap {
    width: 100% !important;
    display: flex !important;
    flex-direction: column !important;
}
.elementor-element-7bc0d733 .elementor-widget-pp-info-box {
    width: 100% !important;
    height: 100% !important;
    display: flex !important;
    flex-direction: column !important;
}
.elementor-element-7bc0d733 .pp-info-box {
    background: #ffffff !important;
    border-radius: 6px !important;
    padding: 24px 18px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08) !important;
    text-align: center !important;
    width: 100% !important;
    height: 100% !important;
    box-sizing: border-box !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: flex-start !important;
}
.elementor-element-7bc0d733 .pp-info-box-title {
    color: #64141F !important;
    font-size: 17px !important;
    font-weight: 700 !important;
    margin: 12px 0 8px 0 !important;
    font-family: "Montserrat", sans-serif !important;
}
.elementor-element-7bc0d733 .pp-info-box-description {
    color: #4b4f58 !important;
    font-size: 13px !important;
    line-height: 1.6 !important;
    margin: 0 !important;
}
.elementor-element-7bc0d733 .pp-info-box-image img {
    max-width: 48px !important;
    height: auto !important;
    margin: 0 auto !important;
    display: block !important;
}

/* Section 3: Overview */
.elementor-element-45040261 {
    padding: 50px 0 !important;
    background: #ffffff !important;
}
.elementor-element-45040261 > .elementor-container {
    max-width: 1240px !important;
    margin: 0 auto !important;
    padding: 0 15px !important;
}
.elementor-element-45040261 .elementor-row {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    gap: 30px !important;
    width: 100% !important;
}
.elementor-element-45040261 .elementor-column.elementor-col-50 {
    width: 50% !important;
    flex: 1 1 50% !important;
}
.elementor-element-45040261 img {
    border-radius: 8px !important;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08) !important;
    max-width: 100% !important;
    height: auto !important;
    display: block !important;
}
.elementor-element-45040261 .elementor-heading-title {
    color: #64141F !important;
    font-size: 26px !important;
    font-weight: 700 !important;
    margin-bottom: 15px !important;
    font-family: "Montserrat", sans-serif !important;
    line-height: 1.3 !important;
}
.elementor-element-45040261 p {
    color: #4b4f58 !important;
    font-size: 14.5px !important;
    line-height: 1.7 !important;
    margin-bottom: 12px !important;
}

/* Section 4: Sustainability */
.elementor-element-1ebb905d {
    padding: 50px 0 !important;
    background: #faf8f5 !important;
    width: 100% !important;
}
.elementor-element-1ebb905d > .elementor-container {
    max-width: 1240px !important;
    margin: 0 auto !important;
    padding: 0 15px !important;
}
.elementor-element-1ebb905d .elementor-row {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    gap: 30px !important;
    width: 100% !important;
}
.elementor-element-1ebb905d .elementor-column.elementor-col-50 {
    width: 50% !important;
    flex: 1 1 50% !important;
}
.elementor-element-1ebb905d img {
    border-radius: 8px !important;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08) !important;
    max-width: 100% !important;
    height: auto !important;
    display: block !important;
}
.elementor-element-1ebb905d .elementor-heading-title {
    color: #000000 !important;
    font-size: 24px !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
    letter-spacing: 1px !important;
    margin-bottom: 15px !important;
    font-family: "Montserrat", sans-serif !important;
}
.elementor-element-1ebb905d p {
    color: #4b4f58 !important;
    font-size: 14.5px !important;
    line-height: 1.7 !important;
    margin-bottom: 20px !important;
}
.elementor-element-1ebb905d .elementor-button {
    background: #64141F !important;
    color: #ffffff !important;
    font-family: "Poppins", sans-serif !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    padding: 10px 24px !important;
    border-radius: 4px !important;
    display: inline-block !important;
    text-decoration: none !important;
}

/* Section 5: Stats Facts */
.elementor-element-425a92a3 {
    padding: 50px 0 !important;
    background: #ffffff !important;
}
.elementor-element-425a92a3 > .elementor-container {
    max-width: 1240px !important;
    margin: 0 auto !important;
    padding: 0 15px !important;
}
.elementor-element-425a92a3 .elementor-row {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    gap: 20px !important;
    width: 100% !important;
}
.elementor-element-425a92a3 .elementor-column.elementor-col-25 {
    width: 25% !important;
    flex: 1 1 25% !important;
}

/* Section 6: Testimonials */
.elementor-element-0dd5e11 {
    background: #73001B !important;
    padding: 50px 0 !important;
    width: 100% !important;
}
.elementor-element-0dd5e11 > .elementor-container {
    max-width: 1240px !important;
    margin: 0 auto !important;
    padding: 0 15px !important;
}
.elementor-element-0dd5e11 .elementor-heading-title {
    color: #ffffff !important;
    font-size: 26px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    text-align: center !important;
    letter-spacing: 1px !important;
    margin-bottom: 35px !important;
    font-family: "Montserrat", sans-serif !important;
}
.elementor-element-0dd5e11 .pp-testimonials-wrap {
    width: 100% !important;
}
.elementor-element-0dd5e11 .pp-testimonials-carousel {
    display: flex !important;
    flex-direction: row !important;
    justify-content: center !important;
    gap: 24px !important;
    flex-wrap: wrap !important;
}
.elementor-element-0dd5e11 .pp-testimonial-slide {
    flex: 1 1 300px !important;
    max-width: 360px !important;
    text-align: center !important;
}
.elementor-element-0dd5e11 .pp-testimonial-image img {
    width: 70px !important;
    height: 70px !important;
    border-radius: 50% !important;
    border: 3px solid #ffffff !important;
    margin: 0 auto 15px auto !important;
    display: block !important;
    object-fit: cover !important;
}
.elementor-element-0dd5e11 .pp-testimonial-description {
    color: #ffffff !important;
    font-size: 13.5px !important;
    line-height: 1.6 !important;
    font-style: italic !important;
    margin-bottom: 12px !important;
}
.elementor-element-0dd5e11 .pp-testimonial-title {
    color: #ffffff !important;
    font-size: 15px !important;
    font-weight: 700 !important;
}
.elementor-element-0dd5e11 .pp-testimonial-company {
    color: #D2AF77 !important;
    font-size: 12px !important;
}

/* Section 7: Pre-Footer Banner */
.elementor-element-5a5c4582 {
    background: linear-gradient(180deg, #C49F6A 0%, #966F37 100%) !important;
    padding: 30px 0 !important;
    width: 100% !important;
}
.elementor-element-5a5c4582 > .elementor-container {
    max-width: 1240px !important;
    margin: 0 auto !important;
    padding: 0 15px !important;
}
.elementor-element-5a5c4582 .elementor-row {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    justify-content: space-between !important;
    width: 100% !important;
}
.elementor-element-5a5c4582 .elementor-button {
    background: #64141F !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    border-radius: 4px !important;
    padding: 10px 22px !important;
}

/* Footer Section 2c99f6d */
.elementor-element-2c99f6d {
    background: #64141F !important;
    padding: 50px 0 30px 0 !important;
    width: 100% !important;
}
.elementor-element-2c99f6d > .elementor-container {
    max-width: 1240px !important;
    margin: 0 auto !important;
    padding: 0 15px !important;
}
.elementor-element-2c99f6d .elementor-row {
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    gap: 30px !important;
    width: 100% !important;
}
.elementor-element-2c99f6d .elementor-column.elementor-col-25 {
    width: 25% !important;
    flex: 1 1 25% !important;
}
.elementor-element-2c99f6d h4,
.elementor-element-2c99f6d h5,
.elementor-element-2c99f6d .elementor-heading-title {
    color: #ffffff !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    margin-bottom: 20px !important;
}
.elementor-element-2c99f6d ul.elementor-icon-list-items {
    list-style: none !important;
    padding: 0 !important;
    margin: 0 !important;
}
.elementor-element-2c99f6d ul.elementor-icon-list-items li {
    list-style: none !important;
    margin-bottom: 8px !important;
}
.elementor-element-2c99f6d ul.elementor-icon-list-items a {
    color: #ffffff !important;
    opacity: 0.85 !important;
    text-decoration: none !important;
    font-size: 13.5px !important;
    transition: opacity 0.2s !important;
}
.elementor-element-2c99f6d ul.elementor-icon-list-items a:hover {
    opacity: 1 !important;
    color: #D2AF77 !important;
}

/* Sub-Footer Section 21a00a3 */
.elementor-element-21a00a3 {
    background: #C49F6A !important;
    padding: 12px 0 !important;
    width: 100% !important;
}
.elementor-element-21a00a3 > .elementor-container {
    max-width: 1240px !important;
    margin: 0 auto !important;
    padding: 0 15px !important;
}
.elementor-element-21a00a3 .elementor-row {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    justify-content: space-between !important;
    width: 100% !important;
}
.elementor-element-21a00a3 p,
.elementor-element-21a00a3 a {
    color: #ffffff !important;
    font-size: 13px !important;
    margin: 0 !important;
    text-decoration: none !important;
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .elementor-element-7bc0d733 .elementor-row {
        flex-wrap: wrap !important;
    }
    .elementor-element-7bc0d733 .elementor-column.elementor-col-25 {
        width: 50% !important;
        flex: 1 1 50% !important;
        max-width: 50% !important;
    }
    .elementor-element-45040261 .elementor-row,
    .elementor-element-1ebb905d .elementor-row {
        flex-direction: column !important;
    }
    .elementor-element-45040261 .elementor-column.elementor-col-50,
    .elementor-element-1ebb905d .elementor-column.elementor-col-50 {
        width: 100% !important;
        flex: 1 1 100% !important;
    }
    .elementor-element-2c99f6d .elementor-row {
        flex-wrap: wrap !important;
    }
    .elementor-element-2c99f6d .elementor-column.elementor-col-25 {
        width: 50% !important;
        flex: 1 1 50% !important;
    }
}
@media (max-width: 767px) {
    .elementor-element-7bc0d733 .elementor-column.elementor-col-25,
    .elementor-element-425a92a3 .elementor-column.elementor-col-25,
    .elementor-element-2c99f6d .elementor-column.elementor-col-25 {
        width: 100% !important;
        flex: 1 1 100% !important;
        max-width: 100% !important;
    }
}

/* Popup modal styling */
#elementor-popup-modal-11717 {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 999999;
    align-items: center;
    justify-content: center;
    background: rgba(0,0,0,0.65);
    backdrop-filter: blur(4px);
}
#elementor-popup-modal-11717.is-active {
    display: flex;
}
#elementor-popup-modal-11717 .dialog-widget-content {
    background: #ffffff;
    max-width: 650px;
    width: 90%;
    border-radius: 8px;
    padding: 30px;
    position: relative;
    box-shadow: 0 20px 50px rgba(0,0,0,0.3);
    max-height: 90vh;
    overflow-y: auto;
}
#elementor-popup-modal-11717 .dialog-close-button {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 24px;
    background: none;
    border: none;
    cursor: pointer;
    color: #64141f;
}
</style>
';
$headContent .= "\n" . $headFixes;

// 2. HEADER 21
$h21Start = strpos($live, '<div data-elementor-type="header"');
$contentStart = strpos($live, '<div id="content"');
$header21Html = substr($live, $h21Start, $contentStart - $h21Start);
$header21Html = localizeUrls($header21Html);

// Wire Enquiry Now button to open the popup modal
$header21Html = preg_replace('/href="[^"]*request-quote[^"]*"([^>]*class="[^"]*elementor-button)/i', 'href="javascript:void(0)" onclick="openEnquiryModal()"\1', $header21Html);
// Wire search form
$header21Html = preg_replace('/<form role="search" method="get" class="elementor-search-form" action="[^"]*">/i', '<form role="search" method="get" class="elementor-search-form" action="{{ route(\'products.search\') }}">', $header21Html);

// 3. PAGE 136 (home.blade.php content)
$e136Start = strpos($live, '<div data-elementor-type="wp-page" data-elementor-id="136"');
$footerStart = strpos($live, '<div data-elementor-type="footer" data-elementor-id="61"');
$page136Inner = substr($live, $contentStart, $footerStart - $contentStart);
$page136Inner = localizeUrls($page136Inner);
// Strip elementor-invisible so all columns and widgets are 100% visible immediately
$page136Inner = str_replace('elementor-invisible', '', $page136Inner);

// 4. FOOTER 61
$waStart = strpos($live, '<div class="ht-ctc');
if ($waStart === false) $waStart = strpos($live, 'ht_ctc_chat');
$footer61Html = substr($live, $footerStart, $waStart - $footerStart);
$footer61Html = localizeUrls($footer61Html);

// 5. WHATSAPP & POPUP
$popupStart = strpos($live, '<div data-elementor-type="popup"');
$waHtml = substr($live, $waStart, $popupStart - $waStart);
$waHtml = localizeUrls($waHtml);

$scriptsStart = strpos($live, '<script', $popupStart);
$popupHtml = substr($live, $popupStart, $scriptsStart - $popupStart);
$popupHtml = localizeUrls($popupHtml);

// Wrap popup modal with container id and close button
$popupModalWrapped = '
<div id="elementor-popup-modal-11717" role="dialog" aria-modal="true">
    <div class="dialog-widget-content">
        <button type="button" class="dialog-close-button" onclick="closeEnquiryModal()">&times;</button>
        ' . $popupHtml . '
    </div>
</div>
';

// Wire popup form action to Laravel inquiries route
$popupModalWrapped = preg_replace('/<form action="[^"]*" method="post"/i', '<form action="{{ route(\'inquiries.store\') }}" method="POST"><input type="hidden" name="_token" value="{{ csrf_token() }}">', $popupModalWrapped);

// 6. SCRIPTS
$bodyEnd = strpos($live, '</body>');
$scriptsHtml = substr($live, $scriptsStart, $bodyEnd - $scriptsStart);
$scriptsHtml = localizeUrls($scriptsHtml);

// Add modal open/close script + Swiper fallback init
$modalJs = '
<script>
function openEnquiryModal() {
    var m = document.getElementById("elementor-popup-modal-11717");
    if (m) m.classList.add("is-active");
}
function closeEnquiryModal() {
    var m = document.getElementById("elementor-popup-modal-11717");
    if (m) m.classList.remove("is-active");
}
document.addEventListener("DOMContentLoaded", function() {
    // Backdrop click close
    var m = document.getElementById("elementor-popup-modal-11717");
    if (m) {
        m.addEventListener("click", function(e) {
            if (e.target === m) closeEnquiryModal();
        });
    }
    // Mobile menu toggle
    var toggles = document.querySelectorAll(".elementor-menu-toggle");
    toggles.forEach(function(btn) {
        btn.addEventListener("click", function() {
            var dd = document.querySelector(".elementor-nav-menu--dropdown");
            if (dd) {
                dd.style.display = (dd.style.display === "block" ? "none" : "block");
            }
        });
    });
    // Fallback swiper initialization for hero slider if needed
    if (typeof Swiper !== "undefined") {
        new Swiper(".elementor-slides-wrapper.swiper-container", {
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false },
            effect: "fade",
            fadeEffect: { crossFade: true },
            speed: 600,
            navigation: {
                nextEl: ".elementor-swiper-button-next",
                prevEl: ".elementor-swiper-button-prev"
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            }
        });
    }
    // Testimonials slick carousel fallback
    if (typeof jQuery !== "undefined" && typeof jQuery.fn.slick !== "undefined") {
        jQuery(".pp-testimonials.pp-slick-slider").each(function() {
            if (!jQuery(this).hasClass("slick-initialized")) {
                jQuery(this).slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    speed: 600,
                    dots: true,
                    arrows: false,
                    responsive: [
                        { breakpoint: 1025, settings: { slidesToShow: 2, slidesToScroll: 1 } },
                        { breakpoint: 768, settings: { slidesToShow: 1, slidesToScroll: 1 } }
                    ]
                });
            }
        });
    }
});
</script>
';
$scriptsHtml .= "\n" . $modalJs;

// BUILD app.blade.php
$appBlade = '<!DOCTYPE html>
<html lang="en">
<head>
' . $headContent . '
@stack("styles")
</head>
<body itemtype="https://schema.org/WebPage" itemscope="itemscope" class="home wp-singular page-template-default page page-id-136 wp-custom-logo wp-theme-astra theme-astra woocommerce-no-js ast-desktop ast-plain-container ast-no-sidebar astra-3.7.10 ast-header-custom-item-inside ast-single-post ast-inherit-site-logo-transparent above-header-nav-padding-support ast-full-width-layout ast-sticky-header-shrink ast-inherit-site-logo-sticky elementor-default elementor-kit-17 elementor-page elementor-page-136 astra-addon-3.6.6">
<div id="page" class="hfeed site">
<a class="skip-link screen-reader-text" href="#content">Skip to content</a>

' . $header21Html . '

@if(Request::is("/") || Request::routeIs("home"))
    @yield("content")
@else
    <div id="content" class="site-content">
        <div class="ast-container" style="max-width: 1240px; margin: 30px auto; padding: 0 20px;">
            <div id="primary" class="content-area primary">
                <main id="main" class="site-main">
                    @yield("content")
                </main>
            </div>
        </div>
    </div>
@endif

' . $footer61Html . '
' . $waHtml . '
' . $popupModalWrapped . '

</div><!-- #page -->

' . $scriptsHtml . '
@stack("scripts")
</body>
</html>
';

file_put_contents(__DIR__ . '/resources/views/layouts/app.blade.php', $appBlade);
echo "Successfully generated resources/views/layouts/app.blade.php (" . strlen($appBlade) . " bytes)\n";

// BUILD home.blade.php
$homeBlade = '@extends("layouts.app")

@section("content")
' . $page136Inner . '
@endsection
';

file_put_contents(__DIR__ . '/resources/views/pages/home.blade.php', $homeBlade);
echo "Successfully generated resources/views/pages/home.blade.php (" . strlen($homeBlade) . " bytes)\n";
