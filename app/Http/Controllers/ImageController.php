<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
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

   public function detail($id){
       $image = Image::find($id);

       return view('image.detail',[
           'image' => $image
       ]);
   }

   public function delete($id){

    $user = \Auth::user();
    $image = Image::find($id);

    DB::table('images')->delete($id);
    Storage::disk('images')->delete($image->image_path);

    return redirect()->route('user.profile',['id' => $user->id])->with([
        'message' => 'Imagen eliminada correctamente!'
    ]);

   }

   public function update(Request $request){
       
    $image_id = $request->input('id');
    $description = $request->input('description');

    $image = Image::find($image_id);

    

    $image->description = $description;

    $image->update();

    return redirect()->route('image.detail',['id'=>$image_id])->with(['message'=>'Imagen actualizada con éxito']);
    
   }

}