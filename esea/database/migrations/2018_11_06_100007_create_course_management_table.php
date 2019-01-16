<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_school_course');
        Schema::dropIfExists('m_school_course_translation');
        Schema::dropIfExists('m_school_program');
        Schema::dropIfExists('m_school_program_translation');
        Schema::enableForeignKeyConstraints();

        // Cấu hình comment
        Schema::create('m_school_course', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('school_class_id')->unsigned();
            $table->integer('num_student')->unsigned();
            $table->integer('num_teacher')->unsigned();
            $table->integer('age')->nullable()->default('0');
            $table->integer('age_to')->nullable()->default('0');
            $table->integer('age_month')->nullable()->default('0');
            $table->timestamp('start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('status')->unsigned()->default(0)->comment('Trạng thái: (1) Hiển thị, (0) Không');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_course', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
            $table->foreign('school_class_id')->references('id')->on('m_school_class');
        });

        Schema::create('m_school_course_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255)->comment('slug');
            $table->string('name', 255)->comment('Tên khóa');
            $table->string('name_class', 255)->comment('Tên lớp');
            $table->longtext('content', 64)->nullable()->comment('Nội dung');
            $table->string('meta_title', 255)->nullable()->comment('Nội dung thẻ meta title');
            $table->string('meta_keyword', 255)->nullable()->comment('Nội dung thẻ meta keyword');
            $table->longText('meta_description')->nullable()->comment('Nội dung thẻ description');
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_course_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school_course');
        });


        // Tên chương trình
        Schema::create('m_school_program', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('school_course_id')->unsigned();
            $table->decimal('time', 8, 2)->unsigned();
            $table->string('fee', 255)->comment('Phi hoc');
            $table->tinyInteger('unit_1')->unsigned()->default(1)->comment('(1) Tiếng, (2) Buổi, (3) Ngày, (4) Tuần, (5) Tháng, (6) Năm');
            $table->tinyInteger('unit_2')->unsigned()->default(2)->comment('(1) Tiếng, (2) Buổi, (3) Ngày, (4) Tuần, (5) Tháng, (6) Năm');
            $table->tinyInteger('unit_3')->unsigned()->default(2)->comment('(1) Tiếng, (2) Buổi, (3) Ngày, (4) Tuần, (5) Tháng, (6) Năm');
            $table->tinyInteger('unit_4')->unsigned()->default(2)->comment('(1) Tiếng, (2) Buổi, (3) Ngày, (4) Tuần, (5) Tháng, (6) Năm');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_program', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
            $table->foreign('school_course_id')->references('id')->on('m_school_course');
        });

        Schema::create('m_school_program_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('Tên giáo trình');
            $table->longtext('content', 64)->nullable()->comment('Nội dung');
            $table->string('meta_title', 255)->nullable()->comment('Nội dung thẻ meta title');
            $table->string('meta_keyword', 255)->nullable()->comment('Nội dung thẻ meta keyword');
            $table->longText('meta_description')->nullable()->comment('Nội dung thẻ description');
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_program_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school_program');
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
        Schema::dropIfExists('m_school_course');
        Schema::dropIfExists('m_school_course_translation');
        Schema::dropIfExists('m_school_program');
        Schema::dropIfExists('m_school_program_translation');
        Schema::enableForeignKeyConstraints();
    }
}
