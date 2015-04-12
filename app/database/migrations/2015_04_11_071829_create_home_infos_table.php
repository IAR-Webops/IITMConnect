<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('home_infos', function($table)
            {
                  $table->increments('id');
                  $table->integer('user_id');            
                  $table->string('fathersname');
                  $table->string('mothersname');
                  $table->string('permaddline1');
                  $table->string('permaddline2');
                  $table->string('permcity');
                  $table->string('permstate');
                  $table->string('permpincode');                                
                  $table->string('permcountry');                                
                  $table->string('permphonelandline');                                
                  $table->string('permphonemobile');
                  
                  $table->string('checkboxmailadd');
                  $table->string('mailaddline1');
                  $table->string('mailaddline2');
                  $table->string('mailcity');
                  $table->string('mailstate');
                  $table->string('mailpincode');
                  $table->string('mailcountry');
                  $table->string('mailphonelandline');
                  $table->string('mailphonemobile');

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
		Schema::drop('home_infos');		
	}

}
