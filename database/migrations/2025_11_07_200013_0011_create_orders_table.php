
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('idorder');
            $table->date('date');
            $table->string('name_customer',45);
            $table->string('address',45);
            $table->string('phone',45);
            $table->string('status',45);
            $table->string('quantity',45);
            $table->unsignedBigInteger('products_idproduct')->nullable();
            $table->unsignedBigInteger('services_idservice')->nullable();
            $table->unsignedBigInteger('companies_idcompany');
            $table->unsignedBigInteger('users_iduser');
            $table->timestamps();

            $table->foreign('products_idproduct')->references('idproduct')->on('products')->onDelete('cascade');
            $table->foreign('services_idservice')->references('idservice')->on('services')->onDelete('cascade');
            $table->foreign('companies_idcompany')->references('idcompany')->on('companies')->onDelete('cascade');
            $table->foreign('users_iduser')->references('iduser')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
