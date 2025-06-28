<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMbkmTable extends Migration
{
    public function up()
    {
        Schema::create('mbkm', function (Blueprint $table) {
            $table->id('id_mbkm');

            // Relasi
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('validator_id')->nullable();

            // Data
            $table->string('nama_kegiatan');
            $table->string('ketua');
            $table->string('anggota');
            $table->string('dospem');
            $table->string('keterlibatan_dospem');
            $table->string('sumber_biaya');
            $table->string('sertifikat');
            $table->string('nama_mitra');
            $table->string('lokasi_mitra');
            $table->string('surat_kerja_sama');
            $table->date('tanggal_pelaksanaan');
            $table->date('tanggal_selesai');
            $table->enum('status', ['pending', 'terima', 'tolak', 'revisi'])->default('pending');

            $table->timestamps();

            // Foreign key
            
            $table->foreign('mahasiswa_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('validator_id')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mbkm');
    }
}
