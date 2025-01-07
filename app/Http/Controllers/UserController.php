<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function checkUser(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if ($user) {
            return view('user.found', ['user' => $user]);
        } else {
            return view('user.notfound');
        }
    }

    public function getUser()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.users', compact('users', 'roles'));
    }

    public function deleteAdmin($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users');
    }

    public function postUser(Request $request)
    {
        $request->validate([
            'user_id'=> 'required|exists:users,id',
            'role'=> 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($request->input('user_id'));
        $role = $request->input('role');

        if ($user->hasRole($role)) {
            return back()->with('message', 'This user already has the assigned role.');
        }
        $user->assignRole($role);
        return redirect('/users');
    }
}
