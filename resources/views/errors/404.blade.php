@extends('layouts.app')

@section('content')
<style>
    .error-page-wrap {
        padding: 90px 20px 110px;
        text-align: center;
        background: #fdfefe;
    }
    .error-code {
        font-size: 110px;
        font-weight: 900;
        line-height: 1;
        color: var(--primary, #64141f);
        letter-spacing: -2px;
        margin-bottom: 12px;
        opacity: 0.95;
    }
    .error-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 15px;
    }
    .error-desc {
        max-width: 580px;
        margin: 0 auto 35px;
        color: #64748b;
        font-size: 16px;
        line-height: 1.6;
    }
    .error-search-box {
        max-width: 520px;
        margin: 0 auto 45px;
        display: flex;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #cbd5e1;
    }
    .error-search-input {
        flex: 1;
        padding: 14px 20px;
        font-size: 15px;
        border: none;
        outline: none;
    }
    .error-search-btn {
        background: var(--primary, #64141f);
        color: white;
        border: none;
        padding: 0 28px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .error-search-btn:hover {
        background: #4a0d15;
    }
    .popular-categories {
        max-width: 820px;
        margin: 0 auto 50px;
    }
    .popular-cat-title {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #94a3b8;
        font-weight: 700;
        margin-bottom: 18px;
    }
    .cat-chips-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }
    .cat-chip {
        display: inline-block;
        padding: 9px 18px;
        background: #f1f5f9;
        color: #334155;
        border-radius: 30px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        border: 1px solid #e2e8f0;
    }
    .cat-chip:hover {
        background: var(--primary, #64141f);
        color: #ffffff;
        border-color: var(--primary, #64141f);
        transform: translateY(-2px);
    }
    .error-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .btn-error-primary {
        background: var(--primary, #64141f);
        color: #ffffff;
        padding: 13px 28px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-error-primary:hover {
        background: #4a0d15;
        color: #fff;
    }
    .btn-error-outline {
        background: transparent;
        color: #334155;
        border: 1px solid #cbd5e1;
        padding: 13px 28px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-error-outline:hover {
        background: #f8fafc;
        border-color: #94a3b8;
    }
</style>

<div class="error-page-wrap">
    <div class="container">
        <div class="error-code">404</div>
        <h1 class="error-title">Page or Chemical Product Not Found</h1>
        <p class="error-desc">
            The page or product you are looking for may have been relocated, renamed, or is temporarily unavailable. Try searching our complete industrial dyes catalog below or explore our primary product groups.
        </p>

        <!-- Search Bar -->
        <form action="{{ route('products.index') }}" method="GET" class="error-search-box">
            <input type="text" name="s" class="error-search-input" placeholder="Search by Product Name, CAS No., or C.I. Number..." required>
            <button type="submit" class="error-search-btn">Search Catalog</button>
        </form>

        <!-- Popular Categories Quick Links -->
        <div class="popular-categories">
            <div class="popular-cat-title">Explore Core Chemical Categories</div>
            <div class="cat-chips-grid">
                <a href="{{ url('/vat-dyes') }}" class="cat-chip">Vat Dyes</a>
                <a href="{{ url('/solvent-dyes') }}" class="cat-chip">Solvent Dyes</a>
                <a href="{{ url('/reactive-dyes') }}" class="cat-chip">Reactive Dyes</a>
                <a href="{{ url('/acid-dyes') }}" class="cat-chip">Acid Dyes</a>
                <a href="{{ url('/basic-dyes') }}" class="cat-chip">Basic Dyes</a>
                <a href="{{ url('/direct-dyes') }}" class="cat-chip">Direct Dyes</a>
                <a href="{{ url('/pigments') }}" class="cat-chip">Organic Pigments</a>
                <a href="{{ url('/food-colours') }}" class="cat-chip">Food Colours</a>
                <a href="{{ url('/naphthols') }}" class="cat-chip">Naphthols</a>
                <a href="{{ url('/fast-bases') }}" class="cat-chip">Fast Bases</a>
            </div>
        </div>

        <div class="error-actions">
            <a href="{{ url('/') }}" class="btn-error-primary">← Back to Homepage</a>
            <a href="{{ route('products.index') }}" class="btn-error-outline">Browse All Products</a>
            <a href="{{ route('contact') }}" class="btn-error-outline">Contact Sales Team</a>
        </div>
    </div>
</div>
@endsection

