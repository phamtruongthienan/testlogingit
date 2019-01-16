<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_adverts');
        Schema::dropIfExists('m_adverts_translation');
        Schema::dropIfExists('m_client');
        Schema::dropIfExists('m_client_translation');
        Schema::enableForeignKeyConstraints();

        // Cấu hình quảng cáo
        Schema::create('m_adverts', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type')->nullable()->comment('Loại popup: (1) Mở cửa sổ mới,(2) Modal,(3) Tĩnh,(4) Video');
            $table->tinyInteger('position')->nullable()->default(1)->comment('Vị trí popup: (1) Đầu trang, (2) Cuối trang, (3) Sidebar, (4) ...');
            $table->tinyInteger('target')->nullable()->default(1)->comment('Chỉ định trang: (1) All, (2) Homepage, (3) trang chi tiết trường');
            $table->string('link', 255)->nullable()->comment('URL chỉ định');
            $table->timestamp('start_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('status')->nullable()->default(1)->comment('Trạng thái: (1) Kích hoạt, (0) Tắt');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('m_adverts_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->longtext('content', 64)->nullable()->comment('Nội dung quảng cáo');
            $table->string('image', 255)->nullable()->comment('URL của logo, chỉ lưu path');
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_adverts_translation', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_adverts');
        });

        // Cấu hình đối tác liên kết
        Schema::create('m_client', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('sort');
            $table->tinyInteger('status')->default(1)->comment('Trạng thái: (1) Kích hoạt, (0) Tắt');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('m_client_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->nullable()->comment('Tên đối tác');
            $table->string('address', 128)->nullable();
            $table->string('email', 64)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('job', 255)->nullable()->comment('Ngành nghề');
            $table->longtext('content', 64)->nullable()->comment('Nội dung giới thiệu');
            $table->bigInteger('investment')->nullable()->comment('Vốn đầu tư');
            $table->smallInteger('staff')->nullable()->comment('Số nhân viên');
            $table->string('logo', 255)->nullable()->comment('URL của logo, chỉ lưu path');
            $table->integer('school_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->integer('translation_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::table('m_client_translation', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('m_school');
            $table->foreign('language_id')->references('id')->on('config_language');
            $table->foreign('translation_id')->references('id')->on('m_client');
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
        Schema::dropIfExists('m_adverts');
        Schema::dropIfExists('m_client');
        Schema::enableForeignKeyConstraints();
    }
}
