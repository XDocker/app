<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ContainersAccountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `accounts` table
		
		Schema::create('accountContainers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('containers');
			$table->integer('cloudAccountId')->unsigned()->index();
			$table->foreign('cloudAccountId')->references('id')->on('cloudAccounts')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->softDeletes();
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
		Schema::drop('accountContainers');
	}

}
