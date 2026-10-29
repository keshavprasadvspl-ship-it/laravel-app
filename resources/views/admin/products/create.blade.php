@extends('admin.layout')

@section('title', 'Add New Product')

@section('content')
<div class="page-title-row">
    <div>
        <h1 class="page-heading">Add New Chemical Product</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Enter technical chemical specifications, category mappings, and SEO tags.</p>
    </div>

    <div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline">← Back to Catalog</a>
    </div>
</div>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">
        <!-- Left Column: Product Details & Specs -->
        <div>
            <!-- Basic Information Card -->
            <div class="card">
                <div class="card-header">1. Basic Information</div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" for="title">Product Name *</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-input" placeholder="e.g. Basic Green 1 (Diamond Green) Dyes" required>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label" for="slug">URL Slug (Leave blank to auto-generate)</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-input" placeholder="e.g. basic-green-1-diamond-green-dyes">
                        </div>
                        <div>
                            <label class="form-label" for="brand">Brand</label>
                            <input type="text" name="brand" id="brand" value="{{ old('brand', 'S D International') }}" class="form-input">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" for="short_description">Short Summary Description</label>
                        <textarea name="short_description" id="short_description" rows="3" class="form-textarea" placeholder="Brief technical summary...">{{ old('short_description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="content">Full Chemical Properties & Overview</label>
                        <textarea name="content" id="content" rows="6" class="form-textarea" placeholder="Detailed content, synonyms, fastness properties...">{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Technical Chemical Specifications Card -->
            <div class="card">
                <div class="card-header">2. Technical Chemical Specifications</div>
                <div class="card-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label" for="cas_number">CAS Registry Number</label>
                            <input type="text" name="cas_number" id="cas_number" value="{{ old('cas_number') }}" class="form-input" placeholder="e.g. 0633-03-04">
                        </div>
                        <div>
                            <label class="form-label" for="ci_number">C.I. Number</label>
                            <input type="text" name="ci_number" id="ci_number" value="{{ old('ci_number') }}" class="form-input" placeholder="e.g. 42040">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label" for="relative_name">Relative Name / Synonyms</label>
                            <input type="text" name="relative_name" id="relative_name" value="{{ old('relative_name') }}" class="form-input" placeholder="e.g. Diamond Green">
                        </div>
                        <div>
                            <label class="form-label" for="molecular_formula">Molecular Formula</label>
                            <input type="text" name="molecular_formula" id="molecular_formula" value="{{ old('molecular_formula') }}" class="form-input" placeholder="e.g. C27H33N2.HSO4">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label" for="molecular_weight">Molecular Weight (g/mol)</label>
                            <input type="text" name="molecular_weight" id="molecular_weight" value="{{ old('molecular_weight') }}" class="form-input" placeholder="e.g. 482.63">
                        </div>
                        <div>
                            <label class="form-label" for="physical_appearance">Physical Appearance</label>
                            <input type="text" name="physical_appearance" id="physical_appearance" value="{{ old('physical_appearance') }}" class="form-input" placeholder="e.g. Bright Green Powder">
                        </div>
                    </div>

                    <div>
                        <label class="form-label" for="packaging">Packaging</label>
                        <input type="text" name="packaging" id="packaging" value="{{ old('packaging', '25 kg / Drum / Bag / Carton Box') }}" class="form-input">
                    </div>
                </div>
            </div>

            <!-- SEO Metadata Card (Rank Math Replica) -->
            <div class="card">
                <div class="card-header">3. SEO Settings (Rank Math Compatible)</div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" for="meta_title">SEO Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" class="form-input" placeholder="Custom Google Search Title">
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3" class="form-textarea" placeholder="Google snippet description...">{{ old('meta_description') }}</textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <label class="form-label" for="focus_keyword">Focus Keyword</label>
                            <input type="text" name="focus_keyword" id="focus_keyword" value="{{ old('focus_keyword') }}" class="form-input" placeholder="e.g. Basic Green 1 supplier">
                        </div>
                        <div>
                            <label class="form-label" for="robots">Robots Meta</label>
                            <input type="text" name="robots" id="robots" value="{{ old('robots', 'index,follow') }}" class="form-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Publishing & Taxonomies -->
        <div>
            <!-- Publish Status Card -->
            <div class="card">
                <div class="card-header">Publish Status</div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label" for="status">Catalog Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="publish" selected>Published (Live)</option>
                            <option value="draft">Draft (Hidden)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 15px;">Save & Publish Product</button>
                </div>
            </div>

            <!-- Image Card -->
            <div class="card">
                <div class="card-header">Product Image</div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" for="image">Upload Image File</label>
                        <input type="file" name="image" id="image" class="form-input" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="image_url">Or Image Path / URL</label>
                        <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}" class="form-input" placeholder="/uploads/...">
                    </div>
                </div>
            </div>

            <!-- Categories Card -->
            <div class="card">
                <div class="card-header">Product Categories</div>
                <div class="card-body" style="max-height: 380px; overflow-y: auto;">
                    @foreach($categories as $cat)
                        <div style="margin-bottom: 8px;">
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 13.5px; cursor: pointer;">
                                <input type="checkbox" name="categories[]" value="{{ $cat->id }}">
                                <span>{{ $cat->name }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
