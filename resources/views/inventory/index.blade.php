@extends('layouts.app')
@section('title', 'Inventory')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Inventory</h4>
    <a href="{{ route('inventory.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-1"></i> Add Inventory
    </a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Current Stock</th>
                    <th>Minimum Stock</th>
                    <th>Updated At</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventories as $inventory)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $inventory->product->product_name ?? '—' }}</td>
                    <td>{{ $inventory->current_stock }}</td>
                    <td>{{ $inventory->minimum_stock }}</td>
                    <td>{{ $inventory->updated_at->format('Y-m-d H:i') }}</td>
                    <td class="text-end">
                        <a href="{{ route('inventory.edit', $inventory) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fa fa-pen"></i> Edit
                        </a>
                        <form action="{{ route('inventory.destroy', $inventory) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this inventory?')">
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
                    <td colspan="6" class="text-center text-muted py-4">No inventory records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($inventories->hasPages())
    <div class="card-footer">{{ $inventories->links() }}</div>
    @endif
</div>
@endsection