<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::with('user')->get();
        return response()->json($deliveries, 200);
    }

    public function show($id)
    {
        $delivery = Delivery::with('user')->find($id);

        if (!$delivery) {
            return response()->json(['message' => 'Delivery not found'], 404);
        }

        return response()->json($delivery, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gender' => 'nullable|string|max:45',
            'birth_day' => 'nullable|date',
            'vehicle_type' => 'nullable|string|max:45',
            'dni_document_front' => 'nullable|string|max:45',
            'dni_document_back' => 'nullable|string|max:45',
            'driving_license' => 'nullable|string|max:45',
            'transit_license' => 'nullable|string|max:45',
            'profile_photo' => 'nullable|string|max:45',
            'users_iduser' => 'required|exists:users,iduser',
        ]);

        $delivery = Delivery::create($validated);

        return response()->json($delivery, 201);
    }

    public function update(Request $request, $id)
    {
        $delivery = Delivery::find($id);

        if (!$delivery) {
            return response()->json(['message' => 'Delivery not found'], 404);
        }

        $validated = $request->validate([
            'gender' => 'sometimes|nullable|string|max:45',
            'birth_day' => 'sometimes|nullable|date',
            'vehicle_type' => 'sometimes|nullable|string|max:45',
            'dni_document_front' => 'sometimes|nullable|string|max:45',
            'dni_document_back' => 'sometimes|nullable|string|max:45',
            'driving_license' => 'sometimes|nullable|string|max:45',
            'transit_license' => 'sometimes|nullable|string|max:45',
            'profile_photo' => 'sometimes|nullable|string|max:45',
            'users_iduser' => 'sometimes|exists:users,iduser',
        ]);

        $delivery->update($validated);

        return response()->json($delivery, 200);
    }

    public function destroy($id)
    {
        $delivery = Delivery::find($id);

        if (!$delivery) {
            return response()->json(['message' => 'Delivery not found'], 404);
        }

        $delivery->delete();

        return response()->json(['message' => 'Delivery deleted successfully'], 200);
    }
}
