<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateAdminLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api')->comment('接口路由');
            $table->string('route')->comment('前端路由');
            $table->string('method')->comment('请求方法');
            $table->string('ip')->comment('ip地址');
            $table->string('token')->comment('token');
            $table->string('user_id')->comment('用户id');
            $table->json('action')->nullable()->comment('操作参数');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_logs');
    }
}
