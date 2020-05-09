<?php

use Illuminate\Database\Seeder;

class categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Categories::create([
            'name' => 'Сезонное хранение',
            'description' => 'Lorem ipsue'
        ]);

        \App\Categories::create([
            'name' => 'Личные вещи',
            'description' => 'Lorem ipsue'
        ]);

        \App\Categories::create([
            'name' => 'Мебель',
            'description' => 'Lorem ipsue'
        ]);

        \App\Categories::create([
            'name' => 'Стройматериалы',
            'description' => 'Lorem ipsue'
        ]);

        \App\Categories::create([
            'name' => 'Велосипеды',
            'description' => 'Lorem ipsue'
        ]);

        \App\Categories::create([
            'name' => 'Хранение шин',
            'description' => 'Lorem ipsue'
        ]);

        \App\Categories::create([
            'name' => 'Колеса',
            'description' => 'Lorem ipsue'
        ]);

        \App\Categories::create([
            'name' => 'Мотоцикл',
            'description' => 'Lorem ipsue'
        ]);

        \App\Categories::create([
            'name' => 'Хранение сноубордов и лыж',
            'description' => 'Lorem ipsue'
        ]);

        \App\Categories::create([
            'name' => 'Хранение спорт инвентаря',
            'description' => 'Lorem ipsue'
        ]);

        \App\Categories::create([
            'name' => 'Хранение детских колясок',
            'description' => 'Lorem ipsue'
        ]);



    }
}
