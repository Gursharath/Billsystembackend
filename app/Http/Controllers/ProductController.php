<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'barcode' => 'required|unique:products',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image_path' => 'nullable|string'
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required',
            'barcode' => 'sometimes|required|unique:products,barcode,' . $id,
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
            'image_path' => 'nullable|string'
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }

    public function barcode($code)
    {
        $product = Product::where('barcode', $code)->first();
        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return $product;
    }
}