<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearbookTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('yearbook', function($table)
        {
            $table->increments('id');
            $table->integer('user_id');
			$table->string('remember_insti_for', 8000);
			$table->string('insti_name');
			$table->string('insti_life_icons');
			$table->string('grad_year');

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
		Schema::drop('yearbook');
	}

}
