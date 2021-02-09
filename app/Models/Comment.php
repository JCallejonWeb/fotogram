<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table ='comments';

    //Relacion muchos a 1
    public function user(){
        return $this->belongsTo('app\models\User','user_id');
    }

    public function image(){
      return $this->belongsTo('app\models\Image','image_id');  
    }


}
