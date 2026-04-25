<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $search = request('search');
        $products = Product::with(['category', 'supplier'])
            ->when($search, fn($q) =>
                $q->where('product_name', 'like', "%{$search}%")
                  ->orWhere('model_number', 'like', "%{$search}%")
            )->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers  = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'  => 'required|exists:suppliers,id',
            'category_id'  => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'model_number' => 'nullable|string|max:255',
        ]);
        Product::create($request->only(['supplier_id', 'category_id', 'product_name', 'model_number']));
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers  = Supplier::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'supplier_id'  => 'required|exists:suppliers,id',
            'category_id'  => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'model_number' => 'nullable|string|max:255',
        ]);
        $product->update($request->only(['supplier_id', 'category_id', 'product_name', 'model_number']));
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }
}