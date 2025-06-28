<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodesTable extends Migration
{
    public function up()
    {
        Schema::create('periodes', function (Blueprint $table) {
            $table->id('periode_id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->boolean('status');
            $table->enum('jenis_periode', ['ganjil', 'genap']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('periodes');
    }
}
