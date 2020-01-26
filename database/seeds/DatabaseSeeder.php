<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(TopicsSeeder::class);
        $this->call(ProgressLevelsSeeder::class);
        $this->call(LearningGoalsSeeder::class);
        $this->call(UsersGoalsSeeder::class);
    }
}
