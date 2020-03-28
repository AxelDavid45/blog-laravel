<?php

use Illuminate\Database\Seeder;
use App\User;
use \Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Create the admin user
        User::create(
            [
                'name'     => 'Axel Espinosa',
                'email'    => 'axel@admin.com',
                'password' => Hash::make(
                    '123456789'
                )
            ]
        );

        //Generate dummy records of posts
        factory(App\Post::class, 25)->create();

    }
}
