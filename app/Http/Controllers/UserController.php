<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreateUser;
use App\User;
use App\UsersRoles;
use DB;
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

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $comments = Comment::where('user_id', $id)->pluck('id');
        $comment_array = $comments->toArray();

        DB::transaction(function () use ($comment_array, $id) {
            User::destroy($id);
            Comment::destroy($comment_array);
        }, 5);

        return Redirect::to('/admin/users');
    }

    /**
     * @param $id
     * @param Request $request
     */
    public function update($id, Request $request) {
        User::where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }
}
