@extends('layouts.app')
@section('title', 'Edit Customer')
@section('content')
<div class="row justify-content-center">
<div class="col-md-7">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fa fa-pen text-warning me-2"></i>Edit Customer
        </div>
        <div class="card-body">
            <form action="{{ route('customers.update', $customer) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name"
                               class="form-control @error('first_name') is-invalid @enderror"
                               value="{{ old('first_name', $customer->first_name) }}" required>
                        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="last_name"
                               class="form-control @error('last_name') is-invalid @enderror"
                               value="{{ old('last_name', $customer->last_name) }}" required>
                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Contact Info</label>
                    <input type="text" name="contact_info" class="form-control"
                           value="{{ old('contact_info', $customer->contact_info) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Address</label>
                    <textarea name="address" class="form-control" rows="2">{{ old('address', $customer->address) }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection