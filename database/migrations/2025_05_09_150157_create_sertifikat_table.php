<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSertifikatTable extends Migration
{
    public function up()
    {
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->unsignedBigInteger('periode_id');
            $table->unsignedBigInteger('id_aktifitas')->nullable();
            $table->unsignedBigInteger('id_kompetisi')->nullable();
            $table->unsignedBigInteger('id_kmdb')->nullable();
            $table->unsignedBigInteger('id_mbkm')->nullable();
            $table->unsignedBigInteger('id_rekognisi')->nullable();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('validator_id')->nullable();
            $table->text('revisi_alasan')->nullable(); // Kolom alasan revisi
            $table->float('nilai')->nullable();


            // Data utama
            $table->string('nama_kegiatan');

            $table->timestamps();

            // Relasi Foreign Key

            $table->foreign('periode_id')->references('periode_id')->on('periodes')->onDelete('cascade');
            $table->foreign('id_aktifitas')->references('id_aktifitas')->on('aktifitas')->onDelete('set null');
            $table->foreign('id_kompetisi')->references('id_kompetisi')->on('kompetisi_mandiri')->onDelete('set null');
            $table->foreign('id_kmdb')->references('id_kmdb')->on('kemendikbud')->onDelete('set null');
            $table->foreign('id_mbkm')->references('id_mbkm')->on('mbkm')->onDelete('set null');
            $table->foreign('id_rekognisi')->references('id_rekognisi')->on('rekognisi')->onDelete('set null');
            $table->foreign('mahasiswa_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('validator_id')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sertifikat');
    }
}
