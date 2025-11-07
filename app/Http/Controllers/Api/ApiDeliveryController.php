<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiDeliveryController extends Controller
{
    public function index(): JsonResponse
    {
        $deliveries = Delivery::with(['user', 'vehicles'])->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Deliveries retrieved successfully',
            'data' => $deliveries
        ], 200);
    }

    public function store(Request $request): JsonResponse
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

        try {
            $delivery = Delivery::create($validated);
            $delivery->load(['user', 'vehicles']);

            return response()->json([
                'success' => true,
                'message' => 'Delivery created successfully',
                'data' => $delivery
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating delivery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Delivery $delivery): JsonResponse
    {
        $delivery->load(['user', 'vehicles']);

        return response()->json([
            'success' => true,
            'message' => 'Delivery retrieved successfully',
            'data' => $delivery
        ], 200);
    }

    public function update(Request $request, Delivery $delivery): JsonResponse
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
            'users_iduser' => 'sometimes|required|exists:users,iduser',
        ]);

        try {
            $delivery->update($validated);
            $delivery->load(['user', 'vehicles']);

            return response()->json([
                'success' => true,
                'message' => 'Delivery updated successfully',
                'data' => $delivery
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating delivery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Delivery $delivery): JsonResponse
    {
        try {
            $delivery->delete();

            return response()->json([
                'success' => true,
                'message' => 'Delivery deleted successfully',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting delivery',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
