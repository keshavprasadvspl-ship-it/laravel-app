@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/live/post-13522.css') }}">
<style>
    /* Exact pixel-perfect blog archive styling matching SD International live site */
    .elementor-13522 .elementor-element.elementor-element-fc02641 .elementor-posts-container .elementor-post__thumbnail {
        padding-bottom: calc(1.11 * 100%);
        position: relative;
        overflow: hidden;
    }
    .elementor-13522 .elementor-element.elementor-element-fc02641 .elementor-posts-container .elementor-post__thumbnail img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .elementor-13522 .elementor-post__card {
        background: #ffffff;
        border-radius: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease;
    }
    .elementor-13522 .elementor-post__card:hover {
        box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.15);
    }
    .elementor-13522 .elementor-post__text {
        padding: 0 30px;
        margin-top: 46px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .elementor-13522 .elementor-post__title {
        font-family: 'Montserrat', sans-serif !important;
        font-size: 21px !important;
        font-weight: 700 !important;
        line-height: 1.35 !important;
        margin: 0 0 25px 0 !important;
    }
    .elementor-13522 .elementor-post__title a {
        color: #000000 !important;
        text-decoration: none !important;
        transition: color 0.2s ease;
    }
    .elementor-13522 .elementor-post__title a:hover {
        color: #64141f !important;
    }
    .elementor-13522 .elementor-post__excerpt {
        font-family: 'Open Sans', sans-serif;
        font-size: 14px;
        color: #7a7a7a;
        line-height: 1.6;
        margin-bottom: 25px;
        flex-grow: 1;
    }
    .elementor-13522 .elementor-post__excerpt p {
        margin: 0;
        color: #7a7a7a;
        font-size: 14px;
        line-height: 1.6;
    }
    .elementor-13522 .elementor-post__read-more {
        font-family: 'Open Sans', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: #64141f !important;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 25px;
        transition: color 0.2s ease;
    }
    .elementor-13522 .elementor-post__read-more:hover {
        color: #000000 !important;
    }
    .elementor-13522 .elementor-post__meta-data {
        border-top: 1px solid #eaeaea;
        padding: 15px 30px;
        font-family: 'Open Sans', sans-serif;
        font-size: 12px;
        color: #adadad;
    }
    .elementor-13522 .elementor-post__meta-data span {
        color: #adadad;
    }
    .elementor-13522 .elementor-post__meta-data span + span:before {
        content: "•";
        margin: 0 8px;
    }
    .elementor-13522 .elementor-pagination {
        text-align: center;
        margin-top: 40px;
        margin-bottom: 20px;
    }
    .elementor-13522 .elementor-pagination .page-numbers {
        display: inline-block;
        font-family: 'Open Sans', sans-serif;
        font-size: 15px;
        color: #7a7a7a;
        text-decoration: none;
        padding: 4px 8px;
        margin: 0 4px;
        transition: color 0.2s ease;
    }
    .elementor-13522 .elementor-pagination .page-numbers.current,
    .elementor-13522 .elementor-pagination .page-numbers:hover {
        color: #000000;
        font-weight: 700;
    }
    .elementor-screen-only {
        position: absolute;
        top: -10000em;
        width: 1px;
        height: 1px;
        margin: -1px;
        padding: 0;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }
</style>
@endpush

@section('content')
<div id="content" class="site-content">
    <div class="ast-container">
        <div data-elementor-type="archive" data-elementor-id="13522" class="elementor elementor-13522 elementor-location-archive">
            <div class="elementor-section-wrap">
                <section class="elementor-section elementor-top-section elementor-element elementor-element-425c4d7 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="425c4d7" data-element_type="section" data-settings='{"ekit_has_onepagescroll_dot":"yes"}'>
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-b5e1a1b" data-id="b5e1a1b" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-fc02641 elementor-grid-3 elementor-grid-tablet-2 elementor-grid-mobile-1 elementor-posts--thumbnail-top elementor-card-shadow-yes elementor-posts__hover-gradient elementor-widget elementor-widget-archive-posts" data-id="fc02641" data-element_type="widget" data-settings='{"archive_cards_columns":"3","archive_cards_columns_tablet":"2","archive_cards_columns_mobile":"1","archive_cards_row_gap":{"unit":"px","size":35,"sizes":[]},"ekit_we_effect_on":"none"}' data-widget_type="archive-posts.archive_cards">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-posts-container elementor-posts elementor-posts--skin-cards elementor-grid elementor-has-item-ratio">
                                                    @foreach($posts as $post)
                                                    <article class="elementor-post elementor-grid-item post-{{ $post->id }} post type-post status-publish format-standard has-post-thumbnail hentry category-blogs">
                                                        <div class="elementor-post__card">
                                                            <a class="elementor-post__thumbnail__link" href="{{ url('/blogs/' . $post->slug) }}" target="_blank">
                                                                <div class="elementor-post__thumbnail">
                                                                    <img width="150" height="150" src="{{ asset($post->image_url) }}" class="attachment-thumbnail size-thumbnail" alt="{{ $post->title }}" decoding="async" loading="lazy" />
                                                                </div>
                                                            </a>
                                                            <div class="elementor-post__text">
                                                                <h1 class="elementor-post__title">
                                                                    <a href="{{ url('/blogs/' . $post->slug) }}" target="_blank">
                                                                        {{ $post->title }}
                                                                    </a>
                                                                </h1>
                                                                <div class="elementor-post__excerpt">
                                                                    <p>{{ $post->excerpt }}</p>
                                                                </div>
                                                                <a class="elementor-post__read-more" href="{{ url('/blogs/' . $post->slug) }}" target="_blank">
                                                                    Read More »
                                                                </a>
                                                            </div>
                                                            <div class="elementor-post__meta-data">
                                                                <span class="elementor-post-date">
                                                                    {{ $post->created_at ? $post->created_at->format('F d, Y') : 'October 27, 2026' }}
                                                                </span>
                                                                <span class="elementor-post-avatar">
                                                                    No Comments
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </article>
                                                    @endforeach
                                                </div>

                                                <nav class="elementor-pagination" role="navigation" aria-label="Pagination">
                                                    @if ($posts->currentPage() > 1)
                                                        <a class="page-numbers prev" href="{{ url('/blogs/page/' . ($posts->currentPage() - 1)) }}">&laquo;</a>
                                                    @endif

                                                    @for ($i = 1; $i <= min(5, $posts->lastPage()); $i++)
                                                        @if ($i == $posts->currentPage())
                                                            <span aria-current="page" class="page-numbers current"><span class="elementor-screen-only">Page</span>{{ $i }}</span>
                                                        @else
                                                            <a class="page-numbers" href="{{ url('/blogs/page/' . $i) }}"><span class="elementor-screen-only">Page</span>{{ $i }}</a>
                                                        @endif
                                                    @endfor

                                                    @if ($posts->hasMorePages() && $posts->currentPage() > 1)
                                                        <a class="page-numbers next" href="{{ url('/blogs/page/' . ($posts->currentPage() + 1)) }}">&raquo;</a>
                                                    @endif
                                                </nav>
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
    </div> <!-- ast-container -->
</div><!-- #content -->
@endsection
