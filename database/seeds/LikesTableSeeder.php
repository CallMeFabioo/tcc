<?php

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 200) as $index) {
        	$model = collect([Comment::class, Post::class])->random();
        	$user = User::all()->random();

        	Like::firstOrCreate([
        		'user_id' => $user->id,
    				'likeable_id' => $model::get()->random()->id,
    				'likeable_type' => $model
        	]);
        }
    }
}
