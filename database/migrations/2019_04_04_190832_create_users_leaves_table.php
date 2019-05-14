<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('type_of_leave_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('confirm')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('user_id')
            -> references('id')
            ->on('users');  

            
            $table->foreign('type_of_leave_id')
            -> references('id')
            ->on('type_of_leave') ;
           

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::DropIfExists('users_leaves');
    }
}
