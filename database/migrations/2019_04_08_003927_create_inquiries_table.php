<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 16)->index();
            $table->string('email', 200)->index();
            $table->string('phone_number', 13);
            $table->string('product_type', 4);
            $table->string('content', 2000);
            $table->string('status')->default('00');
            $table->bigInteger('staff_id')->unsigned()->nullable(); # incrementsに型を合わせるために必要
            $table->foreign('staff_id')->references('id')->on('staffs'); # 外部キー参照
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
        Schema::dropIfExists('inquiries');
    }
}
