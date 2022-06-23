<?php

namespace Database\Seeders;

use App\Models\SocialLink;
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
            'description' => 'Web Developer, Laravel PHP blablabla ..........',
            'cv' => null,
            'image' => null,
            'email' => 'adolfz10@gmail.com',
        ]);

        \App\Models\Project::factory(3)->create();

        SocialLink::factory()->create([
            'name' => 'Twitter',
            'url' => 'https://twitter.com/gamg_',
            'icon' => 'fa-brands fa-twitter',
        ]);

        SocialLink::factory()->create([
            'name' => 'Youtube',
            'url' => 'https://www.youtube.com/channel/UCAhUwzPtyWu7Bj5vmjq9YEA',
            'icon' => 'fa-brands fa-youtube',
        ]);
    }
}
