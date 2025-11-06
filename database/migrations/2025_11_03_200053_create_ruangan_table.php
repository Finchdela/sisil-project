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
        Schema::create('ruangan', function (Blueprint $table) {
            $table->id();                    // Primary key
            $table->string('nama_ruang');    // Room name
            $table->integer('kapasitas');    // Room capacity
            $table->string('lokasi');        // Room location
            $table->timestamps();            // Created/Updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('ruangan');
    }
};
