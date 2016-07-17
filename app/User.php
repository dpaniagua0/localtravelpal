<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Storage;
use Socialite;
use Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','bio', 'video_url',
        'video_alien_id','img_path','img_type', 'avatar'
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
     * The destinations that belong to the user.
     */
    public function destinations()
    {
        return $this->hasMany('App\Destination', 'owner_id');
    }

    /**
    * Get user whis lists
    */
    public function wishlists(){
        return $this->hasMany('App\WishList', 'owner_id');
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

    public function getProfileImage(){
        return Storage::url('app/avatars/'.$this->id.'/'.md5($this->id).'.jpg');
    }

    public static function findByEmailOrCreate($userData){
        return User::firstOrCreate([
            'name' => $userData->name,
            'email' => $userData->email,
            'avatar' => $userData->avatar_original
        ]);
    }  

    public function execute($hasCode, $listener) {

        if(!$hasCode) return $this->redirectToProvider();
        $user = User::findByEmailOrCreate($this->getFacebookUser());
        Auth::login($user, true);
        return redirect('/');
    }

    public function getFacebookUser() {
        return Socialite::driver('facebook')->user();
    }

}
