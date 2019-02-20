<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_menu');
        Schema::dropIfExists('m_menu_translation');
        Schema::enableForeignKeyConstraints();

        // Cấu hình menu
        Schema::create('m_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('news_id')->unsigned()->nullable()->default(null);
            $table->integer('layout_id')->unsigned()->nullable()->default(null);
            $table->integer('sort')->unsigned()->nullable();
            $table->tinyInteger('position')->default(1)->comment('Vị trí: (1) Header, (2) Sidebar, (3) Footer');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_menu', function (Blueprint $table) {
            $table->foreign('news_id')->references('id')->on('m_news');
            $table->foreign('layout_id')->references('id')->on('m_layout');
        });

        Schema::create('m_menu_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_menu_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_menu');
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
        Schema::dropIfExists('m_menu');
        Schema::dropIfExists('m_menu_translation');
        Schema::enableForeignKeyConstraints();
    }
}
