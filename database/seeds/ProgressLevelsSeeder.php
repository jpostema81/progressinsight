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

        $data = array(
            array('name' => 'matig', 'percentage' => 0, 'default' => false),
            array('name' => 'redelijk', 'percentage' => 50,'default' => true),
            array('name' => 'goed', 'percentage' => 100, 'default' => false),
        );

        DB::table('progress_levels')->insert($data);
    }
}
