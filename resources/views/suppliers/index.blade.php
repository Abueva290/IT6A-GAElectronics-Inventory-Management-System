@extends('layouts.app')
@section('title', 'Suppliers')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Suppliers</h4>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-1"></i> Add Supplier
    </a>
</div>

<form method="GET" action="{{ route('suppliers.index') }}" class="mb-3">
    <div class="input-group" style="max-width:350px">
        <input type="text" name="search" class="form-control"
               placeholder="Search supplier..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">
            <i class="fa fa-search"></i>
        </button>
        @if(request('search'))
        <a href="{{ route('suppliers.index') }}" class="btn btn-outline-danger">
            <i class="fa fa-x"></i>
        </a>
        @endif
    </div>
</form>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Supplier Name</th>
                    <th>Contact Person</th>
                    <th>Contact Info</th>
                    <th>Address</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->supplier_name }}</td>
                    <td>{{ $supplier->contact_person ?? '—' }}</td>
                    <td>{{ $supplier->contact_info ?? '—' }}</td>
                    <td>{{ $supplier->address ?? '—' }}</td>
                    <td class="text-end">
                        <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fa fa-pen"></i> Edit
                        </a>
                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this supplier?')">
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
                    <td colspan="6" class="text-center text-muted py-4">No suppliers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($suppliers->hasPages())
    <div class="card-footer">{{ $suppliers->links() }}</div>
    @endif
</div>
@endsection