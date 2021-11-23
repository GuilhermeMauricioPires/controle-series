<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function create()
    {
        return view('registro.create');
    }

    public function store(Request $request)
    {
        $dados = $request->except('_token');
        $dados['password'] = Hash::make($dados['password']);
        $user = User::create($dados);
        Auth::login($user);
        return redirect()->route('listar_series');
    }
}
