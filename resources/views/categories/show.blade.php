@extends('layouts.app')

@section('content')
<style>
    .cat-page-header {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 40px 0;
        margin-bottom: 35px;
    }
    .cat-page-header h1 {
        font-size: 32px;
        color: var(--primary-dark);
        margin-bottom: 12px;
        font-weight: 700;
    }
    .cat-page-header p {
        color: #475569;
        font-size: 15px;
        max-width: 900px;
        line-height: 1.65;
    }
    .catalog-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 35px;
        padding: 0 0 80px;
    }
    .catalog-sidebar {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    .sidebar-widget {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 22px;
    }
    .widget-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--primary-accent);
    }
    .cat-menu-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .cat-menu-item a {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 12px;
        border-radius: 6px;
        color: #334155;
        font-size: 13.5px;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .cat-menu-item a:hover {
        background: #f1f5f9;
        color: var(--primary);
    }
    .cat-menu-item.active a {
        background: var(--cream-bg);
        color: var(--primary-accent);
        font-weight: 700;
        border-left: 3px solid var(--primary-accent);
    }
    .sidebar-contact-card {
        background: var(--gold-gradient);
        color: white;
        border-radius: 8px;
        padding: 24px;
        text-align: center;
    }
    .sidebar-contact-card h4 {
        color: white;
        font-size: 16px;
        margin-bottom: 8px;
    }
    .sidebar-contact-card p {
        font-size: 13px;
        color: #f8fafc;
        margin-bottom: 18px;
        line-height: 1.5;
    }
    .sidebar-contact-card .btn-submit {
        width: 100%;
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 10px;
        border-radius: 6px;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .sidebar-contact-card .btn-submit:hover {
        background: var(--btn-hover);
    }
    .catalog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 22px;
    }
    .product-catalog-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all 0.25s ease;
    }
    .product-catalog-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.06);
        border-color: #cbd5e1;
    }
    .prod-thumb {
        height: 180px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
        border-bottom: 1px solid #f1f5f9;
        text-decoration: none;
    }
    .prod-thumb img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    .prod-info {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .prod-name {
        font-size: 14.5px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
        line-height: 1.35;
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .prod-name:hover {
        color: var(--primary);
    }
    .prod-cas-tag {
        font-size: 12px;
        color: #64748b;
        font-family: monospace;
        margin-bottom: 12px;
    }
    .prod-card-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #f1f5f9;
    }
    .btn-card-quote {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 6px 14px;
        border-radius: 4px;
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .btn-card-quote:hover {
        background: var(--btn-hover);
    }
    .pagination-wrap {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }
    @media (max-width: 900px) {
        .catalog-layout {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="cat-page-header">
    <div class="container">
        <h1>{{ $category->name }}</h1>
        @if($category->description)
            <p>{!! nl2br(e(strip_tags($category->description))) !!}</p>
        @else
            <p>
                Browse high-performance {{ $category->name }} manufactured and exported by SD International. Tested to strict ISO 9001:2015 quality standards with ready inventory for international air and sea freight shipments.
            </p>
        @endif
    </div>
</div>

<div class="container">
    <div class="catalog-layout">
        <!-- Sidebar Filter -->
        <aside class="catalog-sidebar">
            <div class="sidebar-widget">
                <h3 class="widget-title">Categories</h3>
                <ul class="cat-menu-list">
                    @foreach($allCategories as $cat)
                        <li class="cat-menu-item {{ $category->id === $cat->id ? 'active' : '' }}">
                            <a href="{{ url('/' . $cat->slug) }}">
                                <span>{{ $cat->name }}</span>
                                <span style="font-size: 12px; color: #64748b;">({{ $cat->products_count ?? $cat->products()->count() }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="sidebar-contact-card">
                <h4>Inquire for {{ $category->name }}</h4>
                <p style="font-size: 13.5px; color: #4b5563; margin-bottom: 14px;">
                    Contact our sales division for CIF/FOB pricing & COA.
                </p>
                <button type="button" class="btn-submit" onclick="openQuoteModal('{{ addslashes($category->name) }}')">Get Category Quote</button>
            </div>
        </aside>

        <!-- Main Product Grid -->
        <main class="catalog-main">
            @if($products->isEmpty())
                <div style="background: #f8fafc; padding: 40px; text-align: center; border-radius: 8px;">
                    <h3>No products currently listed in this category</h3>
                    <p style="color: #64748b; margin: 10px 0 20px;">We manufacture custom batches for {{ $category->name }}. Contact us directly.</p>
                    <button type="button" class="btn-enquire" onclick="openQuoteModal('{{ addslashes($category->name) }}')">Inquire Custom Batch</button>
                </div>
            @else
                <div class="catalog-grid">
                    @foreach($products as $prod)
                    <div class="product-catalog-card">
                        <a href="{{ url('/' . $prod->slug) }}" class="prod-thumb">
                            @if($prod->image_url)
                                <img src="{{ $prod->image_url }}" alt="{{ $prod->title }}" loading="lazy">
                            @else
                                <img src="https://sdinternational.com/wp-content/uploads/2020/07/logo.png" alt="{{ $prod->title }}" style="max-height: 40px; opacity: 0.6;">
                            @endif
                        </a>
                        <div class="prod-info">
                            <div>
                                <a href="{{ url('/' . $prod->slug) }}" class="prod-name">{{ $prod->title }}</a>
                                @if($prod->cas_number)
                                    <div class="prod-cas-tag">CAS: {{ $prod->cas_number }}</div>
                                @endif
                            </div>
                            <div class="prod-card-actions">
                                <a href="{{ url('/' . $prod->slug) }}" style="font-size: 13px; font-weight: 600;">Details →</a>
                                <button type="button" class="btn-card-quote" onclick="openQuoteModal('{{ addslashes($prod->title) }}', '{{ $prod->slug }}')">Get Quote</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="pagination-wrap">
                    {{ $products->links() }}
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
