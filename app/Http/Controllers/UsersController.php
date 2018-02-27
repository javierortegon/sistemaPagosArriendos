<?php

namespace App\Http\Controllers;

use DB;
use App\User;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getUsuarios(){
        $usuarios = User::all();
        return view ('auth.usuarios', ['usuarios' => $usuarios ]);
    }
}
