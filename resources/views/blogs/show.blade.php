@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/live/post-13570.css') }}">
<style>
    /* Exact pixel-perfect single blog post styling matching SD International live site */
    .elementor-13570 {
        max-width: 1140px;
        margin: 0 auto;
        padding: 30px 20px 80px;
    }
    .elementor-13570 .elementor-element-f5efd57 {
        margin: 20px 0 25px;
    }
    .elementor-13570 .elementor-element-f5efd57 .elementor-heading-title {
        color: #870B28 !important;
        font-family: "Poppins", "Montserrat", sans-serif !important;
        font-size: 38px !important;
        font-weight: 600 !important;
        line-height: 1.3 !important;
        margin: 0 !important;
        text-align: left;
    }
    .elementor-13570 .elementor-element-3fe7c4b {
        margin-bottom: 35px;
        text-align: center;
    }
    .elementor-13570 .elementor-element-3fe7c4b img {
        width: 100% !important;
        max-width: 1000px !important;
        height: auto !important;
        display: block !important;
        margin: 0 auto !important;
        border-radius: 0 !important;
    }
    .elementor-13570 .elementor-element-b5b2aa4 {
        font-family: 'Open Sans', sans-serif !important;
        font-size: 15px !important;
        line-height: 1.85 !important;
        color: #333333 !important;
    }
    .elementor-13570 .elementor-element-b5b2aa4 p {
        font-family: 'Open Sans', sans-serif !important;
        font-size: 15px !important;
        line-height: 1.85 !important;
        color: #333333 !important;
        margin-bottom: 22px !important;
    }
    .elementor-13570 .elementor-element-b5b2aa4 h2 {
        font-family: "Poppins", "Montserrat", sans-serif !important;
        color: #870B28 !important;
        font-size: 26px !important;
        font-weight: 600 !important;
        line-height: 1.35 !important;
        margin-top: 35px !important;
        margin-bottom: 16px !important;
    }
    .elementor-13570 .elementor-element-b5b2aa4 h3 {
        font-family: "Poppins", "Montserrat", sans-serif !important;
        color: #870B28 !important;
        font-size: 20px !important;
        font-weight: 600 !important;
        line-height: 1.4 !important;
        margin-top: 28px !important;
        margin-bottom: 14px !important;
    }
    .elementor-13570 .elementor-element-b5b2aa4 ol,
    .elementor-13570 .elementor-element-b5b2aa4 ul {
        font-family: 'Open Sans', sans-serif !important;
        font-size: 15px !important;
        line-height: 1.8 !important;
        color: #333333 !important;
        margin: 0 0 22px 0 !important;
        padding-left: 28px !important;
    }
    .elementor-13570 .elementor-element-b5b2aa4 li {
        margin-bottom: 10px !important;
        line-height: 1.75 !important;
    }
    .elementor-13570 .elementor-element-b5b2aa4 a {
        color: #64141F !important;
        text-decoration: none !important;
        font-weight: 600 !important;
        transition: color 0.2s ease !important;
    }
    .elementor-13570 .elementor-element-b5b2aa4 a:hover {
        color: #000000 !important;
        text-decoration: underline !important;
    }
    .elementor-13570 .elementor-element-b5b2aa4 b,
    .elementor-13570 .elementor-element-b5b2aa4 strong {
        font-weight: 600 !important;
        color: #111111 !important;
    }

    @media (max-width: 768px) {
        .elementor-13570 .elementor-element-f5efd57 .elementor-heading-title {
            font-size: 28px !important;
        }
        .elementor-13570 .elementor-element-b5b2aa4 h2 {
            font-size: 22px !important;
        }
        .elementor-13570 {
            padding: 20px 15px 50px;
        }
    }
</style>
@endpush

@section('content')
<div id="content" class="site-content">
    <div class="ast-container">
        <div data-elementor-type="single-post" data-elementor-id="13570" class="elementor elementor-13570 elementor-location-single ast-article-single">
            <div class="elementor-section-wrap">

                <!-- 1. Post Title Section -->
                <section class="elementor-section elementor-top-section elementor-element elementor-element-f24a696 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="f24a696" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-bd2fbd6" data-id="bd2fbd6" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-f5efd57 elementor-widget elementor-widget-theme-post-title elementor-page-title elementor-widget-heading" data-id="f5efd57" data-element_type="widget" data-widget_type="theme-post-title.default">
                                            <div class="elementor-widget-container">
                                                <h1 class="elementor-heading-title elementor-size-default">{{ $post->title }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- 2. Featured Image Section -->
                @if($post->image_url)
                <section class="elementor-section elementor-top-section elementor-element elementor-element-1e6796c elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="1e6796c" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-79b70ec" data-id="79b70ec" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-3fe7c4b elementor-widget elementor-widget-theme-post-featured-image elementor-widget-image" data-id="3fe7c4b" data-element_type="widget" data-widget_type="theme-post-featured-image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image">
                                                    <img width="1000" height="668" src="{{ asset($post->image_url) }}" class="attachment-large size-large" alt="{{ $post->title }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @endif

                <!-- 3. Post Content Section -->
                <section class="elementor-section elementor-top-section elementor-element elementor-element-69e4f13 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="69e4f13" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fd2440b" data-id="fd2440b" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-b5b2aa4 elementor-widget elementor-widget-theme-post-content" data-id="b5b2aa4" data-element_type="widget" data-widget_type="theme-post-content.default">
                                            <div class="elementor-widget-container">
                                                {!! $post->content !!}
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
@endsection
