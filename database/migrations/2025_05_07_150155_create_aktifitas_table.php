<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktifitasTable extends Migration
{
    public function up()
    {
        Schema::create('aktifitas', function (Blueprint $table) {
            $table->id('id_aktifitas');

            // Relasi
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('validator_id')->nullable();

            // Data kegiatan
            $table->enum('status', ['pending', 'terima', 'tolak', 'revisi'])->default('pending');
            $table->string('nama_kegiatan');
            $table->string('peserta');
            $table->string('dospem');
            $table->string('keterlibatan_dospem');
            $table->string('surat_tugas');
            $table->string('sertifikat');
            $table->string('dokumentasi');
            $table->text('deskripsi'); // lebih tepat pakai text
            $table->string('link_penyelenggara');

            $table->timestamps();

            // Foreign key
            $table->foreign('mahasiswa_id')->references('user_id')->on('users');
            $table->foreign('validator_id')->references('user_id')->on('users');
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('aktifitas');
    }
}
