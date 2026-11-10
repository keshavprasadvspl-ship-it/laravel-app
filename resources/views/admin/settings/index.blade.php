@extends('admin.layout')

@section('title', 'Global Website & Export Settings')

@section('content')
<div class="page-title-row">
    <div>
        <h1 class="page-heading">Website & Company Settings</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Update corporate identity, export sales hotlines, plant addresses, and SEO configurations.</p>
    </div>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">
        <div>
            <!-- Company & Contact Info -->
            <div class="card">
                <div class="card-header">Company Profile & Contact Information</div>
                <div class="card-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 16px;">
                        <div class="form-group">
                            <label class="form-label">Company Legal Name *</label>
                            <input type="text" name="company_name" value="{{ $settings['company_name'] ?? 'SD International' }}" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Primary Hotline Phone</label>
                            <input type="text" name="phone" value="{{ $settings['phone'] ?? '+91 99206 69561' }}" class="form-input">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 16px;">
                        <div class="form-group">
                            <label class="form-label">Alternative / Landline</label>
                            <input type="text" name="phone_alt" value="{{ $settings['phone_alt'] ?? '+91 22 2854 4455' }}" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">WhatsApp Support Number</label>
                            <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '+919920669561' }}" class="form-input" placeholder="+919920669561">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 16px;">
                        <div class="form-group">
                            <label class="form-label">General Inquiry Email</label>
                            <input type="email" name="email" value="{{ $settings['email'] ?? 'info@sdinternational.com' }}" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Export Sales Email</label>
                            <input type="email" name="export_email" value="{{ $settings['export_email'] ?? 'sales@sdinternational.com' }}" class="form-input">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Tagline / Mission</label>
                        <input type="text" name="company_tagline" value="{{ $settings['company_tagline'] ?? '' }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Office & Laboratory Working Hours</label>
                        <input type="text" name="working_hours" value="{{ $settings['working_hours'] ?? 'Mon - Sat: 9:30 AM - 6:30 PM (IST)' }}" class="form-input">
                    </div>
                </div>
            </div>

            <!-- Locations Card -->
            <div class="card">
                <div class="card-header">Office & Factory Locations</div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label">Corporate Head Office Address (Mumbai)</label>
                        <textarea name="corporate_address" rows="2" class="form-textarea">{{ $settings['corporate_address'] ?? '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Manufacturing Plant & Warehouse Address (Gujarat)</label>
                        <textarea name="factory_address" rows="2" class="form-textarea">{{ $settings['factory_address'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Global SEO & Social Card -->
            <div class="card">
                <div class="card-header">Global Search Engine Optimization & Social Media</div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Default Global Meta Title</label>
                        <input type="text" name="meta_title" value="{{ $settings['meta_title'] ?? '' }}" class="form-input">
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Default Global Meta Description</label>
                        <textarea name="meta_description" rows="3" class="form-textarea">{{ $settings['meta_description'] ?? '' }}</textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 16px;">
                        <div class="form-group">
                            <label class="form-label">LinkedIn Company URL</label>
                            <input type="url" name="linkedin_url" value="{{ $settings['linkedin_url'] ?? '' }}" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Facebook Page URL</label>
                            <input type="url" name="facebook_url" value="{{ $settings['facebook_url'] ?? '' }}" class="form-input">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;">
                        <div class="form-group">
                            <label class="form-label">Twitter / X URL</label>
                            <input type="url" name="twitter_url" value="{{ $settings['twitter_url'] ?? '' }}" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Google Analytics Measurement ID</label>
                            <input type="text" name="google_analytics_id" value="{{ $settings['google_analytics_id'] ?? '' }}" class="form-input" placeholder="G-XXXXXXXXXX">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar / Stats -->
        <div>
            <div class="card">
                <div class="card-header">Save Configurations</div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 12px;">Save Settings</button>
                    <p style="font-size: 12px; color: var(--text-muted); margin-top: 10px; line-height: 1.4;">
                        Changes take effect immediately across all public layouts, schema tags, and inquiry templates.
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Export Credentials & Metrics</div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Global Export Countries</label>
                        <input type="text" name="export_countries_count" value="{{ $settings['export_countries_count'] ?? '45+' }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Annual Manufacturing Capacity</label>
                        <input type="text" name="annual_capacity_mt" value="{{ $settings['annual_capacity_mt'] ?? '12,000 MT' }}" class="form-input">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
