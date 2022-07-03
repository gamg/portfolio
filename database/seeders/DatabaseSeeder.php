<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
             'password' => Hash::make('*77.Carlotaz.77*'),
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
            'image' => 'hero/8t0S6GsG4ZCT62hZi6NrLXZvCAkgr7qSRtCZvGal.jpg',
            'email' => 'adolfz10@gmail.com',
        ]);

        \App\Models\Project::factory()->create([
            'image' => 'projects/QRl57qydxDiPFEHkWI14PUySrrr8kh63x9YfKd5j.jpg'
        ]);

        \App\Models\Project::factory()->create([
            'image' => 'projects/tj4cv9QduwL4C8G3F59boKatY9Ib9PCgF7KF0qgs.jpg'
        ]);

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
