<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Company;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use App\Models\Vehicle;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configurar Route Model Binding para IDs personalizados
        Route::bind('cart', function ($value) {
            return Cart::where('idcart', $value)->firstOrFail();
        });

        Route::bind('category', function ($value) {
            return Category::where('idcategory', $value)->firstOrFail();
        });

        Route::bind('company', function ($value) {
            return Company::where('idcompany', $value)->firstOrFail();
        });

        Route::bind('delivery', function ($value) {
            return Delivery::where('iddelivery', $value)->firstOrFail();
        });

        Route::bind('order', function ($value) {
            return Order::where('idorder', $value)->firstOrFail();
        });

        Route::bind('product', function ($value) {
            return Product::where('idproduct', $value)->firstOrFail();
        });

        Route::bind('role', function ($value) {
            return Role::where('idrole', $value)->firstOrFail();
        });

        Route::bind('service', function ($value) {
            return Service::where('idservice', $value)->firstOrFail();
        });

        Route::bind('user', function ($value) {
            return User::where('iduser', $value)->firstOrFail();
        });

        Route::bind('vehicle', function ($value) {
            return Vehicle::where('idvehicle', $value)->firstOrFail();
        });
    }
}
