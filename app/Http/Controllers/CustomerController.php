<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $search = request('search');
        $customers = Customer::when($search, fn($q) =>
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('contact_info', 'like', "%{$search}%")
        )->latest()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'address'      => 'nullable|string',
        ]);
        Customer::create($request->only(['first_name', 'last_name', 'contact_info', 'address']));
        return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'address'      => 'nullable|string',
        ]);
        $customer->update($request->only(['first_name', 'last_name', 'contact_info', 'address']));
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted!');
    }
}