<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kd_book', 50);
            $table->unsignedbigInteger('konten_id');
            $table->unsignedbigInteger('user_id');
            $table->integer('jumlah');
            $table->bigInteger('total')->nullable();
            $table->foreign('user_id')->references('id')->on('akuns');
            $table->foreign('konten_id')->references('id')->on('kontens');
            $table->foreign('kd_book')->references('kd_book')->on('pesans');
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
        Schema::dropIfExists('carts');
    }
}
