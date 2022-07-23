<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateAdminPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('api_route')->comment('接口路由');
            $table->string('route')->comment('前端路由');
            $table->string('title')->comment('接口名称');
            $table->tinyInteger('status')->default(0)->comment('0.正常.1禁用');
            $table->string('method')->default('*')->comment('方法名称');
            $table->integer('p_id')->default(0)->comment('父节点');
            $table->tinyInteger('hidden')->default(0)->comment('0.否 1.是');
            $table->tinyInteger('is_menu')->default(0)->comment('0.否 1.是');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_permissions');
    }
}
