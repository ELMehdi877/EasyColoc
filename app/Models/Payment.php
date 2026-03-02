<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected $fillable = [
        'depense_id',
        'colocation_id',
        'total_amount',
        'status',
    ];

    //Relation avec depense
    public function depense() 
    {
        return $this->belongsTo(Depense::class);
    }

    // Relation avec user
    public function users() {
        return $this->belongsToMany(User::class, 'users_payments')->withPivot('amount_part', 'paid');
    }
}
