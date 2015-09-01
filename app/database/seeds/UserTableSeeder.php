<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array('rollno' => 'foo1@bar.com','active' => 'test'));
        User::create(array('rollno' => 'foo3@bar.com','active' => 'test'));
    }

}