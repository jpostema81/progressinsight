<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserInvitationActivation;
use App\Invitation;
use App\User;
use Carbon\Carbon;


/**
 * UserInvitationConfirmationController
 * 
 * This class is intended for just confirming an user invitation
 */
class UserInvitationConfirmationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserInvitationActivation $request)
    {
        $validatedInput = $request->validated();

        $invitation = Invitation::where('activation_token', $request->get('activationToken'))->first();

        // todo: check expiration date

        if($invitation instanceof Invitation)
        {
            if(Carbon::parse($invitation->expiration_date)->isPast()) {
                return response()->json([
                    'message' => "Deze uitnodiging is verlopen",
                ], 500);
            }

            $user = new User();
            $user->fill($validatedInput);
            $user->email = $invitation->email;
            $user->email_verified_at = now();
            $user->save();
            $user->roles()->sync($invitation->roles);

            return response()->json([
                'message' => "Gebruikersaccount is geactiveerd",
                'user'    => $user,
            ]);
        }
        else
        {
            return response()->json([
                'message' => "Ongeldige activatiecode",
            ], 500);  
        }
    }
}
