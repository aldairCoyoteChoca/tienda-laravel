<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserPerfilUpdateRequest;
use Illuminate\Support\Facades\Storage;
use App\User;

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
        $user->update($request->all());
        //actualiza el usuario
        if($request->file('photo')){
            $path = Storage::disk('public')->put('image', $request->file('photo'));
            $user->fill(['photo' => ($path)])->save();
        }
        alert()->success('Perfil actualizado con éxito');
        return redirect()->route('perfil');
    }
}
