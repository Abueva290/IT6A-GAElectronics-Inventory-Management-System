<?php
namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\StockInDetail;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    public function index()
    {
        $stockIns = StockIn::with('supplier', 'employee')->latest()->paginate(10);
        return view('stockin.index', compact('stockIns'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('supplier_name')->get();
        $employees = Employee::orderBy('first_name')->get();
        $products  = Product::orderBy('product_name')->get();
        return view('stockin.create', compact('suppliers', 'employees', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'               => 'required|exists:suppliers,id',
            'employee_id'               => 'required|exists:employees,id',
            'date_received'             => 'required|date',
            'delivery_receipt_no'       => 'nullable|string|max:100',
            'remarks'                   => 'nullable|string',
            'items'                     => 'required|array|min:1',
            'items.*.product_id'        => 'required|exists:products,id',
            'items.*.quantity_received' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $stockIn = StockIn::create([
                'supplier_id'         => $request->supplier_id,
                'employee_id'         => $request->employee_id,
                'date_received'       => $request->date_received,
                'delivery_receipt_no' => $request->delivery_receipt_no,
                'remarks'             => $request->remarks,
            ]);

            foreach ($request->items as $item) {
                StockInDetail::create([
                    'stock_in_id'       => $stockIn->id,
                    'product_id'        => $item['product_id'],
                    'quantity_received' => $item['quantity_received'],
                ]);
            }
        });

        return redirect()->route('stockin.index')
            ->with('success', 'Stock In recorded successfully!');
    }

    public function show(StockIn $stockin)
    {
        $stockin->load('supplier', 'employee', 'stockInDetails.product');
        return view('stockin.show', compact('stockin'));
    }

    public function destroy(StockIn $stockin)
    {
        DB::transaction(function () use ($stockin) {
            foreach ($stockin->stockInDetails as $detail) {
                $inventory = \App\Models\Inventory::where('product_id', $detail->product_id)->first();
                if ($inventory) {
                    $inventory->decrement('current_stock', $detail->quantity_received);
                }
            }
            $stockin->delete();
        });

        return redirect()->route('stockin.index')
            ->with('success', 'Stock In deleted and inventory restored!');
    }
}