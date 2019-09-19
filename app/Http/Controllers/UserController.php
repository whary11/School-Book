<?php

namespace App\Http\Controllers;
use App\User;
class UserController extends FatherController
{
    public function getUserAll(){
        $users = User::all();
        return  $this->responseApp($users, 'success', ['type'=>'success', 'content'=>'Registros consultados co éxito.']);
    }

    
    public function saveUser(){
        return 'Guardar usuario';
    }
}
