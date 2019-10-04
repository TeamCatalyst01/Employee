<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->mediumText('address');
            $table->date('join_date');
            $table->date('birth_date');
            $table->string('gender');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->integer('age');
            $table->string('picture');
            /**
             *  if we need add a foreign key constraint then
             *  the column should be unsigned integer
             */
            $table->integer('dept_id')->unsigned();
            $table->integer('designation_id')->unsigned();
            $table->integer('salary_id')->unsigned();
       

            /**
             *  Add foreign key constraints to these columns
             */
            $table->foreign('dept_id')->references('id')->on('departments');
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->foreign('salary_id')->references('id')->on('salaries');
            $table->timestamps();
            
            /**
             *  Add Soft Deletes.
             * 
             *  it just mean that if we are deleting a row, then
             *  it will not delete row. it will just add a value to
             *  deleted_at column.
             */
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
