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
    public function post(){
        return $this->hasMany(post::class);
    }
     public function likes(){
        return $this->hasMany(likes::class);
    }
     public function comments(){
        return $this->hasMany(comment::class);
    }
      public function settings(){
        return $this->hasMany(setting::class);
    }
    public function roles(){
        return $this->belongsToMany('App\roles','user_role','user_id','role_id')->orderby('id');
    }
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
    public function hasRoles($roles){
        if(is_array($roles)){
            foreach ($roles as  $role) {
                if($this->hasRole($role)){
                    return true;
                }
            }
        }
        else{
            if($this->hasRole($roles)){
                return true;
            }
        }
    }
    public function hasRole($role){
        if($this->roles()->where("name",$role)->first()){
            return true;
       }
       return false;
    }
}
