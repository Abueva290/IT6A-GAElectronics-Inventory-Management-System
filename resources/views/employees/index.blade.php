@extends('layouts.app')
@section('title', 'Employees')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Employees</h4>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-1"></i> Add Employee
    </a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                    <th>Contact Info</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->role ?? '—' }}</td>
                    <td>{{ $employee->contact_info ?? '—' }}</td>
                    <td class="text-end">
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fa fa-pen"></i> Edit
                        </a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this employee?')">
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
                    <td colspan="6" class="text-center text-muted py-4">No employees found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($employees->hasPages())
    <div class="card-footer">{{ $employees->links() }}</div>
    @endif
</div>
@endsection