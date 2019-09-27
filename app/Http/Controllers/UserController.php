<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends FatherController
{
    public function getUser()
    {
        $user = User::where('id', Auth::id())->with(['permissions', 'roles'])->first();
        return  $this->responseApp($user, 'success', ['type' => 'success', 'content' => 'Registros consultados con éxito.']);
    }


    public function saveUser()
    {
        return 'Guardar usuario';
    }
}
