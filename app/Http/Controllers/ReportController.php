<?php
namespace App\Http\Controllers;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Inventory;

class ReportController extends Controller
{
    public function index()
    {
        $totalRevenue     = Sale::where('status', 'completed')->sum('total_amount');
        $totalSales       = Sale::count();
        $totalProducts    = Product::count();
        $avgTransaction   = $totalSales > 0 ? $totalRevenue / $totalSales : 0;
        $recentSales      = Sale::with('customer')->latest()->take(10)->get();
        $lowStock         = Inventory::with('product')
                            ->whereColumn('current_stock', '<=', 'minimum_stock')
                            ->get();
        $monthlySales = Sale::selectRaw('MONTH(sales_date) as month, YEAR(sales_date) as year, SUM(total_amount) as total, COUNT(*) as count')
                    ->groupBy('year', 'month')
                    ->orderBy('year', 'desc')
                    ->orderBy('month', 'desc')
                    ->take(6)
                    ->get();

        return view('reports.index', compact(
            'totalRevenue', 'totalSales', 'totalProducts',
            'avgTransaction', 'recentSales', 'lowStock', 'monthlySales'
        ));
    }
}