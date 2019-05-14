<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_leave', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('type_of_leave_id');
            $table->integer('total_availble');
            $table->integer('total_used');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('user_id')
            -> references('id')
            ->on('users')
            ->onDelete('cascade');  
            
            $table->foreign('type_of_leave_id')
            -> references('id')
            ->on('type_of_leave')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::DropIfExists('status_leave');
    }
}
