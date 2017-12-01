<?php
namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
    
    public function login(Request $request, User $user) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth()->attempt(request(['email','password']))) {
            $user = $user->where('email', $request->get("email"))->first();
            Auth::login($user);
            return response()->json(['user' => Auth::user()],200);
        }
        return $this->sendFailedLoginResponse($request);
    }
    
    public function logout(){
        Auth::logout();
    }  

    protected function validator(Request $request)
    {
        return Validator::make($request->all(),[
            'name' => 'required|string|max:15|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
    }

    public function Register(Request $request) {
        $bbb = $this->validator($request);
        if($bbb->fails()){
            return $bbb->errors();
        }
        $inputs = $request->all();
        if($inputs["password_confirmation"]==$inputs["password"]) {
            $inputs["remember_token"] = md5(time().str_random(2));
            $inputs["password"] = bcrypt($inputs["password"]);
            unset($inputs['password_confirmation']);
            $user = User::create($inputs);
            Auth::login($user, true); 
        }
        return response()->json(['user' => Auth::user()], 200);
    }
}