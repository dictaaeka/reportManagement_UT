<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Menambahkan kolom unit_model_id ke tabel reports.
     * Nullable & restrictOnDelete supaya UnitModel yang masih
     * dipakai oleh Report tidak bisa terhapus begitu saja.
     */
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->foreignId('unit_model_id')
                ->nullable()
                ->after('site_id')
                ->constrained('unit_models')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['unit_model_id']);
            $table->dropColumn('unit_model_id');
        });
    }
};