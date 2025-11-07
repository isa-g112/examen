
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('carts', function (Blueprint $table) {
            $table->id('idcart');
            $table->unsignedBigInteger('iduser');
            $table->unsignedBigInteger('products_idproduct')->nullable();
            $table->unsignedBigInteger('services_idservice')->nullable();
            $table->timestamps();

            $table->foreign('iduser')->references('iduser')->on('users')->onDelete('cascade');
            $table->foreign('products_idproduct')->references('idproduct')->on('products')->onDelete('cascade');
            $table->foreign('services_idservice')->references('idservice')->on('services')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('carts');
    }
};
