@extends('layouts.app')

@section('content')
<style>
    .app-hero {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: white;
        padding: 55px 0 50px;
    }
    .app-hero h1 {
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 12px;
        color: #ffffff;
    }
    .app-hero p {
        font-size: 16px;
        color: #94a3b8;
        max-width: 720px;
        line-height: 1.6;
    }
    .app-section {
        padding: 60px 0 80px;
    }
    .app-intro-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 45px;
        line-height: 1.7;
        color: #334155;
    }
    .app-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 30px;
    }
    .industry-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: transform 0.25s, box-shadow 0.25s;
        display: flex;
        flex-direction: column;
    }
    .industry-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.07);
        border-color: #cbd5e1;
    }
    .industry-header {
        background: #f1f5f9;
        padding: 22px 24px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .industry-icon {
        font-size: 30px;
        background: #ffffff;
        width: 52px;
        height: 52px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        flex-shrink: 0;
    }
    .industry-header h3 {
        font-size: 19px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.3;
    }
    .industry-body {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .industry-desc {
        color: #475569;
        font-size: 14.5px;
        line-height: 1.6;
        margin-bottom: 18px;
    }
    .recommended-classes {
        margin-bottom: 20px;
    }
    .recommended-classes-label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 8px;
    }
    .classes-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .class-tag {
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        color: #1e293b;
        font-size: 12.5px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.15s;
    }
    .class-tag:hover {
        background: var(--primary, #64141f);
        color: #ffffff;
        border-color: var(--primary, #64141f);
    }
    .industry-footer {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
    }
    .btn-card-quote {
        flex: 1;
        text-align: center;
        background: var(--primary, #64141f);
        color: #ffffff;
        padding: 9px 16px;
        border-radius: 6px;
        font-size: 13.5px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-card-quote:hover {
        background: #4a0d15;
    }
    .btn-card-browse {
        background: #f1f5f9;
        color: #334155;
        padding: 9px 14px;
        border-radius: 6px;
        font-size: 13.5px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-card-browse:hover {
        background: #e2e8f0;
    }
    @media (max-width: 768px) {
        .app-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="app-hero">
    <div class="container">
        <span style="display:inline-block; background:rgba(255,255,255,0.15); color:#f8fafc; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:1px; padding:4px 12px; border-radius:20px; margin-bottom:12px;">Global Substrate & Process Solutions</span>
        <h1>Industrial Applications Matrix</h1>
        <p>SD International synthesizes specialized colorants and chemical auxiliaries tailored to stringent substrate requirements, fastness levels, migration resistance, and environmental standards across heavy processing industries.</p>
    </div>
</div>

<div class="container app-section">
    <div class="app-intro-card">
        <h2 style="font-size:20px; font-weight:700; color:#0f172a; margin-bottom:10px;">Tailored Color Chemistry for Global Process Industries</h2>
        <p>Our production facilities in Ankleshwar, Gujarat are engineered to deliver consistent dispersion, high tinctorial strength, and international test compliance (ISO 105, AATCC, EN71, RoHS, REACH). Explore key application sectors below or request a tailored grade matching report from our lab team.</p>
    </div>

    <div class="app-grid">
        <!-- 1. Textiles -->
        <div class="industry-card">
            <div class="industry-header">
                <div class="industry-icon">🧵</div>
                <div>
                    <h3>Textile Dyeing & Printing</h3>
                    <span style="font-size:13px; color:#64748b;">Cellulosic, Polyester, Wool, Blends</span>
                </div>
            </div>
            <div class="industry-body">
                <p class="industry-desc">High-performance dye ranges for exhaust, continuous pad-steam, and printing processes. Renowned for superior light, wash, perspiration, and chlorine fastness on cotton, denim, and synthetics.</p>
                <div class="recommended-classes">
                    <div class="recommended-classes-label">Recommended Colorant Classes</div>
                    <div class="classes-tags">
                        <a href="{{ url('/vat-dyes') }}" class="class-tag">Vat Dyes</a>
                        <a href="{{ url('/reactive-dyes') }}" class="class-tag">Reactive Dyes</a>
                        <a href="{{ url('/disperse-dyes') }}" class="class-tag">Disperse Dyes</a>
                        <a href="{{ url('/direct-dyes') }}" class="class-tag">Direct Dyes</a>
                        <a href="{{ url('/acid-dyes') }}" class="class-tag">Acid Dyes</a>
                    </div>
                </div>
                <div class="industry-footer">
                    <a href="{{ route('quote.request', ['app' => 'textiles']) }}" class="btn-card-quote">Request Technical Recipe</a>
                    <a href="{{ url('/vat-dyes') }}" class="btn-card-browse">Explore Dyes</a>
                </div>
            </div>
        </div>

        <!-- 2. Plastics & Polymers -->
        <div class="industry-card">
            <div class="industry-header">
                <div class="industry-icon">🧪</div>
                <div>
                    <h3>Plastics, Polymers & Masterbatch</h3>
                    <span style="font-size:13px; color:#64748b;">PET, PS, ABS, PC, HDPE, PP</span>
                </div>
            </div>
            <div class="industry-body">
                <p class="industry-desc">Heat-stable solvent dyes and high-tinctorial organic pigments engineered for polymer compounding, fiber extrusion, and engineering plastics with minimal sublimation.</p>
                <div class="recommended-classes">
                    <div class="recommended-classes-label">Recommended Colorant Classes</div>
                    <div class="classes-tags">
                        <a href="{{ url('/solvent-dyes') }}" class="class-tag">Solvent Dyes</a>
                        <a href="{{ url('/pigments') }}" class="class-tag">Organic Pigments</a>
                        <a href="{{ url('/optical-brightening-agents') }}" class="class-tag">Optical Brighteners</a>
                    </div>
                </div>
                <div class="industry-footer">
                    <a href="{{ route('quote.request', ['app' => 'plastics']) }}" class="btn-card-quote">Request Heat Stability Data</a>
                    <a href="{{ url('/solvent-dyes') }}" class="btn-card-browse">Solvent Dyes</a>
                </div>
            </div>
        </div>

        <!-- 3. Inks & Printing -->
        <div class="industry-card">
            <div class="industry-header">
                <div class="industry-icon">🖨️</div>
                <div>
                    <h3>Inks & Graphic Arts</h3>
                    <span style="font-size:13px; color:#64748b;">Flexo, Gravure, Offset, Inkjet</span>
                </div>
            </div>
            <div class="industry-body">
                <p class="industry-desc">Finely dispersed organic pigments and water/solvent soluble dyes providing high transparency, gloss, rheology stability, and exceptional print sharpness for packaging inks.</p>
                <div class="recommended-classes">
                    <div class="recommended-classes-label">Recommended Colorant Classes</div>
                    <div class="classes-tags">
                        <a href="{{ url('/pigments') }}" class="class-tag">Pigment Red & Blue</a>
                        <a href="{{ url('/basic-dyes') }}" class="class-tag">Basic Dyes</a>
                        <a href="{{ url('/solvent-dyes') }}" class="class-tag">Solvent Dyes</a>
                    </div>
                </div>
                <div class="industry-footer">
                    <a href="{{ route('quote.request', ['app' => 'inks']) }}" class="btn-card-quote">Request Formulation TDS</a>
                    <a href="{{ url('/pigments') }}" class="btn-card-browse">Pigments</a>
                </div>
            </div>
        </div>

        <!-- 4. Paints & Industrial Coatings -->
        <div class="industry-card">
            <div class="industry-header">
                <div class="industry-icon">🎨</div>
                <div>
                    <h3>Paints & Coatings</h3>
                    <span style="font-size:13px; color:#64748b;">Automotive, Architectural, Powder</span>
                </div>
            </div>
            <div class="industry-body">
                <p class="industry-desc">Weatherfast, non-blooming pigments that resist chemical exposure and UV radiation, ensuring vivid, lasting exterior finishes in liquid and powder coating formulations.</p>
                <div class="recommended-classes">
                    <div class="recommended-classes-label">Recommended Colorant Classes</div>
                    <div class="classes-tags">
                        <a href="{{ url('/pigments') }}" class="class-tag">Organic Pigments</a>
                        <a href="{{ url('/solvent-dyes') }}" class="class-tag">Metal Complex Dyes</a>
                    </div>
                </div>
                <div class="industry-footer">
                    <a href="{{ route('quote.request', ['app' => 'paints']) }}" class="btn-card-quote">Request Weathering Data</a>
                    <a href="{{ url('/pigments') }}" class="btn-card-browse">Browse Pigments</a>
                </div>
            </div>
        </div>

        <!-- 5. Paper & Pulp -->
        <div class="industry-card">
            <div class="industry-header">
                <div class="industry-icon">📄</div>
                <div>
                    <h3>Paper, Packaging & Pulp</h3>
                    <span style="font-size:13px; color:#64748b;">Tissue, Writing Paper, Duplex Board</span>
                </div>
            </div>
            <div class="industry-body">
                <p class="industry-desc">Direct and basic dyes offering remarkable substantivity to unbleached and bleached wood pulps with clean backwater clarity and maximum cost efficiency.</p>
                <div class="recommended-classes">
                    <div class="recommended-classes-label">Recommended Colorant Classes</div>
                    <div class="classes-tags">
                        <a href="{{ url('/direct-dyes') }}" class="class-tag">Direct Dyes</a>
                        <a href="{{ url('/basic-dyes') }}" class="class-tag">Basic Dyes</a>
                        <a href="{{ url('/optical-brightening-agents') }}" class="class-tag">OBA for Paper</a>
                    </div>
                </div>
                <div class="industry-footer">
                    <a href="{{ route('quote.request', ['app' => 'paper']) }}" class="btn-card-quote">Get Bulk Paper Quotation</a>
                    <a href="{{ url('/direct-dyes') }}" class="btn-card-browse">Direct Dyes</a>
                </div>
            </div>
        </div>

        <!-- 6. Food, Beverage & Pharma -->
        <div class="industry-card">
            <div class="industry-header">
                <div class="industry-icon">🍬</div>
                <div>
                    <h3>Food, Confectionery & Pharma</h3>
                    <span style="font-size:13px; color:#64748b;">Beverages, Candy, Tablets, Cosmetics</span>
                </div>
            </div>
            <div class="industry-body">
                <p class="industry-desc">High purity primary synthetic food colors and lakes compliant with BIS, US FDA, and European EFSA regulations for safety, heavy metal control, and vivid edible coloration.</p>
                <div class="recommended-classes">
                    <div class="recommended-classes-label">Recommended Colorant Classes</div>
                    <div class="classes-tags">
                        <a href="{{ url('/food-colours') }}" class="class-tag">Tartrazine</a>
                        <a href="{{ url('/food-colours') }}" class="class-tag">Sunset Yellow</a>
                        <a href="{{ url('/food-colours') }}" class="class-tag">Brilliant Blue</a>
                        <a href="{{ url('/food-colours') }}" class="class-tag">Allura Red</a>
                    </div>
                </div>
                <div class="industry-footer">
                    <a href="{{ route('quote.request', ['app' => 'food']) }}" class="btn-card-quote">Request Food Grade COA</a>
                    <a href="{{ url('/food-colours') }}" class="btn-card-browse">Food Colours</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

