<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request = $request -> all();
        $comment = Comment::create([
            'comment' => $request['comment'],
            'rating' => $request['rating'],
            'user_id' => $request['user_id']
        ]);
        DB::table('spot_comments')->insert([
            'comment_id' => $comment['id'],
            'spot_id' => $request['spot_id'],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json([
            'code' => 201,
            'message' => 'comment added successfully',
            'comment' => $comment
        ]);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if ($comment == NULL) {
            return response()->json([
                'code' => 400,
                'message' => 'this comment does not exist'
            ]);
        } else {
            $comment = $comment->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Task deleted successfully',
                'comment' => $comment
            ]);
        }
    }
}
