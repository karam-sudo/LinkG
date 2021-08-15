<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
class CreateForeignKeys extends Migration {

	public function up()
	{

		Schema::table('projects', function(Blueprint $table) {
			$table->foreign('Service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
			
						
		});

		Schema::table('positions', function(Blueprint $table) {
			$table->foreign('Service_id')->references('id')->on('services')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('team_members', function(Blueprint $table) {
			$table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('jobtime_id')->references('id')->on('job_times')->onDelete('cascade')->onUpdate('cascade');	
			$table->foreign('jobtype_id')->references('id')->on('job_types')->onDelete('cascade')->onUpdate('cascade');	
			$table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');	
		});

		Schema::table('employees', function(Blueprint $table) {

			$table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade')->onUpdate('cascade');
				
		});

		

	}

	public function down()
	{
		
		Schema::table('projects', function(Blueprint $table) {
			$table->dropForeign('projects_Service_id_foreign');
		});

		Schema::table('positions', function(Blueprint $table) {
			$table->dropForeign('positions_Service_id_foreign');
		});
		
	}
}