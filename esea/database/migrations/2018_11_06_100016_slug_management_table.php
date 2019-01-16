<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SlugManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_slug');
        Schema::dropIfExists('m_rating');
        Schema::dropIfExists('m_rating_translation');
        Schema::dropIfExists('m_school_score');
        Schema::dropIfExists('m_exchange_rate');
        Schema::enableForeignKeyConstraints();

        // Cấu hình subscribe
        Schema::create('m_exchange_rate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id')->unsigned();
            $table->string('rate', 255);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
        Schema::table('m_exchange_rate', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
        });

        Schema::create('m_slug', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255);
            $table->string('category', 255);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('m_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rating', 20);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('m_rating_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_rating_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_rating');
        });

        Schema::create('m_school_score', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('score')->unsigned();
            $table->integer('school_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_score', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_slug');
        Schema::dropIfExists('m_rating');
        Schema::dropIfExists('m_rating_translation');
        Schema::dropIfExists('m_school_score');
        Schema::enableForeignKeyConstraints();
    }
}
