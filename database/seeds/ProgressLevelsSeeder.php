<?php

use Illuminate\Database\Seeder;

class ProgressLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('progress_levels')->delete();

        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);

        $data = array(
            array('name' => 'matig'),
            array('name' => 'redelijk'),
            array('name' => 'goed'),
        );

        DB::table('progress_levels')->insert($data);
    }
}
