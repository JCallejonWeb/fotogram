<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
   public function __Construct(){
       $this->middleware('auth');
   }

   public function like($image_id){

        //Roceger los datos del user y de la imagen, quien da like y a que se da like.

        $user = \Auth::user();

        //condicion para ver si existe el like y no duplicarlo

        $isset_like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->count();

        
        if ($isset_like == 0){

            $like = new Like();
            $like->user_id= $user->id;
            $like->image_id = $image_id;

            //Guardamos en la bbdd

            $like->save();
            return response()->json([
                'like' => $like
            ]);
        } else {
            return response()->json([
                'message' => 'El like ya existe'
            ]);
        }
   }

   public function dislike($image_id){
    //Roceger los datos del user y de la imagen, quien da like y a que se da like.

    $user = \Auth::user();

    //condicion para ver si existe el like y no duplicarlo

    $like = Like::where('user_id', $user->id)
                     ->where('image_id', $image_id)
                     ->first();

 
    if ($like){
        //Guardamos en la bbdd

        $like->delete();
        return response()->json([
            'like' => $like,
            'message' => 'Se ha eliminado el like correctamente'
        ]);
    } else {
        return response()->json([
            'message' => 'El like ya no existe'
        ]);
    }
    }


}
