<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Mail\RegistrationConfirmation;
use App\Http\Resources\UserResource;
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
