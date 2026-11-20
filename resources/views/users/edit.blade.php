@extends('layouts.app')

@section('title', 'Edit User | POS Foundations')

@section('content')
<section class="page-hero form-hero">
    <div class="container narrow">
        <p class="eyebrow">User accounts</p>
        <h1>Edit User</h1>
        <p class="lead">Update {{ $user->full_name }} and optionally replace the profile picture.</p>
    </div>
</section>

<section class="section form-section">
    <div class="container form-container">
        <form class="record-form" action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            @include('users._form', ['submitLabel' => 'Save changes'])
        </form>
    </div>
</section>
@endsection
