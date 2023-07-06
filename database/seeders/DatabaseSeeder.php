<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(10)->create()->each(function ($user) {
            $user->blogposts()->saveMany(BlogPost::factory(rand(1,6))->make());
        });


//        $this->call([
//            UserTableSeeder::class,
//            BlogPostSeeder::class
//        ]);
    }
}
