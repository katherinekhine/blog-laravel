<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        \App\Models\User::factory()->create([
            "name" => "arkarmin",
            "email" => "arkar@example.com"
        ]);

        \App\Models\User::factory()->create([
            "name" => "katherine",
            "email" => "katherine@example.com"
        ]);

        \App\Models\Article::factory(20)->create();
        \App\Models\Comment::factory(40)->create();



        $list = ['News', 'Tech', 'Mobile', 'Web', 'Lang'];
        foreach ($list as $name) {
            \App\Models\Category::create(["name" => $name]);
        }
    }
}
