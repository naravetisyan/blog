<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleGoogleProviderCallback()
    {

        $SocialUser =  Socialite::driver('google')->stateless()->user();
        $findUser = User::where('email', $SocialUser->email)->first();
        if($findUser){
            Auth::login($findUser);
            return redirect('home');

        } else {

            $user = new User;
            $user->name=$SocialUser->name;
            $user->email=$SocialUser->email;
            $user->password=bcrypt(str_random(10));
            $user->save();
            Auth::login($user);
            return redirect('home');
        }

    }

    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleFacebookProviderCallback()
    {

        $SocialUser =  Socialite::driver('facebook')->user();
        $findUser = User::where('email', $SocialUser->email)->first();
        if ($findUser) {
            Auth::login($findUser);
            return redirect('home');

        } else {
            $user = new User;
            $user->name=$SocialUser->name;
            $user->email=$SocialUser->email;
            $user->password=bcrypt(str_random(10));
            $user->save();
            Auth::login($user);
            return redirect('home');
        }
    }

    // public function redirectToProvider()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // public function handleProviderCallback()
    // {
    //     $user = Socialite::driver('facebook')->user();
    // }

}
