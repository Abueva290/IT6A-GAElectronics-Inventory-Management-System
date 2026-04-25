@extends('layouts.app')
@section('title', 'Add Payment')
@section('content')
<div class="row justify-content-center">
<div class="col-md-7">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fa fa-plus text-primary me-2"></i>Add Payment
        </div>
        <div class="card-body">
            <form action="{{ route('payments.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Sales Transaction <span class="text-danger">*</span></label>
                    <select name="sale_id" class="form-select @error('sale_id') is-invalid @enderror" required>
                        <option value="">— Select Sale —</option>
                        @foreach($sales as $sale)
                        <option value="{{ $sale->id }}" @selected(old('sale_id') == $sale->id)>
                            SALE-{{ str_pad($sale->id, 3, '0', STR_PAD_LEFT) }} — {{ $sale->customer->full_name ?? '' }} (₱{{ number_format($sale->total_amount, 2) }})
                        </option>
                        @endforeach
                    </select>
                    @error('sale_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Payment Date <span class="text-danger">*</span></label>
                        <input type="date" name="payment_date" class="form-control"
                               value="{{ old('payment_date', now()->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Amount Paid (₱) <span class="text-danger">*</span></label>
                        <input type="number" name="amount_paid" step="0.01" min="0.01"
                               class="form-control @error('amount_paid') is-invalid @enderror"
                               value="{{ old('amount_paid') }}" required>
                        @error('amount_paid')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Payment Method <span class="text-danger">*</span></label>
                        <select name="payment_method" class="form-select" required>
                            <option value="cash" @selected(old('payment_method') === 'cash')>Cash</option>
                            <option value="gcash" @selected(old('payment_method') === 'gcash')>GCash</option>
                            <option value="paymaya" @selected(old('payment_method') === 'paymaya')>PayMaya</option>
                            <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>Bank Transfer</option>
                            <option value="other" @selected(old('payment_method') === 'other')>Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="unpaid" @selected(old('status') === 'unpaid')>Unpaid</option>
                            <option value="partial" @selected(old('status') === 'partial')>Partial</option>
                            <option value="paid" @selected(old('status') === 'paid')>Paid</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-1"></i> Save
                    </button>
                    <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection