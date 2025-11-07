<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiOrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::with(['user', 'company', 'product', 'service'])->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Orders retrieved successfully',
            'data' => $orders
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'name_customer' => 'required|string|max:45',
            'address' => 'required|string|max:45',
            'phone' => 'required|string|max:45',
            'status' => 'required|string|max:45',
            'quantity' => 'required|string|max:45',
            'products_idproduct' => 'nullable|exists:products,idproduct',
            'services_idservice' => 'nullable|exists:services,idservice',
            'companies_idcompany' => 'required|exists:companies,idcompany',
            'users_iduser' => 'required|exists:users,iduser',
        ]);

        try {
            $order = Order::create($validated);
            $order->load(['user', 'company', 'product', 'service']);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => $order
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Order $order): JsonResponse
    {
        $order->load(['user', 'company', 'product', 'service']);

        return response()->json([
            'success' => true,
            'message' => 'Order retrieved successfully',
            'data' => $order
        ], 200);
    }

    public function update(Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'date' => 'sometimes|required|date',
            'name_customer' => 'sometimes|required|string|max:45',
            'address' => 'sometimes|required|string|max:45',
            'phone' => 'sometimes|required|string|max:45',
            'status' => 'sometimes|required|string|max:45',
            'quantity' => 'sometimes|required|string|max:45',
            'products_idproduct' => 'nullable|exists:products,idproduct',
            'services_idservice' => 'nullable|exists:services,idservice',
            'companies_idcompany' => 'sometimes|required|exists:companies,idcompany',
            'users_iduser' => 'sometimes|required|exists:users,iduser',
        ]);

        try {
            $order->update($validated);
            $order->load(['user', 'company', 'product', 'service']);

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully',
                'data' => $order
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Order $order): JsonResponse
    {
        try {
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
