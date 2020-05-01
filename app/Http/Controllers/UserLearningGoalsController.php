<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\LearningGoalResource;
use App\LearningGoal;


class UserLearningGoalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        //return response()->json(['learningGoals' => LearningGoalResource::collection($user->learningGoals)]);

        return LearningGoalResource::collection($user->learningGoals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, DummyModelClass $DummyModelVariable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, DummyModelClass $DummyModelVariable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, LearningGoal $learningGoal)
    {
        $progressLevelId = $request->get('progressLevelId');

        $user->learningGoals()->updateExistingPivot($learningGoal, array('progress_level_id' => $progressLevelId));

        // return updated learningGoal that belongs to this specific user from the pivot table

        // return in json formaat met eigen index veld ('learningGoal'), omdat laravel anders alle data in 'data' index veld zet 
        // wat VueX code minder leesbaar maakt (response.data.data i.p.v. response.data.learningGoal)
        return response()->json([
            'learningGoal' => new LearningGoalResource($user->learningGoals()->find($learningGoal->id)),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, DummyModelClass $DummyModelVariable)
    {
        //
    }
}
