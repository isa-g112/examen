<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiCartController extends Controller
{
    public function index(): JsonResponse
    {
        $carts = Cart::with(['user', 'product', 'service'])->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Carts retrieved successfully',
            'data' => $carts
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'iduser' => 'required|exists:users,iduser',
            'products_idproduct' => 'nullable|exists:products,idproduct',
            'services_idservice' => 'nullable|exists:services,idservice',
        ]);

        try {
            $cart = Cart::create($validated);
            $cart->load(['user', 'product', 'service']);

            return response()->json([
                'success' => true,
                'message' => 'Cart created successfully',
                'data' => $cart
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Cart $cart): JsonResponse
    {
        $cart->load(['user', 'product', 'service']);

        return response()->json([
            'success' => true,
            'message' => 'Cart retrieved successfully',
            'data' => $cart
        ], 200);
    }

    public function update(Request $request, Cart $cart): JsonResponse
    {
        $validated = $request->validate([
            'iduser' => 'sometimes|required|exists:users,iduser',
            'products_idproduct' => 'nullable|exists:products,idproduct',
            'services_idservice' => 'nullable|exists:services,idservice',
        ]);

        try {
            $cart->update($validated);
            $cart->load(['user', 'product', 'service']);

            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
                'data' => $cart
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Cart $cart): JsonResponse
    {
        try {
            $cart->delete();

            return response()->json([
                'success' => true,
                'message' => 'Cart deleted successfully',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
