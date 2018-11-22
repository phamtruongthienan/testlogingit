<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Decentralization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decentralization', function (Blueprint $table) {
            $table->integer('id_user')->unsigned();
            $table->integer('id_role')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_role')->references('id')->on('roles');
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
        Schema::dropIfExists('decentralization');
    }
}
