<?php

namespace App\Http\Controllers\Conveniencestore\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'conveniencestore/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:conveniencestore');
    }

    // Guardの認証方法を指定
    protected function guard()
    {
        return Auth::guard('conveniencestore');
    }

    public function showResetForm(Request $request, $token = null)
    {
        // 管理者ユーザ用のviewを指定
        return view('conveniencestore.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    public function broker()
    {
        // 管理者ユーザ用のパスワードブローカーを指定
        return Password::broker('conveniencestores');
    }
}
