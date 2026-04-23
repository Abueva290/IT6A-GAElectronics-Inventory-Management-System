@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')
<div class="row justify-content-center">
<div class="col-md-8">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fa fa-pen text-warning me-2"></i>Edit Product
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="product_name"
                               class="form-control @error('product_name') is-invalid @enderror"
                               value="{{ old('product_name', $product->product_name) }}" required>
                        @error('product_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Model Number</label>
                        <input type="text" name="model_number" class="form-control"
                               value="{{ old('model_number', $product->model_number) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">— Select Category —</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                {{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Unit Price <span class="text-danger">*</span></label>
                        <input type="number" name="unit_price" step="0.01" min="0"
                               class="form-control @error('unit_price') is-invalid @enderror"
                               value="{{ old('unit_price', $product->unit_price) }}" required>
                        @error('unit_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Stock <span class="text-danger">*</span></label>
                        <input type="number" name="stock" min="0"
                               class="form-control @error('stock') is-invalid @enderror"
                               value="{{ old('stock', $product->stock) }}" required>
                        @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="2">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection