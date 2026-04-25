@extends('layouts.app')
@section('title', 'Edit Payment')
@section('content')
<div class="row justify-content-center">
<div class="col-md-7">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fa fa-pen text-warning me-2"></i>Edit Payment
        </div>
        <div class="card-body">
            <form action="{{ route('payments.update', $payment) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Sales Transaction</label>
                    <input type="text" class="form-control" value="SALE-{{ str_pad($payment->sale_id, 3, '0', STR_PAD_LEFT) }}" disabled>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Payment Date <span class="text-danger">*</span></label>
                        <input type="date" name="payment_date" class="form-control"
                               value="{{ old('payment_date', $payment->payment_date->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Amount Paid (₱) <span class="text-danger">*</span></label>
                        <input type="number" name="amount_paid" step="0.01" min="0.01"
                               class="form-control"
                               value="{{ old('amount_paid', $payment->amount_paid) }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Payment Method <span class="text-danger">*</span></label>
                        <select name="payment_method" class="form-select" required>
                            <option value="cash" @selected(old('payment_method', $payment->payment_method) === 'cash')>Cash</option>
                            <option value="gcash" @selected(old('payment_method', $payment->payment_method) === 'gcash')>GCash</option>
                            <option value="paymaya" @selected(old('payment_method', $payment->payment_method) === 'paymaya')>PayMaya</option>
                            <option value="bank_transfer" @selected(old('payment_method', $payment->payment_method) === 'bank_transfer')>Bank Transfer</option>
                            <option value="other" @selected(old('payment_method', $payment->payment_method) === 'other')>Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="unpaid" @selected(old('status', $payment->status) === 'unpaid')>Unpaid</option>
                            <option value="partial" @selected(old('status', $payment->status) === 'partial')>Partial</option>
                            <option value="paid" @selected(old('status', $payment->status) === 'paid')>Paid</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection