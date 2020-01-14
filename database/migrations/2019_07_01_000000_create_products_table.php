<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('mulu')->comment('目录')->nullable();
            $table->string('xitongbianma')->comment('系统编码')->nullable();
            $table->string('tongyongming')->comment('通用名')->nullable();
            $table->string('guige')->comment('规格')->nullable();
            $table->string('jixing')->comment('剂型')->nullable();
            $table->string('changjia')->comment('厂家')->nullable();
            $table->string('pizhunwenhao')->comment('批准文号')->nullable();
            $table->string('shoucilaihuo1')->comment('首次来货单位1')->nullable();
            $table->string('qiquan1')->comment('齐全1')->nullable();
            $table->string('cunzaiwenti1')->comment('存在问题1')->nullable();
            $table->string('shoucilaihuo2')->comment('首次来货单位2')->nullable();
            $table->string('qiquan2')->comment('齐全2')->nullable();
            $table->string('cunzaiwenti2')->comment('存在问题2')->nullable();

            $table->string('tag1')->nullable();
            $table->string('tag2')->nullable();
            $table->string('tag3')->nullable();
            $table->string('tag4')->nullable();
            $table->string('tag5')->nullable();
            $table->string('tag6')->nullable();
            $table->string('tag7')->nullable();
            $table->string('tag8')->nullable();
            $table->string('tag9')->nullable();
            $table->string('tag10')->nullable();
            $table->string('tag11')->nullable();
            $table->string('tag12')->nullable();
            $table->string('tag13')->nullable();
            $table->string('tag14')->nullable();
            $table->string('tag15')->nullable();
            $table->string('tag16')->nullable();


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
        Schema::dropIfExists('products');
    }
}
