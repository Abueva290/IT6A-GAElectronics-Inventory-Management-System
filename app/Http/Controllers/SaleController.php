<?php
namespace App\Http\Controllers;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('customer', 'employee')->latest()->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::orderBy('first_name')->get();
        $employees = Employee::orderBy('first_name')->get();
        $products  = Product::all();
        return view('sales.create', compact('customers', 'employees', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'        => 'required|exists:customers,id',
            'employee_id'        => 'required|exists:employees,id',
            'sales_date'         => 'required|date',
            'status'             => 'required|in:pending,completed,cancelled',
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $total = 0;
            $sale = Sale::create([
                'customer_id'  => $request->customer_id,
                'employee_id'  => $request->employee_id,
                'sales_date'   => $request->sales_date,
                'status'       => $request->status,
                'total_amount' => 0,
            ]);

            foreach ($request->items as $item) {
                $subtotal = $item['quantity'] * $item['unit_price'];
                $total   += $subtotal;
                SaleItem::create([
                    'sales_id'   => $sale->id,
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal'   => $subtotal,
                ]);
                $inventory = Inventory::where('product_id', $item['product_id'])->first();
                if ($inventory) {
                    $inventory->decrement('current_stock', $item['quantity']);
                }
            }
            $sale->update(['total_amount' => $total]);
        });

        return redirect()->route('sales.index')->with('success', 'Sale recorded successfully!');
    }

    public function show(Sale $sale)
    {
        $sale->load('customer', 'employee', 'saleItems.product', 'payments');
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        return view('sales.edit', compact('sale'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);
        $sale->update($request->only('status'));
        return redirect()->route('sales.index')->with('success', 'Sale updated successfully!');
    }

    public function destroy(Sale $sale)
    {
        DB::transaction(function () use ($sale) {
            foreach ($sale->saleItems as $item) {
                $inventory = Inventory::where('product_id', $item->product_id)->first();
                if ($inventory) {
                    $inventory->increment('current_stock', $item->quantity);
                }
            }
            $sale->delete();
        });
        return redirect()->route('sales.index')->with('success', 'Sale deleted and inventory restored!');
    }
}