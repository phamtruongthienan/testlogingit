<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchSubscribeManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('m_subscribe');
        Schema::enableForeignKeyConstraints();

        // Cấu hình subscribe
        Schema::create('m_subscribe', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 64);
            $table->tinyInteger('status')->unsigned()->default(0)->comment('Trạng thái: (1) Có thể gửi, (0) Không');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
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
        Schema::dropIfExists('m_subscribe');
        Schema::enableForeignKeyConstraints();
    }
}
