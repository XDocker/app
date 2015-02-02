<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ContainersDeploymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `accounts` table
		
		Schema::table('deployments', function(Blueprint $table)
		{
			$table->text('containers');

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
		Schema::table('deployments', function(Blueprint $table)
		{
			$table->dropColumn('containers');

		});
	}

}
