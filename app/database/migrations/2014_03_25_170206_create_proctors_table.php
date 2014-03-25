<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProctorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('proctors', function($table)
        {
            $table->increments('id');
            $table->timestamps(); 
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');

            $table->string('name');

            $table->date('date');

            $table->float('density_wet');
            $table->float('density_dry');
            $table->float('percent_moisture');
            $table->string('description');
            
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::drop('proctors');
	}

}
