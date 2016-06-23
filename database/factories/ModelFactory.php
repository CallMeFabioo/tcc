<?php

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

$factory->define(User::class, function (Faker\Generator $faker) {
	$avatar = [
		'thumbnail' => [
			'url' => asset('images/avatar_thumbnail.png'),
			'width' => '260',
			'height' => '260'
		],
		'standard' => [
			'url' => asset('images/avatar_standard.png'),
			'width' => '50',
			'height' => '50'
		],
	];

  return [
    'name' => $faker->name,
    'username' => $faker->userName,
    'email' => $faker->safeEmail,
    'password' => bcrypt('123123123'),
    'avatar' => json_encode($avatar)
  ];
});

$factory->define(Post::class, function (Faker\Generator $faker) {
	$images = [
		'thumbnail' => [
			'url' => asset('images/thumbnail.png'),
			'width' => '260',
			'height' => '260'
		],
		'standard' => [
			'url' => asset('images/standard.png'),
			'width' => '600',
			'height' => '600'
		],
	];

  return [
		'uid' => str_random(15),
    'images' => json_encode($images),
    'description' => $faker->paragraph(5),
    'user_id' => function() {
    	return User::get()->random()->id;
    }
  ];
});

$factory->define(Comment::class, function (Faker\Generator $faker) {
  return [
    'text' => $faker->paragraph(5),
    'user_id' => function() {
    	return User::get()->random()->id;
    },
    'post_id' => function() {
    	return Post::get()->random()->id;
    }
  ];
});
