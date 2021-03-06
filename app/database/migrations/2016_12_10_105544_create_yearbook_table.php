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
			$table->string('insti_remember_for', 8000);
			$table->string('insti_name');
			$table->string('insti_life_icons');
			$table->string('insti_craziest_moment', 8000);
			$table->string('grad_year');
			$table->string('order_status');
			$table->string('batch_project');
			$table->text('insti_story');
			$table->string('group_pic_1', 500);
			$table->string('group_pic_2', 500);
			$table->string('group_pic_3', 500);

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
