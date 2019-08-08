<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

use Illuminate\Support\Facades\DB;

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
            DB::table('spot_comments')->insert([
                'comment_id' => $comment['id'],
                'spot_id' => $input['spot_id'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
            return response()->json([
                'code' => 201,
                'message' => 'comment added successfully',
                'comment' => $comment
            ]);
        }
        if ($request->input('shop_id')) {
            DB::table('shop_comments')->insert([
                'comment_id' => $comment['id'],
                'shop_id' => $input['shop_id'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
                ]);
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
            $comment = $comment->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Task deleted successfully',
                'comment' => $comment
            ]);
        }
    }
}
