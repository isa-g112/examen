<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['category', 'company'])->get();
        return response()->json($services, 200);
    }

    public function show($id)
    {
        $service = Service::with(['category', 'company'])->find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        return response()->json($service, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'description' => 'nullable|string|max:45',
            'price' => 'required|string|max:45',
            'image' => 'nullable|string|max:45',
            'categories_idcategory' => 'required|exists:categories,idcategory',
            'companies_idcompany' => 'required|exists:companies,idcompany',
        ]);

        $service = Service::create($validated);

        return response()->json($service, 201);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:45',
            'description' => 'sometimes|nullable|string|max:45',
            'price' => 'sometimes|string|max:45',
            'image' => 'sometimes|nullable|string|max:45',
            'categories_idcategory' => 'sometimes|exists:categories,idcategory',
            'companies_idcompany' => 'sometimes|exists:companies,idcompany',
        ]);

        $service->update($validated);

        return response()->json($service, 200);
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $service->delete();

        return response()->json(['message' => 'Service deleted successfully'], 200);
    }
}
