@extends('layouts.app')
@section('title', 'New Stock In')
@section('content')
<div class="row justify-content-center">
<div class="col-lg-9">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fa fa-boxes-stacking text-primary me-2"></i>New Stock In
        </div>
        <div class="card-body">
            <form action="{{ route('stockin.store') }}" method="POST">
                @csrf

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Supplier <span class="text-danger">*</span></label>
                        <select name="supplier_id" class="form-select" required>
                            <option value="">— Select Supplier —</option>
                            @foreach($suppliers as $s)
                            <option value="{{ $s->id }}" @selected(old('supplier_id') == $s->id)>
                                {{ $s->supplier_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Employee <span class="text-danger">*</span></label>
                        <select name="employee_id" class="form-select" required>
                            <option value="">— Select Employee —</option>
                            @foreach($employees as $e)
                            <option value="{{ $e->id }}" @selected(old('employee_id') == $e->id)>
                                {{ $e->first_name }} {{ $e->last_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Date Received <span class="text-danger">*</span></label>
                        <input type="date" name="date_received" class="form-control"
                               value="{{ old('date_received', now()->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Delivery Receipt No.</label>
                        <input type="text" name="delivery_receipt_no" class="form-control"
                               value="{{ old('delivery_receipt_no') }}" placeholder="e.g. DR-2026-001">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Remarks</label>
                    <textarea name="remarks" class="form-control" rows="2"
                              placeholder="Optional notes...">{{ old('remarks') }}</textarea>
                </div>

                <hr>
                <h6 class="fw-bold mb-3"><i class="fa fa-list me-2"></i>Products Received</h6>
                <div id="itemsContainer">
                    <div class="row item-row align-items-end mb-2">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Product</label>
                            <select name="items[0][product_id]" class="form-select" required>
                                <option value="">— Select Product —</option>
                                @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Qty Received</label>
                            <input type="number" name="items[0][quantity_received]"
                                   class="form-control" min="1" value="1" required>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-danger btn-sm remove-row">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="button" id="addItem" class="btn btn-outline-secondary btn-sm mb-3">
                    <i class="fa fa-plus me-1"></i> Add Product
                </button>

                <div class="d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-1"></i> Save Stock In
                    </button>
                    <a href="{{ route('stockin.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script>
let index = 1;
document.getElementById('addItem').addEventListener('click', function() {
    const tpl = document.querySelector('.item-row').cloneNode(true);
    tpl.querySelectorAll('[name]').forEach(el => {
        el.name = el.name.replace(/\[\d+\]/, `[${index}]`);
        el.value = el.tagName === 'SELECT' ? '' : 1;
    });
    document.getElementById('itemsContainer').appendChild(tpl);
    index++;
});
document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-row')) {
        const rows = document.querySelectorAll('.item-row');
        if (rows.length > 1) e.target.closest('.item-row').remove();
    }
});
</script>
@endpush