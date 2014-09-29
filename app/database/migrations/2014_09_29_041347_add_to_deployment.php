<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddToDeployment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('deployments', function(Blueprint $table)
		{
			$table->string('token');
			$table->text('parameters');
			$table->text('job_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('deployments', function(Blueprint $table)
		{
			$table->dropColumn('token');
			$table->dropColumn('parameters');
			$table->dropColumn('job_id');
		});
	}

}
