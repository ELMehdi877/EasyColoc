<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
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
    public function store(StorePaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function markAsPaid(Payment $payment)
    {
        $user = auth()->user();

        // Trouver la ligne pivot de cet utilisateur
        $userPayment = $payment->users()
            ->where('user_id', $user->id)
            ->first();

        if (!$userPayment) {
            return back()->with('error', 'Paiement introuvable.');
        }

        // Marquer comme payé
        $payment->users()->updateExistingPivot($user->id, [
            'paid' => 'yes'
        ]);

        // Vérifier si tous les membres ont payé
        $remaining = $payment->users()
            ->wherePivot('paid', 'no')
            ->count();

        if ($remaining === 0) {
            $payment->update([
                'status' => 'completed'
            ]);
        }

        return back()->with('success', 'Paiement effectué !');
    }
}
