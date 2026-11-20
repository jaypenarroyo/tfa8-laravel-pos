@extends('layouts.app')

@section('title', 'About | POS Foundations')

@section('content')
<section class="page-hero">
    <div class="container narrow">
        <p class="eyebrow">About the application</p>
        <h1>Securing POS resource management with Laravel conventions.</h1>
        <p class="lead">TFA8 refactors customer and user management into resource controllers and protects every management route with Breeze authentication.</p>
    </div>
</section>

<section class="section">
    <div class="container two-column">
        <div>
            <h2>Purpose</h2>
            <p>The application uses one resource route per managed model. Laravel maps those routes to focused controller actions for listing, creating, reading, editing, updating, and deleting records.</p>
            <p>Laravel Breeze provides secure registration, login, logout, password hashing, and session handling. The auth middleware redirects unauthenticated visitors to the login page before protected data can be reached.</p>
        </div>
        <div class="stack-list">
            <article><strong>Resource routes</strong><span>Seven conventional CRUD actions for customers and users</span></article>
            <article><strong>Authentication</strong><span>Breeze controllers and views for registration, login, logout, and passwords</span></article>
            <article><strong>Access control</strong><span>Auth middleware around both account-management resources</span></article>
            <article><strong>Security</strong><span>Hashed passwords, regenerated sessions, CSRF protection, and validation</span></article>
        </div>
    </div>
</section>
@endsection
