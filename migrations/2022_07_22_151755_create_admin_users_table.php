<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->string('email',50);
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->string('remember_token',100);
            $table->string('avatar');
            $table->tinyInteger('status')->default(0)->comment('0.正常.1禁用');
            $table->integer('ding_id')->default(0);
            $table->integer('oauth_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_users');
    }
}
