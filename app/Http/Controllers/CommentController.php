<?php

namespace App\Http\Controllers;

use App\Comment;
use Carbon\Carbon;
use Request;

class CommentController extends Controller
{
    /**
     *
     */
    public function create() {
        $request = Request::all();

        Comment::insert([
            'user_id'       => $request['user_id'],
            'project_id'    => $request['project_id'],
            'comment'       => $request['comment'],
            'created_at'    => Carbon::now(),
        ]);
    }

    /**
     * @param $id
     */
    public function update($id) {
        $request = Request::all();
        $comment = Comment::find($id);
        $comment->comment = $request['comment'];
        $comment->updated_at = Carbon::now();
        $comment->save();
    }
}
