<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporan_kerusakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('alat_id')->constrained('peralatan')->onDelete('cascade');
            $table->text('deskripsi_kerusakan');
            $table->date('tanggal_lapor');
            $table->enum('status', ['dilaporkan', 'diproses', 'selesai'])->default('dilaporkan');
            $table->text('tindakan')->nullable(); // Tindakan yang dilakukan admin
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_kerusakan');
    }
};