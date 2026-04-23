<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $search = request('search');
        $products = Product::with('category')->when($search, fn($q) =>
            $q->where('product_name', 'like', "%{$search}%")
              ->orWhere('model_number', 'like', "%{$search}%")
        )->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'model_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'unit_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'model_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'unit_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }
}