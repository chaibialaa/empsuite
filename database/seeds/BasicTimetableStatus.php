<?php

use Illuminate\Database\Seeder;

class BasicTimetableStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timetable_types')->insert([
            'title' => 'Routine',

        ]);

        DB::table('timetable_types')->insert([
            'title' => 'Exams',

        ]);


    }
}
