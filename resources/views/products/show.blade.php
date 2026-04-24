@extends('layouts.site')

@section('content')
    <section class="page-hero">
        <div class="container split-grid split-grid--hero">
            <div>
                <p class="section-tag">Product Category</p>
                <h1>{{ $category['title'] }}</h1>
                <p class="page-hero__lead">{{ $category['intro'] }}</p>
            </div>

            <div class="stack-card">
                <h3>Typical Applications</h3>
                <ul class="check-list">
                    @foreach ($category['applications'] as $application)
                        <li>{{ $application }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container product-detail-grid">
            <div class="product-detail-main">
                @foreach ($category['items'] as $item)
                    <article class="spec-card">
                        <h2>{{ $item['name'] }}</h2>
                        <p>{{ $item['summary'] }}</p>

                        <div class="spec-table">
                            @foreach ($item['specs'] as $label => $value)
                                <div class="spec-row">
                                    <span>{{ $label }}</span>
                                    <strong>{{ $value }}</strong>
                                </div>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>

            <aside class="product-detail-side">
                <div class="stack-card">
                    <h3>Need a quotation?</h3>
                    <p>
                        Reach {{ $site['name'] }} directly for product discussion, sourcing, and application-oriented support.
                    </p>
                    <a class="button" href="{{ route('contact') }}">Contact Now</a>
                </div>

                <div class="stack-card">
                    <h3>Direct Contact</h3>
                    <ul class="footer__list">
                        <li>{{ $site['address'] }}</li>
                        <li><a href="{{ $site['phone_href'] }}">{{ $site['phone'] }}</a></li>
                        <li><a href="{{ $site['email_href'] }}">{{ $site['email'] }}</a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </section>
@endsection
