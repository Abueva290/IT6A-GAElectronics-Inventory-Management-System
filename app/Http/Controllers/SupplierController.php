<?php
namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $search = request('search');
        $suppliers = Supplier::when($search, fn($q) =>
            $q->where('supplier_name', 'like', "%{$search}%")
              ->orWhere('contact_person', 'like', "%{$search}%")
        )->latest()->paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);
        Supplier::create($request->all());
        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully!');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);
        $supplier->update($request->all());
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted!');
    }
}