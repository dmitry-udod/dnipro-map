<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property array $roles
 * @property array $categories
 * @property array $cities
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $city
 * @property-read string $role
 * @property-read mixed $responsible
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'roles',
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

    /**
     * Get cities list for select
     *
     * @return array|\Illuminate\Support\Collection
     */
    public function citiesForDropDown()
    {
        if (!$this->isAdmin() && !$this->isSuperAdmin()) {
            return [];
        }            

        $q = City::orderBy('name');
        
        if(!$this->isSuperAdmin()) {
            $q->whereIn('id', $this->cities);
        }

        return $q->pluck('name', 'id');
    }

    /**
     * Get cities list for select
     *
     * @return array|\Illuminate\Support\Collection
     */
    public function responsibleUsersForDropDown()
    {
        if (! $this->isAdmin() && ! $this->isSuperAdmin()) {
            return [];
        }

        $q = User::orderBy('name');

        return $q->pluck('name', 'id')->prepend('Немає відповідальної особи', 0);
    }

    /**
     * Get cities list for select
     *
     * @return array|\Illuminate\Support\Collection
     */
    public function categoriesForDropDown()
    {
        if (!$this->isAdmin() && !$this->isSuperAdmin()) {
            return [];
        }

        $q = Category::orderBy('name');

        if(!$this->isSuperAdmin()) {
            $cityIds = City::where('id', $this->cities)->pluck('id');
            $q = Category::where('city_id', $cityIds)->orderBy('name');
        }

        return $q->pluck('name', 'id');
    }

    /**
     * Get roles list for select
     *
     * @return array
     */
    public function rolesForDropDown()
    {
        $roles = Role::all();
        if ($this->isSuperAdmin()) {
            return $roles;
        }            

        unset($roles['superadmin']);    

        return $roles;
    }

    /**
     * Get role text value
     *
     * @return string
     */
    public function getRoleAttribute()
    {
        if (!empty($this->roles[0])) {
            return Role::all()[$this->roles[0]];
        }
    }

    /**
     * Get role text value
     *
     * @return string
     */
    public function getCityAttribute()
    {
        if (!empty($this->cities[0])) {
            $city = City::find($this->cities[0]);
            if ($city) {
                return $city->name;
            }
        }
    }

    public function getResponsibleAttribute()
    {
        return Category::where('responsible_user_id', $this->id)->pluck('name')->implode(', ');
    }
}
