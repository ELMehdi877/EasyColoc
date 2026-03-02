<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Http\Requests\StoreDepenseRequest;
use App\Http\Requests\UpdateDepenseRequest;

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
        Depense::create([
        'titre' => $request->titre,
        'amount' => $request->amount,
        'user_id' => auth()->id(),
        'categorie_id' => $request->categorie_id,
        'colocation_id' => $request->colocation_id,
    ]);

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
        //
    }
}
