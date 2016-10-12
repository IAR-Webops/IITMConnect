<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffinityProgramsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('affinity_programs', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('unique_name');
            $table->string('image');
            $table->string('short_details');
            $table->string('long_details', 4000);
            $table->string('status');

            $table->string('created_at');
            $table->string('updated_at');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('affinity_programs');
	}

}
