<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InviteRequest;
use App\Invitation;
use App\Mail\NewUserInvitation;
use Mail;
use App\Http\Resources\InvitationResource;

class InvitationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invitations = Invitation::all();

        return InvitationResource::collection($invitations);
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
    public function store(InviteRequest $request)
    {
        $validatedInput = $request->validated();

        foreach($validatedInput["emails"] as $email)
        {
            $activationToken = bin2hex(random_bytes(20));
            $roles = array_map(function($value) { return $value["id"]; }, $request->get("roles"));

            $invitation = new Invitation();
            $invitation->email = $email["email"];
            $invitation->activation_token = $activationToken;
            $invitation->save();
            $invitation->roles()->sync($roles);

            try 
            {
                Mail::to($email["email"])->send(new NewUserInvitation($activationToken));
            }
            catch(\Exception $e)
            {
                return response()->json(['message' => 'Fout tijdens verzenden mail: ' . $e->getMessage()], 500);
            }
        }
        
        return response()->json([
            'message' => "invitations were sent successfully",
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
