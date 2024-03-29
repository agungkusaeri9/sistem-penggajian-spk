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
        Schema::create('spk_kriteria', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->enum('jenis', ['benefit', 'cost']);
            $table->integer('bobot');
            $table->float('bobot_sederhana', 8, 2);
            $table->timestamps();
        });

        Schema::create('spk_kriteria_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spk_kriteria_id')->constrained('spk_kriteria')->cascadeOnDelete();
            $table->string('nama');
            $table->integer('nilai');
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
        Schema::dropIfExists('spk_kriteria_detail');
        Schema::dropIfExists('spk_kriteria');
    }
};
