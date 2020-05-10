<?php

use Illuminate\Database\Seeder;

class QoimaListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Qoima_list::create([
            'name' => 'Qoima in Abay',
            'description' => 'first qoima',
            'address' => 'Abay 123',
            'map_address' => '43.216616, 76.841477',
            'url_address' => 'https://www.memento-mori.site/',
            'working_time' => '8 to 6 ',
            'phone' => '+77751234578',
            'email' => 'qoima1@qoima.com',
        ]);

        \App\Qoima_list::create([
            'name' => 'Qoima in Ryspect',
            'description' => 'Qoima in Ryspect',
            'address' => 'Ryspect 123',
            'map_address' => '43.251736, 76.888439',
            'url_address' => 'https://www.memento-mori.site/',
            'working_time' => '8 to 6',
            'phone' => '+77751232312',
            'email' => 'qoima2@qoima.com',
        ]);


        \App\Qoima_list::create([
            'name' => 'Qoima in Dostyk',
            'description' => 'Qoima in Dostyk',
            'address' => 'Dostyk 123',
            'map_address' => '43.242897, 76.957266',
            'url_address' => 'https://www.memento-mori.site/',
            'working_time' => '8 to 6',
            'phone' => '+77751237896',
            'email' => 'qoima3@qoima.com',
        ]);



    }
}
