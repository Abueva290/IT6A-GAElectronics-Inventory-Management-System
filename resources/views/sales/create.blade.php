@extends('layouts.app')
@section('title', 'New Sale')
@section('content')
<div class="row justify-content-center">
<div class="col-lg-9">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fa fa-cart-shopping text-primary me-2"></i>New Sale
        </div>
        <div class="card-body">
            <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
                @csrf

                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fa fa-triangle-exclamation me-1"></i> Error:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <input type="hidden" name="status" value="pending">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Customer <span class="text-danger">*</span></label>
                        <select name="customer_id" id="customerSelect" class="form-select @error('customer_id') is-invalid @enderror" required>
                            <option value="">— Select Customer —</option>
                            @foreach($customers as $c)
                            <option value="{{ $c->id }}" @selected(old('customer_id') == $c->id)>
                                {{ $c->full_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('customer_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Sales Date <span class="text-danger">*</span></label>
                        <input type="date" name="sales_date" class="form-control"
                               value="{{ old('sales_date', now()->format('Y-m-d')) }}" required>
                    </div>
                </div>

                <hr>
                <h6 class="fw-bold mb-3"><i class="fa fa-list me-2"></i>Product Items</h6>

                <script>
                    const productPrices = {
                        @foreach($products as $p)
                            {{ $p->id }}: {{ $p->unit_price ?? 0 }},
                        @endforeach
                    };
                </script>

                <div id="itemsContainer">
                    <div class="row item-row align-items-end mb-2">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Product</label>
                            <select name="items[0][product_id]" class="form-select product-select" required>
                                <option value="">— Select Product —</option>
                                @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Qty</label>
                            <input type="number" name="items[0][quantity]" class="form-control qty-input" min="1" value="1" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Unit Price (₱)</label>
                            <input type="number" name="items[0][unit_price]" class="form-control price-input bg-light" step="0.01" min="0" readonly required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Subtotal</label>
                            <input type="text" class="form-control subtotal-input" readonly value="0.00">
                        </div>
                    </div>
                </div>

                <button type="button" id="addItem" class="btn btn-outline-secondary btn-sm mb-3">
                    <i class="fa fa-plus me-1"></i> Add Item
                </button>

                <div class="text-end mb-3">
                    <h5>Total: ₱<span id="grandTotal">0.00</span></h5>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-1"></i> Save Sale
                    </button>
                    <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
{{-- Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
// Init Select2 for Customer
$(document).ready(function() {
    $('#customerSelect').select2({
        placeholder: '— Search Customer —',
        allowClear: true,
        width: '100%'
    });
});

let index = 1;

function calcTotal() {
    let grand = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const qty   = parseFloat(row.querySelector('.qty-input').value) || 0;
        const price = parseFloat(row.querySelector('.price-input').value) || 0;
        const sub   = qty * price;
        row.querySelector('.subtotal-input').value = sub.toFixed(2);
        grand += sub;
    });
    document.getElementById('grandTotal').textContent = grand.toFixed(2);
}

document.addEventListener('change', function(e) {
    if (e.target.classList.contains('product-select')) {
        const productId = e.target.value;
        const priceInput = e.target.closest('.item-row').querySelector('.price-input');
        priceInput.value = productId ? (productPrices[productId] || 0).toFixed(2) : '';
        calcTotal();
    }
    if (e.target.classList.contains('qty-input')) {
        calcTotal();
    }
});

document.getElementById('addItem').addEventListener('click', function() {
    const tpl = document.querySelector('.item-row').cloneNode(true);
    tpl.querySelectorAll('[name]').forEach(el => {
        el.name = el.name.replace(/\[\d+\]/, `[${index}]`);
        if (!el.classList.contains('subtotal-input')) el.value = '';
    });
    document.getElementById('itemsContainer').appendChild(tpl);
    index++;
});
</script>
@endpush