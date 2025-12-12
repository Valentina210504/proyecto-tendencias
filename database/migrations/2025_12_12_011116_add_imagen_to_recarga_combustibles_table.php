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
        Schema::table('recarga_combustibles', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('estacion_servicio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recarga_combustibles', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
};
