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
        // return with info and comments
        $spotInfo = Spot::with('Comments')->find($spotId);
        return response()->json([
            'comment' => $spotInfo
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
        // returns with shop info and comments
        $shopInfo = Shop::with('Comments')->find($shopId);
        return response()->json([
            'item' => $shopInfo
        ]);
    }
    /*==========shop search API end==========*/

    /*==========comment API start==========*/

    public function addComment(Request $request)
    {
        $comment = Comment::create($request->all());
        return response()->json([
            "code" => 200,
            "message" => "comment added successfully",
            "comment" => $comment,
        ]);
    }
}
