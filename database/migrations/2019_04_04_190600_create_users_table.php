<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('email')->unique(); 
            $table->string('password');
            $table->date('date_of_birth');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->timestamp ('email_verified_at')-> nullable();
            $table->string('comment')->nullable();
            $table->boolean('status')->nullable()->default(0);
            $table->rememberToken();
            $table->softDeletes();
           
            $table->timestamps();

            $table->foreign('department_id')
            ->references('id')
            ->on('departments');
            
            $table->foreign('employee_id')
            ->references('id')
            ->on('employment_data')
            ->onDelete('cascade');
            $table->foreign('contact_id')
            ->references('id')
            ->on('contact_data')
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
        Schema::dropIfExists('users');
    }
}
