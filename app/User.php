<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'roles' => 'array',
        'categories' => 'array',
        'cities' => 'array',
    ];

    /**
     * Check is current user has super admin rights
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->hasRole('superadmin');
    }

    /**
     * Check is cureant user has admin rights
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Check is user has role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return !empty($this->roles) && in_array($role, $this->roles);
    }
}
