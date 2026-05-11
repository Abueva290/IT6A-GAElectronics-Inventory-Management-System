@extends('layouts.app')
@section('title', 'Stock In')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fa fa-boxes-stacking text-primary me-2"></i>Stock In</h4>
    <a href="{{ route('stockin.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-1"></i> New Stock In
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Supplier</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stockIns as $s)
                <tr>
                    <td>SI-{{ str_pad($s->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $s->supplier->supplier_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($s->stockin_date)->format('M d, Y') }}</td>
                    <td>{{ $s->stockInDetails->count() }} item(s)</td>
                    <td>
                        <a href="{{ route('stockin.show', $s) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-eye"></i>
                        </a>
                        <form action="{{ route('stockin.destroy', $s) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this stock in record?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No stock in records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $stockIns->links() }}</div>
@endsection