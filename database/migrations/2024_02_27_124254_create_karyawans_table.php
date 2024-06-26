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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->unique();
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('alamat');
            $table->foreignId('jabatan_id')->constrained('jabatan');
            $table->foreignId('divisi_id')->constrained('divisi');
            $table->foreignId('golongan_gaji_id')->constrained('golongan_gaji');
            $table->foreignId('user_id')->constrained('users');
            $table->string('nomor_telepon');
            $table->string('nomor_ktp');
            $table->integer('status_karyawan');
            $table->date('tanggal_bergabung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
};
