@extends('layouts.app')

@section('title', 'Profile | POS Foundations')

@section('content')
<section class="page-hero compact">
    <div class="container narrow">
        <p class="eyebrow">Authenticated account</p>
        <h1>Profile Settings</h1>
        <p class="lead">Update your account information or change your password.</p>
    </div>
</section>

<section class="section bg-gray-100">
    <div class="container max-w-3xl space-y-6">
        <div class="p-6 bg-white shadow sm:rounded-lg">
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="p-6 bg-white shadow sm:rounded-lg">
            @include('profile.partials.update-password-form')
        </div>
    </div>
</section>
@endsection
