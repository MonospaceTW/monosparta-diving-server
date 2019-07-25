<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\User;

use App\spot;

use App\shop;

use App\comment;

class TaskController extends Controller
{
    /*==========spot search API==========*/
    public function spotIndex()
    {
        $site = spot::orderBy("id", "desc")->get([
            'id',
            'name',
            'county',
            'district',
            'img1'
        ]);
        return response()->json([
            'item'=>$site
        ]);
    }

    public function spotSearch(Request $request)
    {
        if ($request->location&&$request->level) {
            $location = $request->location;
            $level = $request->level;
            $siteLocation = spot::where("location", $location)->where("level", $level)->get();
            return response()->json([
                'item'=>$siteLocation
            ]);
        }
        else {
            if ($request->location) {
                $parm = $request->location;
                $siteLocation = spot::where("location", $parm)->get();
                return response()->json([
                    'item'=>$siteLocation
                ]);
            }
            if ($request->level) {
                $parm = $request->level;
                $siteLevel = spot::where("level", $parm)->get();
                return response()->json([
                    'item'=>$siteLevel
                ]);
            }
        }
    }

    public function spotInfo($spotId)
    {
        $spotInfo = spot::where("id", $spotId)->get();
        // add comment search
        $comment = comment::where("spot_id", $spotId)->with("User")->get();
        return response()->json([
            'item' => $spotInfo,
            'comment' => $comment,
        ]);
    }
    /*==========spot search API end==========*/

    /*==========shop search API==========*/
    public function shopIndex()
    {
        $shop = shop::orderBy("id", "desc")->get([
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
            $item = shop::where("location", $location)->where("service", $service)->get();
            return response()->json([
                'item'=>$item
            ]);
        }
        else {
            if ($request->location) {
                $parm = $request->location;
                $shopLocation =shop::where("location", $parm)->get();
                return response()->json([
                    'item'=>$shopLocation
                ]);
            }
            if ($request->service) {
                $parm = $request->service;
                $shopService = shop::where("service","LIKE", "%".$parm."%")->get();
                return response()->json([
                    'item'=>$shopService
                ]);
            }
        }
    }

    public function shopInfo($shopId)
    {
        $shopInfo = shop::where("id", $shopId)->get();
        $comment = comment::where("shop_id", $shopId)->with("User")->get();
        return response()->json([
            'item' => $shopInfo,
            'comment' => $comment,
        ]);
    }
    /*==========shop search API end==========*/

    /*==========comment API start==========*/

    public function addComment(Request $request)
    {
        $comment = comment::create($request->all());
        return response()->json([
            "code" => 200,
            "message" => "comment added successfully",
            "comment" => $comment
        ]);
    }
}
