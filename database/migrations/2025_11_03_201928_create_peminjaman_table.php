<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ruang_id')->constrained('ruangan')->onDelete('cascade');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->text('tujuan_peminjaman');
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'selesai'])->default('pending');
        $table->timestamps();
        });
    }   

    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
};
