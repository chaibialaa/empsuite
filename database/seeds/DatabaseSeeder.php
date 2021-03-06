<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(BasicConfig::class);
        $this->call(BasicPermission::class);
        $this->call(BasicClassroomStatus::class);
        $this->call(BasicTimetableStatus::class);
        $this->call(BasicCoreModule::class);
        Model::reguard();
    }
}
