<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $services = Service::with(['category', 'company'])->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Services retrieved successfully',
            'data' => $services
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
            $service = Service::create($validated);
            $service->load(['category', 'company']);

            return response()->json([
                'success' => true,
                'message' => 'Service created successfully',
                'data' => $service
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Service $service): JsonResponse
    {
        $service->load(['category', 'company']);

        return response()->json([
            'success' => true,
            'message' => 'Service retrieved successfully',
            'data' => $service
        ], 200);
    }

    public function update(Request $request, Service $service): JsonResponse
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
            $service->update($validated);
            $service->load(['category', 'company']);

            return response()->json([
                'success' => true,
                'message' => 'Service updated successfully',
                'data' => $service
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Service $service): JsonResponse
    {
        try {
            $service->delete();

            return response()->json([
                'success' => true,
                'message' => 'Service deleted successfully',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting service',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
