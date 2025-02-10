<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_bahan_bakus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bahanbaku_id')->constrained('bahan_bakus')->onDelete('cascade');
            $table->string('jumlah');
            $table->date('tanggal');
            $table->string('petugas');
            $table->string('total_harga');
            $table->string('keterangan')->nullable();
            $table->string('supplier')->nullable();
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
        Schema::dropIfExists('order_bahan_bakus');
    }
}