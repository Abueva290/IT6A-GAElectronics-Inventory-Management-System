@extends('layouts.app')
@section('title', 'Products')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Products</h4>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-1"></i> Add Product
    </a>
</div>

<form method="GET" action="{{ route('products.index') }}" class="mb-3">
    <div class="input-group" style="max-width:350px">
        <input type="text" name="search" class="form-control"
               placeholder="Search product..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">
            <i class="fa fa-search"></i>
        </button>
        @if(request('search'))
        <a href="{{ route('products.index') }}" class="btn btn-outline-danger">
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
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->category->category_name ?? '—' }}</td>
                    <td>{{ $product->model_number ?? '—' }}</td>
                    <td>₱{{ number_format($product->unit_price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td class="text-end">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-info me-1">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fa fa-pen"></i> Edit
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this product?')">
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
                    <td colspan="7" class="text-center text-muted py-4">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
    <div class="card-footer">{{ $products->links() }}</div>
    @endif
</div>
@endsection