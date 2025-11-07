
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('services', function (Blueprint $table) {
            $table->id('idservice');
            $table->string('name',45);
            $table->string('description',45)->nullable();
            $table->string('price',45);
            $table->string('image',45)->nullable();
            $table->unsignedBigInteger('categories_idcategory');
            $table->unsignedBigInteger('companies_idcompany');
            $table->timestamps();

            $table->foreign('categories_idcategory')->references('idcategory')->on('categories')->onDelete('cascade');
            $table->foreign('companies_idcompany')->references('idcompany')->on('companies')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('services');
    }
};
