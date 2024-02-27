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
        Schema::create('golongan_gaji_tunjangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('golongan_gaji_id')->constrained('golongan_gaji')->cascadeOnDelete();
            $table->foreignId('tunjangan_id')->nullable()->constrained('tunjangan');
            $table->bigInteger('nominal');
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
        Schema::dropIfExists('golongan_gaji_tunjangan');
    }
};
