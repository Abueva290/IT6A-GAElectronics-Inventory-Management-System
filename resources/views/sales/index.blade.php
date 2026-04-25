@extends('layouts.app')
@section('title', 'Sales')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Sales</h4>
    <a href="{{ route('sales.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-1"></i> New Sale
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Sale ID</th>
                    <th>Customer</th>
                    <th>Employee</th>
                    <th>Sales Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><code>SALE-{{ str_pad($sale->id, 3, '0', STR_PAD_LEFT) }}</code></td>
                    <td>{{ $sale->customer->full_name ?? '—' }}</td>
                    <td>{{ $sale->employee->first_name ?? '—' }} {{ $sale->employee->last_name ?? '' }}</td>
                    <td>{{ $sale->sales_date->format('M d, Y') }}</td>
                    <td class="fw-bold">₱{{ number_format($sale->total_amount, 2) }}</td>
                    <td>
                        @if($sale->status === 'completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif($sale->status === 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @else
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-outline-info me-1">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('sales.edit', $sale) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fa fa-pen"></i>
                        </a>
                        <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this sale?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">No sales found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($sales->hasPages())
    <div class="card-footer">{{ $sales->links() }}</div>
    @endif
</div>
@endsection