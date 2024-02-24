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
        Schema::create('golongan_gaji', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique();
            $table->text('deskripsi')->nullable();
            $table->string('tingkat', 100)->nullable();
            $table->foreignId('jabatan_id')->nullable()->constrained('jabatan');
            $table->decimal('gaji_pokok', 10, 2);
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('golongan_gaji');
    }
};
