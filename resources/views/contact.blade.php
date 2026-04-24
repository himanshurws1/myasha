@extends('layouts.site')

@section('content')
    <section class="page-hero page-hero--contact">
        <div class="container">
            <p class="section-tag">Contact</p>
            <h1>Get in touch with {{ $site['name'] }}</h1>
            <p class="page-hero__lead">
                Your main office details are now shown consistently across the header, footer, and contact page.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container contact-grid">
            <div class="contact-panel">
                <h2>Contact Info</h2>

                <div class="contact-card">
                    <p class="info-card__tag">Address</p>
                    <p>{{ $site['address'] }}</p>
                </div>

                <div class="contact-card">
                    <p class="info-card__tag">Email</p>
                    <a href="{{ $site['email_href'] }}">{{ $site['email'] }}</a>
                </div>

                <div class="contact-card">
                    <p class="info-card__tag">Phone</p>
                    <a href="{{ $site['phone_href'] }}">{{ $site['phone'] }}</a>
                </div>
            </div>

            <div class="stack-card">
                <h2>Send An Enquiry</h2>
                @if (session('success'))
                    <div class="form-alert form-alert--success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="form-alert form-alert--error">
                        Please check the form fields and try again.
                    </div>
                @endif

                <form class="contact-form" method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    <label>
                        <span>Your Name</span>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your name">
                        @error('name')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </label>

                    <label>
                        <span>Company</span>
                        <input type="text" name="company" value="{{ old('company') }}" placeholder="Enter company name">
                        @error('company')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </label>

                    <label>
                        <span>Email Address</span>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email address">
                        @error('email')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </label>

                    <label>
                        <span>Phone Number</span>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number">
                        @error('phone')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </label>

                    <label>
                        <span>Message</span>
                        <textarea name="message" rows="6" placeholder="Tell us which products or support you need">{{ old('message') }}</textarea>
                        @error('message')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </label>

                    <button class="button" type="submit">Request a Quote</button>
                </form>
            </div>
        </div>
    </section>
@endsection
