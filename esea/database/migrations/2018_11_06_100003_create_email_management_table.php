<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_group_email');
        Schema::dropIfExists('m_group_email_user');
        Schema::dropIfExists('config_email');
        Schema::dropIfExists('m_email');
        Schema::dropIfExists('m_contact');
        Schema::dropIfExists('m_contact_reply');
        Schema::enableForeignKeyConstraints();

        // Cấu hình nhóm người nhận
        Schema::create('m_group_email', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->comment('Tên nhóm người nhận');
            $table->tinyInteger('group')->default(1)->comment('Loại nhóm: (1) người dùng đã đăng ký, (2) người dùng đăng ký tham quan, (3) Danh sách email tùy chọn');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        // Cấu hình danh sách email của group loại (3)
        Schema::create('m_group_email_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->comment('ID của nhóm người nhận');
            $table->longtext('email')->nullable()->comment('Danh sách email. VD: [{"id":1,"email":"abc@gmail.com"},{"id":2,"email":"abc2@gmail.com"}]');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        Schema::table('m_group_email_user', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('m_group_email');
        });


        // Cấu hình danh sách máy chủ gửi mail
        Schema::create('config_email', function (Blueprint $table) {
            $table->increments('id');
            $table->string('smtp_server', 255)->comment('SMTP Server');
            $table->string('smtp_port', 6)->default('25')->comment('SMTP Port');
            $table->string('smtp_username', 64)->nullable()->comment('SMTP Username');
            $table->string('smtp_password', 64)->nullable()->comment('SMTP Password');
            $table->string('smtp_protocol', 5)->default('TLS')->comment('SMTP Protocol');
            $table->string('smtp_name', 64)->comment('SMTP Name');
            $table->boolean('default')->default(false)->comment('Mặc định: true, false');
            $table->boolean('default_credentials')->default(false)->comment('Mặc định: true, false');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes()->comment('Xóa mềm');
        });

        // Danh sách email đã gửi
        Schema::create('m_email', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64)->nullable()->comment('Tiêu đề email');
            $table->longtext('content')->nullable()->comment('Nội dung email');
            $table->longtext('email')->nullable()->comment('Danh sách email nếu nhóm người nhận là 3. VD: [{"id":1,"email":"abc@gmail.com"},{"id":2,"email":"abc2@gmail.com"}]');
            $table->tinyInteger('status')->default(1)->comment('Trạng thái gửi mail. (1) thành công, (0) Lỗi');
            $table->integer('group_id')->unsigned()->comment('ID của nhóm người nhận');
            $table->integer('smtp_id')->unsigned()->comment('ID của server gửi');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes()->comment('Xóa mềm');
        });

        Schema::table('m_email', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('m_group_email');
            $table->foreign('smtp_id')->references('id')->on('config_email');
        });

        // Danh sách email liên hệ
        Schema::create('m_contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 64)->nullable()->comment('email');
            $table->tinyInteger('type')->default(0)->comment('Loại trợ giúp');
            $table->string('title', 64)->nullable()->comment('Tiêu đề');
            $table->longtext('content')->nullable()->comment('Nội dung email');
            $table->longtext('browser')->nullable()->comment('Nội dung browser');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes()->comment('Xóa mềm');
        });

        Schema::create('m_contact_reply', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contact_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('smtp_id')->unsigned();
            $table->longtext('content', 64)->nullable();
            $table->tinyInteger('status')->default(0)->comment('Trạng thái gửi email: (0) Thành công, (1) Lỗi');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_contact_reply', function (Blueprint $table) {
            $table->foreign('contact_id')->references('id')->on('m_contact');
            $table->foreign('user_id')->references('id')->on('m_users');
            $table->foreign('smtp_id')->references('id')->on('config_email');
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
        Schema::dropIfExists('m_group_email');
        Schema::dropIfExists('m_group_email_user');
        Schema::dropIfExists('config_email');
        Schema::dropIfExists('m_email');
        Schema::dropIfExists('m_contact');
        Schema::dropIfExists('m_contact_reply');
        Schema::enableForeignKeyConstraints();
    }
}
