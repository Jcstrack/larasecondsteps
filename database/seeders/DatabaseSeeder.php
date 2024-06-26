<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Database\Factories\PostFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     CategorySeeder::class,

        // ]);

        Post::factory(5)->create();
    }
}
