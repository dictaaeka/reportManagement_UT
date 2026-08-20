<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Ganti FK issue_id & site_id di tabel reports dari cascadeOnDelete()
     * menjadi restrictOnDelete(), supaya Issue/Site yang masih dipakai
     * oleh Report tidak bisa terhapus begitu saja lewat database.
     */
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['issue_id']);
            $table->dropForeign(['site_id']);
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->foreign('issue_id')
                ->references('id')->on('issues')
                ->restrictOnDelete();

            $table->foreign('site_id')
                ->references('id')->on('sites')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['issue_id']);
            $table->dropForeign(['site_id']);
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->foreign('issue_id')
                ->references('id')->on('issues')
                ->cascadeOnDelete();

            $table->foreign('site_id')
                ->references('id')->on('sites')
                ->cascadeOnDelete();
        });
    }
};