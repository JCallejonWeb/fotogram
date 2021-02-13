<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Image;

class ImageController extends Controller
{
   public function __construct(){
       $this->middleware('auth');
   }

   public function create(){
       return view("image.create");
   }

   public function save(Request $request){

        $validate = $this->validate($request, [
            'image_path' => 'required|image',
            'description' => 'required|string|max:255',
        ]);

        $img_path = $request->file('image_path');
        $description = $request->input('description');


        $user = \Auth::user();

        $img = new Image();
        $img->user_id = $user->id;
        $img->description = $description;

        if($img_path){
            //POnemos nombre uncico
            $image_path_name = time().$img_path->getClientOriginalName();
            //Guardamos en la capteta estorage/app/users
            Storage:: disk('images')->put($image_path_name, File::get($img_path));
            //se lo setemaos al obj image
            $img->image_path = $image_path_name;
        }

        $img->save();

        return redirect()->route('home')->with([
            'message' => 'La foto se ha subido correctamente!!'
        ]);
   }


   public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file,200);
   }

   


}
