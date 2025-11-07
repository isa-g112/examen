<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('companies', function (Blueprint $table) {
            $table->id('idcompany');
            $table->string('company_name', 45);
            $table->string('legal_representative_name', 45);
            $table->string('legal_representative_lastname', 45);
            $table->string('legal_representative_dni', 45);
            $table->string('legal_representative_email', 45);
            $table->string('rfc', 45);
            $table->string('terms_and_conditions', 45);
            $table->string('pdf_ine_certificate', 45);
            $table->string('pdf_bank_certificate', 45);
            $table->string('profile_photo', 45)->nullable();
            $table->string('account_holder_name', 45);
            $table->string('account_holder_email', 45);
            $table->string('bank_name', 45);
            $table->string('account_number', 45);
            $table->string('account_iban', 45)->nullable();
            $table->string('billing_contact_name', 45);
            $table->string('billing_contact_email', 45);
            $table->unsignedBigInteger('users_iduser');
            $table->timestamps();
        });

        // Agregar la clave foránea después de crear la tabla
        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('users_iduser')
                  ->references('iduser')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('companies');
    }
};
