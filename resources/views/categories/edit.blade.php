@extends('layouts.app')
@section('title', 'Edit Category')
@section('content')
<div class="row justify-content-center">
<div class="col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fa fa-pen text-warning me-2"></i>Edit Category
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="category_name"
                           class="form-control @error('category_name') is-invalid @enderror"
                           value="{{ old('category_name', $category->category_name) }}" required>
                    @error('category_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection