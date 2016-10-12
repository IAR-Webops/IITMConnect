<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffinityProgramsOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('affinity_programs_offers', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('image');
            $table->string('short_details');
            $table->string('long_details', 4000);
            $table->string('offer_code');
            $table->string('offer_code_message');
            $table->string('status');
            $table->string('affinityprogramId');

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
		Schema::drop('affinity_programs_offers');
	}

}
