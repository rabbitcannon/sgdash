<?php

namespace App\Http\Controllers;

use App\Comment;
use Request;

class CommentController extends Controller
{
    public function create() {
        $request = Request::all();

        $comment = new Comment();
        $comment->user_id       = $request['user_id'];
        $comment->project_id    = $request['project_id'];
        $comment->comment       = $request['comment'];
        $comment->save();
    }
}
