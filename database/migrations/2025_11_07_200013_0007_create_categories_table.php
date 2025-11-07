
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('idcategory');
            $table->string('name',45);
            $table->string('description',45)->nullable();
            $table->unsignedBigInteger('companies_idcompany');
            $table->timestamps();

            $table->foreign('companies_idcompany')->references('idcompany')->on('companies')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('categories');
    }
};
