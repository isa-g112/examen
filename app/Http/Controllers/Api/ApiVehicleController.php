<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiVehicleController extends Controller
{
    public function index(): JsonResponse
    {
        $vehicles = Vehicle::with('delivery')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Vehicles retrieved successfully',
            'data' => $vehicles
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'brand' => 'nullable|string|max:45',
            'model' => 'nullable|string|max:45',
            'year' => 'nullable|string|max:45',
            'plate' => 'nullable|string|max:45',
            'deliveries_iddelivery' => 'nullable|exists:deliveries,iddelivery',
        ]);

        try {
            $vehicle = Vehicle::create($validated);
            $vehicle->load('delivery');

            return response()->json([
                'success' => true,
                'message' => 'Vehicle created successfully',
                'data' => $vehicle
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating vehicle',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Vehicle $vehicle): JsonResponse
    {
        $vehicle->load('delivery');

        return response()->json([
            'success' => true,
            'message' => 'Vehicle retrieved successfully',
            'data' => $vehicle
        ], 200);
    }

    public function update(Request $request, Vehicle $vehicle): JsonResponse
    {
        $validated = $request->validate([
            'brand' => 'nullable|string|max:45',
            'model' => 'nullable|string|max:45',
            'year' => 'nullable|string|max:45',
            'plate' => 'nullable|string|max:45',
            'deliveries_iddelivery' => 'nullable|exists:deliveries,iddelivery',
        ]);

        try {
            $vehicle->update($validated);
            $vehicle->load('delivery');

            return response()->json([
                'success' => true,
                'message' => 'Vehicle updated successfully',
                'data' => $vehicle
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating vehicle',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Vehicle $vehicle): JsonResponse
    {
        try {
            $vehicle->delete();

            return response()->json([
                'success' => true,
                'message' => 'Vehicle deleted successfully',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting vehicle',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
