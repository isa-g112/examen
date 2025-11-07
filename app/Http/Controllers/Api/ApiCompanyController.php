<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use Illuminate\Http\JsonResponse;

class ApiCompanyController extends Controller
{

    public function index(): JsonResponse
    {
        $companies = Company::with('user')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Companies retrieved successfully',
            'data' => $companies
        ], 200);
    }


    public function store(StoreCompanyRequest $request): JsonResponse
    {
        try {
            $company = Company::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Company created successfully',
                'data' => $company
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating company',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function show(Company $company): JsonResponse
    {
        $company->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Company retrieved successfully',
            'data' => $company
        ], 200);
    }

    public function update(StoreCompanyRequest $request, Company $company): JsonResponse
    {
        try {
            $company->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Company updated successfully',
                'data' => $company
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating company',
                'error' => $e->getMessage()
            ], 500);
        }
    }

   
    public function destroy(Company $company): JsonResponse
    {
        try {
            $company->delete();

            return response()->json([
                'success' => true,
                'message' => 'Company deleted successfully',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting company',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
