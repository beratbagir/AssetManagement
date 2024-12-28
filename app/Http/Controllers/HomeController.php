<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home()
    {
        $userCount = User::count();

        return view('home', compact('userCount'));
    }

    public function showusername()
    {
    $user = Auth::user();

    return view('back.layouts.inc.header', compact('user'));
    }

    public function showemail()
    {
        $user = Auth::user();

        return view('back.layouts.auth.settings', compact('showemail'));
    }

    public function showpassword()
    {
        $user = Auth::user();

        return view('back.layouts.auth.settings', compact('userpassword'));
    }

    public function profileUpdate(Request $request)
{
    $request->validate([
        'name' => 'required|string|min:4|max:255',
        'email' => 'required|email|string|max:255|unique:users,email,' . Auth::id(),
        'tittle' => 'required|string|max:255',
    ]);

    $user = Auth::user();

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->tittle = $request->input('tittle');

    $user->save();
    return redirect()->route('author.settings');
}

    public function deleteAccount()
    {
        $user= Auth::user();
        $user->delete();
        Auth::logout();
        return redirect('/login');
    }









}
