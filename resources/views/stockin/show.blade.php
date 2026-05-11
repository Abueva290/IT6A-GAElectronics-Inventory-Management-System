@extends('layouts.app')
@section('title', 'Stock In Details')
@section('content')
<div class="d-flex justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-0">SI-{{ str_pad($stockin->id, 3, '0', STR_PAD_LEFT) }}</h4>
        <small class="text-muted">{{ \Carbon\Carbon::parse($stockin->date_received)->format('F d, Y') }}</small>
    </div>
    <a href="{{ route('stockin.index') }}" class="btn btn-outline-secondary">
        <i class="fa fa-arrow-left me-1"></i> Back
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">Products Received</div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Qty Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stockin->stockInDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->product_name }}</td>
                            <td>{{ $detail->quantity_received }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">Stock In Info</div>
            <div class="card-body">
                <p class="mb-2"><strong>Supplier:</strong> {{ $stockin->supplier->supplier_name }}</p>
                <p class="mb-2"><strong>Employee:</strong> {{ $stockin->employee->first_name }} {{ $stockin->employee->last_name }}</p>
                <p class="mb-2"><strong>Date Received:</strong> {{ \Carbon\Carbon::parse($stockin->date_received)->format('F d, Y') }}</p>
                @if($stockin->delivery_receipt_no)
                <p class="mb-2"><strong>DR No.:</strong> {{ $stockin->delivery_receipt_no }}</p>
                @endif
                @if($stockin->remarks)
                <p class="mb-0"><strong>Remarks:</strong> {{ $stockin->remarks }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection