<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes protégées
Route::middleware('auth')->group(function () {

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Voir toutes les colocations
    Route::get('/coloc', [ColocationController::class, 'show'])
        ->name('colocations.index');

    // Créer une colocation
    Route::post('/cree_coloc', [ColocationController::class, 'store'])
        ->name('colocations.store');

    // Rejoindre une colocation
    Route::post('/colocations/{id}/rejoindre', [ColocationController::class, 'rejoindre'])
        ->name('colocations.rejoindre');

    // Quitter une colocation
    Route::post('/colocations/{id}/quiter', [ColocationController::class, 'quitter'])
     ->name('colocations.quiter');

    // envoyé une invitation
    Route::post('/colocations/{colocation}/invite', 
        [InvitationController::class, 'sendInvitation']
    )->name('invitations.send');

    // Admin
    Route::get('/admin', function () {
        return view('administration');
    });

    Route::get('/invitations/{token}', [InvitationController::class, 'accept'])
    ->name('invitations.accept');

});

require __DIR__.'/auth.php';