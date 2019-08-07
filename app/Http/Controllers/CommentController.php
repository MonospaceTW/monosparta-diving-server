<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $comment = Comment::create($request->all());
        return response()->json([
            "code" => 201,
            "message" => "comment added successfully",
            "comment" => $comment,
        ]);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if ($comment == NULL) {
            return response()->json([
                "code" => 400,
                "message" => "This comment does not exist"
            ]);
        } else {
            $comment = $comment->delete();
            return response()->json([
                "code" => 200,
                "message" => "Task deleted successfully",
                "comment" => $comment
            ]);
        }
    }
}
