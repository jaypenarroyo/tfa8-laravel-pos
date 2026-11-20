@extends('layouts.app')

@section('title', 'Edit Customer | POS Foundations')

@section('content')
<section class="page-hero form-hero">
    <div class="container narrow">
        <p class="eyebrow">Customer accounts</p>
        <h1>Edit Customer</h1>
        <p class="lead">Update the existing record for {{ $customer->full_name }}.</p>
    </div>
</section>

<section class="section form-section">
    <div class="container form-container">
        <form class="record-form" action="{{ route('customers.update', $customer) }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            @include('customers._form', ['submitLabel' => 'Save changes'])
        </form>
    </div>
</section>
@endsection
