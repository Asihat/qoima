<?php

use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Items::create([
           'name' => 'Book',
           'description' => 'Book for reading',
            'length' => '20',
            'width' => '20',
            'height' => '20',
            'amount' => '20',
            'price' => 100.00,
            'user_id' => 1,
            'qoima_id' => 1,
            'status' => 0,
        ]);

        \App\Items::create([
            'name' => 'NoteBook',
            'description' => 'NoteBook for playing DOTA 2',
            'length' => '20',
            'width' => '20',
            'height' => '20',
            'amount' => '20',
            'price' => 100.00,
            'user_id' => 1,
            'qoima_id' => 1,
            'status' => 0,
        ]);

        \App\Items::create([
            'name' => 'Velosiped',
            'description' => 'Velosiped for fun',
            'length' => '20',
            'width' => '20',
            'height' => '20',
            'amount' => '20',
            'price' => 100.00,
            'user_id' => 1,
            'qoima_id' => 1,
            'status' => 0,
        ]);
    }
}
