<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKemendikbudTable extends Migration
{
    public function up()
    {
        Schema::create('kemendikbud', function (Blueprint $table) {
            $table->id('id_kmdb');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('validator_id')->nullable();

            $table->enum('status', ['pending', 'terima', 'tolak', 'revisi'])->default('pending');
            $table->string('nama_kegiatan');
            $table->string('surat');
            $table->date('tanggal');
            $table->string('ketua');
            $table->string('anggota');
            $table->string('dospem');
            $table->string('keterlibatan_dospem');
            $table->string('prestasi');
            $table->string('sertifikat');
            $table->string('lingkup_kegiatan');
            $table->string('sumber_biaya');
            $table->integer('biaya');
            $table->string('lokasi_kegiatan');

            $table->timestamps();

            // Foreign keys
            $table->foreign('mahasiswa_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('validator_id')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kemendikbud');
    }
}
