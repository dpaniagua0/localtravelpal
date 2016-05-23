<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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


    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }

       /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    /**
    * Get a list of role ids
    * @return array
    */

    public function getRolesListAttribute(){
        return $this->roles->lists('id')->toArray();
    }

    public function hasRole($rol) {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == $rol)
            {
                return true;
            }
        }

        return false;
    }
}
