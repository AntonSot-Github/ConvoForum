<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403);
        }

        $users = User::latest()->paginate();

        return view('users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', "$user->name was deleted");
    }
}
