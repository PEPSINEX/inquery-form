<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('subject', 40);
            $table->string('content', 4000);
            $table->string('comment', 200)->nullable();
            $table->bigInteger('staff_id')->unsigned()->nullable(); # incrementsに型を合わせるために必要
            $table->foreign('staff_id')->references('id')->on('staffs'); # 外部キー参照
            $table->bigInteger('inquiry_id')->unsigned()->nullable(); # incrementsに型を合わせるために必要
            $table->foreign('inquiry_id')->references('id')->on('inquiries'); # 外部キー参照
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
        Schema::dropIfExists('answers');
    }
}
