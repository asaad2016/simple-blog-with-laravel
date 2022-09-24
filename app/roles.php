<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
   protected $fillable=
    [
    'name','description',
    ];
    public function users(){
         return $this->belongsToMany('App\User','user_role','role_id','user_id')->orderby('id');
    }
}
