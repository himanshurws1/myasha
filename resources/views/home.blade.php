@extends('layouts.site')

@section('content')
    <section class="hero">
        <div class="container hero__grid">
            <div class="hero__content">
                <p class="section-tag">{{ $site['hero']['eyebrow'] }}</p>
                <h1>{{ $site['hero']['title'] }}</h1>
                <p class="hero__lead">{{ $site['hero']['description'] }}</p>

                <div class="hero__actions">
                    <a class="button" href="{{ route('products.index') }}">Explore Products</a>
                    <a class="button button--ghost" href="{{ route('contact') }}">Contact Myasha</a>
                </div>

                <ul class="hero__highlights">
                    @foreach ($site['hero']['highlights'] as $highlight)
                        <li>{{ $highlight }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="hero__visual">
                <div class="hero-panel hero-panel--accent">
                    <span>Industrial Focus</span>
                    <h2>Built for the same strong industrial look and category-led browsing style.</h2>
                    <p>
                        The layout echoes the structure of the reference website with clearer hierarchy, stronger spacing,
                        and more maintainable Laravel templates.
                    </p>
                </div>

                <div class="metric-row">
                    @foreach ($site['hero_metrics'] as $metric)
                        <article class="metric-card">
                            <strong>{{ $metric['value'] }}</strong>
                            <span>{{ $metric['label'] }}</span>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section section--tight">
        <div class="container card-grid card-grid--three">
            @foreach ($site['hero']['cards'] as $card)
                <article class="info-card">
                    <p class="info-card__tag">Core Strength</p>
                    <h3>{{ $card['title'] }}</h3>
                    <p>{{ $card['text'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section">
        <div class="container split-grid">
            <div>
                <p class="section-tag">Welcome To {{ strtoupper($site['name']) }}</p>
                <h2>A one-stop industrial website experience for process-control enquiries.</h2>
                <p class="section-copy">{{ $site['about']['lead'] }}</p>
                @foreach ($site['about']['paragraphs'] as $paragraph)
                    <p class="section-copy">{{ $paragraph }}</p>
                @endforeach
            </div>

            <div class="stack-card">
                <h3>Capability Snapshot</h3>
                <ul class="check-list">
                    @foreach ($site['about']['capabilities'] as $capability)
                        <li>{{ $capability }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="section section--alt">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="section-tag">Our Specialization</p>
                    <h2>Solutions shaped for core industrial segments.</h2>
                </div>
                <p class="section-copy">
                    The category emphasis mirrors the reference site: quick trust-building, sector coverage, and clear paths
                    into instrumentation pages.
                </p>
            </div>

            <div class="specialization-grid">
                @foreach ($site['industries_applications'] as $industry)
                    <article class="specialization-card specialization-card--link">
                        <span>{{ str_pad((string) ($loop->iteration), 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $industry['title'] }}</h3>
                        <p>{{ $industry['summary'] }}</p>
                        <a class="text-link text-link--light" href="{{ route('industries') }}#{{ $industry['slug'] }}">View details</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="section-tag">Products</p>
                    <h2>Category pages ready for product-led browsing.</h2>
                </div>
                <a class="button button--small" href="{{ route('products.index') }}">View All Categories</a>
            </div>

            <div class="card-grid">
                @foreach ($site['product_categories'] as $slug => $category)
                    <article class="product-card">
                        <p class="info-card__tag">Category</p>
                        <h3>{{ $category['title'] }}</h3>
                        <p>{{ $category['intro'] }}</p>
                        <a class="text-link" href="{{ route('products.show', $slug) }}">Open category</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section--alt">
        <div class="container split-grid">
            <div>
                <p class="section-tag">Why Choose Us</p>
                <h2>Structured like an industrial brand site, but easier to edit and extend.</h2>
                <ul class="check-list">
                    @foreach ($site['why_choose_us'] as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="stack-card">
                <h3>Trusted Brand Landscape</h3>
                <div class="partner-grid">
                    @foreach ($site['partners'] as $partner)
                        <span>{{ $partner }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="section-tag">Our Process</p>
                    <h2>How the enquiry journey is framed.</h2>
                </div>
            </div>

            <div class="process-grid">
                @foreach ($site['process_steps'] as $step)
                    <article class="process-card">
                        <span>{{ str_pad((string) ($loop->iteration), 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $step['title'] }}</h3>
                        <p>{{ $step['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section--cta">
        <div class="container cta-banner">
            <div>
                <p class="section-tag">Get In Touch</p>
                <h2>Ready to position {{ $site['name'] }} as your industrial brand online.</h2>
                <p>
                    Contact details across the site now point to your address, email, and phone number so customers can
                    reach you directly.
                </p>
            </div>
            <a class="button" href="{{ route('contact') }}">Open Contact Page</a>
        </div>
    </section>
@endsection
