<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_school_comment');
        Schema::dropIfExists('m_school_comment_rating');
        Schema::dropIfExists('m_school_comment_reply');
        Schema::enableForeignKeyConstraints();

        // Cấu hình comment
        Schema::create('m_school_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->longtext('content');
            $table->tinyInteger('rating')->nullable()->unsigned()->default(0);
            $table->integer('school_id')->unsigned();
            $table->tinyInteger('status')->unsigned()->default(0)->comment('Trạng thái: (1) Hiển thị, (0) Không');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_comment', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('m_customer');
            $table->foreign('school_id')->references('id')->on('m_school');
        });

        Schema::create('m_school_comment_reply', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comment_id')->unsigned();
            $table->longtext('content');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('Trạng thái: (1) Hiển thị, (0) Không');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_comment_reply', function (Blueprint $table) {
            $table->foreign('comment_id')->references('id')->on('m_school_comment');
        });


        // Cấu hình comment
        Schema::create('m_school_comment_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('rating')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_comment_rating', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
            $table->foreign('customer_id')->references('id')->on('m_customer');
            $table->foreign('category_id')->references('id')->on('m_school_category');
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
        Schema::dropIfExists('m_school_comment');
        Schema::dropIfExists('m_school_comment_rating');
        Schema::dropIfExists('m_school_comment_reply');
        Schema::enableForeignKeyConstraints();
    }
}
