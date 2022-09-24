<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class setting extends Model
{
   protected $fillable=
    [
    'name','value',
    ];
    public function users(){
         return $this->belongsToMany(User::class);
    }
}
