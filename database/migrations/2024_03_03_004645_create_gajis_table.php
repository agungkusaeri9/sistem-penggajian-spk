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
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('karyawan_id')->constrained('karyawan')->cascadeOnDelete();
            $table->foreignId('golongan_gaji_id')->constrained('golongan_gaji');
            $table->bigInteger('gaji_pokok')->nullable();
            $table->bigInteger('gaji_bersih')->nullable();
            $table->bigInteger('gaji_lembur')->nullable();
            $table->bigInteger('tunjangan')->nullable();
            $table->bigInteger('potongan')->nullable();
            $table->integer('bulan');
            $table->integer('tahun');
            $table->text('keterangan')->nullable();
            $table->enum('tipe_pembayaran', ['transfer', 'tunai']);
            $table->foreignId('bank_id')->nullable()->constrained('bank');
            $table->string('bukti')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('gaji');
    }
};
