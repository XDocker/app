<?php

use Illuminate\Database\Migrations\Migration;

class CreateTicketCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `accounts` table
		Schema::create('ticket_comments', function($table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned()->index();
			$table->integer('ticket_id')->unsigned()->index();
			$table->string('title');
			$table->text('description');
			$table->boolean('active')->default(false);
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
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
		Schema::drop('ticket_comments');
	}

}
