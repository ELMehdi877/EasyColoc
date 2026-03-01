<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Http\Requests\StoreInvitationRequest;
use App\Http\Requests\UpdateInvitationRequest;
use App\Mail\InvitationMail;
use App\Models\Colocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvitationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvitationRequest $request, Invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invitation $invitation)
    {
        //
    }

    public function sendInvitation(StoreInvitationRequest $request, $colocationId)
    {
        $token = Str::uuid();

        $invitation = Invitation::create([
            'colocation_id' => $colocationId,
            'sender_id' => Auth::id(),
            'email_receiver' => $request->email,
            'token' => $token,
            'status' => 'pending',
        ]);

        // Générer le lien
        $link = route('invitations.accept', $token);

        // Envoyer email
        Mail::to($request->email)->send(new InvitationMail($link));

        return back()->with('success', 'Invitation envoyée.');
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)
                                ->where('status', 'pending')
                                ->firstOrFail();

        $user = Auth::user();

        // Vérifier qu'il n'est pas déjà membre actif d'une autre colocation
        $dejaMembre = $user->colocations()
                        ->wherePivot('is_member', 'oui')
                        ->exists();

        if ($dejaMembre) {
            return redirect()->route('colocations.index')
                ->with('error', 'Vous êtes déjà membre d’une colocation.');
        }

        // Ajouter dans pivot
        $user->colocations()->attach($invitation->colocation_id, [
            'role' => 'member',
            'is_member' => 'oui',
        ]);

        // Mettre statut à accepté
        $invitation->update([
            'status' => 'accepte'
        ]);

       

        return redirect()->route('colocations.index')
            ->with('success', 'Invitation acceptée.');
    }
}
