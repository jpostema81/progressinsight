<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $data = array(
            array('name' => 'admin'),
            array('name' => 'student'),
        );

        DB::table('roles')->insert($data);
    }
}
