<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colocations_users extends Model
{
    /** @use HasFactory<\Database\Factories\ColocationsUsersFactory> */
    use HasFactory;

    protected $fillable = [
        'role'
    ];

}
