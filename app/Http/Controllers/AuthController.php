<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    public function registr()
    {
        return view('auth.registr');
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->all());


        return redirect()->route('home.index');
    }
}
