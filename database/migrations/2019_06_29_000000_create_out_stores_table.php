<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_stores', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('abstract')->comment('摘要')->nullable();
            $table->string('outstore_date')->comment('出库日期')->nullable();
            $table->string('outstore_no')->comment('单据编号-出库单号')->nullable();
            $table->string('unit_no')->comment('单位编号')->nullable();
            $table->string('unit_name')->comment('单位名称')->nullable();
            $table->string('good_no')->comment('商品编号')->nullable();
            $table->string('good_name')->comment('商品名称')->nullable();
            $table->string('good_specification')->comment('商品规格')->nullable();
            $table->string('manufacturer')->comment('生产厂家')->nullable();
            $table->string('good_unit')->comment('商品单位')->nullable();
            $table->string('batch_no')->comment('商品批号')->nullable();
            $table->string('efffctive_date')->comment('有效日期')->nullable();
            $table->string('number')->comment('数量')->nullable();
            $table->string('tax_unit_price')->comment('含税单价')->nullable();
            $table->string('total_tax_price')->comment('含税总价')->nullable();
            $table->string('unit_price')->comment('单价')->nullable();
            $table->string('amount')->comment('金额')->nullable();
            $table->string('tax')->comment('税额')->nullable();

            $table->string('good_location_name')->comment('货位名称')->nullable();
            $table->string('rack_no')->comment('架位号')->nullable();
            $table->string('dosage_form')->comment('剂型')->nullable();
            $table->string('department_name')->comment('部门名称')->nullable();
            $table->string('person_business')->comment('业务员')->nullable();
            $table->string('drawer')->comment('开票人')->nullable();
            $table->string('payment_mothod')->comment('付款方式')->nullable();
            $table->string('ticket_mothod')->comment('发票方式')->nullable();
            $table->string('ticket_no')->comment('票号')->nullable();
            $table->string('relevant_doc_no')->comment('相关单据编号')->nullable();
            $table->string('person_work')->comment('操作员')->nullable();
            $table->string('note')->comment('备注')->nullable();





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
        Schema::dropIfExists('out_stores');
    }
}


//
//$table->string('efffctive_date')->comment('有效日期')->nullable();
//$table->string('efffctive_date')->comment('有效日期')->nullable();
//$table->string('number')->comment('数量')->nullable();
//$table->string('tax_unit_price')->comment('含税单价')->nullable();
//$table->string('total_tax_price')->comment('含税总价')->nullable();
//$table->string('unit_price')->comment('单价')->nullable();
//$table->string('amount')->comment('金额')->nullable();
//$table->string('tax')->comment('税额')->nullable();
//$table->string('good_location_name')->comment('货位名称')->nullable();
//$table->string('rack_no')->comment('架位号')->nullable();
//$table->string('dosage_form')->comment('剂型')->nullable();
//$table->string('department_name')->comment('部门名称')->nullable();
//$table->string('person_business')->comment('业务员')->nullable();
//$table->string('drawer')->comment('开票人')->nullable();
//$table->string('ticket_no')->comment('票号')->nullable();
//$table->string('relevant_doc_no')->comment('相关单据编号')->nullable();
//$table->string('person_work')->comment('操作员')->nullable();
//$table->string('note')->comment('备注')->nullable();