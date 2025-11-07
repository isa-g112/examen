<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'company', 'product', 'service'])->get();
        return response()->json($orders, 200);
    }

    public function show($id)
    {
        $order = Order::with(['user', 'company', 'product', 'service'])->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order, 200);
    }

    public function store(Request $request)
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

        $order = Order::create($validated);

        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $validated = $request->validate([
            'date' => 'sometimes|date',
            'name_customer' => 'sometimes|string|max:45',
            'address' => 'sometimes|string|max:45',
            'phone' => 'sometimes|string|max:45',
            'status' => 'sometimes|string|max:45',
            'quantity' => 'sometimes|string|max:45',
            'products_idproduct' => 'sometimes|nullable|exists:products,idproduct',
            'services_idservice' => 'sometimes|nullable|exists:services,idservice',
            'companies_idcompany' => 'sometimes|exists:companies,idcompany',
            'users_iduser' => 'sometimes|exists:users,iduser',
        ]);

        $order->update($validated);

        return response()->json($order, 200);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
