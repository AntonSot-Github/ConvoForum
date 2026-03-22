<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403);
        }

        $query = User::latest();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(5)->withQueryString();

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        
        return view('users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete yourself');
        }

        if ($user->isAdmin()) {
            return back()->with('error', 'You cannot delete another admin');
        }

        $userAva = $user->avatar;
        if ($userAva && $userAva !== 'avatars/av_def.png') {
            Storage::disk('public')->delete($userAva);
            $user->update(['avatar' => 'avatars/av_def.png']);
            
        }

        $user->delete();

        return back()->with('success', "$user->name was deleted");
    }
}
