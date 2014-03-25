<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('tests', function($table)
        {
            $table->increments('id');
            $table->timestamps(); 
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->integer('proctor_id')->unsigned();
            $table->foreign('proctor_id')->references('id')->on('proctors');
            $table->integer('number');
            $table->date('date');
            $table->string('elevation');
            $table->float('lat');
            $table->float('lng');

            $table->string('description');
            $table->string('location');
            $table->text('notes');

            $table->float('density_wet');
            $table->float('density_dry');
            $table->float('percent_moisture');

            $table->float('density_required');

            $table->float('compaction_percent');
            
            $table->integer('retest_of_number');
            
            $table->boolean('pass');
            
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
        Schema::drop('tests');
	}

}
