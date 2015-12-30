<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'group_id' => '1',
            'group_name' => 'Admin',
        ]);

       // \DB::statement("SELECT pg_catalog.setval(pg_get_serial_sequence('groups', 'group_id'), "
       //      . "MAX(group_id)) FROM groups");

        DB::table('users')->insert([
            'id' => Uuid::generate(),
            'group_id' => '1',
            'username' => 'admin',
            'email' => 'admin@spam4.me',
            'password' => bcrypt('123456'),
            'name' => 'Admin Sistem Inventory',
            'active' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
