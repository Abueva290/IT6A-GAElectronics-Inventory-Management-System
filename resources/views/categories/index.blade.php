@extends('layouts.app')
@section('title', 'Categories')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Categories</h4>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-1"></i> Add Category
    </a>
</div>

{{-- Search Bar --}}
<form method="GET" action="{{ route('categories.index') }}" class="mb-3">
    <div class="input-group" style="max-width:350px">
        <input type="text" name="search" class="form-control"
               placeholder="Search category..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">
            <i class="fa fa-search"></i>
        </button>
        @if(request('search'))
        <a href="{{ route('categories.index') }}" class="btn btn-outline-danger">
            <i class="fa fa-x"></i>
        </a>
        @endif
    </div>
</form>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->created_at->format('M d, Y') }}</td>
                    <td class="text-end">
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fa fa-pen"></i> Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        No categories found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())
    <div class="card-footer">{{ $categories->links() }}</div>
    @endif
</div>
@endsection