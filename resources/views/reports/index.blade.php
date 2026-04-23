@extends('layouts.app')
@section('title', 'Reports & Analytics')
@section('content')

{{-- KPI Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <i class="fa fa-peso-sign fa-2x text-success mb-2"></i>
            <h4 class="fw-bold">₱{{ number_format($totalRevenue, 2) }}</h4>
            <p class="text-muted mb-0">Total Revenue</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <i class="fa fa-cart-shopping fa-2x text-primary mb-2"></i>
            <h4 class="fw-bold">{{ $totalSales }}</h4>
            <p class="text-muted mb-0">Total Sales</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <i class="fa fa-box fa-2x text-warning mb-2"></i>
            <h4 class="fw-bold">{{ $totalProducts }}</h4>
            <p class="text-muted mb-0">Total Products</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <i class="fa fa-chart-line fa-2x text-info mb-2"></i>
            <h4 class="fw-bold">₱{{ number_format($avgTransaction, 2) }}</h4>
            <p class="text-muted mb-0">Avg. Transaction</p>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Monthly Sales --}}
    <div class="col-md-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">
                <i class="fa fa-chart-bar text-primary me-2"></i>Monthly Sales Summary
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Month</th>
                            <th>Total Sales</th>
                            <th>Transactions</th>
                            <th>Avg. per Transaction</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($monthlySales as $monthly)
                        <tr>
                            <td>{{ \Carbon\Carbon::create($monthly->year, $monthly->month)->format('F Y') }}</td>
                            <td class="fw-bold text-success">₱{{ number_format($monthly->total, 2) }}</td>
                            <td>{{ $monthly->count }}</td>
                            <td>₱{{ number_format($monthly->count > 0 ? $monthly->total / $monthly->count : 0, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No sales data yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Low Stock Alert --}}
    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">
                <i class="fa fa-triangle-exclamation text-warning me-2"></i>Low Stock Alert
            </div>
            <div class="card-body">
                @forelse($lowStock as $item)
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
                <p class="text-success mb-0">
                    <i class="fa fa-circle-check me-2"></i>All stock levels are healthy!
                </p>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Recent Sales --}}
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white fw-bold">
        <i class="fa fa-clock-rotate-left text-info me-2"></i>Recent Sales
    </div>
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>Sale ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentSales as $sale)
                <tr>
                    <td><a href="{{ route('sales.show', $sale) }}">SALE-{{ str_pad($sale->id, 3, '0', STR_PAD_LEFT) }}</a></td>
                    <td>{{ $sale->customer->full_name ?? '—' }}</td>
                    <td>{{ $sale->sale_date->format('M d, Y') }}</td>
                    <td class="fw-bold">₱{{ number_format($sale->total_amount, 2) }}</td>
                    <td>
                        @if($sale->status === 'completed') <span class="badge bg-success">Completed</span>
                        @elseif($sale->status === 'pending') <span class="badge bg-warning text-dark">Pending</span>
                        @else <span class="badge bg-danger">Cancelled</span> @endif
                    </td>
                    <td>
                        @if($sale->payment_status === 'paid') <span class="badge bg-success">Paid</span>
                        @elseif($sale->payment_status === 'partial') <span class="badge bg-info">Partial</span>
                        @else <span class="badge bg-secondary">Unpaid</span> @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No sales yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection