@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-center p-4 border-0 shadow-sm">
            <i class="fa fa-tags fa-2x text-primary mb-2"></i>
            <h4 class="fw-bold">{{ \App\Models\Category::count() }}</h4>
            <p class="text-muted mb-0">Categories</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-4 border-0 shadow-sm">
            <i class="fa fa-box fa-2x text-warning mb-2"></i>
            <h4 class="fw-bold">{{ \App\Models\Product::count() }}</h4>
            <p class="text-muted mb-0">Products</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-4 border-0 shadow-sm">
            <i class="fa fa-users fa-2x text-success mb-2"></i>
            <h4 class="fw-bold">{{ \App\Models\Customer::count() }}</h4>
            <p class="text-muted mb-0">Customers</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-4 border-0 shadow-sm">
            <i class="fa fa-cart-shopping fa-2x text-danger mb-2"></i>
            <h4 class="fw-bold">{{ \App\Models\Sale::count() }}</h4>
            <p class="text-muted mb-0">Total Sales</p>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Recent Sales --}}
    <div class="col-md-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="fa fa-cart-shopping text-primary me-2"></i>Recent Sales</span>
                <a href="{{ route('sales.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr><th>Sale ID</th><th>Customer</th><th>Total</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Sale::with('customer')->latest()->take(5)->get() as $sale)
                        <tr>
                            <td><a href="{{ route('sales.show', $sale) }}">SALE-{{ str_pad($sale->id, 3,'0',STR_PAD_LEFT) }}</a></td>
                            <td>{{ $sale->customer->full_name ?? '—' }}</td>
                            <td>₱{{ number_format($sale->total_amount, 2) }}</td>
                            <td>
                                @if($sale->status === 'completed') <span class="badge bg-success">Done</span>
                                @elseif($sale->status === 'pending') <span class="badge bg-warning text-dark">Pending</span>
                                @else <span class="badge bg-danger">Cancelled</span> @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">No sales yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Low Stock Alert --}}
    <div class="col-md-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="fa fa-triangle-exclamation text-warning me-2"></i>Low Stock Alert</span>
                <a href="{{ route('inventory.index') }}" class="btn btn-sm btn-outline-warning">View All</a>
            </div>
            <div class="card-body">
                @forelse(\App\Models\Inventory::with('product')->whereColumn('current_stock', '<=', 'minimum_stock')->get() as $item)
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <div>
                        <div class="fw-semibold">{{ $item->product->product_name }}</div>
                        <small class="text-muted">Min: {{ $item->minimum_stock }}</small>
                    </div>
                    @if($item->current_stock === 0)
                        <span class="badge bg-danger">Out of Stock</span>
                    @else
                        <span class="badge bg-warning text-dark">{{ $item->current_stock }} left</span>
                    @endif
                </div>
                @empty
                <p class="text-success mb-0"><i class="fa fa-circle-check me-2"></i>All stock levels are healthy!</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection