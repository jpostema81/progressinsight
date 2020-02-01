<?php

use Illuminate\Database\Seeder;
use App\User;
use App\LearningGoal;
use App\ProgressLevel;

class UsersGoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_learning_goals')->delete();
        
        $user = User::first();
        $learningGoals = LearningGoal::all();
        $progress_level_id = ProgressLevel::first()->id;
        $user->learningGoals()->attach($learningGoals, ['progress_level_id' => $progress_level_id]);
    }
}
