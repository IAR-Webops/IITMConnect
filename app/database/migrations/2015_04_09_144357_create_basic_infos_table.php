<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('basic_infos', function($table)
        {
            $table->increments('id');
            $table->integer('user_id');            
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('department');
            $table->string('minor');
            $table->string('optionsRadiosDegree');
            $table->string('projectguide');                                
            $table->string('email');                                
            $table->string('phone');                                
            $table->string('phonehome');                                
            $table->string('graduatingyear');
            $table->string('optionsRadiosFuture');
            $table->string('future_field1');
            $table->string('future_field2');
            $table->string('future_field3');
            $table->string('current_city');            

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
		Schema::drop('basic_infos');
	}

}
