<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('operaciones', function (Blueprint $table) {
            $table->integer('anio')->nullable()->after('fecha_entrada');
            $table->integer('mes')->nullable()->after('anio');
            $table->integer('semana')->nullable()->after('mes');
        });
    }

    public function down(): void
    {
        Schema::table('operaciones', function (Blueprint $table) {
            $table->dropColumn(['anio', 'mes', 'semana']);
        });
    }
};