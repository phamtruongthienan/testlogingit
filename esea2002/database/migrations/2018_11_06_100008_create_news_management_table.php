<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_layout');
        Schema::dropIfExists('m_news');
        Schema::dropIfExists('m_news_translation');
        Schema::enableForeignKeyConstraints();

        // Cấu hình Layout
        Schema::create('m_layout', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('Tên layout');
            $table->string('models', 255)->nullable()->default(null)->comment('Tên Model');
            $table->string('path', 255)->comment('Path view của layout');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        // Cấu hình bài viết
        Schema::create('m_news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('layout_id')->unsigned();
            $table->tinyInteger('status')->unsigned()->default(0)->comment('Trạng thái: (1) Hiển thị, (0) Không');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_news', function (Blueprint $table) {
            $table->foreign('layout_id')->references('id')->on('m_layout');
        });

        Schema::create('m_news_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('meta_title', 255)->nullable()->comment('Nội dung thẻ meta title');
            $table->string('meta_keyword', 255)->nullable()->comment('Nội dung thẻ meta keyword');
            $table->longText('meta_description')->nullable()->comment('Nội dung thẻ description');
            $table->longtext('content', 64)->nullable()->comment('Nội dung');
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_news_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_news');
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
        Schema::dropIfExists('m_layout');
        Schema::dropIfExists('m_news');
        Schema::dropIfExists('m_news_translation');
        Schema::enableForeignKeyConstraints();
    }
}
