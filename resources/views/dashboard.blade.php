@extends('layouts.app')

@section('title', 'Dashboard | POS Foundations')

@section('content')
<section class="page-hero">
    <div class="container narrow">
        <p class="eyebrow">Authenticated session</p>
        <h1>Welcome, {{ auth()->user()->full_name }}</h1>
        <p class="lead">You are logged in and can securely manage customer and user resources.</p>
        <div class="button-row">
            <a class="button primary" href="{{ route('customers.index') }}">Manage customers</a>
            <a class="button secondary" href="{{ route('users.index') }}">Manage users</a>
        </div>
    </div>
</section>
@endsection
