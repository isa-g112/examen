<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['user', 'product', 'service'])->get();
        return response()->json($carts, 200);
    }

    public function show($id)
    {
        $cart = Cart::with(['user', 'product', 'service'])->find($id);

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        return response()->json($cart, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'iduser' => 'required|exists:users,iduser',
            'products_idproduct' => 'nullable|exists:products,idproduct',
            'services_idservice' => 'nullable|exists:services,idservice',
        ]);

        $cart = Cart::create($validated);

        return response()->json($cart, 201);
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $validated = $request->validate([
            'iduser' => 'sometimes|exists:users,iduser',
            'products_idproduct' => 'sometimes|nullable|exists:products,idproduct',
            'services_idservice' => 'sometimes|nullable|exists:services,idservice',
        ]);

        $cart->update($validated);

        return response()->json($cart, 200);
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $cart->delete();

        return response()->json(['message' => 'Cart deleted successfully'], 200);
    }
}
