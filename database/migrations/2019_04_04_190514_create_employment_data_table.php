<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start_job_date');
            $table->float('salary');
            $table->enum('working_hours',config('enum.working_hours'));
            $table->enum('tax_office',config('enum.tax_office'));
            $table->date('health_exam_from');
            $table->date('health_exam_to');
            $table->string('position')->nullable;
            $table->string('bank_account');
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
        Schema::dropIfExists('employment_data');
    }
}
