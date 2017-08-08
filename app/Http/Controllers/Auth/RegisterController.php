<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\AccountRegister;
use App\User;
use App\Http\Controllers\Controller;
use App\UsersRoles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param RegisterAccount $request
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    protected function create(AccountRegister $request)
    {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('register_email'),
            'password' => bcrypt($request->input('password')),
        ]);

        UsersRoles::create([
            'user_id' => $user->id,
            'role_id' => 2
        ]);

        return redirect('/register/success');
    }
}
