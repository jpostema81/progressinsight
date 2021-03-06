<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\Auth\RegisterUser;
use Illuminate\Support\Facades\Auth;
use App\Role;
use App\LearningGoal;
use App\ProgressLevel;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user = new User();
        $user->fill($validatedInput);
        $activationToken = bin2hex(random_bytes(20));
        $user->activation_token = $activationToken;
        $user->save();

        // attach default student role
        $student_role = Role::where('name', 'student')->first();
        $user->roles()->attach($student_role);

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
            Mail::to($emailAddress)->send(new RegistrationConfirmation($activationToken));
        }
        catch(\Exception $e)
        {
            return response()->json(['message' => 'Fout tijdens verzenden mail: ' . $e->getMessage()], 500);
        }

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
            'user'         => $user,
            'message'      => 'U bent succesvol geregistreerd',
        ]);
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
    public function update(UpdateUser $request, User $user)
    {
        // Validate and retrieve only the updated fields    
        $validatedInput = $request->validated();

        $user->fill($validatedInput)->save();

        return response()->json([
            'message' => "Gebruikersgegevens zijn bijgewerkt",
            'user'    => $user,
        ]);
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
