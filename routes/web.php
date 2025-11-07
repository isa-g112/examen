
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

Route::resource('companies', CompanyController::class);

Route::prefix('api')->group(function() {
    Route::apiResource('companies', CompanyController::class);
});
