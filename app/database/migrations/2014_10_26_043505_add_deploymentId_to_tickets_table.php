<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDeploymentIdToTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `accounts` table
		
		Schema::table('tickets', function(Blueprint $table)
		{
			$table->integer('deploymentId');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `accounts` table
		Schema::table('tickets', function(Blueprint $table)
		{
			$table->dropColumn('deploymentId');

		});
	}

}
