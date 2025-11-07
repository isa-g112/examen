<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiCartController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiCompanyController;
use App\Http\Controllers\Api\ApiDeliveryController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiRoleController;
use App\Http\Controllers\Api\ApiServiceController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiVehicleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Resources
Route::apiResource('carts', ApiCartController::class);
Route::apiResource('categories', ApiCategoryController::class);
Route::apiResource('companies', ApiCompanyController::class);
Route::apiResource('deliveries', ApiDeliveryController::class);
Route::apiResource('orders', ApiOrderController::class);
Route::apiResource('products', ApiProductController::class);
Route::apiResource('services', ApiServiceController::class);
Route::apiResource('users', ApiUserController::class);
Route::apiResource('vehicles', ApiVehicleController::class);
