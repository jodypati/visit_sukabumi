<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Facebook;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
            /*'avatarUrl' => $data['avatarUrl'],
            'country' => $data['country'],
            'state' => $data['state'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'statusInfo' => $data['statusInfo'],
            'profession' => $data['profession'],
            'tempatLahir' => $data['tempatLahir'],
            'tglLahir' => $data['tglLahir'],
            'educLevId' => $data['educLevId'],
            'imgUsrFileName' => $data['imgUsrFileName'],
            'imgUsrFilePath' => $data['imgUsrFilePath'],
            'lastStudy' => $data['lastStudy'],
            'statusInfoUpAt' => $data['statusInfoUpAt']*/
        ]);
    }

    public function LoginPage()
    {
        $login_url = Facebook::getLoginUrl(['email']);
        return view('auth.login', compact('login_url'));
    }
}
