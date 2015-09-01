<?php

class StaticDepartmentTableSeeder extends Seeder {

    public function run()
    {
        DB::table('static_departments')->delete();

        StaticDepartment::create(array('deptartment_name' => 'Aerospace Engineering',					'deptartment_code' => 'AE'));
        StaticDepartment::create(array('deptartment_name' => 'Applied Mechanics',						'deptartment_code' => 'AM'));
        StaticDepartment::create(array('deptartment_name' => 'Bio-Technology',							'deptartment_code' => 'BT'));
        StaticDepartment::create(array('deptartment_name' => 'Civil Engineering',						'deptartment_code' => 'CE'));
        StaticDepartment::create(array('deptartment_name' => 'Chemical Engineering',					'deptartment_code' => 'CH'));
        StaticDepartment::create(array('deptartment_name' => 'Computer Science and Engg.',				'deptartment_code' => 'CS'));
        StaticDepartment::create(array('deptartment_name' => 'Chemistry',								'deptartment_code' => 'CY'));
        StaticDepartment::create(array('deptartment_name' => 'Engineering Design',						'deptartment_code' => 'ED'));
        StaticDepartment::create(array('deptartment_name' => 'Electrical Engineering',					'deptartment_code' => 'EE'));
        StaticDepartment::create(array('deptartment_name' => 'Humanities and Social Sciences',			'deptartment_code' => 'HS'));
        StaticDepartment::create(array('deptartment_name' => 'Mathematics',								'deptartment_code' => 'MA'));
        StaticDepartment::create(array('deptartment_name' => 'Mechanical Engineering',					'deptartment_code' => 'ME'));
        StaticDepartment::create(array('deptartment_name' => 'Metallurgical and Materials Engineering',	'deptartment_code' => 'MM'));
        StaticDepartment::create(array('deptartment_name' => 'Management Studies',						'deptartment_code' => 'MS'));
        StaticDepartment::create(array('deptartment_name' => 'Ocean Engineering',						'deptartment_code' => 'OE'));
        StaticDepartment::create(array('deptartment_name' => 'Physics',									'deptartment_code' => 'PH'));
    }

}