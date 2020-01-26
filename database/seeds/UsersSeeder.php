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
        $data = array(
            'first_name' => 'Jeroen',
            'last_name' => 'Postema',
            'email' => 'jeroen@script.nl',
            'email_verified_at' => now(),
            'password' => Hash::make('postema'),
            'remember_token' => Str::random(10),
        );

        DB::table('users')->insert($data);
    }
}
