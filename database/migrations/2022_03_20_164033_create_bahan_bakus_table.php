<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBahanBakusTable extends Migration
{


    public function up()
    {
        Schema::create('bahan_bakus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('stok');
            $table->integer('harga');
            $table->string('satuan');
            $table->string('status')->nullable();
            $table->integer('minimal_stok')->nullable();
            $table->timestamps();
        });

        Schema::create('bahan_baku_masuks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bahanbaku_id')->constrained('bahan_bakus')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->timestamps();
        });
        // trigger bahanbakumasuk
        DB::unprepared('
        CREATE TRIGGER update_stok_bahanbakumasuk after INSERT ON bahan_baku_masuks
        FOR EACH ROW BEGIN
        UPDATE bahan_bakus
            SET stok = stok + NEW.jumlah
        WHERE
        id = NEW.bahanbaku_id;
        END
        ');

        DB::unprepared('
        CREATE TRIGGER delete_old_stok_bahanbakumasuk after DELETE ON bahan_baku_masuks
        FOR EACH ROW BEGIN
        UPDATE bahan_bakus
            SET stok = stok - OLD.jumlah
        WHERE
        id = OLD.bahanbaku_id;
        END
        ');
        // end
        Schema::create('bahan_baku_keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bahanbaku_id')->constrained('bahan_bakus')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->timestamps();
        });

        // trigger bahanbakukeluar

        DB::unprepared('
        CREATE TRIGGER update_stok_bahanbakukeluar after INSERT ON bahan_baku_keluars
        FOR EACH ROW BEGIN
        UPDATE bahan_bakus
            SET stok = stok - NEW.jumlah
        WHERE
        id = NEW.bahanbaku_id;
        END
        ');

        DB::unprepared('
        CREATE TRIGGER delete_old_stok_bahanbakeluar after DELETE ON bahan_baku_keluars
        FOR EACH ROW BEGIN
        UPDATE bahan_bakus
            SET stok = stok - OLD.jumlah
        WHERE
        id = OLD.bahanbaku_id;
        END
        ');

        // Schema::create('customers', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('nama_customer');
        //     $table->string('no_hp');
        //     $table->string('jenis_kelamin');
        //     $table->string('email');
        //     $table->timestamps();
        // });
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('status')->nullable();
            $table->timestamps();
        });
        Schema::create('meja', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kursi')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('foto');
            $table->foreignId('kategori_id')->constrained('kategori')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('harga');
            $table->integer('stok');
            $table->string('status')->nullable();
            $table->timestamps();
        });
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string("no_order")->unique();
            $table->foreignId('meja_id')->nullable()->constrained('meja')->onUpdate('cascade')->onDelete('cascade');
            $table->text('catatan')->nullable();
            $table->integer('total');
            $table->dateTime('waktu');
            $table->string('status')->nullable();
            $table->timestamps();
        });
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('order')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('menu')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah');
            $table->integer('total');
            $table->timestamps();
        });
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('order')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah');
            $table->dateTime('waktu_bayar');
            $table->integer('total');
            $table->string('status')->nullable();
            $table->timestamps();
        });

        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menu')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('bahanbaku_id')->constrained('bahan_bakus')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah');
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
        Schema::dropIfExists('bahan_bakus');
        Schema::dropIfExists('bahan_baku_masuks');
        Schema::dropIfExists('update_stok_bahanbakumasuk');
        Schema::dropIfExists('delete_old_stok_bahanbakumasuk');
        Schema::dropIfExists('bahan_baku_keluars');
        Schema::dropIfExists('update_stok_bahanbakukeluar');
        Schema::dropIfExists('delete_old_stok_bahanbakeluar');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('meja');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('order');
        Schema::dropIfExists('order_detail');
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('ingredients');
    }
}
