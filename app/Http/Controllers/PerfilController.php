<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserPerfilUpdateRequest;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Product;

class PerfilController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
    }
    
    public function perfil()
    {
        return view('web.perfil');
    }

    public function editPerfil(User $user)
    {   
        $user = auth()->user();

        return view('web.editperfil', compact('user'));
        
    }
    public function update(Request $request, User $user)
    {
        if($request->photo_up){
            if($file = Product::setFile($request->photo_up)){
                $request->request->add(['photo' => "image/$file"]);
            }
            if($user->photo !== 'image/icons/default.jpg' ){
                if(public_path("$user->photo")){
                    unlink(public_path("$user->photo"));
                }
            }
        }

        $user->update($request->all());
       
        alert()->success('Perfil actualizado con éxito');
        return redirect()->route('perfil');
    }
}
