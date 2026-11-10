@extends('layouts.app')

@section('content')
<style>
    .quote-hero {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: #ffffff;
        padding: 55px 0 50px;
        position: relative;
    }
    .quote-hero h1 {
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 12px;
        color: #ffffff;
    }
    .quote-hero p {
        font-size: 16px;
        color: #94a3b8;
        max-width: 680px;
        line-height: 1.6;
    }
    .quote-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 40px;
        padding: 50px 0 80px;
    }
    .quote-form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 35px 40px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }
    .quote-form-card h2 {
        font-size: 22px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }
    .quote-form-card .subtitle {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 28px;
    }
    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-size: 13.5px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }
    .form-control, .form-select {
        width: 100%;
        padding: 11px 14px;
        font-size: 14.5px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        outline: none;
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: inherit;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary, #64141f);
        box-shadow: 0 0 0 3px rgba(100, 20, 31, 0.1);
    }
    .quote-sidebar-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 25px;
    }
    .quote-sidebar-card h3 {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .benefit-item {
        display: flex;
        gap: 12px;
        margin-bottom: 18px;
        align-items: flex-start;
    }
    .benefit-icon {
        background: #fee2e2;
        color: var(--primary, #64141f);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 700;
        flex-shrink: 0;
    }
    .benefit-text h4 {
        font-size: 14.5px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 2px;
    }
    .benefit-text p {
        font-size: 13px;
        color: #64748b;
        line-height: 1.45;
    }
    .btn-submit-quote {
        background: var(--primary, #64141f);
        color: #ffffff;
        font-size: 16px;
        font-weight: 700;
        border: none;
        border-radius: 6px;
        padding: 14px 28px;
        width: 100%;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
    }
    .btn-submit-quote:hover {
        background: #4a0d15;
    }
    .badge-export {
        display: inline-block;
        background: rgba(255,255,255,0.15);
        color: #f8fafc;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 4px 12px;
        border-radius: 20px;
        margin-bottom: 12px;
    }
    @media (max-width: 900px) {
        .quote-layout {
            grid-template-columns: 1fr;
        }
        .form-grid-2 {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="quote-hero">
    <div class="container">
        <span class="badge-export">Direct Factory Export Division</span>
        <h1>Request Quotation & Sample Dispatch</h1>
        <p>Connect with our technical export sales division in Mumbai for bulk FOB / CIF container pricing, laboratory test samples (50g-500g), Technical Data Sheets (TDS), and Material Safety Data Sheets (MSDS).</p>
    </div>
</div>

<div class="container">
    <div class="quote-layout">
        <!-- Main Form -->
        <div class="quote-form-card">
            <h2>Commercial & Technical Inquiry Form</h2>
            <p class="subtitle">Please provide your technical parameters. Our chemical export managers respond within 12 business hours.</p>

            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 16px 20px; border-radius: 6px; margin-bottom: 25px; border: 1px solid #bbf7d0; font-weight: 500;">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if (isset($errors) && $errors->any())
                <div style="background: #fee2e2; color: #991b1b; padding: 16px 20px; border-radius: 6px; margin-bottom: 25px; border: 1px solid #fecaca;">
                    <ul style="margin: 0 0 0 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('inquiries.store') }}" method="POST">
                @csrf

                <!-- Inquiry Type / Purpose -->
                <div class="form-group">
                    <label for="inquiry_type">Inquiry Purpose *</label>
                    <select name="inquiry_type" id="inquiry_type" class="form-select" required>
                        <option value="quote" {{ old('inquiry_type') == 'quote' ? 'selected' : '' }}>Bulk Price Quotation (FOB / CIF)</option>
                        <option value="sample" {{ (old('inquiry_type') == 'sample' || request('type') == 'sample') ? 'selected' : '' }}>Laboratory Sample Dispatch (Test Evaluation)</option>
                        <option value="tds" {{ old('inquiry_type') == 'tds' ? 'selected' : '' }}>Technical Data Sheet (TDS)</option>
                        <option value="msds" {{ old('inquiry_type') == 'msds' ? 'selected' : '' }}>Material Safety Data Sheet (MSDS / SDS)</option>
                        <option value="general" {{ old('inquiry_type') == 'general' ? 'selected' : '' }}>General Technical Guidance</option>
                    </select>
                </div>

                <!-- Product of Interest -->
                <div class="form-grid-2">
                    <div class="form-group">
                        <label for="product_name">Chemical / Product Name *</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" 
                               value="{{ old('product_name', $prefilledProduct ? $prefilledProduct->title : request('product')) }}" 
                               placeholder="e.g. Vat Blue 4 (Indanthrone)" required>
                    </div>

                    <div class="form-group">
                        <label for="product_slug">CAS / C.I. Number or Code</label>
                        <input type="text" name="product_slug" id="product_slug" class="form-control" 
                               value="{{ old('product_slug', $prefilledProduct ? ($prefilledProduct->cas_number ?: $prefilledProduct->ci_number) : request('cas')) }}" 
                               placeholder="e.g. CAS 81-77-6 or C.I. 69800">
                    </div>
                </div>

                <!-- Buyer Info -->
                <div class="form-grid-2">
                    <div class="form-group">
                        <label for="name">Contact Person Full Name *</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Dr. Alexander Schmidt" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Corporate Email Address *</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="alexander@company.com" required>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label for="phone">Phone / WhatsApp (with Country Code) *</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="+49 170 1234567" required>
                    </div>

                    <div class="form-group">
                        <label for="company">Company / Organization Name *</label>
                        <input type="text" name="company" id="company" class="form-control" value="{{ old('company') }}" placeholder="e.g. Textile Mills Ltd." required>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label for="country">Country of Destination *</label>
                        <input type="text" name="country" id="country" class="form-control" value="{{ old('country') }}" placeholder="e.g. Germany, Bangladesh, USA, Brazil" required>
                    </div>

                    <div class="form-group">
                        <label for="packaging_est">Estimated Volume / Packaging</label>
                        <input type="text" name="packaging_est" id="packaging_est" class="form-control" placeholder="e.g. 5 MT / 25 KG Drums, 1x20' FCL">
                    </div>
                </div>

                <!-- Message -->
                <div class="form-group">
                    <label for="message">Detailed Specifications / End-Use Application / Port of Delivery</label>
                    <textarea name="message" id="message" rows="4" class="form-control" placeholder="Mention required purity grade, solubility, target substrate (e.g. 100% cotton yarn), destination seaport/airport, and any compliance requirements (REACH, OEKO-TEX, ZDHC)...">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn-submit-quote">Submit Export Inquiry →</button>
            </form>
        </div>

        <!-- Sidebar Info -->
        <div>
            <div class="quote-sidebar-card">
                <h3>Global Export Assurance</h3>

                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <div class="benefit-text">
                        <h4>Prompt Lab Samples</h4>
                        <p>Standard 50g-100g evaluation samples dispatched via DHL / FedEx express worldwide.</p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <div class="benefit-text">
                        <h4>Export Documentation</h4>
                        <p>Complete COA, MSDS, Bill of Lading, Certificate of Origin, and REACH pre-registration assistance.</p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <div class="benefit-text">
                        <h4>Global Seaport Logistics</h4>
                        <p>FOB Nhava Sheva (JNPT) / Mundra or CIF delivery to any global seaport in 45+ countries.</p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <div class="benefit-text">
                        <h4>Rigorous Quality Testing</h4>
                        <p>Spectrophotometer spectrophotometric shade matching and chromatography batch control.</p>
                    </div>
                </div>
            </div>

            <!-- Direct Contact Card -->
            <div class="quote-sidebar-card" style="background: #ffffff;">
                <h3>Need Immediate Assistance?</h3>
                <p style="color: #64748b; font-size: 13.5px; margin-bottom: 16px;">Our international business development executives are available on phone and WhatsApp:</p>

                <p style="font-size: 14.5px; margin-bottom: 8px;">
                    <strong>Direct Sales:</strong> <a href="tel:+919920669561" style="color: var(--primary, #64141f); text-decoration: none;">+91 99206 69561</a>
                </p>
                <p style="font-size: 14.5px; margin-bottom: 8px;">
                    <strong>WhatsApp:</strong> <a href="https://wa.me/919920669561" target="_blank" style="color: #16a34a; text-decoration: none;">Chat on WhatsApp ↗</a>
                </p>
                <p style="font-size: 14.5px;">
                    <strong>Export Desk:</strong> <a href="mailto:info@sdinternational.com" style="color: #334155; text-decoration: none;">info@sdinternational.com</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
