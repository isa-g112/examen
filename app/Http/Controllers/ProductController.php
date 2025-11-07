<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'company'])->get();
        return response()->json($products, 200);
    }

    public function show($id)
    {
        $product = Product::with(['category', 'company'])->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'description' => 'nullable|string|max:45',
            'price' => 'required|string|max:45',
            'image' => 'nullable|string|max:45',
            'categories_idcategory' => 'required|exists:categories,idcategory',
            'companies_idcompany' => 'required|exists:companies,idcompany',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:45',
            'description' => 'sometimes|nullable|string|max:45',
            'price' => 'sometimes|string|max:45',
            'image' => 'sometimes|nullable|string|max:45',
            'categories_idcategory' => 'sometimes|exists:categories,idcategory',
            'companies_idcompany' => 'sometimes|exists:companies,idcompany',
        ]);

        $product->update($validated);

        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
