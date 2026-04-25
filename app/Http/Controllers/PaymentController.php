<?php
namespace App\Http\Controllers;
use App\Models\Payment;
use App\Models\Sale;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('sale.customer')->latest()->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $sales = Sale::with('customer')->get();
        return view('payments.create', compact('sales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_id'        => 'required|exists:sales,id',
            'payment_date'   => 'required|date',
            'amount_paid'    => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,gcash,paymaya,bank_transfer,other',
            'status'         => 'required|in:paid,partial,unpaid',
        ]);
        Payment::create($request->only(['sale_id', 'payment_date', 'amount_paid', 'payment_method', 'status']));
        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully!');
    }

    public function edit(Payment $payment)
    {
        $sales = Sale::with('customer')->get();
        return view('payments.edit', compact('payment', 'sales'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'payment_date'   => 'required|date',
            'amount_paid'    => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,gcash,paymaya,bank_transfer,other',
            'status'         => 'required|in:paid,partial,unpaid',
        ]);
        $payment->update($request->only(['payment_date', 'amount_paid', 'payment_method', 'status']));
        return redirect()->route('payments.index')->with('success', 'Payment updated successfully!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted!');
    }
}