<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
         \App\Models\User::factory()->create([
             'name' => 'Gustavo',
             'email' => 'adolfz10@gmail.com',
         ]);

         \App\Models\Navitem::factory()->create([
             'label' => 'Hello',
             'link'  =>  '#'
         ]);

        \App\Models\Navitem::factory()->create([
            'label' => 'Projects',
            'link'  =>  '#'
        ]);

        \App\Models\Navitem::factory()->create([
            'label' => 'Contact me',
            'link'  =>  '#'
        ]);
    }
}
