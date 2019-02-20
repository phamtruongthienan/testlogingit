<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_school_level');
        Schema::dropIfExists('m_school_level_translation');
        Schema::dropIfExists('m_school_type');
        Schema::dropIfExists('m_school_type_translation');
        Schema::dropIfExists('m_school_language');
        Schema::dropIfExists('m_school_language_translation');
        Schema::dropIfExists('m_school_category');
        Schema::dropIfExists('m_school_category_translation');
        Schema::dropIfExists('m_school_attribute');
        Schema::dropIfExists('m_school_attribute_translation');
        Schema::dropIfExists('m_school_class');
        Schema::dropIfExists('m_school_class_translation');
        Schema::dropIfExists('m_school_class_addon');
        Schema::dropIfExists('m_school_class_addon_translation');
        Schema::dropIfExists('m_school_event');
        Schema::dropIfExists('m_school_event_translation');
        Schema::dropIfExists('m_school');
        Schema::dropIfExists('m_school_translation');
        Schema::dropIfExists('m_school_teacher');
        Schema::dropIfExists('m_school_teacher_translation');
        Schema::dropIfExists('m_school_image');
        Schema::dropIfExists('m_school_language_course');
        Schema::dropIfExists('m_school_category_rating');
        Schema::dropIfExists('m_school_attribute_rating');
        Schema::dropIfExists('m_school_attribute_addon');
        Schema::dropIfExists('m_school_attribute_addon_translation');
        Schema::enableForeignKeyConstraints();

        // Cấu hình cấp trường
        Schema::create('m_school_level', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('m_school_level_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('Tên cấp trường');
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_level_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school_level');
        });


        // Cấu hình loại trường
        Schema::create('m_school_type', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('m_school_type_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('Tên loại trường');
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_type_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school_type');
        });

        // Cấu hình ngoại ngữ
        Schema::create('m_school_language', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('m_school_language_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('Tên ngoại ngữ');
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_language_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school_language');
        });


        // Cấu hình nhóm thuộc tính
        Schema::create('m_school_category', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('m_school_category_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('Tên nhóm thuộc tính');
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_category_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school_category');
        });

        // Cấu hình thuộc tính
        Schema::create('m_school_attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icon', 255)->comment('Icon thuộc tính');
            $table->integer('school_category_id')->unsigned()->comment('ID của nhóm thuộc tính');
            $table->integer('type')->unsigned()->default(1)->comment('Loại thuộc tính: (1) Text field, (2) Checkbox');
            $table->tinyInteger('search')->unsigned()->default(1)->comment('Cho phép tìm kiếm: (1) Cho phép, (0) Không');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_attribute', function (Blueprint $table) {
            $table->foreign('school_category_id')->references('id')->on('m_school_category');
        });

        Schema::create('m_school_attribute_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('Tên nhóm thuộc tính');
            $table->string('content', 255)->nullable()->comment('Giá trị');
            $table->string('unit', 255)->nullable()->nullable()->comment('Đơn vị tính');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->softDeletes();
        });

        Schema::table('m_school_attribute_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school_attribute');
        });

        // Cấu hình phòng học
        Schema::create('m_school_class', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('m_school_class_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('Tên nhóm thuộc tính');
            $table->string('position', 255)->nullable()->comment('Vị trí');
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_class_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school_class');
        });

        // Cấu hình phòng học dynamic
        Schema::create('m_school_class_addon', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_class_id')->unsigned()->comment('ID của phòng học');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_class_addon', function (Blueprint $table) {
            $table->foreign('school_class_id')->references('id')->on('m_school_class');
        });

        Schema::create('m_school_class_addon_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('Khóa');
            $table->string('content', 255)->nullable()->comment(' Nội dung khóa');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->softDeletes();
        });

        Schema::table('m_school_class_addon_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school_class_addon');
        });

        // Cấu hình sự kiện
        Schema::create('m_school_event', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type')->unsigned()->default(1)->comment('Đối tượng: (1) Loại trường, (2) Chọn từ danh sách trường, (3) Tất cả khách hàng, (4) Chọn khách hàng');
            $table->longtext('target')->nullable()->comment('Đối tượng áp dụng. Định dạng json');
            $table->tinyInteger('date_type')->unsigned()->default(1)->comment('Thời gian: (1) Vĩnh viễn, (2) Khoảng thời gian');
            $table->timestamp('start_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('discount_type')->unsigned()->default(1)->comment('Giảm giá: (1) Phần trăm, (2) Hiện kim');
            $table->bigInteger('discount')->default(0)->unsigned()->comment('Giá trị giảm');
            $table->string('code', 64)->nullable()->comment('Mã giảm');
            $table->tinyInteger('position')->default(1)->comment('Vị trí: (1) Đầu trang, (2) Cuối trang, (3) Sidebar, (4) whatsnew, (5) Homepage');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('Trạng thái: (1) Hiển thị, (0) Không');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('m_school_event_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo', 255)->nullable()->comment('URL của banner, chỉ lưu path');
            $table->string('slug', 255)->comment('Slug');
            $table->string('name', 255)->comment('Tên chương trình');
            $table->longtext('content', 64)->nullable()->comment('Nội dung');
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_event_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school_event');
        });

        // Cấu hình trường học
        Schema::create('m_school', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('branch')->default(1)->comment('(1) Chi nhánh, (0) Trụ sở chính');
            $table->integer('school_id')->nullable()->unsigned()->comment('Nếu là trụ sở chính thì phải có ID này');
            $table->integer('city_id')->nullable()->unsigned();
            $table->integer('district_id')->nullable()->unsigned();
            $table->integer('ward_id')->nullable()->unsigned();
            $table->integer('school_level_id')->unsigned();
            $table->integer('school_type_id')->unsigned();
            $table->string('facebook_page', 255)->nullable();
            $table->string('google_page', 255)->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('file_360', 255)->nullable();
            $table->string('file_pdf', 255)->nullable();
            $table->string('file_video', 255)->nullable();
            $table->string('background_intro', 10)->nullable();
            $table->string('background_facility', 10)->nullable();
            $table->string('background_price', 10)->nullable();
            $table->string('background_review', 10)->nullable();
            $table->string('background_map', 10)->nullable();
            $table->string('lat', 50)->nullable();
            $table->string('lng', 50)->nullable();
            $table->string('tuition', 50);
            $table->string('tuition_max', 50);
            $table->tinyInteger('search')->default(1)->comment('(1) Cho phép tìm kiếm, (0) Không');
            $table->tinyInteger('status')->default(1)->comment('(1) Cho phép hiển thị, (0) Không');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
            $table->foreign('city_id')->references('id')->on('config_city');
            $table->foreign('district_id')->references('id')->on('config_district');
            $table->foreign('ward_id')->references('id')->on('config_ward');
            $table->foreign('school_level_id')->references('id')->on('m_school_level');
            $table->foreign('school_type_id')->references('id')->on('m_school_type');
        });

        Schema::create('m_school_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255)->nullable()->comment('SEO URL');
            $table->string('name', 255)->comment('Tên trường');
            $table->string('slogan', 255)->comment('Slogan trường');
            $table->string('meta_title', 255)->nullable()->comment('Nội dung thẻ meta title');
            $table->string('meta_keyword', 255)->nullable()->comment('Nội dung thẻ meta keyword');
            $table->longText('meta_description')->nullable()->comment('Nội dung thẻ description');
            $table->string('address', 128)->nullable()->comment('Địa chỉ');
            $table->string('phone', 20)->nullable()->comment('Số điện thoại');
            $table->string('email', 64)->nullable()->comment('Địa chỉ email');
            $table->longtext('content', 64)->nullable()->comment('Thông tin');
            $table->longtext('description', 64)->nullable()->comment('Giới thiệu');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->softDeletes();
        });

        Schema::table('m_school_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school');
        });

        Schema::create('m_school_teacher', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num_teacher')->unsigned()->comment('Số giáo viên');
            $table->integer('school_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_teacher', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
        });

        Schema::create('m_school_teacher_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('teacher', 128)->comment('Giáo viên');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->softDeletes();
        });

        Schema::table('m_school_teacher_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school_teacher');
        });

        Schema::create('m_school_image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 255)->comment('Ảnh trường');
            $table->integer('school_id')->unsigned();
            $table->integer('is_avatar')->nullable()->unsigned()->default(0);
            $table->integer('is_cover')->nullable()->unsigned()->default(0);
            $table->integer('is_intro')->nullable()->unsigned()->default(0);
            $table->integer('is_gallery')->nullable()->unsigned()->default(0);
            $table->integer('is_meta')->nullable()->unsigned()->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_image', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
        });

        Schema::create('m_school_language_course', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_language_id')->unsigned();
            $table->integer('school_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_language_course', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
            $table->foreign('school_language_id')->references('id')->on('m_school_language');
        });

        Schema::create('m_school_category_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_category_id')->unsigned();
            $table->integer('school_id')->unsigned();
            $table->tinyInteger('rating')->unsigned()->default(3)->comment('Giá trị từ 0 đến 10');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_category_rating', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
            $table->foreign('school_category_id')->references('id')->on('m_school_category');
        });

        Schema::create('m_school_attribute_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_attribute_id')->unsigned();
            $table->integer('school_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_attribute_rating', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
            $table->foreign('school_attribute_id')->references('id')->on('m_school_attribute');
        });

        Schema::create('m_school_attribute_addon', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_attribute_addon', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
        });

        Schema::create('m_school_attribute_addon_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('Tên thuộc tính');
            $table->longtext('content', 255)->nullable()->comment('Nội dung render');
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_school_attribute_addon_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_school_attribute_addon');
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
        Schema::dropIfExists('m_school_level');
        Schema::dropIfExists('m_school_level_translation');
        Schema::dropIfExists('m_school_type');
        Schema::dropIfExists('m_school_type_translation');
        Schema::dropIfExists('m_school_language');
        Schema::dropIfExists('m_school_language_translation');
        Schema::dropIfExists('m_school_category');
        Schema::dropIfExists('m_school_category_translation');
        Schema::dropIfExists('m_school_attribute');
        Schema::dropIfExists('m_school_attribute_translation');
        Schema::dropIfExists('m_school_class');
        Schema::dropIfExists('m_school_class_translation');
        Schema::dropIfExists('m_school_class_addon');
        Schema::dropIfExists('m_school_class_addon_translation');
        Schema::dropIfExists('m_school_event');
        Schema::dropIfExists('m_school_event_translation');
        Schema::dropIfExists('m_school');
        Schema::dropIfExists('m_school_translation');
        Schema::dropIfExists('m_school_teacher');
        Schema::dropIfExists('m_school_teacher_translation');
        Schema::dropIfExists('m_school_image');
        Schema::dropIfExists('m_school_language_course');
        Schema::dropIfExists('m_school_category_rating');
        Schema::dropIfExists('m_school_attribute_rating');
        Schema::dropIfExists('m_school_attribute_addon');
        Schema::dropIfExists('m_school_attribute_addon_translation');
        Schema::enableForeignKeyConstraints();
    }
}
