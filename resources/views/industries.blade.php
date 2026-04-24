@extends('layouts.site')

@section('content')
    <section class="page-hero">
        <div class="container">
            <p class="section-tag">Industries & Applications</p>
            <h1>Industry-focused application cards inspired by the reference site.</h1>
            <p class="page-hero__lead">
                This page brings the industrial sectors into a dedicated menu item beside Products and presents them as
                richer cards with application-oriented details.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="section-tag">Core Sectors</p>
                    <h2>Industries and applications your customers can browse directly.</h2>
                </div>
                <p class="section-copy">
                    The cards below follow the same sector lineup visible on the reference website and expand each sector
                    with industry-use details.
                </p>
            </div>

            <div class="industry-grid">
                @foreach ($site['industries_applications'] as $industry)
                    <article class="industry-card" id="{{ $industry['slug'] }}">
                        <div class="industry-card__header">
                            <span>{{ str_pad((string) ($loop->iteration), 2, '0', STR_PAD_LEFT) }}</span>
                            <p class="info-card__tag">Industry & Application</p>
                        </div>

                        <h3>{{ $industry['title'] }}</h3>
                        <p class="industry-card__summary">{{ $industry['summary'] }}</p>

                        <ul class="mini-list">
                            @foreach ($industry['details'] as $detail)
                                <li>{{ $detail }}</li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
