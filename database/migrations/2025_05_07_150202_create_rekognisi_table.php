<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekognisiTable extends Migration
{
    public function up()
    {
        Schema::create('rekognisi', function (Blueprint $table) {
            $table->id('id_rekognisi');

            // Relasi
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('validator_id')->nullable();

            // Data
            $table->string('nama_kegiatan');
            $table->string('ketua');
            $table->string('anggota');
            $table->string('surat_tugas');
            $table->string('dospem');
            $table->text('deskripsi_karya');
            $table->string('nama_lembaga_mitra');
            $table->string('no_surat_rekognisi');
            $table->string('jenis_karya');
            $table->string('link_acara');
            $table->year('tahun'); // Lebih tepat jika isinya hanya tahun
            $table->string('bukti_penyerahan');
            $table->enum('status', ['pending', 'terima', 'tolak', 'revisi'])->default('pending');

            $table->timestamps();

            // Foreign key
            
            $table->foreign('mahasiswa_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('validator_id')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekognisi');
    }
}
