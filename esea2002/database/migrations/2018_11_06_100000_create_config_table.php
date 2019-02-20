<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('config_language');
        Schema::dropIfExists('config_main');
        Schema::dropIfExists('config_main_translation');
        Schema::dropIfExists('config_other');
        Schema::dropIfExists('config_city');
        Schema::dropIfExists('config_district');
        Schema::dropIfExists('config_ward');
        Schema::enableForeignKeyConstraints();

        // Cấu hình ngôn ngữ
        Schema::create('config_language', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->comment('Tên ngôn ngữ');
            $table->string('code', 5)->comment('Mã ngôn ngữ: vn, en,...');
            $table->boolean('default')->default(false)->comment('Ngôn ngữ mặc định: true, false');
            $table->string('currency_code', 5)->comment('Mã tiền tệ: VND, USD,...');
            $table->string('date_format', 15)->comment('Định dạng ngày tháng');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        // Cấu hình thông tin
        Schema::create('config_main', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        // Cấu hình thông tin translation
        Schema::create('config_main_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo', 255)->nullable()->comment('URL của logo, chỉ lưu path');
            $table->string('name', 128)->nullable()->comment('Tên website');
            $table->string('company_name', 128)->nullable()->comment('Tên công ty');
            $table->longText('slogan')->nullable()->comment('Slogan');
            $table->longText('quote')->nullable()->comment('Trích dẫn');
            $table->string('address', 128)->nullable()->comment('Địa chỉ');
            $table->string('phone', 20)->nullable()->comment('Số điện thoại');
            $table->string('email', 64)->nullable()->comment('Địa chỉ email');
            $table->string('represent', 64)->nullable()->comment('Tên người đại diện');
            $table->tinyInteger('num_client')->default(8)->nullable()->comment('Số lượng client hiển thị trên trang chủ');
            $table->tinyInteger('num_school')->default(8)->nullable()->comment('Số lượng trường hiển thị trên trang chủ');
            $table->tinyInteger('num_promo')->default(6)->nullable()->comment('Số lượng khuyến mãi hiển thị trên trang chủ');
            $table->tinyInteger('distance_google')->default(50)->nullable()->comment('Khoảng cách địa điểm gần bạn KM');
            $table->string('background_search', 255)->nullable()->comment('URL của ảnh nền trang chủ (tìm kiếm)');
            $table->string('background_promotion', 255)->nullable()->comment('URL của ảnh nền trang chủ (khuyến mãi)');
            $table->string('background_client', 255)->nullable()->comment('URL của ảnh nền trang chủ (đối tác)');
            $table->boolean('enable_ssl')->nullable()->default(false)->comment('Kích hoạt HTTPS: mặc định không mở');
            $table->string('meta_title', 255)->nullable()->comment('Nội dung thẻ meta title');
            $table->string('meta_keyword', 255)->nullable()->comment('Nội dung thẻ meta keyword');
            $table->longText('meta_description')->nullable()->comment('Nội dung thẻ description');
            $table->string('analytics_id', 255)->nullable()->comment('ID của site trong google analytics');
            $table->string('facebook_page', 255)->nullable()->comment('URL fanpage facebook');
            $table->string('googleplus_page', 255)->nullable()->comment('URL của google plus');
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned()->comment('ID của main');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        Schema::table('config_main_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('config_main');
        });

        // Cấu hình các thông số toàn trang
        Schema::create('config_other', function (Blueprint $table) {
            $table->string('key', 255)->comment('Tên khóa constant. VD: FB_APP_ID, FB_APP_KEY, GG_APP_ID,...');
            $table->string('value', 128)->comment('Nội dung của khóa constant.');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });


        // Cấu hình địa điểm
        Schema::create('config_city', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('config_district', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->integer('city_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('config_district', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('config_city');
        });


        Schema::create('config_ward', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->integer('district_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('config_ward', function (Blueprint $table) {
            $table->foreign('district_id')->references('id')->on('config_district');
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
        Schema::dropIfExists('config_language');
        Schema::dropIfExists('config_main');
        Schema::dropIfExists('config_main_translation');
        Schema::dropIfExists('config_other');
        Schema::dropIfExists('config_city');
        Schema::dropIfExists('config_district');
        Schema::dropIfExists('config_ward');
        Schema::enableForeignKeyConstraints();
    }
}
