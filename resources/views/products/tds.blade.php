<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->title }} - Technical Data Sheet (TDS) | S D International</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: #f1f5f9;
            color: #111827;
            margin: 0;
            padding: 24px;
            line-height: 1.6;
        }
        .tds-sheet {
            max-width: 820px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .tds-toolbar {
            max-width: 820px;
            margin: 0 auto 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }
        .btn-tool {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
        }
        .btn-print {
            background: linear-gradient(180deg, #951634 0%, #73001B 100%);
            color: #ffffff;
        }
        .btn-back {
            background: #ffffff;
            color: #1e293b;
            border: 1px solid #cbd5e1;
        }
        .tds-header {
            background: linear-gradient(90deg, #73001B 0%, #951634 100%);
            color: #ffffff;
            padding: 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }
        .tds-header-brand h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 22px;
            margin: 0 0 4px 0;
            letter-spacing: 0.5px;
        }
        .tds-header-brand p {
            margin: 0;
            font-size: 12px;
            opacity: 0.9;
        }
        .tds-badge {
            background: rgba(255,255,255,0.16);
            border: 1px solid rgba(255,255,255,0.35);
            padding: 6px 14px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            white-space: nowrap;
        }
        .tds-body {
            padding: 28px 32px 32px;
        }
        .tds-product-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #73001B;
            margin: 0 0 6px 0;
        }
        .tds-product-sub {
            font-size: 13.5px;
            color: #475569;
            margin: 0 0 22px 0;
        }
        .tds-section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: #73001B;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border-bottom: 2px solid #D2AC67;
            padding-bottom: 6px;
            margin: 24px 0 14px 0;
        }
        table.tds-spec-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }
        table.tds-spec-table th,
        table.tds-spec-table td {
            border: 1px solid #cbd5e1;
            padding: 9px 14px;
            text-align: left;
            vertical-align: top;
        }
        table.tds-spec-table th {
            width: 34%;
            background: #f8fafc;
            color: #0f172a;
            font-weight: 600;
        }
        .tds-rich-block {
            font-size: 13.5px;
            color: #334155;
        }
        .tds-rich-block h2, .tds-rich-block h3, .tds-rich-block h4 {
            font-family: 'Montserrat', sans-serif;
            font-size: 15px;
            color: #73001B;
            margin: 16px 0 6px 0;
        }
        .tds-footer {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 18px 32px;
            font-size: 12px;
            color: #475569;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .tds-disclaimer {
            margin-top: 22px;
            padding: 12px 14px;
            background: #fffbeb;
            border-left: 3px solid #D2AC67;
            font-size: 11.5px;
            color: #57534e;
        }
        @media print {
            body { background: #ffffff; padding: 0; }
            .tds-toolbar { display: none !important; }
            .tds-sheet { box-shadow: none; border: none; max-width: 100%; }
            .tds-header { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div class="tds-toolbar">
        <a href="{{ url('/' . $product->slug) }}" class="btn-tool btn-back">&larr; Back to Product</a>
        <button type="button" class="btn-tool btn-print" onclick="window.print()">Download / Print PDF</button>
    </div>

    <div class="tds-sheet">
        <div class="tds-header">
            <div class="tds-header-brand">
                <h1>S D INTERNATIONAL</h1>
                <p>ISO 9001:2015 Certified | Government of India Recognised Two Star Export House</p>
            </div>
            <div class="tds-badge">Technical Data Sheet (TDS)</div>
        </div>

        <div class="tds-body">
            <h2 class="tds-product-title">{{ $product->title }}</h2>
            <p class="tds-product-sub">Manufacturer, Supplier &amp; Global Exporter &mdash; Mumbai, India</p>

            @php
                $attrs = is_array($product->attributes_json) ? $product->attributes_json : [];
            @endphp

            <div class="tds-section-title">1. Product Identification &amp; Technical Parameters</div>
            <table class="tds-spec-table">
                <tbody>
                    <tr>
                        <th>Product Name</th>
                        <td><strong>{{ $product->title }}</strong></td>
                    </tr>
                    <tr>
                        <th>Brand</th>
                        <td>{{ $product->brand ?: 'S D International' }}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $primaryCat ? $primaryCat->name : 'Dyes & Chemicals' }}</td>
                    </tr>
                    @if($product->cas_number)
                    <tr>
                        <th>CAS Registry Number</th>
                        <td>{{ $product->cas_number }}</td>
                    </tr>
                    @endif
                    @if($product->ci_number)
                    <tr>
                        <th>Colour Index (C.I.) Number</th>
                        <td>{{ $product->ci_number }}</td>
                    </tr>
                    @endif
                    @if(!empty($attrs['commercial-name']['value']) || $product->relative_name)
                    <tr>
                        <th>Commercial / Synonym Name</th>
                        <td>{{ $attrs['commercial-name']['value'] ?? $product->relative_name }}</td>
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
                    @if($product->physical_appearance || !empty($attrs['physical-appearance']['value']))
                    <tr>
                        <th>Physical Appearance</th>
                        <td>{{ $product->physical_appearance ?: ($attrs['physical-appearance']['value'] ?? '') }}</td>
                    </tr>
                    @endif
                    @foreach($attrs as $key => $attr)
                        @if(is_array($attr) && !empty($attr['label']) && !empty($attr['value']) && !in_array($key, ['brand', 'category', 'product-name', 'commercial-name', 'c-i-number', 'cas-number', 'molecular-formula', 'molecular-weight', 'physical-appearance']))
                        <tr>
                            <th>{{ $attr['label'] }}</th>
                            <td>{{ $attr['value'] }}</td>
                        </tr>
                        @endif
                    @endforeach
                    <tr>
                        <th>Standard Packaging</th>
                        <td>{{ $product->packaging ?: '25 Kg HDPE Bags | Kraft Paper Bags | Fibre Drums | HDPE Drums | Palletized Export Cargo' }}</td>
                    </tr>
                    <tr>
                        <th>Quality Certification</th>
                        <td>ISO 9001:2015 Certified Manufacturing &amp; Quality Control</td>
                    </tr>
                </tbody>
            </table>

            @if($product->content)
            <div class="tds-section-title">2. Chemical Details, Properties &amp; Applications</div>
            <div class="tds-rich-block">
                {!! preg_replace('/<img[^>]+download\.jpg[^>]*>/i', '', $product->content) !!}
            </div>
            @endif

            <div class="tds-disclaimer">
                <strong>Disclaimer:</strong> The technical information provided in this Technical Data Sheet is intended as a general guide based on our current laboratory knowledge. Customised specifications, batch COA, and MSDS are supplied upon formal enquiry. Please contact our technical sales team for exact application requirements.
            </div>
        </div>

        <div class="tds-footer">
            <div><strong>S D International</strong> &mdash; 701, Ashok Heights, Gundavali Hill, Andheri East, Mumbai - 400069, Maharashtra, India</div>
            <div><strong>Phone:</strong> +91 99206 69561 &nbsp;|&nbsp; <strong>Email:</strong> info@sdinternational.com</div>
        </div>
    </div>
</body>
</html>
