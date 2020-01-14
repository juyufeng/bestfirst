<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemp002sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp002s', function (Blueprint $table) {
            $table->bigIncrements('id');

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
            $table->string('tag17')->nullable();
            $table->string('tag18')->nullable();
            $table->string('tag19')->nullable();
            $table->string('tag20')->nullable();
            $table->string('tag21')->nullable();


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
        Schema::dropIfExists('temp002s');
    }
}
