<?php

class StaticHostelTableSeeder extends Seeder {

    public function run()
    {
        DB::table('static_hostels')->delete();

        StaticHostel::create(array('hostel_name' => 'Alakananda',   'hostel_code' => 'AK'));
        StaticHostel::create(array('hostel_name' => 'Brahmaputra',  'hostel_code' => 'BH'));
        StaticHostel::create(array('hostel_name' => 'Cauvery',      'hostel_code' => 'CY'));
        StaticHostel::create(array('hostel_name' => 'Day Scholar',  'hostel_code' => 'DS'));
        StaticHostel::create(array('hostel_name' => 'Ganga',        'hostel_code' => 'GN'));
        StaticHostel::create(array('hostel_name' => 'Godavari',     'hostel_code' => 'GD'));
        StaticHostel::create(array('hostel_name' => 'Jamuna',       'hostel_code' => 'JM'));
        StaticHostel::create(array('hostel_name' => 'Krishna',      'hostel_code' => 'KN'));
        StaticHostel::create(array('hostel_name' => 'Mahanadhi',    'hostel_code' => 'MH'));
        StaticHostel::create(array('hostel_name' => 'Mandakini',    'hostel_code' => 'MN'));
        StaticHostel::create(array('hostel_name' => 'Narmada',      'hostel_code' => 'AK'));
        StaticHostel::create(array('hostel_name' => 'Pampa',        'hostel_code' => 'PM'));
        StaticHostel::create(array('hostel_name' => 'Sabarmati',    'hostel_code' => 'SB'));
        StaticHostel::create(array('hostel_name' => 'Saraswathi',   'hostel_code' => 'SW'));
        StaticHostel::create(array('hostel_name' => 'Sarayu',       'hostel_code' => 'SY'));
        StaticHostel::create(array('hostel_name' => 'Sharavati',    'hostel_code' => 'SH'));
        StaticHostel::create(array('hostel_name' => 'Sindhu',       'hostel_code' => 'SI'));
        StaticHostel::create(array('hostel_name' => 'Tamraparani',  'hostel_code' => 'TP'));
        StaticHostel::create(array('hostel_name' => 'Tapti',        'hostel_code' => 'TA'));
        StaticHostel::create(array('hostel_name' => 'Tunga',        'hostel_code' => 'TU'));
    }

}