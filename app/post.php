<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\likes;
use App\User;
use App\Category;
class post extends Model
{
    protected $fillable=
    [
    'title','body',
    ];
    public function comments(){
	   return $this->belongsTo(comment::class)->orderby('id');
	}
    public function category(){
	   return $this->belongsTo(Category::class);
	}
    public function likes(){
        return $this->hasMany(likes::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
