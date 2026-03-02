<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    /** @use HasFactory<\Database\Factories\DepenseFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'colocation_id',
        'categorie_id',
        'titre',
        'amount',
    ];

    // Relation avec l'utilisateur (créateur de la dépense)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec la catégorie
    public function categorie()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation avec la colocation
    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    // Relation avec la payment
    public function payments() 
    {
        return $this->hasMany(Payment::class);
    }
}
