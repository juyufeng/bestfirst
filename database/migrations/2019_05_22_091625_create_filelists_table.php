<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilelistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filelists', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id');

            $table->string('pre_entry_id',18)->unique()->comment('自编条码 必填');
            $table->string('bill_no',50)->comment('提运单号')->nullable();
            $table->string('container_number',20)->comment('箱号')->nullable();
            $table->string('notes',150)->comment('备注')->nullable();

            $table->string('oss',30)->comment('OSS服务提供商')->nullable();
            //阿里或七牛
            $table->string('object',255)->comment('阿里/七牛 文件服务器路径')->nullable();
            $table->string('localfile',255)->comment('文件本地路径')->nullable();
            //文件信息
            $table->string('bucket',30)->comment('bucket 只能是小写字母')->nullable();
            $table->string('fsize',255)->comment('资源尺寸，单位为字节')->nullable();
            $table->string('fname',255)->comment('上传的原始文件名。')->nullable();
            $table->string('ext',30)->comment('上传资源的后缀名，通过自动检测的 mimeType 或者$(fname)的后缀来获取。')->nullable();
            $table->string('dot_ext',30)->comment('.exe .pdf .png')->nullable();

            $table->string('is_status1',30)->comment('状态')->nullable();
            $table->string('is_status1_date',30)->comment('状态')->nullable();

            $table->string('is_status2',30)->comment('状态')->nullable();
            $table->string('is_status2_date',30)->comment('状态')->nullable();

            $table->string('is_status3',30)->comment('状态')->nullable();
            $table->string('is_status3_date',30)->comment('状态')->nullable();

            $table->string('is_status4',30)->comment('状态')->nullable();
            $table->string('is_status4_date',30)->comment('状态')->nullable();

            $table->string('is_status5',30)->comment('状态')->nullable();
            $table->string('is_status5_date',30)->comment('状态')->nullable();

            $table->string('is_status6',30)->comment('状态')->nullable();
            $table->string('is_status6_date',30)->comment('状态')->nullable();

            $table->string('is_status7',30)->comment('状态')->nullable();
            $table->string('is_status7_date',30)->comment('状态')->nullable();

            $table->string('is_status8',30)->comment('状态')->nullable();
            $table->string('is_status8_date',30)->comment('状态')->nullable();


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
        Schema::dropIfExists('filelists');
    }
}
