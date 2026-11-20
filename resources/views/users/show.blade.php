@extends('layouts.app')

@section('title', 'User Details | POS Foundations')

@section('content')
<section class="page-hero form-hero">
    <div class="container narrow">
        <p class="eyebrow">User resource</p>
        <h1>{{ $user->full_name }}</h1>
        <p class="lead">Review this secured user account and its profile picture.</p>
    </div>
</section>

<section class="section form-section">
    <div class="container form-container">
        <article class="record-form detail-list">
            <img class="avatar-preview" src="{{ $user->avatar ? Storage::disk('public')->url($user->avatar) : asset('images/avatar-placeholder.svg') }}" alt="Avatar for {{ $user->full_name }}">
            <p><strong>Username</strong><span>{{ $user->username }}</span></p>
            <p><strong>Email</strong><span>{{ $user->email }}</span></p>
            <p><strong>Created</strong><span>{{ $user->created_at }}</span></p>
            <div class="form-actions">
                <a class="button secondary" href="{{ route('users.index') }}">Back</a>
                <a class="button primary" href="{{ route('users.edit', $user) }}">Edit user</a>
            </div>
        </article>
    </div>
</section>
@endsection
