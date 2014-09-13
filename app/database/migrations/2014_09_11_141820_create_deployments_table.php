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
            $table->integer('cloud_account_id')->unsigned()->index();
            $table->foreign('cloud_account_id')->references('id')->on('cloud_accounts');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('parameters');
            $table->string('status');
            $table->timestamps();
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
