<?php

namespace App\Http\Controllers\Conveniencestore\Auth;

use App\Http\Controllers\Controller;
use App\Models\Conveniencestore;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    // 新規登録画面
    public function showRegistrationForm()
    {
        return view('conveniencestore.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'conveniencestore_name' => ['required', 'string', 'max:255'],
            'branch' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:7'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Conveniencestore::create([
            'conveniencestore_name' => $data['conveniencestore_name'],
            'branch' => $data['branch'],
            'zip' => $data['zip'],
            'address' => $data['address'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
