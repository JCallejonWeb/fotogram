<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function save(Request $request){

        //Validacion

        $validate = $this->validate($request, [
            'image_id' => 'required|integer',
            'content' => 'required|string|max:255',
        ]);

        //Recogemos los datos del formulario

        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //Guardamos en la bd

        $comment->save();

        return redirect()->route('image.detail',['id'=> $image_id])->with([
            'message' => 'El comentario se ha publicado correctamente!'
        ]);

    }

    public function delete($id){

        //obj del user logueado
        $user = \Auth::user();

        //CONSEGUIR OBJ DEL COMMENT
        $comment = Comment::find($id);

        //Comprobar el dueño del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment->delete();

            return redirect()->route('image.detail',['id' => $comment->image_id])->with([
                'message'=> 'El comentario se ha eliminado correctamente!'
            ]);
        } else {
            return redirect()->route('image.detail',['id' => $comment->image_id])->with([
                'message'=> 'El comentario se ha eliminado correctamente!'
            ]);
        }


    }

}
