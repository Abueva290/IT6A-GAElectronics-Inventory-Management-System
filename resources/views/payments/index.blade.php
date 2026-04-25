@extends('layouts.app')
@section('title', 'Payments')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Payments</h4>
    <a href="{{ route('payments.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-1"></i> Add Payment
    </a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Sale</th>
                    <th>Customer</th>
                    <th>Payment Date</th>
                    <th>Amount Paid</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><code>SALE-{{ str_pad($payment->sale_id, 3, '0', STR_PAD_LEFT) }}</code></td>
                    <td>{{ $payment->sale->customer->full_name ?? '—' }}</td>
                    <td>{{ $payment->payment_date->format('M d, Y') }}</td>
                    <td class="fw-bold">₱{{ number_format($payment->amount_paid, 2) }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                    <td>
                        @if($payment->status === 'paid')
                            <span class="badge bg-success">Paid</span>
                        @elseif($payment->status === 'partial')
                            <span class="badge bg-warning text-dark">Partial</span>
                        @else
                            <span class="badge bg-secondary">Unpaid</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fa fa-pen"></i> Edit
                        </a>
                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this payment?')">
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
                    <td colspan="8" class="text-center text-muted py-4">No payments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($payments->hasPages())
    <div class="card-footer">{{ $payments->links() }}</div>
    @endif
</div>
@endsection