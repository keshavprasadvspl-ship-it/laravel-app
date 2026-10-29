@extends('layouts.app')

@section('content')
<style>
    .contact-hero {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 50px 0;
        margin-bottom: 50px;
    }
    .contact-hero h1 {
        font-size: 36px;
        color: var(--primary-dark);
        margin-bottom: 10px;
    }
    .contact-hero p {
        color: #64748b;
        font-size: 16px;
    }
    .contact-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        padding-bottom: 80px;
    }
    .contact-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 35px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }
    .contact-card h2 {
        font-size: 24px;
        color: var(--primary-dark);
        margin-bottom: 20px;
        border-bottom: 2px solid var(--primary-accent);
        padding-bottom: 10px;
    }
    .contact-info-item {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
    }
    .contact-info-icon {
        background: var(--cream-bg);
        color: var(--primary-accent);
        width: 44px;
        height: 44px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .contact-info-text h4 {
        font-size: 16px;
        color: var(--primary-dark);
        margin-bottom: 4px;
    }
    .contact-info-text p, .contact-info-text a {
        color: #64748b;
        font-size: 14.5px;
        line-height: 1.5;
    }
    @media (max-width: 900px) {
        .contact-layout {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="contact-hero">
    <div class="container">
        <h1>Contact SD International</h1>
        <p>Get in touch with our factory and export sales division in Mumbai for quotations, technical datasheets, and sample dispatches.</p>
    </div>
</div>

<div class="container">
    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 16px 20px; border-radius: 6px; margin-bottom: 30px; border: 1px solid #bbf7d0;">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="contact-layout">
        <!-- Contact Form -->
        <div class="contact-card">
            <h2>Send Us a Message</h2>
            <form action="{{ url('/inquiries') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Your Name *</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="John Doe" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="john@example.com" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone / WhatsApp *</label>
                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="+91 99206 69561" required>
                </div>

                <div class="form-group">
                    <label for="product_name">Product of Interest</label>
                    <input type="text" name="product_name" id="product_name" class="form-control" placeholder="e.g. Basic Green 1, Vat Blue 4...">
                </div>

                <div class="form-group">
                    <label for="message">Message / Inquiries</label>
                    <textarea name="message" id="message" rows="4" class="form-control" placeholder="Whether you have questions regarding color matching, COA, pricing, or shipping..."></textarea>
                </div>

                <button type="submit" class="btn-submit" style="padding: 14px;">Send Inquiry</button>
            </form>
        </div>

        <!-- Corporate Contact Info -->
        <div>
            <div class="contact-card" style="margin-bottom: 30px;">
                <h2>Corporate Headquarters</h2>

                <div class="contact-info-item">
                    <div class="contact-info-icon">📍</div>
                    <div class="contact-info-text">
                        <h4>Office Address</h4>
                        <p>B-103, Vardhman Vatika, Chitalsar, Manpada, Thane (W) - 400607, Mumbai, Maharashtra, India.</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">📞</div>
                    <div class="contact-info-text">
                        <h4>Phone Numbers</h4>
                        <p>
                            <a href="tel:+919920669561">+91 99206 69561</a><br>
                            <a href="tel:+919820454441">+91 98204 54441</a>
                        </p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">✉️</div>
                    <div class="contact-info-text">
                        <h4>Email</h4>
                        <p><a href="mailto:info@sdinternational.com">info@sdinternational.com</a></p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">⏰</div>
                    <div class="contact-info-text">
                        <h4>Working Hours</h4>
                        <p>Monday - Saturday: 9:30 AM – 6:30 PM IST</p>
                    </div>
                </div>
            </div>

            <!-- Additional Compliance Box -->
            <div class="contact-card" style="background: #fdf2f3; border-color: #fecdd3;">
                <h3 style="color: var(--primary); margin-bottom: 12px;">Tax & Export Credentials</h3>
                <p style="font-size: 14px; color: #4b5563; margin-bottom: 8px;"><strong>GST No:</strong> 27AATPM4523B1ZQ</p>
                <p style="font-size: 14px; color: #4b5563; margin-bottom: 8px;"><strong>TAN No:</strong> MUMJ1*****</p>
                <p style="font-size: 14px; color: #4b5563;"><strong>Quality Management:</strong> ISO 9001:2015, REACH Compliance & GOTS Verified.</p>
            </div>
        </div>
    </div>
</div>
@endsection
