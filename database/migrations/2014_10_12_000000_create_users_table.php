<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            //            $table->integer('role_id')->default(2);
            //            $table->string('settings')->nullable();
            $table->string('name', 30)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email',60)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->default('https://openkbuy.oss-cn-shanghai.aliyuncs.com/openimage/AppStatic/emptyImagehead.png');
            $table->tinyInteger('vip_level')->default(0);
            $table->string('buyer_pop', 30)->nullable();
            $table->string('vendor_pop', 30)->nullable();
            $table->string('ticket',30)->nullable();
            $table->string('type',30)->nullable();
            $table->string('xin',30)->nullable();
            $table->decimal('ya', 15)->default(0);
            $table->string('open_mark', 50)->nullable();

            $table->boolean('is_lock')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
