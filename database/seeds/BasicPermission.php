<?php

use Illuminate\Database\Seeder;

class BasicPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'AddAnnouncement',
            'display_name' => 'Add Announcement',
            'description' => 'Add New Announcement',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'EditOwnAnnouncement',
            'display_name' => 'Edit Owned Announcement',
            'description' => 'Edit Owned Announcement',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'EditAnyAnnouncement',
            'display_name' => 'Edit Any Announcement',
            'description' => 'Edit Any Announcement',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'TeachingStudents',
            'display_name' => 'Teach Students',
            'description' => 'Teach Students',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
