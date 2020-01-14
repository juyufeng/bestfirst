<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShWorkNosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sh_work_nos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id');
            $table->string('pre_entry_id',18)->comment('自编条码')->nullable();
            $table->string('entry_id',18)->comment('海关编号')->nullable();
            $table->string('edi_no',18)->comment('统一编号')->nullable();
            $table->string('wt_name', 20)->comment('委托单位')->nullable();
            $table->string('client_co', 30)->comment('客户代码')->nullable();
            $table->string('client_name', 30)->comment('客户名称')->nullable();
            $table->string('client_workco', 30)->comment('客户编号co')->nullable();
            $table->string('client_workid', 30)->comment('客户编号id')->nullable();
            $table->string('traf_name', 60)->comment('运输工具')->nullable();
            $table->string('voyage_no', 30)->comment('航次')->nullable();
            $table->string('bill_no', 50)->comment('提运单号')->nullable();
            $table->string('trade_id', 18)->comment('经营单位id')->nullable();
            $table->string('trade_co', 10)->comment('经营单位co')->nullable();
            $table->string('trade_name', 38)->comment('经营单位name')->nullable();
            $table->string('trade_mode', 20)->comment('贸易方式')->nullable();
            $table->string('contr_no', 50)->comment('合同号')->nullable();
            $table->string('manual_no', 20)->comment('手册号')->nullable();
            $table->string('container_number', 20)->comment('箱号')->nullable();
            $table->string('good_name', 150)->comment('商品名称')->nullable();
            $table->string('notes', 250)->comment('备注')->nullable();
            $table->string('pdf_filename', 250)->comment('pdf文件名称')->nullable();

            $table->string('is_status1', 30)->comment('状态')->nullable();
            $table->string('is_status1_date', 20)->comment('状态')->nullable();

            $table->string('is_status2', 30)->comment('状态')->nullable();
            $table->string('is_status2_date', 20)->comment('状态')->nullable();

            $table->string('is_status3', 30)->comment('状态')->nullable();
            $table->string('is_status3_date', 20)->comment('状态')->nullable();

            $table->string('is_status4', 30)->comment('状态')->nullable();
            $table->string('is_status4_date', 20)->comment('状态')->nullable();

            $table->string('is_status5', 30)->comment('状态')->nullable();
            $table->string('is_status5_date', 20)->comment('状态')->nullable();

            $table->string('is_status6', 30)->comment('状态')->nullable();
            $table->string('is_status6_date', 20)->comment('状态')->nullable();

            $table->string('is_status7', 30)->comment('状态')->nullable();
            $table->string('is_status7_date', 20)->comment('状态')->nullable();

            $table->string('is_status8', 30)->comment('状态')->nullable();
            $table->string('is_status8_date', 20)->comment('状态')->nullable();

            $table->string('is_status9', 30)->comment('状态')->nullable();
            $table->string('is_status9_date', 20)->comment('状态')->nullable();

            $table->string('is_flog1', 30)->comment('状态')->nullable();
            $table->string('is_flog1_date', 20)->comment('状态')->nullable();

            $table->string('is_flog2', 30)->comment('状态')->nullable();
            $table->string('is_flog2_date', 20)->comment('状态')->nullable();

            $table->string('is_flog3', 30)->comment('状态')->nullable();
            $table->string('is_flog3_date', 20)->comment('状态')->nullable();

            $table->string('is_flog4', 30)->comment('状态')->nullable();
            $table->string('is_flog4_date', 20)->comment('状态')->nullable();

            $table->string('is_flog5', 30)->comment('状态')->nullable();
            $table->string('is_flog5_date', 20)->comment('状态')->nullable();

            $table->string('is_flog6', 30)->comment('状态')->nullable();
            $table->string('is_flog6_date', 20)->comment('状态')->nullable();

            $table->string('is_flog7', 30)->comment('状态')->nullable();
            $table->string('is_flog7_date', 20)->comment('状态')->nullable();

            $table->string('is_flog8', 30)->comment('状态')->nullable();
            $table->string('is_flog8_date', 20)->comment('状态')->nullable();

            $table->string('is_flog9', 30)->comment('状态')->nullable();
            $table->string('is_flog9_date', 20)->comment('状态')->nullable();

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
        Schema::dropIfExists('sh_work_nos');
    }
}
