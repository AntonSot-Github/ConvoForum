<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;
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
        $user = User::create($request->all());
        Auth::login($user);

        return redirect()->route('home.index', compact('user'))->with('success', "$user->name, your account was created successfully");
    }
}
