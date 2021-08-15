<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->text('Name');
            $table->string('Email')->unique();
            $table->string('Phone');
            $table->bigInteger('gender_id')->unsigned();
            $table->bigInteger('jobtime_id')->unsigned();
            $table->bigInteger('jobtype_id')->unsigned();
            $table->date('Date_Birth');
            $table->bigInteger('service_id')->unsigned();
            $table->bigInteger('position_id')->unsigned();
            $table->bigInteger('currency_id')->unsigned();
            $table->string('salary');
            $table->string('Address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_members');
    }
}
