<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_stores', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('instore_no')->comment('单据编号')->nullable();
            $table->string('instore_date')->comment('入库日期')->nullable();
            $table->string('person_business')->comment('业务员')->nullable();
            $table->string('unit_name')->comment('单位名称')->nullable();
            $table->string('department_name')->comment('部门名称')->nullable();

            $table->string('good_name')->comment('商品名称')->nullable();
            $table->string('good_style')->comment('商品规格')->nullable();
            $table->string('good_specification')->comment('商品规格')->nullable();
            $table->string('good_unit')->comment('商品单位')->nullable();
            $table->string('manufacturer')->comment('生产厂家')->nullable();
            $table->string('batch_no')->comment('商品批号')->nullable();
            $table->string('efffctive_date')->comment('有效日期')->nullable();
            $table->string('metro_specification')->comment('计量规格')->nullable();
            $table->string('package_number')->comment('包装数量')->nullable();
            $table->string('bit_number')->comment('零散数量')->nullable();

            $table->string('number')->comment('数量')->nullable();
            $table->string('tax_unit_price')->comment('含税单价')->nullable();
            $table->string('total_tax_price')->comment('含税总价')->nullable();
            $table->string('unit_price')->comment('单价')->nullable();
            $table->string('amount')->comment('金额')->nullable();
            $table->string('tax')->comment('税额')->nullable();

            $table->string('discount')->comment('扣率')->nullable();
            $table->string('retail_price')->comment('零售单价')->nullable();
            $table->string('retail_total_price')->comment('零售总价')->nullable();
            $table->string('dosage_form')->comment('剂型')->nullable();

            $table->string('drug_categories')->comment('药品大类')->nullable();
            $table->string('category')->comment('类别')->nullable();
            $table->string('good_location_name')->comment('货位名称')->nullable();

            $table->string('unit_no')->comment('单位编号')->nullable();
            $table->string('good_no')->comment('商品编号')->nullable();

            $table->string('note')->comment('备注')->nullable();
            $table->string('relevant_doc_no')->comment('相关单据编号')->nullable();

            $table->string('receive_persion1')->comment('收货员1')->nullable();

            $table->string('inspector_persion1')->comment('验收员1')->nullable();
            $table->string('inspector_persion2')->comment('验收员2')->nullable();

            $table->string('keeper_persion1')->comment('保管员1')->nullable();
            $table->string('keeper_persion2')->comment('保管员2')->nullable();

            $table->string('HZ')->comment('HZ')->nullable();
            $table->string('unit_cost')->comment('成本单价')->nullable();
            $table->string('KA_price')->comment('KA价')->nullable();
            $table->string('inprovince_price')->comment('省内价')->nullable();

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
        Schema::dropIfExists('in_stores');
    }
}
