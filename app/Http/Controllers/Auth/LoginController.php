<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

use Socialite, Redirect, Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the LinkedIn authentication page.
     *
     * @return Illuminate\Http\Response
     */
    public function redirectToProvider() {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Obtain the user information from LinkedIn
     *
     * @return Illuminate\Http\Response
     */
    public function handleProviderCallback() {

        try {
            $user = Socialite::driver('linkedin')->user();
        } catch(Exception $e) {
            return Redirect::to('auth/linkedin');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser);

        return redirect('/users');
    }

    /**
     * Create a new user if the user does not exist
     *
     * @return Illuminate\Foundation\Auth\AuthenticatesUsers;
     */

    public function findOrCreateUser($user) {

        $authUser = User::where('email', $user->email)->first();

        if($authUser) {
            return $authUser;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make('123456'),
        ]);
    }
}
