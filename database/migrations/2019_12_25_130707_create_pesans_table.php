<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesans', function (Blueprint $table) {
            $table->string('kd_book', 50);
            $table->unsignedbigInteger('user_id');
            $table->bigInteger('total_harga')->nullable();
            $table->enum('status', ['P', 'D']);
            $table->string('bank');
            $table->string('va');
            $table->string('meja_id');
            $table->primary('kd_book');
            $table->foreign('user_id')->references('id')->on('akuns');
            $table->foreign('meja_id')->references('id')->on('mejas');
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
        Schema::dropIfExists('pesans');
    }
}
