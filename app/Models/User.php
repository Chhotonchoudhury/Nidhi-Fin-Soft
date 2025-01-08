<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use  HasRoles, HasApiTokens, HasFactory, Notifiable;

    // Role constants
    const ROLE_SUPER_ADMIN = 'SuperAdmin';
    const ROLE_DIRECTOR = 'Director';
    const ROLE_PROMOTER = 'Promoter';
    const ROLE_MEMBER = 'Member';
    const ROLE_AGENT = 'Agent';
    const ROLE_EMPLOYEE = 'Employee';

    /**
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
    */

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type_id',
        'user_type',
        'unique_code',
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
