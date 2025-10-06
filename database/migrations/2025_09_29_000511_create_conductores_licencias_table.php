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
        Schema::create('conductores_licencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conductor_id')->constrained('conductores');
            $table->foreignId('licencia_id')->constrained('licencias');
            $table->date('fecha_asignacion');
            $table->boolean('estado_asignacion')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conductores_licencias');
    }
};