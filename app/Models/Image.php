<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    // Realacion 1 a muchos

    public function comments(){
        return $this->hasMany('App\models\Comment')->orderBy('id','desc');
    }

    public function likes(){
        return $this->hasMany('App\models\Like');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

}
