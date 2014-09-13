<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTypeToCloudAccounts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cloud_accounts', function(Blueprint $table)
		{
			$table->string('cloudProvider');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cloud_accounts', function(Blueprint $table)
		{
			$table->dropColumn('cloudProvider');
		});
	}

}
