@extends('layouts.app')
@section('title', $product->product_name)
@section('content')
<div class="row justify-content-center">
<div class="col-md-7">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="fa fa-box text-primary me-2"></i>Product Details</span>
            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-warning">
                <i class="fa fa-pen me-1"></i> Edit
            </a>
        </div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-4">Product Name</dt>
                <dd class="col-sm-8">{{ $product->product_name }}</dd>

                <dt class="col-sm-4">Model Number</dt>
                <dd class="col-sm-8">{{ $product->model_number ?? '—' }}</dd>

                <dt class="col-sm-4">Category</dt>
                <dd class="col-sm-8">{{ $product->category->category_name ?? '—' }}</dd>

                <dt class="col-sm-4">Unit Price</dt>
                <dd class="col-sm-8 text-success fw-bold">₱{{ number_format($product->unit_price, 2) }}</dd>

                <dt class="col-sm-4">Stock</dt>
                <dd class="col-sm-8">{{ $product->stock }}</dd>

                <dt class="col-sm-4">Description</dt>
                <dd class="col-sm-8">{{ $product->description ?? '—' }}</dd>
            </dl>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            <i class="fa fa-arrow-left me-1"></i> Back
        </a>
    </div>
</div>
</div>
@endsection