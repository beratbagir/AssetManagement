<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Bu controller, yeni kullanıcıların kaydedilmesini ve doğrulama işlemlerini yönetir.
    |
    */

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Kayıt formunu göster.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('back.page.auth.signup');
    }

    /**
     * Kayıt işlemi yapar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Gelen verilerin doğrulanması
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'tittle' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Kullanıcı oluşturulması
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'tittle' => $validatedData['tittle'],
            'password' => Hash::make($validatedData['password']), // Şifreyi hash'leyerek kaydediyoruz
        ]);

        // İlk kullanıcıyı kontrol et
        if (User::count() === 1) {
            $user->assignRole('super-admin');
        } else {
            $user->assignRole('user');
        }

        // Kullanıcıyı login sayfasına yönlendir
        return redirect('/login')->with('success', 'Kayıt işlemi başarıyla tamamlandı. Giriş yapabilirsiniz.');
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // İlk kullanıcıyı kontrol et
        if (User::count() === 1) {
            $user->assignRole('super-admin');
        } else {
            $user->assignRole('user');
        }

        return $user;
    }
}
