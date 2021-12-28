<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('usuario1')->unsigned();
            $table->foreign('usuario1')->references('id')->on('users');
            $table->bigInteger('usuario2')->unsigned();
            $table->foreign('usuario2')->references('id')->on('users');
            $table->char('status',1)->default('a'); //b -> bloqueado; a -> ativo; r -> recusado;
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
        Schema::dropIfExists('friends');
    }
}
