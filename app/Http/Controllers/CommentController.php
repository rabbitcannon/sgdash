<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Support\Facades\Request;

class CommentController extends Controller
{
    public function create() {
        $request = Request::all();

        $new_comment = [
            'user_id'       => $request['user_id'],
            'project_id'    => $request['project_id'],
            'comment'       => $request['comment'],
        ];

        Comment::insert($new_comment);
    }
}
