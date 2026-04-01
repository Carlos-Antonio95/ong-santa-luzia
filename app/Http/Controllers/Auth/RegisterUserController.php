<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('pages.auth.register');
    }

    public function store(Request $request, CreateNewUser $creator)
    {
        $creator->create($request->all());

        return redirect()->route('dashboard')->with('success', 'Usuário cadastrado com sucesso.');
    }
}
