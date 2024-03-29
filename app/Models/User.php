<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name', 
        'last_name', 
        'suffix',
        'province', 
        'city', 
        'barangay', 
        'street', 
        'landmark',
        'email', 
        'contact_number', 
        'occupation', 
        'username', 
        'password',
        'profile_image',
        'place_of_birth', 
        'date_of_birth', 
        'sex', 
        'valid_id',
        'role',
        'status',
        'benificiary_fullname',
        'benificiary_date_of_birth',
        'relationship',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
