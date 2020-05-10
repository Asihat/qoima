<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(adminsSeeder::class);
        $this->call(categoriesSeeder::class);
        $this->call(ItemsSeeder::class);
        $this->call(QoimaListSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
