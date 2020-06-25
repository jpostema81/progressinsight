<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegistrationActivation;
use App\User;

/**
 * UserRegistrationConfirmationController
 * 
 * This class is intended for just activating an user registration
 */
class UserRegistrationConfirmationController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRegistrationActivation $request)
    {
        // vraag: moet er nog een expiratiedatum gekoppeld worden aan een nieuw geregistreerde gebruiker?
        $validatedInput = $request->validated();

        $newUser = User::where('activation_token', '=', $validatedInput['activationToken'])->first();

        if($newUser instanceof User) {
            $newUser->activation_token = '';
            $newUser->activated = true;
            $newUser->email_verified_at = now();
            $newUser->save();

            return response()->json([
                'message' => "Gebruikersaccount is geactiveerd",
                'user'    => $newUser,
            ]);
        }
        else
        {
            return response()->json([
                'message' => "Ongeldige activatiecode",
                'errors' => ['activationToken' => "Ongeldige activatiecode"]
            ], 500);  
        }
    }
}
