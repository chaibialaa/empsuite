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
        DB::table('core')->insert([
            'titre' => 'EMPsuite v2',
            'theme' => 'default',
            'created_at' => date("Y-m-d H:i:s"),
            'catchmail' => 'bounce@empsuite.com'
        ]);
    }
}
