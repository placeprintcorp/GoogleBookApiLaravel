<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

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
     protected $loginPath = '/login';

    protected $redirectTo = '/';

 public function showLoginForm()
    {

    return view("auth.login");
    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

        public function login(Request $request)
    {

            $this->validateLogin($request);

        $admin = User::where('email', $request->email)->first();

        if (!$admin) {
            return redirect($this->loginPath)->with('error', 'User not found.');
        }elseif($admin->status==1){
          return redirect($this->loginPath)->with('error', 'User is blocked by Admin.');
        }

        if (Hash::check($request->password, $admin->password)) {
            Auth::login($admin);
            return redirect('/')->withSuccess('Successfully Login!');
        }

        return redirect($this->loginPath)
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'Incorrect email or password']);
    }


protected function validateLogin(Request $request)
{
$request->validate([

$this->username() =>'required|email|max:255|exists:users,email',
'password' => 'required|string',
]);
}

}
