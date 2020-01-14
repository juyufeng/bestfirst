<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('p_title', 255)->nullable();
            $table->boolean('enable')->default(1);
            $table->string('project_head_image')->nullable();
            $table->string('project_body_image')->nullable();
            $table->string('type1',10)->nullable();
            $table->string('type2',10)->nullable();
            $table->string('type3',10)->nullable();
            $table->string('type4',10)->nullable();
            $table->string('type5',10)->nullable();
            $table->string('type6',10)->nullable();
            $table->string('type7',10)->nullable();
            $table->string('type8',10)->nullable();

            $table->mediumText('p_content')->nullable();
            $table->string('ex_ticket', 50)->nullable();
            $table->string('state_code', 10)->nullable();
            $table->string('state_msg', 50)->nullable();
            $table->bigInteger('owner_id')->comment('项目发布者')->default(0);
            $table->bigInteger('get_user_id')->comment('项目接受者')->default(0);
            $table->string('check_user_id')->comment('项目审核人')->default(0);
            $table->decimal('fee')->comment('总费用')->default(0);
            $table->decimal('charge')->comment('佣金')->default(0);
            $table->integer('charge_rate')->default('3')->comment('佣金比例 %');
            $table->integer('viewer_count')->default(0)->comment('阅读数');
            $table->integer('zan_count')->default(0)->comment('点赞数');
            $table->integer('unzan_count')->default(0)->comment('不赞数');
            $table->integer('reporter_count')->default(0)->comment('报名人数');
            //对用户不可见
            $table->integer('rank')->default(0);
            $table->string('search_tag1')->nullable()->comment('用户自定义搜索标签');
            $table->string('search_tag2')->nullable();
            $table->string('search_tag3')->nullable();
            $table->string('search_tag4')->nullable();
            $table->string('search_tag5')->nullable();

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
        Schema::dropIfExists('temp003s');
    }
}
