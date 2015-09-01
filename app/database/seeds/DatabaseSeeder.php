<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');

		$this->call('StaticDepartmentTableSeeder');
        $this->command->info('static_departments table seeded!');

		$this->call('StaticHostelTableSeeder');
        $this->command->info('static_hostels table seeded!');

		$this->call('StaticMinorTableSeeder');
        $this->command->info('static_minors table seeded!');
	}

}
