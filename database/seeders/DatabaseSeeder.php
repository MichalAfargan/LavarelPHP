<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Listing;
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
        // \App\Models\User::factory(5)->create();
        $user = User::factory()->create([
            'name' => 'Johen Doe',
            'email' => 'johen@gmail.com' ,
        ]);

        Listing::factory(6)->create([
            'user_id'=>$user->id 
        ]);

        // Listing::create([
        //     'title' => 'laravel senior developer',
        //     'tags' => 'laravel, React ,Dgango',
        //     'company' => 'Y&M Corp',
        //     'location' => 'Israel,Eilat',
        //     'enail' => 'michal@gmail.com',
        //     'website' => 'https://www.acme.com',
        //     'description' => 'We fullstack developers went through a course of over seven months,
        //      we arrived from Eilat and we are thirsty for a good job with good people, 
        //      we are currently learning a new and interesting topic PHP and laravel excited for the next!',
        // ]);


        // Listing::create([
        //     'title' => 'laravel Beginer developer',
        //     'tags' => 'laravel, React ,Dgango, Python ,nodejs',
        //     'company' => 'World Domonition',
        //     'location' => 'Israel,Eilat',
        //     'enail' => 'yosef@gmail.com',
        //     'website' => 'https://chocolatey.org/',
        //     'description' => 'We fullstack developers went through a course of over seven months,
        //      we arrived from Eilat and we are thirsty for a good job with good people, 
        //      we are currently learning a new and interesting topic PHP and laravel excited for the next!',
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
