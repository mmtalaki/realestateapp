<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'password', 'user_image', 'is_active', 'role_id'];

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
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function is_active(){}

    public function isAdmin(){
        return $this->role->slug === "administrator";
    }

    public function isUser(){
        return $this->role->slug === "buyer";
    }

    public function isEditor(){
        return $this->role->slug === "seller";
    }

    public function isCustomer(){
        return $this->role->slug === "agent";
    }

    public function abilities(){
        $this->role->id ?? null;
        return[
            'admin'=>$this->isAdmin(),
            'buyer'=>$this->isBuyer(),
            'seller'=>$this->isSeller(),
            'agent'=>$this->isAgent(),
        ];
    }
}
