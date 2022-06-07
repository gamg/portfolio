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
             'link'  =>  '#hello'
         ]);

        \App\Models\Navitem::factory()->create([
            'label' => 'Projects',
            'link'  =>  '#projects'
        ]);

        \App\Models\Navitem::factory()->create([
            'label' => 'Contact me',
            'link'  =>  '#contact-me'
        ]);

        \App\Models\PersonalInformation::factory()->create([
            'title' => 'Gustavo Meza',
            'description' => 'Desarrollador web Laravel PHP..........',
            'cv' => null,
            'image' => null,
            'email' => 'adolfz10@gmail.com',
        ]);
    }
}
