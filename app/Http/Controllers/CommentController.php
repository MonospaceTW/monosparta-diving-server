<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $input = $request -> all();
        $comment = Comment::create([
            'comment' => $input['comment'],
            'rating' => $input['rating'],
            'user_id' => $input['user_id']
        ]);
        if ($request->input('spot_id')) {
            $comment = $comment->spots()->attach($input['spot_id']);
            return response()->json([
                'code' => 201,
                'message' => 'comment added successfully',
                'comment' => $comment
            ]);
        }
        if ($request->input('shop_id')) {
            $comment = $comment->shops()->attach($input['shop_id']);
            return response()->json([
                'code' => 201,
                'message' => 'comment added successfully',
                'comment' => $comment
            ]);
        }
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
            $comment->shops()->detach();
            $comment->spots()->detach();
            $comment->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Task deleted successfully',
                'comment' => $comment
            ]);
        }
    }
}
