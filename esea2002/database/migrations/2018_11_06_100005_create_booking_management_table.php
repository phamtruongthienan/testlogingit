<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_booking');
        Schema::dropIfExists('m_booking_reply');
        Schema::enableForeignKeyConstraints();

        // Cấu hình booking
        Schema::create('m_booking', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('login_customer')->default(0)->comment('Đăng nhập hay chưa? (0) chưa, (1) có');
            $table->timestamp('booking_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('name', 64)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 64)->nullable();
            $table->longtext('content', 64)->nullable();
            $table->tinyInteger('status')->default(0)->comment('Trạng thái: (0) Mới, (1) Đang xử lý, (2) Đã xử lý');
            $table->tinyInteger('status_booking')->default(0)->comment('Trạng thái: (0) Không đi, (1) Đi');
            $table->integer('school_id')->unsigned();
            $table->integer('customer_id')->nullable()->unsigned()->comment('ID của khách hàng nếu đã đăng nhập rồi');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_booking', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
            $table->foreign('customer_id')->references('id')->on('m_customer');
        });

        // Cấu hình phản hồi  booking
        Schema::create('m_booking_reply', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('smtp_id')->unsigned();
            $table->longtext('content', 64)->nullable();
            $table->tinyInteger('status')->default(0)->comment('Trạng thái gửi email: (0) Thành công, (1) Lỗi');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_booking_reply', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('m_booking');
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
        Schema::dropIfExists('m_booking');
        Schema::dropIfExists('m_booking_reply');
        Schema::enableForeignKeyConstraints();
    }
}
