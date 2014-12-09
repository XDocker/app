<?php
/**
* Class and Function List:
* Function list:
* - up()
* - (()
* - down()
* Classes list:
* - CreateDeploymentsTable extends Migration
*/
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeploymentsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('deployments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('docker_name');
            $table->integer('cloudAccountId')->unsigned()->index();
            $table->foreign('cloudAccountId')->references('id')->on('cloudAccounts');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('parameters');
			$table->text('job_id');
			$table->text('wsParams');
			$table->text('wsResults')->nullable();
            $table->string('status');
            $table->timestamps();
			$table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('deployments');
    }
}
