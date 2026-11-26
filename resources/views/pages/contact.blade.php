@extends('layouts.app')

@push('styles')
<link rel="stylesheet" id="elementor-post-9833-css" href="{{ asset('css/live/post-9833.css') }}" media="all" />
<style>
    /* Contact Page 1:1 Pixel-Perfect Parity with https://sdinternational.com/contact/ */
    .page-id-9833 .site-content > .ast-container,
    .elementor-page-9833 .site-content > .ast-container {
        max-width: 1240px !important;
        margin: 0 auto !important;
        padding: 0 !important;
        box-sizing: border-box !important;
    }
    .page-id-9833 #primary,
    .elementor-page-9833 #primary,
    .page-id-9833 #main,
    .elementor-page-9833 #main,
    .page-id-9833 article.post-9833,
    .elementor-page-9833 article.post-9833,
    .page-id-9833 header.entry-header,
    .page-id-9833 .entry-content,
    .elementor-page-9833 .entry-content {
        margin: 0 !important;
        padding: 0 !important;
        float: none !important;
        width: 100% !important;
    }

    /* Section 1: Page Header Title */
    .elementor-9833 .elementor-element.elementor-element-15da2a0 {
        margin-top: 110px !important;
        margin-bottom: 0px !important;
        overflow: visible !important;
    }
    .elementor-9833 .elementor-element.elementor-element-7d5c8f7 {
        text-align: center !important;
    }
    .elementor-9833 .elementor-element.elementor-element-7d5c8f7 .elementor-heading-title {
        color: #000000 !important;
        font-family: 'Open Sans', sans-serif !important;
        font-size: 22px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: normal !important;
        margin: 0 !important;
        padding: 0 !important;
        line-height: 1.3 !important;
    }

    /* Section 2: Contact Info & Form (Boxed 1240px container matching SD International) */
    .elementor-9833 .elementor-element.elementor-element-141bac8 {
        background-color: #FFFFFF !important;
        margin-top: 10px !important;
        margin-bottom: 0px !important;
        padding: 74px 0px 80px 0px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        overflow: visible !important;
    }
    .elementor-9833 .elementor-element.elementor-element-141bac8 > .elementor-container {
        max-width: 1240px !important;
        margin: 0 auto !important;
        padding: 0 !important;
        display: flex !important;
        flex-wrap: wrap !important;
        box-sizing: border-box !important;
    }
    .elementor-9833 .elementor-element.elementor-element-141bac8 .elementor-row {
        width: 100% !important;
        display: flex !important;
        flex-wrap: wrap !important;
    }

    /* 50/50 Columns */
    @media (min-width: 768px) {
        .elementor-9833 .elementor-element.elementor-element-3314565 {
            width: 50.968% !important;
            box-sizing: border-box !important;
        }
        .elementor-9833 .elementor-element.elementor-element-d89efb4 {
            width: 48.953% !important;
            box-sizing: border-box !important;
        }
    }
    @media (max-width: 767px) {
        .elementor-9833 .elementor-element.elementor-element-3314565,
        .elementor-9833 .elementor-element.elementor-element-d89efb4 {
            width: 100% !important;
        }
    }
    .elementor-9833 .elementor-element.elementor-element-3314565 > .elementor-column-wrap > .elementor-element-populated,
    .elementor-9833 .elementor-element.elementor-element-3314565 > .elementor-element-populated {
        padding: 0px 20px 0px 0px !important;
    }
    .elementor-9833 .elementor-element.elementor-element-d89efb4 > .elementor-column-wrap > .elementor-element-populated,
    .elementor-9833 .elementor-element.elementor-element-d89efb4 > .elementor-element-populated {
        padding: 10px 0px 10px 10px !important;
    }

    /* Left Column Typography */
    .elementor-9833 .elementor-element.elementor-element-58cb732 {
        text-align: left !important;
    }
    .elementor-9833 .elementor-element.elementor-element-58cb732 .elementor-heading-title {
        color: #000000 !important;
        font-family: 'Open Sans', sans-serif !important;
        font-size: 22px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        margin: 0 !important;
        padding: 0 !important;
        line-height: 1.3 !important;
    }
    .elementor-9833 .elementor-element.elementor-element-d079d28,
    .elementor-9833 .elementor-element.elementor-element-a681365 {
        text-align: left !important;
    }
    .elementor-9833 .elementor-element.elementor-element-d079d28 .elementor-heading-title,
    .elementor-9833 .elementor-element.elementor-element-a681365 .elementor-heading-title {
        color: #000000 !important;
        font-family: 'Open Sans', sans-serif !important;
        font-size: 15px !important;
        font-weight: 400 !important;
        line-height: 1.6 !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
    }
    .elementor-9833 .elementor-element.elementor-element-d079d28 {
        margin-top: 23px !important;
        margin-bottom: 0px !important;
    }
    .elementor-9833 .elementor-element.elementor-element-a681365 {
        margin-top: 28px !important;
        margin-bottom: 0px !important;
    }

    /* Inner Section for Icons */
    .elementor-9833 .elementor-element.elementor-element-085ceb9 {
        margin-top: 12px !important;
        margin-bottom: 0px !important;
        overflow: visible !important;
    }
    .elementor-9833 .elementor-element.elementor-element-297a994 > .elementor-column-wrap > .elementor-element-populated,
    .elementor-9833 .elementor-element.elementor-element-297a994 > .elementor-element-populated {
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Icon Lists - Strictly 1 Horizontal Line per List without wrapping */
    .elementor-9833 .elementor-element.elementor-element-ff31485,
    .elementor-9833 .elementor-element.elementor-element-32d2d27,
    .elementor-9833 .elementor-element.elementor-element-cb2b55b {
        padding: 0 !important;
        margin-bottom: 20px !important;
    }
    .elementor-9833 .elementor-icon-list-items.elementor-inline-items {
        display: flex !important;
        flex-wrap: nowrap !important;
        white-space: nowrap !important;
        align-items: center !important;
        margin-right: -12.5px !important;
        margin-left: -12.5px !important;
        padding: 0 !important;
        list-style: none !important;
    }
    .elementor-9833 .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item {
        margin-right: 12.5px !important;
        margin-left: 12.5px !important;
        display: inline-flex !important;
        align-items: center !important;
        white-space: nowrap !important;
        flex-shrink: 0 !important;
    }
    .elementor-9833 .elementor-icon-list-item a,
    .elementor-9833 .elementor-icon-list-item span.elementor-icon-list-text {
        color: #000000 !important;
        text-decoration: none !important;
        font-family: 'Open Sans', sans-serif !important;
        font-size: 15px !important;
        line-height: 1em !important;
        letter-spacing: 0.1px !important;
        transition: color 0.2s;
    }
    .elementor-9833 .elementor-icon-list-item a:hover {
        color: #64141f !important;
    }
    .elementor-9833 .elementor-icon-list-icon {
        margin-right: 5px !important;
        display: inline-flex !important;
        align-items: center !important;
    }
    .elementor-9833 .elementor-icon-list-icon i {
        color: #000000 !important;
        font-size: 20px !important;
        vertical-align: middle !important;
    }

    /* Right Column: Text & Form */
    .elementor-9833 .elementor-element.elementor-element-708a053 {
        text-align: center !important;
        margin-bottom: 24px !important;
    }
    .elementor-9833 .elementor-element.elementor-element-708a053 p {
        color: #000000 !important;
        font-family: 'Open Sans', sans-serif !important;
        font-size: 15px !important;
        margin: 0 !important;
        line-height: 1.6 !important;
    }

    /* Form Fields 1:1 Matching SD International */
    .elementor-9833 .elementor-element.elementor-element-f609084 .pp-contact-form-7 .wpcf7-form p {
        margin: 0 0 20px 0 !important;
        padding: 0 !important;
    }
    .elementor-9833 .elementor-element.elementor-element-f609084 .pp-contact-form-7 .wpcf7-form p:not(:last-of-type) .wpcf7-form-control-wrap {
        margin-bottom: 20px !important;
        display: block !important;
    }
    .elementor-9833 .elementor-element.elementor-element-f609084 .pp-contact-form-7 .wpcf7-form-control.wpcf7-text {
        width: 100% !important;
        height: 45px !important;
        padding: 11.25px 15px !important;
        border: 1px solid #e1e1e1 !important;
        border-radius: 0px !important;
        font-family: 'Open Sans', sans-serif !important;
        font-size: 15px !important;
        font-weight: 400 !important;
        color: #333333 !important;
        background-color: #ffffff !important;
        box-shadow: none !important;
        box-sizing: border-box !important;
        outline: none !important;
        transition: border-color 0.2s ease-in-out;
    }
    .elementor-9833 .elementor-element.elementor-element-f609084 .pp-contact-form-7 .wpcf7-form-control.wpcf7-textarea {
        width: 100% !important;
        height: 164px !important;
        padding: 11.25px 15px !important;
        border: 1px solid #e1e1e1 !important;
        border-radius: 0px !important;
        font-family: 'Open Sans', sans-serif !important;
        font-size: 15px !important;
        font-weight: 400 !important;
        color: #333333 !important;
        background-color: #ffffff !important;
        box-shadow: none !important;
        box-sizing: border-box !important;
        resize: vertical !important;
        outline: none !important;
        transition: border-color 0.2s ease-in-out;
    }
    .elementor-9833 .elementor-element.elementor-element-f609084 .pp-contact-form-7 .wpcf7-form-control.wpcf7-text:focus,
    .elementor-9833 .elementor-element.elementor-element-f609084 .pp-contact-form-7 .wpcf7-form-control.wpcf7-textarea:focus {
        border-color: #64141f !important;
    }
    .elementor-9833 .elementor-element.elementor-element-f609084 .pp-contact-form-7 .wpcf7-form p:nth-last-of-type(1) {
        text-align: left !important;
        margin-top: 20px !important;
        margin-bottom: 0 !important;
    }
    .elementor-9833 .elementor-element.elementor-element-f609084 .pp-contact-form-7 .wpcf7-form input[type="submit"] {
        display: inline-block !important;
        width: 100px !important;
        height: 35px !important;
        background-color: #64141f !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 0px !important;
        font-family: 'Open Sans', sans-serif !important;
        font-size: 15px !important;
        font-weight: 500 !important;
        padding: 0 !important;
        text-align: center !important;
        line-height: 35px !important;
        cursor: pointer !important;
        transition: background-color 0.2s ease-in-out !important;
    }
    .elementor-9833 .elementor-element.elementor-element-f609084 .pp-contact-form-7 .wpcf7-form input[type="submit"]:hover {
        background-color: #4b0e17 !important;
    }

    /* Section 3: Google Map (Boxed 1200px container, subtle background) */
    .elementor-9833 .elementor-element.elementor-element-4c4be20 {
        background-color: rgba(238, 221, 194, 0.15) !important;
        padding: 51px 0px 50px 0px !important;
        margin: 0 !important;
    }
    .elementor-9833 .elementor-element.elementor-element-4c4be20 > .elementor-container {
        max-width: 1200px !important;
        margin: 0 auto !important;
    }
    .elementor-9833 .elementor-element.elementor-element-ab5a068 iframe {
        width: 100% !important;
        height: 400px !important;
        border: 0 !important;
        display: block !important;
    }

    .wpcf7-response-output {
        margin: 1.5em 0 1em;
        padding: 0.6em 1em;
        font-family: 'Open Sans', sans-serif;
        font-size: 14px;
        border-radius: 2px;
    }
    .wpcf7-response-output.alert-success {
        border: 2px solid #46b450 !important;
        color: #46b450 !important;
        background: #f7fff7 !important;
    }
    .wpcf7-response-output.alert-danger {
        border: 2px solid #dc3232 !important;
        color: #dc3232 !important;
        background: #fff8f8 !important;
    }
</style>
@endpush

@section('content')
<div id="content" class="site-content">
    <div class="ast-container">
        <div id="primary" class="content-area primary">
            <main id="main" class="site-main">
                <article class="post-9833 page type-page status-publish ast-article-single" id="post-9833">
                    <header class="entry-header ast-header-without-markup"></header>

                    <div class="entry-content clear" itemprop="text">
                        <div class="elementor elementor-9833" data-elementor-id="9833" data-elementor-type="wp-page">
                            <div class="elementor-inner">
                                <div class="elementor-section-wrap">

                                    <!-- SECTION 1: Page Header -->
                                    <section class="elementor-section elementor-top-section elementor-element elementor-element-15da2a0 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="15da2a0" data-element_type="section" data-settings='{"ekit_has_onepagescroll_dot":"yes"}'>
                                        <div class="elementor-container elementor-column-gap-default">
                                            <div class="elementor-row">
                                                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-9d6a900" data-id="9d6a900" data-element_type="column">
                                                    <div class="elementor-column-wrap elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-7d5c8f7 elementor-widget elementor-widget-heading" data-id="7d5c8f7" data-element_type="widget" data-settings='{"ekit_we_effect_on":"none"}' data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h2 class="elementor-heading-title elementor-size-default">We’d love to hear from you</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <!-- SECTION 2: Contact Info & Form (Stretched 2-Column Section) -->
                                    <section class="elementor-section elementor-top-section elementor-element elementor-element-141bac8 elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="141bac8" data-element_type="section" data-settings='{"background_background":"classic","stretch_section":"section-stretched","ekit_has_onepagescroll_dot":"yes"}'>
                                        <div class="elementor-container elementor-column-gap-default">
                                            <div class="elementor-row">

                                                <!-- Left Column: S D International Details -->
                                                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-3314565" data-id="3314565" data-element_type="column" data-settings='{"animation":"fadeIn"}'>
                                                    <div class="elementor-column-wrap elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            
                                                            <div class="elementor-element elementor-element-58cb732 elementor-widget elementor-widget-heading" data-id="58cb732" data-element_type="widget" data-settings='{"ekit_we_effect_on":"none"}' data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h2 class="elementor-heading-title elementor-size-default">S D International</h2>
                                                                </div>
                                                            </div>

                                                            <div class="elementor-element elementor-element-d079d28 elementor-widget elementor-widget-heading" data-id="d079d28" data-element_type="widget" data-settings='{"ekit_we_effect_on":"none"}' data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <span class="elementor-heading-title elementor-size-default">
                                                                        <b>Corporate Address</b><br/>
                                                                        701, Ashok heights, Off Old Nagardas Road, Near Saraswati Towers, Gundavali Hill, Andheri East, Mumbai, Maharashtra, India. Pincode: 400069
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="elementor-element elementor-element-a681365 elementor-widget elementor-widget-heading" data-id="a681365" data-element_type="widget" data-settings='{"ekit_we_effect_on":"none"}' data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <span class="elementor-heading-title elementor-size-default">
                                                                        <b>Contact Person</b><br/>
                                                                        Mr. Jagdeep Mehta ( Chairman &amp; Managing Director )<br/>
                                                                        Mr. Dhruv Mehta &nbsp;&nbsp;&nbsp;( Sales &amp; Marketing Director )
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <!-- Inner Section: Communication Links -->
                                                            <section class="elementor-section elementor-inner-section elementor-element elementor-element-085ceb9 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="085ceb9" data-element_type="section" data-settings='{"ekit_has_onepagescroll_dot":"yes"}'>
                                                                <div class="elementor-container elementor-column-gap-default">
                                                                    <div class="elementor-row">
                                                                        <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-297a994" data-id="297a994" data-element_type="column">
                                                                            <div class="elementor-column-wrap elementor-element-populated">
                                                                                <div class="elementor-widget-wrap">

                                                                                    <!-- Phone & Email List 1 -->
                                                                                    <div class="elementor-element elementor-element-ff31485 elementor-icon-list--layout-inline elementor-align-left elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="ff31485" data-element_type="widget" data-settings='{"ekit_we_effect_on":"none"}' data-widget_type="icon-list.default">
                                                                                        <div class="elementor-widget-container">
                                                                                            <ul class="elementor-icon-list-items elementor-inline-items">
                                                                                                <li class="elementor-icon-list-item elementor-inline-item">
                                                                                                    <a href="tel:+9198204%2054441%20" target="_blank">
                                                                                                        <span class="elementor-icon-list-icon">
                                                                                                            <i aria-hidden="true" class="fas fa-phone-square-alt"></i>
                                                                                                        </span>
                                                                                                        <span class="elementor-icon-list-text">+91 99206 69561</span>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li class="elementor-icon-list-item elementor-inline-item">
                                                                                                    <a href="mailto:info@sdinternational.com" target="_blank">
                                                                                                        <span class="elementor-icon-list-icon">
                                                                                                            <i aria-hidden="true" class="far fa-envelope"></i>
                                                                                                        </span>
                                                                                                        <span class="elementor-icon-list-text">info@sdinternational.com</span>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li class="elementor-icon-list-item elementor-inline-item">
                                                                                                    <a href="tel:+9198204%2054441%20" target="_blank">
                                                                                                        <span class="elementor-icon-list-icon">
                                                                                                            <i aria-hidden="true" class="fas fa-phone-square-alt"></i>
                                                                                                        </span>
                                                                                                        <span class="elementor-icon-list-text">+91 98204 54441</span>
                                                                                                    </a>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Messaging Apps List 2 -->
                                                                                    <div class="elementor-element elementor-element-32d2d27 elementor-icon-list--layout-inline elementor-align-left elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="32d2d27" data-element_type="widget" data-settings='{"ekit_we_effect_on":"none"}' data-widget_type="icon-list.default">
                                                                                        <div class="elementor-widget-container">
                                                                                            <ul class="elementor-icon-list-items elementor-inline-items">
                                                                                                <li class="elementor-icon-list-item elementor-inline-item">
                                                                                                    <a href="https://wa.link/owdi77" rel="nofollow noopener" target="_blank">
                                                                                                        <span class="elementor-icon-list-icon">
                                                                                                            <i aria-hidden="true" class="fab fa-whatsapp"></i>
                                                                                                        </span>
                                                                                                        <span class="elementor-icon-list-text">+91 99206 69561</span>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li class="elementor-icon-list-item elementor-inline-item">
                                                                                                    <a href="https://msng.link/o/?https%3A%2F%2Fu.wechat.com%2FIP3hcBw97OBITMw8MkO7zuQ=wc" rel="nofollow noopener" target="_blank">
                                                                                                        <span class="elementor-icon-list-icon">
                                                                                                            <i aria-hidden="true" class="fab fa-weixin"></i>
                                                                                                        </span>
                                                                                                        <span class="elementor-icon-list-text">+91 99206 69561</span>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li class="elementor-icon-list-item elementor-inline-item">
                                                                                                    <a href="https://msng.link/o/?+919920669561=sk" rel="nofollow noopener" target="_blank">
                                                                                                        <span class="elementor-icon-list-icon">
                                                                                                            <i aria-hidden="true" class="fab fa-skype"></i>
                                                                                                        </span>
                                                                                                        <span class="elementor-icon-list-text">+91 99206 69561</span>
                                                                                                    </a>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Landline List 3 -->
                                                                                    <div class="elementor-element elementor-element-cb2b55b elementor-icon-list--layout-inline elementor-align-left elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="cb2b55b" data-element_type="widget" data-settings='{"ekit_we_effect_on":"none"}' data-widget_type="icon-list.default">
                                                                                        <div class="elementor-widget-container">
                                                                                            <ul class="elementor-icon-list-items elementor-inline-items">
                                                                                                <li class="elementor-icon-list-item elementor-inline-item">
                                                                                                    <span class="elementor-icon-list-icon">
                                                                                                        <i aria-hidden="true" class="fas fa-phone-square-alt"></i>
                                                                                                    </span>
                                                                                                    <span class="elementor-icon-list-text">022 2683 6000 / 7000</span>
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
                                                </div>

                                                <!-- Right Column: Inquiry Contact Form -->
                                                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-d89efb4" data-id="d89efb4" data-element_type="column" data-settings='{"animation":"fadeIn","animation_delay":200}'>
                                                    <div class="elementor-column-wrap elementor-element-populated">
                                                        <div class="elementor-widget-wrap">

                                                            <div class="elementor-element elementor-element-708a053 elementor-widget elementor-widget-text-editor" data-id="708a053" data-element_type="widget" data-settings='{"ekit_we_effect_on":"none"}' data-widget_type="text-editor.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="elementor-text-editor elementor-clearfix">
                                                                        <p>Fill out the form and we’ll be in touch as soon as possible.</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="elementor-element elementor-element-f609084 pp-contact-form-7-button-custom elementor-widget elementor-widget-pp-contact-form-7" data-id="f609084" data-element_type="widget" data-settings='{"ekit_we_effect_on":"none"}' data-widget_type="pp-contact-form-7.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="pp-contact-form pp-contact-form-7 placeholder-show">
                                                                        <div class="wpcf7 no-js" id="wpcf7-f3216-p9833-o1" lang="en-US" dir="ltr" data-wpcf7-id="3216">
                                                                            <div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div>

                                                                            @if(session('success'))
                                                                                <div class="wpcf7-response-output alert-success" style="border: 2px solid #46b450; padding: 0.8em 1em; color: #46b450; background: #fff; margin-bottom: 20px; font-weight: 600;">
                                                                                    ✓ {{ session('success') }}
                                                                                </div>
                                                                            @endif

                                                                            @if (isset($errors) && $errors->any())
                                                                                <div class="wpcf7-response-output alert-danger" style="border: 2px solid #dc3232; padding: 0.8em 1em; color: #dc3232; background: #fff; margin-bottom: 20px;">
                                                                                    <ul style="margin: 0; padding-left: 20px;">
                                                                                        @foreach ($errors->all() as $error)
                                                                                            <li>{{ $error }}</li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            @endif

                                                                            <div id="contact-ajax-response" style="display: none;"></div>

                                                                            <form action="{{ route('inquiries.store') }}" method="post" class="wpcf7-form init" aria-label="Contact form" id="sd-contact-form">
                                                                                @csrf
                                                                                <fieldset class="hidden-fields-container" style="display: none;">
                                                                                    <input type="hidden" name="_wpcf7" value="3216" />
                                                                                    <input type="hidden" name="_wpcf7_version" value="6.1.7" />
                                                                                    <input type="hidden" name="_wpcf7_locale" value="en_US" />
                                                                                    <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f3216-p9833-o1" />
                                                                                    <input type="hidden" name="_wpcf7_container_post" value="9833" />
                                                                                    <input type="hidden" name="inquiry_type" value="general" />
                                                                                </fieldset>

                                                                                <p>
                                                                                    <span class="wpcf7-form-control-wrap" data-name="your-name">
                                                                                        <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Name" value="{{ old('name') }}" type="text" name="name" required />
                                                                                    </span>
                                                                                </p>
                                                                                <p>
                                                                                    <span class="wpcf7-form-control-wrap" data-name="your-email">
                                                                                        <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email" value="{{ old('email') }}" type="email" name="email" required />
                                                                                    </span>
                                                                                </p>
                                                                                <p>
                                                                                    <span class="wpcf7-form-control-wrap" data-name="tel-590">
                                                                                        <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" placeholder="Phone No" value="{{ old('phone') }}" type="tel" name="phone" required />
                                                                                    </span>
                                                                                </p>
                                                                                <p>
                                                                                    <span class="wpcf7-form-control-wrap" data-name="text-589">
                                                                                        <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Country" value="{{ old('country') }}" type="text" name="country" required />
                                                                                    </span>
                                                                                </p>
                                                                                <p>
                                                                                    <span class="wpcf7-form-control-wrap" data-name="text-33">
                                                                                        <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="City" value="{{ old('city') }}" type="text" name="city" required />
                                                                                    </span>
                                                                                </p>
                                                                                <p>
                                                                                    <span class="wpcf7-form-control-wrap" data-name="text-589">
                                                                                        <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Company Name" value="{{ old('company') }}" type="text" name="company" required />
                                                                                    </span>
                                                                                </p>
                                                                                <p>
                                                                                    <span class="wpcf7-form-control-wrap" data-name="your-message">
                                                                                        <textarea cols="32" rows="5" maxlength="2000" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Whether you have a question about Color, Pricing, Custom color, or anything else, our team is ready to answer all your questions" name="message" required>{{ old('message') }}</textarea>
                                                                                    </span>
                                                                                </p>
                                                                                <p>
                                                                                    <span class="elementor-button-content-wrapper">
                                                                                        <input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Send" id="btn-submit-contact" />
                                                                                    </span>
                                                                                </p>
                                                                                <div class="wpcf7-response-output" aria-hidden="true" style="display: none;"></div>
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

                                    <!-- SECTION 3: Google Map (Boxed 1200px container) -->
                                    <section class="elementor-section elementor-top-section elementor-element elementor-element-4c4be20 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="4c4be20" data-element_type="section" data-settings='{"background_background":"classic","ekit_has_onepagescroll_dot":"yes"}'>
                                        <div class="elementor-container elementor-column-gap-default">
                                            <div class="elementor-row">
                                                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-f1c8237" data-id="f1c8237" data-element_type="column">
                                                    <div class="elementor-column-wrap elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-ab5a068 elementor-widget elementor-widget-google_maps" data-id="ab5a068" data-element_type="widget" data-settings='{"ekit_we_effect_on":"none"}' data-widget_type="google_maps.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="elementor-custom-embed">
                                                                        <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                                                            src="https://maps.google.com/maps?q=S%20D%20INTERNATIONAL%20701%2C%20Ashok%20heights%2C%20Off%20Old%20Nagardas%20Road%2C%20Near%20Saraswati%20Towers%2C%20Gundavali%20Hill%2C%20Andheri%20East%2C%20Mumbai%2C%20Maharashtra&amp;t=m&amp;z=13&amp;output=embed&amp;iwloc=near"
                                                                            title="S D INTERNATIONAL 701, Ashok heights, Off Old Nagardas Road, Near Saraswati Towers, Gundavali Hill, Andheri East, Mumbai, Maharashtra"
                                                                            aria-label="S D INTERNATIONAL 701, Ashok heights, Off Old Nagardas Road, Near Saraswati Towers, Gundavali Hill, Andheri East, Mumbai, Maharashtra"
                                                                        ></iframe>
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
                </article>
            </main>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('sd-contact-form');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        var submitBtn = document.getElementById('btn-submit-contact');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.value = 'Sending...';
        }
    });
});
</script>
@endsection
