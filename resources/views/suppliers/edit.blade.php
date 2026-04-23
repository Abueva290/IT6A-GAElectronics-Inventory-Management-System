@extends('layouts.app')
@section('title', 'Edit Supplier')
@section('content')
<div class="row justify-content-center">
<div class="col-md-7">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fa fa-pen text-warning me-2"></i>Edit Supplier
        </div>
        <div class="card-body">
            <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Supplier Name <span class="text-danger">*</span></label>
                    <input type="text" name="supplier_name"
                           class="form-control @error('supplier_name') is-invalid @enderror"
                           value="{{ old('supplier_name', $supplier->supplier_name) }}" required>
                    @error('supplier_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Contact Person</label>
                        <input type="text" name="contact_person" class="form-control"
                               value="{{ old('contact_person', $supplier->contact_person) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Contact Info</label>
                        <input type="text" name="contact_info" class="form-control"
                               value="{{ old('contact_info', $supplier->contact_info) }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Address</label>
                    <textarea name="address" class="form-control" rows="2">{{ old('address', $supplier->address) }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection