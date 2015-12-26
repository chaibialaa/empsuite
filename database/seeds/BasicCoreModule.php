<?php

use Illuminate\Database\Seeder;

class BasicCoreModule extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_modules')->insert([
            'title' => 'Core'
        ]);

        DB::table('core_modules')->insert([
            'title' => 'Notice'
        ]);

        DB::table('core_modules')->insert([
            'title' => 'Message'
        ]);
        DB::table('core_modules')->insert([
            'title' => 'Level'
        ]);
        DB::table('core_modules')->insert([
            'title' => 'Resource'
        ]);
        DB::table('core_modules')->insert([
            'title' => 'Role'
        ]);
        DB::table('core_modules')->insert([
            'title' => 'Subject'
        ]);

        DB::table('core_modules')->insert([
            'title' => 'Timetable'
        ]);
        DB::table('core_modules')->insert([
            'title' => 'User'
        ]);
    }
}
