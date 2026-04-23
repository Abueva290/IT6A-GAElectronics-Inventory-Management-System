@extends('layouts.app')
@section('title', 'Edit Sale')
@section('content')
<div class="row justify-content-center">
<div class="col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fa fa-pen text-warning me-2"></i>Edit Sale
        </div>
        <div class="card-body">
            <form action="{{ route('sales.update', $sale) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="pending"   @selected($sale->status === 'pending')>Pending</option>
                        <option value="completed" @selected($sale->status === 'completed')>Completed</option>
                        <option value="cancelled" @selected($sale->status === 'cancelled')>Cancelled</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Payment Status</label>
                    <select name="payment_status" class="form-select">
                        <option value="unpaid"  @selected($sale->payment_status === 'unpaid')>Unpaid</option>
                        <option value="partial" @selected($sale->payment_status === 'partial')>Partial</option>
                        <option value="paid"    @selected($sale->payment_status === 'paid')>Paid</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection