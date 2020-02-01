<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LearningGoal;
use App\Http\Resources\LearningGoalResource;
use Illuminate\Database\Eloquent\Builder;
use App\User;


class LearningGoalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $learningGoals = LearningGoal::all();

        if($request->has('user_id'))
        {
            $user_id = $request->get('user_id');
            $user = User::find($user_id);
            
            $learningGoals = $user->learningGoals;
            
            // $learningGoals = LearningGoal::whereHas('users', function (Builder $query) use ($request) {
            //   $query->where('user_id', $request->get('user_id'));
            // })->get();
        }

        return LearningGoalResource::collection($learningGoals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
