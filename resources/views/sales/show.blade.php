@extends('layouts.app')
@section('title', 'Sale Details')
@section('content')
<div class="d-flex justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-0">SALE-{{ str_pad($sale->id, 3, '0', STR_PAD_LEFT) }}</h4>
        <small class="text-muted">{{ $sale->sale_date->format('F d, Y') }}</small>
    </div>
    <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">
        <i class="fa fa-arrow-left me-1"></i> Back
    </a>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">Items Sold</div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr><th>Product</th><th>Qty</th><th>Unit Price</th><th class="text-end">Subtotal</th></tr>
                    </thead>
                    <tbody>
                        @foreach($sale->saleItems as $item)
                        <tr>
                            <td>{{ $item->product->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₱{{ number_format($item->unit_price, 2) }}</td>
                            <td class="text-end">₱{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                        <tr class="table-light fw-bold">
                            <td colspan="3" class="text-end">Total</td>
                            <td class="text-end">₱{{ number_format($sale->total_amount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">Sale Info</div>
            <div class="card-body">
                <p class="mb-2"><strong>Customer:</strong> {{ $sale->customer->full_name }}</p>
                <p class="mb-2"><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $sale->payment_method)) }}</p>
                <p class="mb-2"><strong>Status:</strong>
                    @if($sale->status === 'completed') <span class="badge bg-success">Completed</span>
                    @elseif($sale->status === 'pending') <span class="badge bg-warning text-dark">Pending</span>
                    @else <span class="badge bg-danger">Cancelled</span> @endif
                </p>
                <p class="mb-0"><strong>Payment:</strong>
                    @if($sale->payment_status === 'paid') <span class="badge bg-success">Paid</span>
                    @elseif($sale->payment_status === 'partial') <span class="badge bg-info">Partial</span>
                    @else <span class="badge bg-secondary">Unpaid</span> @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection