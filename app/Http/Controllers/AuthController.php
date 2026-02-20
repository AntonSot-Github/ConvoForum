<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.registr');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            // Сохраняем файл в папку public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        } else {
            $data['avatar'] = 'avatars/av_def.png'; // Путь к дефолтной картинке
        }

        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('home.index', compact('user'))->with('success', "$user->name, your account was created successfully");
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(LoginUserRequest $request)
    {
        if(Auth::attempt($request->validated())){
            $request->session()->regenerate();

            $name = Auth::user()->name;

            return redirect()->route('home.index')->with('success', "{$name}, welcome to Convoforum!");
        };

        return back()->with('error', 'Something wrong, try again please');
    }

    public function logout(Request $request)
    {
        //Logout user(Delete user from session)
        Auth::logout();

        //Destroy current session to protect against reuse
        $request->session()->invalidate();

        //Update CSRF-token
        $request->session()->regenerateToken();

        return redirect()->route('home.index');
    }
}
