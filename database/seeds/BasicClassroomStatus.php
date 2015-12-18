<?php

use Illuminate\Database\Seeder;

class BasicClassroomStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classroom_statuses')->insert([
            'title' => 'Available',

        ]);

        DB::table('classroom_statuses')->insert([
            'title' => 'Maintenance',

        ]);


    }
}
