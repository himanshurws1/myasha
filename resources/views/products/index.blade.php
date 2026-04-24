@extends('layouts.site')

@section('content')
    <section class="page-hero">
        <div class="container">
            <p class="section-tag">Products</p>
            <h1>Industrial instrumentation categories for fast enquiry flow.</h1>
            <p class="page-hero__lead">
                Each category below opens a dedicated page with sample product blocks and application-focused details.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container card-grid">
            @foreach ($site['product_categories'] as $slug => $category)
                <article class="product-card product-card--large">
                    <p class="info-card__tag">Category {{ str_pad((string) ($loop->iteration), 2, '0', STR_PAD_LEFT) }}</p>
                    <h2>{{ $category['title'] }}</h2>
                    <p>{{ $category['intro'] }}</p>

                    <ul class="mini-list">
                        @foreach ($category['applications'] as $application)
                            <li>{{ $application }}</li>
                        @endforeach
                    </ul>

                    <a class="button button--small" href="{{ route('products.show', $slug) }}">View Details</a>
                </article>
            @endforeach
        </div>
    </section>
@endsection
