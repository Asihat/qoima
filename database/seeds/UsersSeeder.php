<?php

use App\Users;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::create([
           'name' => 'Askat',
           'surname' => 'Medetbayev',
            'email' => 'asihat@qoima.com',
            'account' => '1111',
            'phoneNo' => '+77757777777',
            'address' => 'FROM AKTAU;)',
            'password' => '1234567890',
        ]);

        Users::create([
            'name' => 'Baitorbay',
            'surname' => 'Moldir',
            'email' => 'moldir@qoima.com',
            'account' => '2222',
            'phoneNo' => '+77756666666',
            'address' => 'FROM ALMATY;)',
            'password' => '1234567890',
        ]);

        Users::create([
            'name' => 'Zholaman',
            'surname' => 'Khasenov',
            'email' => 'zholaman@qoima.com',
            'account' => '3333',
            'phoneNo' => '+77755555555',
            'address' => 'FROM XZ, TARAZ VRODE;)',
            'password' => '1234567890',
        ]);
    }
}
