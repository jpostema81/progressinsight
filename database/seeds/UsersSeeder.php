<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $data = array(
            [
                'first_name' => 'Jeroen',
                'last_name' => 'Postema',
                'email' => 'jeroen@script.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('postema'),
                'remember_token' => Str::random(10),
            ],
            [
                'first_name' => 'Bas',
                'last_name' => 'Wollinga',
                'email' => 'bwollinga@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('wollinga2020'),
                'remember_token' => Str::random(10),
            ]
        );

        DB::table('users')->insert($data);
    }
}
