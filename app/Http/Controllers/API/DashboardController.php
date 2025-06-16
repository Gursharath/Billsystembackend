<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Invoice;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getStats(Request $request)
    {
        try {
            $totalProducts = Product::count();

            // Define low stock as products with quantity less than 5
            $lowStock = Product::where('quantity', '<', 5)->count();

            // Sum of today's sales (invoices created today)
            $todaySales = Invoice::whereDate('created_at', Carbon::today())->sum('total');

            return response()->json([
                'total_products' => $totalProducts,
                'low_stock' => $lowStock,
                'today_sales' => $todaySales,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch dashboard stats',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
