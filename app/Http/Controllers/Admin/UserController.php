<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return UserResource::collection($users);
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
     * Register a new user
     *
     * @param  \Illuminate\Http\RegisterUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterUser $request)
    {  
        $validatedInput = $request->validated();
        $user = User::create($validatedInput);

        $roles = array_map(function($value) { return $value["id"]; }, $request->get("roles"));
        $user->roles()->sync($roles);

        // add LearningGoals to new user
        $learningGoals = LearningGoal::all();
        $defaultLearningGoals = [];
        $defaultProgressLevel = ProgressLevel::where('default', '=', true)->first();

        foreach($learningGoals as $learningGoal) 
        {
            $defaultLearningGoals[$learningGoal["id"]] = ['progress_level_id' => $defaultProgressLevel->id];
        }

        $user->learningGoals()->sync($defaultLearningGoals);
        $token = auth()->tokenById($user->id);

        try 
        {
            $emailAddress = $validatedInput['email'];
            Mail::to($emailAddress)->send(new RegistrationConfirmation());
        }
        catch(\Exception $e)
        {
            return response()->json(['message' => 'Fout tijdens verzenden mail: ' . $e->getMessage()], 500);
        }

        return $this->respondWithToken($token, $user);
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
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => "user deleted",
        ]);
    }
}
