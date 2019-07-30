<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Spot;

use App\Shop;

use App\Comment;

class TaskController extends Controller
{
    /*==========spot search API==========*/
    public function spotIndex()
    {
        $spot = Spot::orderBy("id", "desc")->get([
            'id',
            'name',
            'county',
            'district',
            'img1'
        ]);
        return response()->json([
            'item'=>$spot
        ]);
    }

    public function spotSearch(Request $request)
    {
        if ($request->location&&$request->level) {
            $location = $request->location;
            $level = $request->level;
            $spotLocation = Spot::where("location", $location)->where("level", $level)->get();
            return response()->json([
                'item'=>$spotLocation
            ]);
        }
        else {
            if ($request->location) {
                $parm = $request->location;
                $spotLocation = Spot::where("location", $parm)->get();
                return response()->json([
                    'item'=>$spotLocation
                ]);
            }
            if ($request->level) {
                $parm = $request->level;
                $spotLevel = Spot::where("level", $parm)->get();
                return response()->json([
                    'item'=>$spotLevel
                ]);
            }
        }
    }

    public function spotInfo($spotId)
    {
        $spotInfo = Spot::where("id", $spotId)->get();
        // add comment search
        $comment = Comment::where("spot_id", $spotId)->with("User")->get();
        return response()->json([
            'item' => $spotInfo,
            'comment' => $comment,
        ]);
    }
    /*==========spot search API end==========*/

    /*==========shop search API==========*/
    public function shopIndex()
    {
        $shop = Shop::orderBy("id", "desc")->get([
            'id',
            'name',
            'county',
            'district',
            'img1'
            ]);
        return response()->json([
            'item'=>$shop
        ]);
    }

    public function shopSearch(Request $request)
    {
        if ($request->location&&$request->service){
            $location = $request->location;
            $service = $request->service;
            $shopLocation = Shop::where("location", $location)->where("service","LIKE", "%".$service."%")->get();
            return response()->json([
                'item'=>$shopLocation
            ]);
        }
        else {
            if ($request->location) {
                $parm = $request->location;
                $shopLocation =Shop::where("location", $parm)->get();
                return response()->json([
                    'item'=>$shopLocation
                ]);
            }
            if ($request->service) {
                $parm = $request->service;
                $shopService = Shop::where("service","LIKE", "%".$parm."%")->get();
                return response()->json([
                    'item'=>$shopService
                ]);
            }
        }
    }

    public function shopInfo($shopId)
    {
        $shopInfo = Shop::where("id", $shopId)->get();
        $comment = Comment::where("shop_id", $shopId)->with("User")->get();
        return response()->json([
            'item' => $shopInfo,
            'comment' => $comment,
        ]);
    }
    /*==========shop search API end==========*/

    /*==========comment API start==========*/

    public function addComment(Request $request)
    {
        if ($request->spot_id) {
            $input = $request->all();
            $insert = Comment::create([
                'comment' => $input['comment'],
                'rating' => $input['rating']
                ]);
            $comment = Comment::find($insert['id']);
            $comment->Spots()->attach($input['spot_id']);
            $comment->Users()->attach($input['user_id']);
        }
        if ($request->shop_id) {
            $input = $request->all();
            $insert = Comment::create([
                'comment' => $input['comment'],
                'rating' => $input['rating']
                ]);
            $comment = Comment::find($insert['id']);
            $comment->Shops()->attach($input['shop_id']);
            $comment->Users()->attach($input['user_id']);
        }
        return response()->json([
            "code" => 200,
            "message" => "comment added successfully",
            "comment" => $insert,
            "input" => $input,
        ]);
    }
}
