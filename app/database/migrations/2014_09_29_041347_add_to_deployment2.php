<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddToDeployment2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('deployments', function(Blueprint $table)
		{
			$table->text('wsParams');
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
			$table->dropColumn('wsParams');
		});
	}

}
