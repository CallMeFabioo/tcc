<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 500) as $index) {
        	$user = User::all()->random();
        	$post = Post::all()->random();

        	$user->favorites()->save($post);
        }
    }
}
