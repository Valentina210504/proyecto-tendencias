<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('licencias', function (Blueprint $table) {
            $table->id();
            $table->string('numero_licencia')->unique();
            $table->string('tipo_licencia');
            $table->date('fecha_expedicion');
            $table->date('fecha_vencimiento');
            $table->string('entidad_emisora');
            $table->boolean('estado')->default(true);
            $table->unsignedBigInteger('registrado_por')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licencias');
    }
};