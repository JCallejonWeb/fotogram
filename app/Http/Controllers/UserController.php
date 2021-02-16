<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;

class UserController extends Controller
{

    public function __Construct(){
        $this->middleware('auth');
    }


    public function config(){
        return view('user.config');
    }

    public function update(Request $request){

        //conseguir el usuario identificado
        $user = \Auth::user();

        $id = $user->id;

        //Recoger los datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        
        //Validacion del formulario
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);
        
        //Asignar nuevos valores al objeto del usuario

        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //Subir la imagen

        $image_path = $request->file('image');

            if($image_path){
                //POnemos nombre uncico
                $image_path_name = time().$image_path->getClientOriginalName();
                //Guardamos en la capteta estorage/app/users
                Storage:: disk('users')->put($image_path_name, File::get($image_path));
                //se lo setemaos al obj user
                $user->image = $image_path_name;
            }

        //Ejecutar query y cambiso en la bbdd 
        //(EL WITH MANDA UNA SESION FLASH CON UN MENSAJE, LAS SESIONES FLAS SE BORRAN AL ACTUALIZAR NO HACE FALTA DESTRUITLAS)

        $user->update();

        return redirect()->route('user.config')->with(['message'=>'Usuario actualizado con éxito']);

    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function profile($id){
        $user = User::find($id);
        return view('user.profile',['user' => $user]);
    }


}
