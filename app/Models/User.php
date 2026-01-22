<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_image',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    

    public function msEvents()
    {
        return $this->hasMany(MS_Event::class, 'created_by');
    }

    public function msRegistrations()
    {
        return $this->hasMany(MS_Registration::class);
    }

    public function msRegisteredEvents()
    {
        return $this->belongsToMany(
            MS_Event::class,
            'registrations',
            'user_id',
            'event_id'
        );
    }
}
