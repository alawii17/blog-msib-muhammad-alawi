<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Category::factory()->create([
        //     'name' => 'Web Development',
        //     'slug' => 'web-develoment'
        // ]);

        // Post::factory()->create([
        //     'title' => 'Fitur baru di Laravel 11',
        //     'author_id' => 1,
        //     'category_id' => 1,
        //     'slug' => 'fitur-baru-di-laravel-11',
        //     'body' => 'Laravel 11 merupakan versi terbaru dan tercanggih dari laravel, dimana laravel 11 ini lebih powerful ketimbang versi sebelumnya, dan mempunyai struktur file yang lebih ringkas'

        // ]);

        $this->call([CategorySeeder::class, UserSeeder::class]);
        Post::factory(10)->recycle([
            Category::all(),
            User::all()
        ])->create();
    }
}