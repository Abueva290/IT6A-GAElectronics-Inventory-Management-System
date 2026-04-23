@extends('layouts.app')
@section('title', 'Edit Inventory')
@section('content')
<div class="row justify-content-center">
<div class="col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fa fa-pen text-warning me-2"></i>Edit Inventory
        </div>
        <div class="card-body">
            <form action="{{ route('inventory.update', $inventory) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Product</label>
                    <input type="text" class="form-control" value="{{ $inventory->product->product_name }}" disabled>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Current Stock <span class="text-danger">*</span></label>
                        <input type="number" name="current_stock" min="0"
                               class="form-control @error('current_stock') is-invalid @enderror"
                               value="{{ old('current_stock', $inventory->current_stock) }}" required>
                        @error('current_stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Minimum Stock <span class="text-danger">*</span></label>
                        <input type="number" name="minimum_stock" min="0"
                               class="form-control @error('minimum_stock') is-invalid @enderror"
                               value="{{ old('minimum_stock', $inventory->minimum_stock) }}" required>
                        @error('minimum_stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('inventory.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection