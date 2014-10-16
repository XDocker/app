<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddToDeployment3 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('deployments', function(Blueprint $table)
		{
			$table->text('wsResults')->nullable();
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
			$table->dropColumn('wsResults');
		});
	}

}
