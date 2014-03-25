<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

        Schema::create('accounts', function($table)
        {
            $table->increments('id');
            $table->string('companyname');
            $table->timestamps();
        });

        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->string('username', 20);
            $table->string('firstname', 20);
            $table->string('lastname', 20);
            $table->string('email', 100)->unique();
            $table->string('password', 64);
            $table->timestamps(); 
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('accounts');
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
        Schema::drop('users');
        Schema::drop('accounts');
	}

}