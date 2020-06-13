<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserInvitationActivation;
use App\Invitation;
use App\User;


class UserInvitationController extends Controller
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
            $user = new User();
            $user->fill($validatedInput);
            $user->email = $invitation->email;
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
