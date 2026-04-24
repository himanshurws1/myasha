@extends('layouts.site')

@section('content')
    <section class="page-hero">
        <div class="container">
            <p class="section-tag">About {{ $site['name'] }}</p>
            <h1>{{ $site['tagline'] }}</h1>
            <p class="page-hero__lead">
                A branded Laravel company site designed to feel industrial, trustworthy, and quote-ready from the first screen.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container split-grid">
            <div>
                <h2>Built around industrial credibility.</h2>
                @foreach ($site['about']['paragraphs'] as $paragraph)
                    <p class="section-copy">{{ $paragraph }}</p>
                @endforeach
                <p class="section-copy">
                    The page structure is intentionally aligned with a manufacturing and instrumentation audience, using strong
                    messaging blocks, category-first navigation, and clear contact access.
                </p>
            </div>

            <div class="stack-card">
                <h3>What Myasha Presents</h3>
                <ul class="check-list">
                    @foreach ($site['about']['capabilities'] as $capability)
                        <li>{{ $capability }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="section section--alt">
        <div class="container split-grid">
            <div>
                <p class="section-tag">What We Offer</p>
                <h2>{{ $site['what_we_offer']['title'] }}</h2>
                <p class="section-copy">{{ $site['what_we_offer']['text'] }}</p>
            </div>

            <div class="stack-card">
                <h3>Offer Highlights</h3>
                <ul class="check-list">
                    @foreach ($site['what_we_offer']['points'] as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="section section--alt">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="section-tag">Industry Coverage</p>
                    <h2>Focused sectors displayed with a familiar industrial website rhythm.</h2>
                </div>
            </div>

            <div class="specialization-grid">
                @foreach ($site['specializations'] as $specialization)
                    <article class="specialization-card">
                        <span>{{ str_pad((string) ($loop->iteration), 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $specialization }}</h3>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="section-tag">Service Focus</p>
                    <h2>Instrumentation and automation support areas shown more clearly.</h2>
                </div>
            </div>

            <div class="card-grid">
                @foreach ($site['service_categories'] as $service)
                    <article class="product-card">
                        <p class="info-card__tag">Service Category</p>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="section-tag">Working Style</p>
                    <h2>A clear process from requirement to support.</h2>
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
@endsection
