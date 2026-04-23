@extends('layouts.app')
@section('title', 'Add Inventory')
@section('content')
<div class="row justify-content-center">
<div class="col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fa fa-plus text-primary me-2"></i>Add Inventory
        </div>
        <div class="card-body">
            <form action="{{ route('inventory.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Product <span class="text-danger">*</span></label>
                    <select name="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                        <option value="">— Select Product —</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                            {{ $product->product_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('product_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Current Stock <span class="text-danger">*</span></label>
                        <input type="number" name="current_stock" min="0"
                               class="form-control @error('current_stock') is-invalid @enderror"
                               value="{{ old('current_stock', 0) }}" required>
                        @error('current_stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Minimum Stock <span class="text-danger">*</span></label>
                        <input type="number" name="minimum_stock" min="0"
                               class="form-control @error('minimum_stock') is-invalid @enderror"
                               value="{{ old('minimum_stock', 0) }}" required>
                        @error('minimum_stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-1"></i> Save
                    </button>
                    <a href="{{ route('inventory.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection