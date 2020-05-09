<?php

use Illuminate\Database\Seeder;

class adminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Admins::create([
            'email' => 'admin@admin.com',
            'password' => '123456789',
            'name' => 'Admin',
            'token' => null,
            'qoima_id' => 1
        ]);
    }
}
