<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Http\Requests\StoreColocationRequest;
use App\Http\Requests\UpdateColocationRequest;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
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
    public function store(StoreColocationRequest $request)
    {
        $colocation = Colocation::create([
            'name'=> $request->name,
            'description' => $request->description,
            'user_id'=>Auth::id(),
            
        ]);
        
        // 2️⃣ ajouter automatiquement le créateur comme membre
        $colocation->users()->attach(Auth::id(), [
            'role' => 'owner',
            'is_member' => 'oui',
        ]);
        return back()->with([
            'success' => 'Nouvelle colocation créée !',
            'colocation' => $colocation,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // Récupérer toutes les colocations
        $colocations = Colocation::with('users', 'creator')->get();

        return view('colocation', compact('colocations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colocation $colocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColocationRequest $request, Colocation $colocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colocation $colocation)
    {
        //
    }


    public function rejoindre($colocationId)
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur est déjà membre actif d'une colocation
        $dejaMembre = $user->colocations()
                        ->wherePivot('is_member', 'oui')
                        ->exists();

        if ($dejaMembre) {
            return back()->with('error', 'Vous êtes déjà membre d’une colocation.');
        }

        // Sinon, il peut rejoindre
        $user->colocations()->attach($colocationId, [
            'role' => 'member',
            'is_member' => 'oui',
        ]);

        return back()->with('success', 'Vous avez rejoint la colocation.');
    }
}
