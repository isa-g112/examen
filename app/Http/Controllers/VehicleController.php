<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('delivery')->get();
        return response()->json($vehicles, 200);
    }

    public function show($id)
    {
        $vehicle = Vehicle::with('delivery')->find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }

        return response()->json($vehicle, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'nullable|string|max:45',
            'model' => 'nullable|string|max:45',
            'year' => 'nullable|string|max:45',
            'plate' => 'nullable|string|max:45',
            'deliveries_iddelivery' => 'nullable|exists:deliveries,iddelivery',
        ]);

        $vehicle = Vehicle::create($validated);

        return response()->json($vehicle, 201);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }

        $validated = $request->validate([
            'brand' => 'sometimes|nullable|string|max:45',
            'model' => 'sometimes|nullable|string|max:45',
            'year' => 'sometimes|nullable|string|max:45',
            'plate' => 'sometimes|nullable|string|max:45',
            'deliveries_iddelivery' => 'sometimes|nullable|exists:deliveries,iddelivery',
        ]);

        $vehicle->update($validated);

        return response()->json($vehicle, 200);
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }

        $vehicle->delete();

        return response()->json(['message' => 'Vehicle deleted successfully'], 200);
    }
}
