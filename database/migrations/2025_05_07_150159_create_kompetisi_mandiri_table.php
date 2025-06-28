<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKompetisiMandiriTable extends Migration
{
    public function up()
    {
        Schema::create('kompetisi_mandiri', function (Blueprint $table) {
            $table->id('id_kompetisi');

            // Relasi
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('validator_id')->nullable();

            // Data kegiatan
            $table->enum('status', ['pending', 'terima', 'tolak', 'revisi'])->default('pending');
            $table->string('nama_kegiatan');
            $table->string('link_penyelenggara');
            $table->string('dospem');
            $table->string('capaian_prestasi');
            $table->string('sertifikat');
            $table->string('foto_penyerahan');
            $table->string('surat_tugas');
            $table->string('jenis_kepesertaan');
            $table->date('tanggal_pelaksanaan');
            $table->date('tanggal_selesai');
            $table->integer('jumlah_anggota');
            $table->string('nidn_nidk'); // perbaikan penamaan

            $table->timestamps();

            // Foreign key
            $table->foreign('mahasiswa_id')->references('user_id')->on('users');
            $table->foreign('validator_id')->references('user_id')->on('users');
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('kompetisi_mandiri');
    }
}
