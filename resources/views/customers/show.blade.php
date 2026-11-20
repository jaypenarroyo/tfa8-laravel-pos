@extends('layouts.app')

@section('title', 'Customer Details | POS Foundations')

@section('content')
<section class="page-hero form-hero">
    <div class="container narrow">
        <p class="eyebrow">Customer resource</p>
        <h1>{{ $customer->full_name }}</h1>
        <p class="lead">Review this customer record before editing or deleting it.</p>
    </div>
</section>

<section class="section form-section">
    <div class="container form-container">
        <article class="record-form detail-list">
            <p><strong>Email</strong><span>{{ $customer->email }}</span></p>
            <p><strong>Phone</strong><span>{{ $customer->phone ?? 'Not provided' }}</span></p>
            <p><strong>Created</strong><span>{{ $customer->created_at }}</span></p>
            <div class="form-actions">
                <a class="button secondary" href="{{ route('customers.index') }}">Back</a>
                <a class="button primary" href="{{ route('customers.edit', $customer) }}">Edit customer</a>
            </div>
        </article>
    </div>
</section>
@endsection
