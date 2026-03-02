<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Colocation;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    //Relation avec colocation one to many
    public function createdColocations()
    {
        return $this->hasMany(Colocation::class);
    }

    //Relation avec colocation many to many 
    public function colocations()
    {
        return $this->belongsToMany(Colocation::class)
                    ->withPivot('role', 'is_member')
                    ->withTimestamps();
    }

    //Relation avec payment
    public function payments()
    {
        return $this->belongsToMany(Payment::class, 'users_payments')->withPivot('amount');
    }
}
