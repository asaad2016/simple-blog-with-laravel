<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\post;
use App\User;
class likes extends Model
{
    protected $fillable=
    [
    'like','dislike',
    ];
    public function post(){
       return $this->belongsTo(post::class)->orderby('id');
   }
   public function user(){
        return $this->belongsTo(User::class)->orderby('id');
    }
}
