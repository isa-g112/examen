<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::with(['category', 'company'])->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data' => $products
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'description' => 'nullable|string|max:45',
            'price' => 'required|string|max:45',
            'image' => 'nullable|string|max:45',
            'categories_idcategory' => 'required|exists:categories,idcategory',
            'companies_idcompany' => 'required|exists:companies,idcompany',
        ]);

        try {
            $product = Product::create($validated);
            $product->load(['category', 'company']);

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'data' => $product
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Product $product): JsonResponse
    {
        $product->load(['category', 'company']);

        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully',
            'data' => $product
        ], 200);
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:45',
            'description' => 'nullable|string|max:45',
            'price' => 'sometimes|required|string|max:45',
            'image' => 'nullable|string|max:45',
            'categories_idcategory' => 'sometimes|required|exists:categories,idcategory',
            'companies_idcompany' => 'sometimes|required|exists:companies,idcompany',
        ]);

        try {
            $product->update($validated);
            $product->load(['category', 'company']);

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'data' => $product
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Product $product): JsonResponse
    {
        try {
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
