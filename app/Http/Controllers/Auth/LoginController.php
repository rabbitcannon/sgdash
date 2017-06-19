<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\AccountLogin;
use Illuminate\Http\Request;

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
//    protected $redirectTo = '/admin';


    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param AccountLogin $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function login(AccountLogin $request) {
        $email = $request->input('login_email');
        $password = $request->input('login_password');
        $login = \Auth::attempt(['email' => $email, 'password' => $password], true);

        if($login) {
            return redirect()->to('/admin');
        }
        else {
            return redirect()->back()->withErrors('fail');
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function logout(Request $request) {
        \Auth::logout();
        return redirect()->to('/login');
    }

    public function redirectTo() {
        
    }
}
