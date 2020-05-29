<?php

namespace App\Http\Controllers\Auth\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Mail\RegistrationConfirmation;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\RegisterUser;
use App\Http\Requests\Auth\Login;
use App\User;
use App\LearningGoal;
use App\ProgressLevel;
use Mail;
use App\Role;

// https://jwt-auth.readthedocs.io/en/docs/quick-start/


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserByToken()
    {
        return response()->json(new UserResource($this->guard()->user()), 200);
    }

    public function register(RegisterUser $request)
    {
        $validatedInput = $request->validated();
        $user = User::create($validatedInput);

        // sync role(s) when applicable
        // only sync roles when authenticated from backend
        // TODO: refactoren naar twee seperate functies voor betere leesbaarheid?
        if($this->guard()->user() instanceof User) 
        {
            $roles = array_map(function($value) { return $value["id"]; }, $request->get("roles"));
            $user->roles()->sync($roles);
        }
        // registration from front-end by not-authenticated user
        else {
            // attach default student role
            $student_role = Role::where('name', 'student')->first();
            $user->roles()->attach($student_role);
        }

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

    public function login(Login $request)
    {
        $validatedInput = $request->validated();

        try 
        {
            if($token = $this->guard()->attempt($validatedInput)) 
            {
                $user = $this->guard()->user();
                return $this->respondWithToken($token, new UserResource($user));
            }
        } 
        catch (\Exception $e) 
        {
            return response()->json(['message' => 'Fout bij het genereren van token'], 500);
        }

        return response()->json(['message' => ['Ongeldige gebruikersnaam / wachtwoord combinatie']], 401);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'U bent nu uitgelogd']);
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
            'user'         => $user,
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }
}
