<?php
namespace App\Http\Controllers;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('product')->latest()->paginate(10);
        return view('inventory.index', compact('inventories'));
    }

    public function create()
    {
        $products = Product::doesntHave('inventory')->get();
        return view('inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'    => 'required|exists:products,id|unique:inventories,product_id',
            'current_stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
        ]);
        Inventory::create($request->only(['product_id', 'current_stock', 'minimum_stock']));
        return redirect()->route('inventory.index')->with('success', 'Inventory created successfully!');
    }

    public function edit(Inventory $inventory)
    {
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'current_stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
        ]);
        $inventory->update($request->only(['current_stock', 'minimum_stock']));
        return redirect()->route('inventory.index')->with('success', 'Inventory updated successfully!');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index')->with('success', 'Inventory deleted!');
    }
}