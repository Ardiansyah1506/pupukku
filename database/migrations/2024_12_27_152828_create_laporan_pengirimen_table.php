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
        Schema::create('laporan_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->integer('uang_makan');
            $table->integer('uang_bensin');
            $table->integer('uang_tol');
            $table->string('file');
            $table->integer('id_user');
            $table->integer('id_pekerjaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_pengiriman');
    }
};
