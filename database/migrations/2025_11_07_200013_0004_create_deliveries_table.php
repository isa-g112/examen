
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id('iddelivery');
            $table->string('gender',45)->nullable();
            $table->date('birth_day')->nullable();
            $table->string('vehicle_type',45)->nullable();
            $table->string('dni_document_front',45)->nullable();
            $table->string('dni_document_back',45)->nullable();
            $table->string('driving_license',45)->nullable();
            $table->string('transit_license',45)->nullable();
            $table->string('profile_photo',45)->nullable();
            $table->unsignedBigInteger('users_iduser');
            $table->timestamps();

            $table->foreign('users_iduser')->references('iduser')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('deliveries');
    }
};
