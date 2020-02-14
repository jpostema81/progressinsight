<?php

use Illuminate\Database\Seeder;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->delete();

        $data = array(
            array('name' => 'HTML'),
            array('name' => 'HTML verdieping'),
            array('name' => 'CSS'),
            array('name' => 'CSS verdieping'),
            array('name' => 'Git'),
            array('name' => 'JavaScript'),
            array('name' => 'JavaScript verdieping'),
            array('name' => 'PHP'),
            array('name' => 'PHP verdieping'),
            array('name' => 'Theorieën'),
            array('name' => 'Laravel'),
            array('name' => 'Laravel verdieping'),
            array('name' => 'Vue.js'),
            //array('name' => 'Vue.js verdieping'),
            array('name' => 'VueX'),
            array('name' => 'Deployment'),
            //array('name' => 'Scrum'),
        );

        DB::table('topics')->insert($data);
    }
}
