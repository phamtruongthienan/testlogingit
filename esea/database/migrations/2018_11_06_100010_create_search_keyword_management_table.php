<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchKeywordManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_keyword');
        Schema::dropIfExists('m_keyword_search');
        Schema::dropIfExists('m_keyword_search_translation');
        Schema::dropIfExists('m_keyword_prioty');
        Schema::dropIfExists('m_keyword_prioty_translation');
        Schema::dropIfExists('m_keyword_school');
        Schema::dropIfExists('m_keyword_school_translation');
        Schema::enableForeignKeyConstraints();

        // Cấu hình keyword
        Schema::create('m_keyword', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('m_keyword_search', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keyword', 255);
            $table->integer('language_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_keyword_search', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
        });

        Schema::create('m_keyword_prioty', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('keyword_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_keyword_prioty', function (Blueprint $table) {
            $table->foreign('keyword_id')->references('id')->on('m_keyword');
        });


        Schema::create('m_keyword_prioty_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type')->default(1)->comment('Loại ưu tiên: (1) Khu vực, (2) Loại trường, (3) Cấp trường');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('Trạng thái: (1) Hiển thị, (0) Không');
            $table->integer('district_id')->unsigned()->nullable();
            $table->integer('school_level_id')->unsigned()->nullable();
            $table->integer('school_type_id')->unsigned()->nullable();
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_keyword_prioty_translation', function (Blueprint $table) {
            $table->foreign('district_id')->references('id')->on('config_district');
            $table->foreign('school_level_id')->references('id')->on('m_school_level');
            $table->foreign('school_type_id')->references('id')->on('m_school_type');
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_keyword_prioty');
        });


        Schema::create('m_keyword_school', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('keyword_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_keyword_school', function (Blueprint $table) {
            $table->foreign('keyword_id')->references('id')->on('m_keyword');
        });

        Schema::create('m_keyword_school_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('Trạng thái: (1) Hiển thị, (0) Không');
            $table->integer('school_id')->unsigned()->nullable();
            $table->integer('sort')->unsigned()->nullable();
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_keyword_school_translation', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_keyword_school');
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
        Schema::dropIfExists('m_keyword');
        Schema::dropIfExists('m_keyword_search');
        Schema::dropIfExists('m_keyword_search_translation');
        Schema::dropIfExists('m_keyword_prioty');
        Schema::dropIfExists('m_keyword_prioty_translation');
        Schema::dropIfExists('m_keyword_school');
        Schema::dropIfExists('m_keyword_school_translation');
        Schema::enableForeignKeyConstraints();
    }
}
