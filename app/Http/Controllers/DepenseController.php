<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Http\Requests\StoreDepenseRequest;
use App\Http\Requests\UpdateDepenseRequest;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
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
    public function store(StoreDepenseRequest $request)
    {
        $user = Auth::user();
        $colocation = $user->colocations()->wherePivot('is_member', 'oui')->first();

        $depense = Depense::create([
            'titre' => $request->titre,
            'amount' => $request->amount,
            'user_id' => auth()->id(),
            'categorie_id' => $request->categorie_id,
            'colocation_id' => $request->colocation_id,
        ]);

        // 2️⃣ Créer un paiement lié à cette dépense
        $payment = Payment::create([
            'total_amount' => $depense->amount,
            'paid' => 'no',
        ]);

        // 3️⃣ Récupérer tous les membres actifs
        $membres = $colocation->users()->wherePivot('is_member', 'oui')->get();
        $part = $depense->amount / $membres->count(); // montant à partager

        // 4️⃣ Ajouter chaque membre dans users_payments avec le montant dû
        foreach ($membres as $membre) {
            $payment->users()->attach($membre->id, [
                'amount_part' => $part
            ]);
        }

        return back()->with('success', 'Dépense ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Depense $depense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depense $depense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepenseRequest $request, Depense $depense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depense $depense)
    {
        $depense->delete();

        return back()->with('success', 'Dépense supprimée avec succès.');
    }
}
