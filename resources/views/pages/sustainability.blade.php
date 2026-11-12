@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/live/post-2843.css') }}">
<style>
    /* Exact Sustainability Styling Matching SD International */
    .elementor-2843 .elementor-element-668d7e47 {
        background: #ffffff !important;
        padding: 55px 0 45px 0 !important;
    }
    .elementor-2843 .elementor-element-441d5f3f {
        background: linear-gradient(180deg, #F0EAD7 0%, #F5EFE1 100%) !important;
        padding: 55px 0 20px 0 !important;
    }
    .elementor-2843 .elementor-element-799ec4d5 {
        background: linear-gradient(180deg, #F5EFE1 0%, #FAF7EE 100%) !important;
        padding: 10px 0 75px 0 !important;
    }
    .elementor-2843 .elementor-divider-separator {
        border-top: 1px solid #757575 !important;
        width: 260px !important;
        max-width: 40% !important;
        margin: 14px auto !important;
        display: block !important;
    }
    .elementor-2843 .elementor-element-4098d130 .elementor-heading-title,
    .elementor-2843 .elementor-element-3fdb3769 .elementor-heading-title {
        color: #202020 !important;
        font-family: 'Open Sans', 'Montserrat', sans-serif !important;
        font-size: 29px !important;
        font-weight: 600 !important;
        line-height: 1.25 !important;
        text-align: center !important;
        margin: 0 !important;
    }
    .elementor-2843 .elementor-element-41ed20a3 .elementor-heading-title,
    .elementor-2843 .elementor-element-e37a7f .elementor-heading-title {
        color: #202020 !important;
        font-family: 'Open Sans', 'Montserrat', sans-serif !important;
        font-size: 29px !important;
        font-weight: 600 !important;
        line-height: 1.25 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.8px !important;
        text-align: center !important;
        margin: 4px 0 0 0 !important;
    }
    .elementor-2843 .elementor-element-17673d4f .elementor-text-editor p {
        font-family: 'Open Sans', sans-serif !important;
        font-size: 15px !important;
        font-weight: 400 !important;
        color: #000000 !important;
        line-height: 1.85 !important;
        text-align: center !important;
        max-width: 880px !important;
        margin: 22px auto 28px !important;
    }
    .elementor-2843 .elementor-element-3f87cbe {
        text-align: center !important;
    }
    .elementor-2843 .elementor-element-3f87cbe img {
        width: 120px !important;
        height: auto !important;
        display: inline-block !important;
    }
    .elementor-2843 .elementor-element-39c0ab08 img {
        width: 100% !important;
        max-width: 580px !important;
        height: auto !important;
        display: block !important;
        border-radius: 4px !important;
    }
    .elementor-2843 .elementor-element-c53cd58 .elementor-text-editor p {
        font-family: 'Open Sans', sans-serif !important;
        font-size: 15px !important;
        font-weight: 400 !important;
        color: #000000 !important;
        line-height: 1.85 !important;
        text-align: left !important;
        margin: 0 0 30px 0 !important;
    }
    .elementor-2843 .pp-logo-grid {
        display: grid !important;
        grid-template-columns: repeat(4, 1fr) !important;
        gap: 18px !important;
        margin-bottom: 20px !important;
    }
    .elementor-2843 .pp-logo-grid .pp-grid-item {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .elementor-2843 .pp-logo-grid img {
        width: 100px !important;
        height: 99px !important;
        object-fit: contain !important;
        display: block !important;
        transition: transform 0.25s ease;
    }
    .elementor-2843 .pp-logo-grid img:hover {
        transform: scale(1.06);
    }
    @media(max-width: 900px) {
        .elementor-2843 .elementor-element-a74d06e .elementor-row {
            flex-direction: column !important;
        }
        .elementor-2843 .elementor-element-e2c973,
        .elementor-2843 .elementor-element-102efcf6 {
            width: 100% !important;
            flex: 0 0 auto !important;
            max-width: 100% !important;
            height: auto !important;
        }
        .elementor-2843 .elementor-element-39c0ab08 {
            margin-bottom: 18px !important;
            text-align: center !important;
        }
        .elementor-2843 .elementor-element-39c0ab08 img {
            margin: 0 auto !important;
        }
        .elementor-2843 .elementor-element-c53cd58 .elementor-text-editor p {
            text-align: center !important;
            margin-bottom: 18px !important;
        }
    }
    @media (max-width: 767px) {
        .elementor-2843 .elementor-element-668d7e47 {
            padding: 22px 12px 18px 12px !important;
        }
        .elementor-2843 .elementor-element-441d5f3f {
            padding: 22px 12px 10px 12px !important;
        }
        .elementor-2843 .elementor-element-799ec4d5 {
            padding: 10px 12px 26px 12px !important;
        }
        .elementor-2843 .elementor-element-4098d130 .elementor-heading-title,
        .elementor-2843 .elementor-element-3fdb3769 .elementor-heading-title,
        .elementor-2843 .elementor-element-41ed20a3 .elementor-heading-title,
        .elementor-2843 .elementor-element-e37a7f .elementor-heading-title {
            font-size: 22px !important;
        }
        .elementor-2843 .elementor-divider-separator {
            margin: 10px auto !important;
        }
        .elementor-2843 .elementor-element-17673d4f .elementor-text-editor p,
        .elementor-2843 .elementor-element-c53cd58 .elementor-text-editor p {
            font-size: 14px !important;
            line-height: 1.65 !important;
            margin: 12px auto 16px !important;
        }
        .elementor-2843 .pp-logo-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 14px !important;
            margin-bottom: 8px !important;
        }
        .elementor-2843 .pp-logo-grid img {
            width: 82px !important;
            height: 82px !important;
        }
    }
</style>
@endpush

@section('content')
<div id="content" class="site-content">
    <div class="ast-container">
        <div id="primary" class="content-area primary">
            <main id="main" class="site-main">
                <article class="post-2843 page type-page status-publish ast-article-single" id="post-2843">
                    <header class="entry-header ast-header-without-markup"></header>

                    <div class="entry-content clear" itemprop="text">
                        <div data-elementor-type="wp-page" data-elementor-id="2843" class="elementor elementor-2843">
                            <div class="elementor-inner">
                                <div class="elementor-section-wrap">
                                    
                                    <!-- SECTION 1: Social Sustainability -->
                                    <section class="elementor-section elementor-top-section elementor-element elementor-element-668d7e47 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="668d7e47" data-element_type="section">
                                        <div class="elementor-container elementor-column-gap-default">
                                            <div class="elementor-row">
                                                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-540fca34" data-id="540fca34" data-element_type="column">
                                                    <div class="elementor-column-wrap elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            
                                                            <div class="elementor-element elementor-element-3e08dedf elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="3e08dedf" data-element_type="widget" data-widget_type="divider.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="elementor-divider">
                                                                        <span class="elementor-divider-separator"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="elementor-element elementor-element-4098d130 elementor-widget elementor-widget-heading" data-id="4098d130" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h1 class="elementor-heading-title elementor-size-large">Social Sustainability</h1>
                                                                </div>
                                                            </div>

                                                            <div class="elementor-element elementor-element-41ed20a3 elementor-widget elementor-widget-heading" data-id="41ed20a3" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h1 class="elementor-heading-title elementor-size-large">Maintain a healthy community</h1>
                                                                </div>
                                                            </div>

                                                            <div class="elementor-element elementor-element-5e6d3788 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="5e6d3788" data-element_type="widget" data-widget_type="divider.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="elementor-divider">
                                                                        <span class="elementor-divider-separator"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="elementor-element elementor-element-17673d4f elementor-widget elementor-widget-text-editor" data-id="17673d4f" data-element_type="widget" data-widget_type="text-editor.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="elementor-text-editor elementor-clearfix">
                                                                        <p>Social sustainability is the least defined and least understood of the different ways of approaching sustainability and sustainable development. Social sustainability has had considerably less attention in public dialogue than economic and environmental sustainability. There are several approaches to sustainability</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="elementor-element elementor-element-3f87cbe elementor-widget elementor-widget-image" data-id="3f87cbe" data-element_type="widget" data-widget_type="image.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="elementor-image">
                                                                        <img decoding="async" width="120" height="54" src="{{ asset('uploads/sustainability/social-sustainable-120x54.png') }}" class="attachment-shop_single size-shop_single" alt="Social Sustainable" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <!-- SECTION 2: Environmental Sustainability Heading & Dividers -->
                                    <section class="elementor-section elementor-top-section elementor-element elementor-element-441d5f3f elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="441d5f3f" data-element_type="section">
                                        <div class="elementor-container elementor-column-gap-default">
                                            <div class="elementor-row">
                                                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-48da15f7" data-id="48da15f7" data-element_type="column">
                                                    <div class="elementor-column-wrap elementor-element-populated">
                                                        <div class="elementor-widget-wrap">

                                                            <div class="elementor-element elementor-element-23698bb1 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="23698bb1" data-element_type="widget" data-widget_type="divider.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="elementor-divider">
                                                                        <span class="elementor-divider-separator"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="elementor-element elementor-element-3fdb3769 elementor-widget elementor-widget-heading" data-id="3fdb3769" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h1 class="elementor-heading-title elementor-size-large">Environmental Sustainability</h1>
                                                                </div>
                                                            </div>

                                                            <div class="elementor-element elementor-element-e37a7f elementor-widget elementor-widget-heading" data-id="e37a7f" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h1 class="elementor-heading-title elementor-size-large">Maintain the natural ability</h1>
                                                                </div>
                                                            </div>

                                                            <div class="elementor-element elementor-element-664d73b8 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="664d73b8" data-element_type="widget" data-widget_type="divider.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="elementor-divider">
                                                                        <span class="elementor-divider-separator"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <!-- SECTION 3: Hands Image & 7 Icons Grid -->
                                    <section class="elementor-section elementor-top-section elementor-element elementor-element-799ec4d5 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="799ec4d5" data-element_type="section">
                                        <div class="elementor-container elementor-column-gap-default">
                                            <div class="elementor-row">
                                                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-686069d8" data-id="686069d8" data-element_type="column">
                                                    <div class="elementor-column-wrap elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            
                                                            <section class="elementor-section elementor-inner-section elementor-element elementor-element-a74d06e elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="a74d06e" data-element_type="section">
                                                                <div class="elementor-container elementor-column-gap-default">
                                                                    <div class="elementor-row">
                                                                        
                                                                        <!-- Left column: Hands Holding City & Tree -->
                                                                        <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-e2c973" data-id="e2c973" data-element_type="column">
                                                                            <div class="elementor-column-wrap elementor-element-populated">
                                                                                <div class="elementor-widget-wrap">
                                                                                    <div class="elementor-element elementor-element-39c0ab08 elementor-widget elementor-widget-image" data-id="39c0ab08" data-element_type="widget" data-widget_type="image.default">
                                                                                        <div class="elementor-widget-container">
                                                                                            <div class="elementor-image">
                                                                                                <img fetchpriority="high" decoding="async" width="1000" height="707" src="{{ asset('uploads/sustainability/shutterstock_323393219.jpg') }}" class="attachment-large size-large" alt="Environmental Sustainability - SD International" />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Right column: Sustainability Description & Badges -->
                                                                        <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-102efcf6" data-id="102efcf6" data-element_type="column">
                                                                            <div class="elementor-column-wrap elementor-element-populated">
                                                                                <div class="elementor-widget-wrap">
                                                                                    
                                                                                    <div class="elementor-element elementor-element-c53cd58 elementor-widget elementor-widget-text-editor" data-id="c53cd58" data-element_type="widget" data-widget_type="text-editor.default">
                                                                                        <div class="elementor-widget-container">
                                                                                            <div class="elementor-text-editor elementor-clearfix">
                                                                                                <p>Social sustainability is the least defined and least understood of the different ways of approaching sustainability and sustainable development. Social sustainability has had considerably less attention in public dialogue than economic and environmental sustainability. There are several approaches to sustainability</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Row 1: 4 Icons -->
                                                                                    <div class="elementor-element elementor-element-b8bfcf1 elementor-grid-4 elementor-widget elementor-widget-pp-logo-grid" data-id="b8bfcf1" data-element_type="widget" data-widget_type="pp-logo-grid.default">
                                                                                        <div class="elementor-widget-container">
                                                                                            <div class="pp-logo-grid elementor-grid">
                                                                                                <div class="pp-grid-item-wrap elementor-grid-item elementor-repeater-item-577c8af">
                                                                                                    <div class="pp-grid-item">
                                                                                                        <img decoding="async" src="{{ asset('uploads/sustainability/green-and-sustainable-science-r7lgmmdrni4cpr83j20usxfvbylepwtn2f5030auhq.png') }}" alt="Green and Sustainable Science" />
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="pp-grid-item-wrap elementor-grid-item elementor-repeater-item-246befb">
                                                                                                    <div class="pp-grid-item">
                                                                                                        <img decoding="async" src="{{ asset('uploads/sustainability/icon-2-r7lgmwpzqoii9gt2uohr2ctxv76g2kyorubcd1vila.png') }}" alt="Eco Friendly Packaging" />
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="pp-grid-item-wrap elementor-grid-item elementor-repeater-item-50f8fc7">
                                                                                                    <div class="pp-grid-item">
                                                                                                        <img decoding="async" src="{{ asset('uploads/sustainability/icon-3-r7lgmfswbnvcghhnlh6gth3n69hu813ipiklq2klpa.png') }}" alt="Carbon Footprint Reduction" />
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="pp-grid-item-wrap elementor-grid-item elementor-repeater-item-a18b0e8">
                                                                                                    <div class="pp-grid-item">
                                                                                                        <img decoding="async" src="{{ asset('uploads/sustainability/icon-4-r7lgm1pbh5c1mc24vt32a2nq9hfc0kjjnksbix5iam.png') }}" alt="Renewable Clean Energy" />
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Row 2: 3 Icons -->
                                                                                    <div class="elementor-element elementor-element-2d3173fe elementor-grid-4 elementor-widget elementor-widget-pp-logo-grid" data-id="2d3173fe" data-element_type="widget" data-widget_type="pp-logo-grid.default">
                                                                                        <div class="elementor-widget-container">
                                                                                            <div class="pp-logo-grid elementor-grid">
                                                                                                <div class="pp-grid-item-wrap elementor-grid-item elementor-repeater-item-577c8af">
                                                                                                    <div class="pp-grid-item">
                                                                                                        <img decoding="async" src="{{ asset('uploads/sustainability/icon-5-r7lgmfswbnvcghhnlh6gth3n69hu813ipiklq2klpa.png') }}" alt="Water Conservation" />
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="pp-grid-item-wrap elementor-grid-item elementor-repeater-item-e414afc">
                                                                                                    <div class="pp-grid-item">
                                                                                                        <img decoding="async" src="{{ asset('uploads/sustainability/icon-6-r7lglrd3dyxw2mh5k6m60n9nq8uanwehy5lz8vku72.png') }}" alt="Recycling & Waste Reduction" />
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="pp-grid-item-wrap elementor-grid-item elementor-repeater-item-983db47">
                                                                                                    <div class="pp-grid-item">
                                                                                                        <img decoding="async" src="{{ asset('uploads/sustainability/Untitled-7-r7lgmfswbnvcghhnlh6gth3n69hu813ipiklq2klpa.png') }}" alt="Responsible Supply Chain" />
                                                                                                    </div>
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
@endsection

