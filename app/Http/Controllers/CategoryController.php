<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $search = request('search');
        $categories = Category::when($search, fn($q) =>
            $q->where('category_name', 'like', "%{$search}%")
        )->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories'
        ]);
        Category::create($request->only('category_name'));
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,'.$category->id
        ]);
        $category->update($request->only('category_name'));
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted!');
    }
}