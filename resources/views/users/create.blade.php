@extends('layouts.app')

@section('title', 'Create User | POS Foundations')

@section('content')
<section class="page-hero form-hero">
    <div class="container narrow">
        <p class="eyebrow">User accounts</p>
        <h1>Create User</h1>
        <p class="lead">Create a secured account with a unique username, email address, and password.</p>
    </div>
</section>

<section class="section form-section">
    <div class="container form-container">
        <form class="record-form" action="{{ route('users.store') }}" method="POST" novalidate>
            @csrf
            @include('users._form', ['submitLabel' => 'Create user'])
        </form>
    </div>
</section>
@endsection
