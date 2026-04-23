@extends('layouts.app')
@section('title', 'Add Category')
@section('content')
<div class="row justify-content-center">
<div class="col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fa fa-plus text-primary me-2"></i>Add Category
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="category_name"
                           class="form-control @error('category_name') is-invalid @enderror"
                           value="{{ old('category_name') }}" placeholder="Enter category name" required>
                    @error('category_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-1"></i> Save
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection