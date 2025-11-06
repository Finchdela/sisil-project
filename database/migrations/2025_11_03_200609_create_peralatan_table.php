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
        Schema::create('peralatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            $table->string('kategori');
            $table->integer('jumlah_total');
            $table->integer('jumlah_tersedia');
            $table->enum('kondisi', ['baik', 'rusak'])->default('baik');
            $table->timestamps();
        }); 
    }

    public function down()
    {
        Schema::dropIfExists('peralatan');
    }
};
