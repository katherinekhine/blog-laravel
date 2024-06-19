<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $request->validate(
            [
                "article_id" => "required",
                "content" => "required",
            ]
        );

        $comment = new Comment;
        $comment->content = $request->content;
        $comment->article_id = $request->article_id;
        $comment->user_id = auth()->id();

        $comment->save();

        return back();
    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        if (Gate::allows("delete-comment", $comment)) {
            $comment->delete();
            return back()->with('info', 'Comment deleted');
        }


        return back()->with('info', 'Unauthorized');
    }
}
