@extends('layouts.app')

@section('content')
<style>
    .product-page-layout {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 40px;
        padding: 40px 0 80px;
    }
    .product-hero-grid {
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 35px;
        margin-bottom: 40px;
    }
    .product-main-image-wrap {
        background: #f8fafc;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 380px;
        position: relative;
    }
    .product-main-image-wrap img {
        max-width: 100%;
        max-height: 340px;
        object-fit: contain;
        border-radius: 4px;
    }
    .product-meta-header h1 {
        font-size: 26px;
        color: var(--primary-dark);
        margin-bottom: 6px;
        line-height: 1.3;
    }
    .product-subtitle {
        color: var(--primary-accent);
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 16px;
        display: block;
    }
    .product-short-desc {
        font-size: 14.5px;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 24px;
    }
    .key-specs-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 25px;
    }
    .spec-badge {
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 6px 12px;
        font-size: 13px;
        color: #334155;
    }
    .spec-badge strong {
        color: #0f172a;
    }
    .product-action-buttons {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin-top: 20px;
    }
    .btn-quote-large {
        background: var(--primary-gradient);
        color: white !important;
        font-family: var(--font-heading);
        font-weight: 700;
        padding: 13px 28px;
        border-radius: 4px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 15px rgba(100,20,31,0.25);
    }
    .btn-quote-large:hover {
        background: var(--btn-hover);
        box-shadow: 0 6px 18px rgba(0,0,0,0.25);
    }
    .btn-whatsapp-large {
        background: #25d366;
        color: white !important;
        font-family: var(--font-heading);
        font-weight: 700;
        padding: 13px 24px;
        border-radius: 4px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-whatsapp-large:hover {
        background: #1ebe5d;
    }

    /* Specifications Table */
    .specs-section {
        margin-top: 40px;
        background: white;
    }
    .section-tab-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 18px;
        border-bottom: 2px solid var(--primary-accent);
        padding-bottom: 8px;
        display: inline-block;
    }
    .specs-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
        font-size: 14px;
    }
    .specs-table th, .specs-table td {
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
    }
    .specs-table th {
        background: var(--cream-bg);
        width: 32%;
        font-weight: 700;
        color: var(--primary-dark);
        text-align: left;
    }
    .specs-table td {
        color: #1e293b;
    }
    .specs-table tr:nth-child(even) td {
        background: #fafafa;
    }

    /* Product Content / Synonyms */
    .product-long-content {
        background: #ffffff;
        font-size: 14.5px;
        line-height: 1.7;
        color: #334155;
        margin-bottom: 40px;
    }
    .product-long-content h2, .product-long-content h3 {
        margin: 20px 0 10px;
        color: #0f172a;
    }
    .product-long-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
    }
    .product-long-content th, .product-long-content td {
        border: 1px solid #e2e8f0;
        padding: 8px 12px;
    }

    /* Sidebar */
    .sidebar-widget {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 24px;
        margin-bottom: 25px;
    }
    .widget-title {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 15px;
        border-bottom: 2px solid var(--primary);
        padding-bottom: 8px;
    }
    .cat-menu-list {
        list-style: none;
        max-height: 480px;
        overflow-y: auto;
    }
    .cat-menu-item a {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        color: #475569;
        font-size: 13.5px;
        border-bottom: 1px dashed #f1f5f9;
    }
    .cat-menu-item a:hover {
        color: var(--primary);
        padding-left: 4px;
    }
    .sidebar-contact-card {
        background: #fdf2f3;
        border: 1px solid #fecdd3;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
    }
    .sidebar-contact-card h4 {
        color: var(--primary);
        font-size: 16px;
        margin-bottom: 8px;
    }

    /* Related Products */
    .related-section {
        margin-top: 50px;
        border-top: 1px solid #e2e8f0;
        padding-top: 40px;
    }
    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }
    .related-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        overflow: hidden;
        padding: 12px;
        text-align: center;
    }
    .related-card img {
        height: 120px;
        width: 100%;
        object-fit: contain;
        margin-bottom: 8px;
    }
    .related-card a {
        font-size: 13.5px;
        font-weight: 600;
        color: #1e293b;
        display: block;
        margin-bottom: 6px;
    }

    @media (max-width: 991px) {
        .product-page-layout {
            grid-template-columns: 1fr;
        }
        .product-hero-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container">
    <div class="product-page-layout">
        <!-- Main Product Content Area -->
        <div class="product-main-col">
            <!-- Hero Grid -->
            <div class="product-hero-grid">
                <div class="product-main-image-wrap">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->title }} chemical structure and dye sample">
                    @else
                        <img src="https://sdinternational.com/wp-content/uploads/2020/07/logo.png" alt="{{ $product->title }}" style="max-height: 80px; opacity: 0.7;">
                    @endif
                </div>

                <div class="product-meta-header">
                    <h1>{{ $product->title }}</h1>
                    @if($product->cas_number)
                        <span class="product-subtitle">CAS Registry Number: {{ $product->cas_number }}</span>
                    @endif

                    <div class="key-specs-badges">
                        @if($product->ci_number)
                            <div class="spec-badge">C.I. Number: <strong>{{ $product->ci_number }}</strong></div>
                        @endif
                        @if($product->relative_name)
                            <div class="spec-badge">Relative Name: <strong>{{ $product->relative_name }}</strong></div>
                        @endif
                        @if($product->molecular_weight)
                            <div class="spec-badge">Mol Weight: <strong>{{ $product->molecular_weight }}</strong></div>
                        @endif
                        @if($product->physical_appearance)
                            <div class="spec-badge">Appearance: <strong>{{ $product->physical_appearance }}</strong></div>
                        @endif
                    </div>

                    <div class="product-short-desc">
                        @if($product->short_description)
                            <p>{{ $product->short_description }}</p>
                        @else
                            <p>
                                Buy high purity {{ $product->title }} from SD International — leading manufacturer, supplier, and global exporter of industrial dyes and pigments in Mumbai, India. Well known for superior purity and international quality compliance.
                            </p>
                        @endif
                    </div>

                    <div class="product-action-buttons">
                        <button type="button" class="btn-quote-large" onclick="openQuoteModal('{{ addslashes($product->title) }}', '{{ $product->slug }}')">
                            Quick Quote
                        </button>
                        <a href="{{ route('quote.request', ['product' => $product->slug, 'cas' => $product->cas_number]) }}" class="btn-quote-large" style="background: #0f172a; text-decoration: none; text-align: center;">
                            🧪 Request Sample / TDS
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=919920669561&text=Hello%20SD%20International,%20I%20need%20price%20and%20COA%20for%20{{ urlencode($product->title) }}%20(CAS%20{{ $product->cas_number }})" class="btn-whatsapp-large" target="_blank" rel="noopener noreferrer">
                            💬 WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Technical Specifications Table -->
            <div class="specs-section">
                <h2 class="section-tab-title">Technical Specifications</h2>
                <table class="specs-table">
                    <tbody>
                        <tr>
                            <th>Brand</th>
                            <td>{{ $product->brand ?: 'S D International' }}</td>
                        </tr>
                        @if($product->categories->isNotEmpty())
                        <tr>
                            <th>Category</th>
                            <td>
                                @foreach($product->categories as $c)
                                    <a href="{{ url('/' . $c->slug) }}">{{ $c->name }}</a>{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </td>
                        </tr>
                        @endif
                        @if($product->title)
                        <tr>
                            <th>Product Name</th>
                            <td>{{ $product->title }}</td>
                        </tr>
                        @endif
                        @if($product->cas_number)
                        <tr>
                            <th>CAS Registry Number</th>
                            <td><strong>{{ $product->cas_number }}</strong></td>
                        </tr>
                        @endif
                        @if($product->ci_number)
                        <tr>
                            <th>C.I. Number</th>
                            <td>{{ $product->ci_number }}</td>
                        </tr>
                        @endif
                        @if($product->relative_name)
                        <tr>
                            <th>Relative Name / Synonyms</th>
                            <td>{{ $product->relative_name }}</td>
                        </tr>
                        @endif
                        @if($product->molecular_formula)
                        <tr>
                            <th>Molecular Formula</th>
                            <td>{{ $product->molecular_formula }}</td>
                        </tr>
                        @endif
                        @if($product->molecular_weight)
                        <tr>
                            <th>Molecular Weight</th>
                            <td>{{ $product->molecular_weight }} g/mol</td>
                        </tr>
                        @endif
                        @if($product->physical_appearance)
                        <tr>
                            <th>Physical Appearance</th>
                            <td>{{ $product->physical_appearance }}</td>
                        </tr>
                        @endif
                        @if($product->packaging)
                        <tr>
                            <th>Packaging</th>
                            <td>{{ $product->packaging }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Country of Origin</th>
                            <td>India (Export Worldwide)</td>
                        </tr>
                        <tr>
                            <th>Quality Standard</th>
                            <td>ISO 9001:2015 Certified Lab Tested</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Detailed Chemical Overview & Synonyms Content -->
            @if($product->content)
            <div class="product-long-content">
                <h2 class="section-tab-title">Product Details & Synonyms</h2>
                {!! $product->content !!}
            </div>
            @endif

            <!-- Packaging & Payment Information (Replicating SD International Standard Terms) -->
            <div class="specs-section">
                <h2 class="section-tab-title">Packaging & Shipment Details</h2>
                <table class="specs-table">
                    <tbody>
                        <tr>
                            <th>Packaging Types</th>
                            <td>HDPE Bags, Kraft Paper Bags, Jumbo Bags, Corrugated Boxes, Fiber Drums, HDPE Drums, IBC Tanks (25kg / 50kg / Customized).</td>
                        </tr>
                        <tr>
                            <th>Payment Terms</th>
                            <td>T/T (Bank Wire), L/C at sight, Advance TT, Cash Against Documents.</td>
                        </tr>
                        <tr>
                            <th>Delivery Time</th>
                            <td>Ready stock: 2-5 days dispatch. Customized orders: 10-15 working days.</td>
                        </tr>
                        <tr>
                            <th>Shipping Ports</th>
                            <td>Nhava Sheva (JNPT) Mumbai / Mundra / Air Cargo Mumbai.</td>
                        </tr>
                        <tr>
                            <th>GST Registration</th>
                            <td>27AATPM4523B1ZQ</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->isNotEmpty())
            <div class="related-section">
                <h2 class="section-tab-title">Related Chemical Products</h2>
                <div class="related-grid">
                    @foreach($relatedProducts as $rel)
                    <div class="related-card">
                        <a href="{{ url('/' . $rel->slug) }}">
                            @if($rel->image_url)
                                <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" loading="lazy">
                            @else
                                <img src="https://sdinternational.com/wp-content/uploads/2020/07/logo.png" alt="{{ $rel->title }}" style="max-height: 40px; opacity: 0.6;">
                            @endif
                            {{ $rel->title }}
                        </a>
                        @if($rel->cas_number)
                            <div style="font-size: 11.5px; color: #64748b;">CAS: {{ $rel->cas_number }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <aside class="product-sidebar">
            <!-- Search Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Search Catalog</h3>
                <form action="{{ url('/products') }}" method="GET">
                    <input type="text" name="q" class="form-control" placeholder="Search product or CAS..." style="margin-bottom: 10px;">
                    <button type="submit" class="btn-submit">Search</button>
                </form>
            </div>

            <!-- Categories Accordion Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Product Categories</h3>
                <ul class="cat-menu-list">
                    @foreach($allCategories as $cat)
                        <li class="cat-menu-item">
                            <a href="{{ url('/' . $cat->slug) }}">
                                <span>{{ $cat->name }}</span>
                                <span style="color: #94a3b8; font-size: 11px;">→</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Fast Contact Card -->
            <div class="sidebar-contact-card">
                <h4>Need Custom Specs or Bulk COA?</h4>
                <p style="font-size: 13.5px; color: #4b5563; margin-bottom: 15px;">
                    Speak directly with our technical sales division in Mumbai.
                </p>
                <a href="tel:+919920669561" style="font-weight: 700; color: var(--primary); font-size: 15px; display: block; margin-bottom: 12px;">
                    📞 +91 99206 69561
                </a>
                <button type="button" class="btn-quote-large" style="width: 100%;" onclick="openQuoteModal('{{ addslashes($product->title) }}', '{{ $product->slug }}')">
                    Request Quotation
                </button>
            </div>
        </aside>
    </div>
</div>
@endsection
