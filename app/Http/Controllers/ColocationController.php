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
        $user = Auth::user();

        // Vérifie si l'utilisateur est membre actif d'une colocation
       
        $colocationActive = $user->colocations()
        ->wherePivot('is_member', 'oui')
        ->with(['users' => function ($query) {
            $query->withPivot('role', 'is_member'); // tous les membres avec rôle
        }, 
        'creator',  //// créateur de la colocation
        'categories.user',   // récupère les catégories et leur créateur
        'depenses.user',      // récupère les dépenses et leur auteur
        'depenses.categorie',      // récupère la catégorie de chaque dépense
        'depenses.payment.users', // récupère la payment avec users de chaque dépense
        ])
        ->first();

        if ($colocationActive) {
            // L'utilisateur est déjà membre → afficher cette colocation seule
            $remboursements = [];

            foreach ($colocationActive->depenses as $depense) {

                $payer = $depense->user;

                $payment = $depense->payment;

            if ($payment) {

                foreach ($payment->users as $debiteur) {

                    if ($debiteur->pivot->paid == 'no' && $debiteur->id != $payer->id) {

                        $remboursements[] = [
                            'debiteur' => $debiteur->name,
                            'creditor' => $payer->name,
                            'montant' => $debiteur->pivot->amount_part,
                            'payment_id' => $payment->id,
                        ];
                    }
                }
            }
            }

            return view('colocation', [
                'colocation' => $colocationActive,
                'remboursements' => $remboursements,
                'dejaMembre' => true
            ]);
            
        } else {
            // L'utilisateur n'est membre d'aucune colocation → afficher toutes les colocations

            $colocations = $user->colocations()
                                ->wherePivot('is_member', 'non')->get(); // récupère les colocations que j'ai rejoindre
            return view('colocation', [
                'colocations' => $colocations,
                'dejaMembre' => false
            ]);
        }
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

    public function quitter($colocationId)
    {
        $user = Auth::user();

        $user->colocations()->updateExistingPivot($colocationId, [
            'is_member' => 'non'
        ]);

        return back()->with('success', 'Vous avez quitté la colocation.');
    }
}
