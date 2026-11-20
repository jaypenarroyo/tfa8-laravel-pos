@extends('layouts.app')

@section('title', 'Create Customer | POS Foundations')

@section('content')
<section class="page-hero form-hero">
    <div class="container narrow">
        <p class="eyebrow">Customer accounts</p>
        <h1>Create Customer</h1>
        <p class="lead">Add a customer record with validated contact information.</p>
    </div>
</section>

<section class="section form-section">
    <div class="container form-container">
        <form class="record-form" action="{{ route('customers.store') }}" method="POST" novalidate>
            @csrf
            @include('customers._form', ['submitLabel' => 'Create customer'])
        </form>
    </div>
</section>
@endsection
