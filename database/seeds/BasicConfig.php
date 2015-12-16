<?php

use Illuminate\Database\Seeder;

class BasicConfig extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->insert([
            'title' => 'default',
            'type' => 'backend',
            'status' => '1',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('themes')->insert([
            'title' => 'default',
            'type' => 'frontend',
            'status' => '1',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('core')->insert([
            'titre' => 'EMPsuite v2',
            'backend-theme' => '1',
            'frontend-theme' => '2',
            'created_at' => date("Y-m-d H:i:s"),
            'catchmail' => 'bounce@bluepenlabs.com'
        ]);
    }
}
