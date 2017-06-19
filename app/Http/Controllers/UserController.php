<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\User;
use App\UsersRoles;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * @param CreateUser $request
     */
    public function create(CreateUser $request) {
        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->created_at = Carbon::now();
        $user->save();

        $user_role = new UsersRoles();
        $user_role->user_id = $user->id;
        $user_role->role_id = $request->role;
        $user_role->save();

        return Redirect::to('/admin/users');
    }
}
