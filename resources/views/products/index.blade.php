@extends('layouts.app')

@section('content')
<style>
    .catalog-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 35px;
        padding: 40px 0 80px;
    }
    .catalog-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e2e8f0;
    }
    .catalog-header h1 {
        font-size: 26px;
        color: #0f172a;
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
    .pagination-wrap {
        margin-top: 40px;
        display: flex;
        justify-content: center;
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
        color: var(--primary-dark, #6A0015);
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--primary-accent, #820024);
    }
    .cat-menu-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 6px;
        max-height: 520px;
        overflow-y: auto;
    }
    .cat-menu-item a {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 7px 10px;
        border-radius: 6px;
        color: #334155;
        font-size: 13.5px;
        text-decoration: none;
        transition: all 0.15s;
    }
    .cat-menu-item a:hover {
        background: #f1f5f9;
        color: var(--primary, #64141f);
        padding-left: 14px;
    }
    .sidebar-contact-card {
        background: var(--gold-gradient, linear-gradient(180deg, #C49F6A 0%, #966F37 100%));
        color: white;
        border-radius: 8px;
        padding: 24px;
        text-align: center;
    }
    .sidebar-contact-card h4 {
        color: white;
        font-size: 16px;
        margin-bottom: 8px;
        font-weight: 700;
    }
    .sidebar-contact-card p {
        font-size: 13px;
        color: #f8fafc;
        margin-bottom: 18px;
        line-height: 1.5;
    }
    .sidebar-contact-card .btn-submit {
        width: 100%;
        background: var(--primary-gradient, linear-gradient(180deg, #951634 0%, #73001B 100%));
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
        background: var(--btn-hover, #3a3a3a);
    }
    @media (max-width: 900px) {
        .catalog-layout {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container">
    <div class="catalog-layout">
        <!-- Sidebar Filter -->
        <aside class="catalog-sidebar">
            <div class="sidebar-widget">
                <h3 class="widget-title">Filter by Category</h3>
                <ul class="cat-menu-list">
                    <li class="cat-menu-item">
                        <a href="{{ url('/products') }}" style="{{ !request('category') ? 'font-weight: 700; color: var(--primary);' : '' }}">
                            <span>All Products</span>
                            <span>({{ \App\Models\Product::count() }})</span>
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li class="cat-menu-item">
                            <a href="{{ url('/products?category=' . $cat->slug) }}" style="{{ request('category') == $cat->slug ? 'font-weight: 700; color: var(--primary);' : '' }}">
                                <span>{{ $cat->name }}</span>
                                <span style="font-size: 12px; color: #64748b;">({{ $cat->products_count ?? $cat->products()->count() }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="sidebar-contact-card">
                <h4>Custom Formulation?</h4>
                <p style="font-size: 13.5px; color: #4b5563; margin-bottom: 14px;">
                    We manufacture custom shades and concentrations.
                </p>
                <button type="button" class="btn-submit" onclick="openQuoteModal()">Inquire Custom Batch</button>
            </div>
        </aside>

        <!-- Main Product Grid -->
        <main class="catalog-main">
            <div class="catalog-header">
                <div>
                    <h1>Chemical Products Catalog</h1>
                    <p style="color: #64748b; font-size: 14px; margin-top: 4px;">
                        Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} chemical items
                    </p>
                </div>

                <!-- Search form -->
                <form action="{{ url('/products') }}" method="GET" style="display: flex; gap: 8px;">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search product or CAS..." style="width: 220px;">
                    <button type="submit" class="btn-submit" style="width: auto; padding: 0 16px;">Filter</button>
                </form>
            </div>

            @if($products->isEmpty())
                <div style="background: #f8fafc; padding: 40px; text-align: center; border-radius: 8px;">
                    <h3>No products found matching your criteria</h3>
                    <p style="color: #64748b; margin: 10px 0 20px;">Try searching with different keywords or clearing your filter.</p>
                    <a href="{{ url('/products') }}" class="btn-enquire">Reset Catalog</a>
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
