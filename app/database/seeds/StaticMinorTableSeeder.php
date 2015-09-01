<?php

class StaticMinorTableSeeder extends Seeder {

    public function run()
    {
        DB::table('static_minors')->delete();

        StaticMinor::create(array('minor_name' => 'An introduction of Nano Science and Technology'));
        StaticMinor::create(array('minor_name' => 'Biomedical Engg.'));
        StaticMinor::create(array('minor_name' => 'Computational Biology'));
        StaticMinor::create(array('minor_name' => 'Development Policy'));
        StaticMinor::create(array('minor_name' => 'Economics'));
        StaticMinor::create(array('minor_name' => 'Energy Technology'));
        StaticMinor::create(array('minor_name' => 'Engineering in Everyday Life'));
        StaticMinor::create(array('minor_name' => 'English Studies'));
        StaticMinor::create(array('minor_name' => 'Foundations in Physics'));
        StaticMinor::create(array('minor_name' => 'From Molecules to Materials Structure, Dynamics and Functions'));
        StaticMinor::create(array('minor_name' => 'Industrial Engineering'));
        StaticMinor::create(array('minor_name' => 'Management'));
        StaticMinor::create(array('minor_name' => 'Materials Technology'));
        StaticMinor::create(array('minor_name' => 'Mathematics for Computer Science'));
        StaticMinor::create(array('minor_name' => 'Medical Bio­technology'));
        StaticMinor::create(array('minor_name' => 'Micro Electronics'));
        StaticMinor::create(array('minor_name' => 'Ocean Technology'));
        StaticMinor::create(array('minor_name' => 'Operations Research'));
        StaticMinor::create(array('minor_name' => 'Photonics'));
        StaticMinor::create(array('minor_name' => 'Robotics'));
        StaticMinor::create(array('minor_name' => 'Social Entrepreneurship'));
        StaticMinor::create(array('minor_name' => 'Structural Mechanics'));
        StaticMinor::create(array('minor_name' => 'Sustainable Infrastructure EnviromentManagement'));
        StaticMinor::create(array('minor_name' => 'Systems Engg.'));
        StaticMinor::create(array('minor_name' => 'Other'));
       
    }

}