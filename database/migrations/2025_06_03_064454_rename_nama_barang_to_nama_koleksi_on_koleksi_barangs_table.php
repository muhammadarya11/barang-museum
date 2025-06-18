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
        Schema::table('nama_koleksi_on_koleksi_barangs', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('koleksi_barangs', function (Blueprint $table) {
        $table->renameColumn('nama_barang', 'nama_koleksi');
        $table->renameColumn('asal_barang', 'asal_koleksi');
    });
    }
};
