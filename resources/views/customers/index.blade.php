@extends('layouts.app')
@section('title', 'Customers')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Customers</h4>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-1"></i> Add Customer
    </a>
</div>

<form method="GET" action="{{ route('customers.index') }}" class="mb-3">
    <div class="input-group" style="max-width:350px">
        <input type="text" name="search" class="form-control"
               placeholder="Search customer..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">
            <i class="fa fa-search"></i>
        </button>
        @if(request('search'))
        <a href="{{ route('customers.index') }}" class="btn btn-outline-danger">
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
                    <th>Full Name</th>
                    <th>Contact Info</th>
                    <th>Address</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->contact_info ?? '—' }}</td>
                    <td>{{ $customer->address ?? '—' }}</td>
                    <td class="text-end">
                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fa fa-pen"></i> Edit
                        </a>
                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this customer?')">
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
                    <td colspan="5" class="text-center text-muted py-4">No customers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($customers->hasPages())
    <div class="card-footer">{{ $customers->links() }}</div>
    @endif
</div>
@endsection