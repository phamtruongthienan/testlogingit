<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_users');
        Schema::dropIfExists('m_customer');
        Schema::dropIfExists('m_child');
        Schema::dropIfExists('m_wishlist');
        Schema::dropIfExists('m_activity_log');
        Schema::enableForeignKeyConstraints();


        // Cấu hình nhân viên
        Schema::create('m_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 128)->unique();
            $table->string('password', 128);
            $table->string('name', 128)->nullable();
            $table->date('dob')->nullable();
            $table->string('phone', 20)->nullable();
            $table->tinyInteger('locked')->unsigned()->default(0);
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        // Cấu hình khách hàng
        Schema::create('m_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 64)->unique();
            $table->string('password', 128);
            $table->string('name', 128)->nullable();
            $table->date('dob')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('address', 255)->nullable()->comment('Address');
            $table->string('logo', 255)->nullable()->comment('URL của logo, chỉ lưu path');
            $table->tinyInteger('type')->default(1)->comment('(1) normal, (2) FB, (3) GG');
            $table->tinyInteger('gender')->default(2)->comment('(1) Name, (0) Nữ, (2) Unknown');
            $table->tinyInteger('status')->default(1)->comment('Trạng thái: (1) Kích hoạt, (0) Tắt');
            $table->string('lat', 20)->nullable();
            $table->string('long', 20)->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        // Cấu hình con trẻ
        Schema::create('m_child', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->comment('ID của khách hàng');
            $table->string('name', 64);
            $table->date('dob')->nullable();
            $table->tinyInteger('gender')->default(2)->comment('(1) Name, (0) Nữ, (2) Unknown');
            $table->longtext('genitive', 255)->nullable()->comment('Tính cách. Lưu dạng json');
            $table->integer('school_id')->unsigned()->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_child', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
            $table->foreign('customer_id')->references('id')->on('m_customer');
        });

        Schema::create('m_wishlist', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->comment('ID của khách hàng');
            $table->integer('school_id')->unsigned()->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_wishlist', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
            $table->foreign('customer_id')->references('id')->on('m_customer');
        });

        Schema::create('m_activity_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('log_name')->nullable();
            $table->text('description');
            $table->integer('subject_id')->nullable();
            $table->string('subject_type')->nullable();
            $table->integer('causer_id')->unsigned();
            $table->string('causer_type')->nullable();
            $table->text('properties')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->index('log_name');
        });

        Schema::table('m_activity_log', function (Blueprint $table) {
            $table->foreign('causer_id')->references('id')->on('m_users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_users');
        Schema::dropIfExists('m_customer');
        Schema::dropIfExists('m_child');
        Schema::dropIfExists('m_wishlist');
        Schema::dropIfExists('m_activity_log');
        Schema::enableForeignKeyConstraints();
    }
}
