<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockLog;

class StockController extends Controller
{
    public function stockIn(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $product->quantity += $validated['quantity'];
        $product->save();

        StockLog::create([
            'product_id' => $product->id,
            'type' => 'in',
            'quantity' => $validated['quantity'],
        ]);

        return response()->json(['message' => 'Stock added']);
    }

    public function stockOut(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->quantity < $validated['quantity']) {
            return response()->json(['message' => 'Not enough stock'], 422);
        }

        $product->quantity -= $validated['quantity'];
        $product->save();

        StockLog::create([
            'product_id' => $product->id,
            'type' => 'out',
            'quantity' => $validated['quantity'],
        ]);

        return response()->json(['message' => 'Stock removed']);
    }

    public function logs()
    {
    $logs = StockLog::latest()->take(6)->get(); // Get latest 5 logs
    return response()->json($logs);
}
    public function latestLogs()
{
    $logs = StockLog::latest()->take(5)->get(); // Get latest 5 logs
    return response()->json($logs);
}
}