<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 50)->create();

        foreach(range(1, 50) as $user) {
        	$user = User::get()->random();
        	$follower = User::get()->random();

        	$user->followers()->save($follower);
        }
    }
}
