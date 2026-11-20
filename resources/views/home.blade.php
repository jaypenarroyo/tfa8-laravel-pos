@extends('layouts.app')

@section('title', 'Home | POS Foundations')

@section('content')
<section class="hero">
    <div class="container hero-grid">
        <div>
            <p class="eyebrow">Laravel POS Application</p>
            <h1>A clean foundation for everyday point-of-sale work.</h1>
            <p class="lead">Manage customer and user resources behind a secure Laravel Breeze login with conventional resource controllers.</p>
            <div class="button-row">
                <a class="button primary" href="{{ auth()->check() ? route('customers.index') : route('login') }}">{{ auth()->check() ? 'Manage customers' : 'Log in to manage' }}</a>
                <a class="button secondary" href="{{ route('about') }}">About the project</a>
            </div>
        </div>
        <div class="dashboard-preview" aria-label="Point-of-sale summary">
            <div class="preview-top">
                <span>Store overview</span>
                <span class="live-dot">Live</span>
            </div>
            <div class="metric-grid">
                <article><span>Customers</span><strong>5</strong><small>Seeded records</small></article>
                <article><span>Team users</span><strong>5</strong><small>Unique usernames</small></article>
                <article><span>Routing</span><strong>REST</strong><small>Resource controllers</small></article>
                <article><span>Security</span><strong>AUTH</strong><small>Protected sessions</small></article>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Authenticated resource workflow</p>
            <h2>Conventional CRUD actions protected by login</h2>
        </div>
        <div class="card-grid">
            <article class="feature-card"><span>01</span><h3>Authenticate</h3><p>Register, log in, log out, and change a password through Breeze.</p></article>
            <article class="feature-card"><span>02</span><h3>Authorize access</h3><p>Redirect logged-out visitors away from protected account pages.</p></article>
            <article class="feature-card"><span>03</span><h3>Use resources</h3><p>Map index, create, store, show, edit, update, and destroy conventionally.</p></article>
            <article class="feature-card"><span>04</span><h3>Manage safely</h3><p>Validate forms, hash passwords, process avatars, and protect sessions.</p></article>
        </div>
    </div>
</section>
@endsection
