
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('roles_users', function (Blueprint $table) {
            $table->id('idroles_users');
            $table->unsignedBigInteger('users_iduser');
            $table->unsignedBigInteger('roles_idrole');
            $table->timestamps();

            $table->foreign('users_iduser')->references('iduser')->on('users')->onDelete('cascade');
            $table->foreign('roles_idrole')->references('idrole')->on('roles')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('roles_users');
    }
};
