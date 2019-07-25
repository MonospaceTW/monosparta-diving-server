<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Task;

use App\User;

use App\spots;

use App\shops;

use App\comments;

class TaskController extends Controller
{
    /*==========spot search API==========*/
    public function spotIndex()
    {
        $site = spots::orderBy("id", "desc")->get([
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
            $siteLocation = spots::where("location", $location)->where("level", $level)->get();
            return response()->json([
                'item'=>$siteLocation
            ]);
        }
        else {
            # code...
            if ($request->location) {
                $parm = $request->location;
                $siteLocation = spots::where("location", $parm)->get();
                return response()->json([
                    'item'=>$siteLocation
                ]);
            }
            if ($request->level) {
                $parm = $request->level;
                $siteLevel = spots::where("level", $parm)->get();
                return response()->json([
                    'item'=>$siteLevel
                ]);
            }
        }
    }

    // $user = User::with('Profile')->where('status', 1)->whereHas('Profile', function($q){
    //     $q->where('gender', 'Male');
    // })->get();

    public function spotInfo($spotId)
    {
        $spotInfo = spots::where("id", $spotId)->get();
        // add comment search
        $comment = comments::where("spot_id", $spotId)->with("User")->get();
        $user = comments::with("User")->get();
        return response()->json([
            'item' => $spotInfo,
            'comment' => $comment
        ]);
        // return comments::with('User')->get();
    }
    /*==========spot search API end==========*/

    /*==========shop search API==========*/
    public function shopIndex()
    {
        $shop = shops::orderBy("id", "desc")->get([
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
            $item = shops::where("location", $location)->where("service", $service)->get();
            return response()->json([
                'item'=>$item
            ]);
        }
        else {
            # code...
            if ($request->location) {
                $parm = $request->location;
                $shopLocation =shops::where("location", $parm)->get();
                return response()->json([
                    'item'=>$shopLocation
                ]);
            }
            if ($request->service) {
                $parm = $request->service;
                $shopService = shops::where("service","LIKE", "%".$parm."%")->get();
                return response()->json([
                    'item'=>$shopService
                ]);
            }
        }
    }

    public function shopInfo($shopId)
    {
        $shopInfo = shops::where("id", $shopId)->get();
        return response()->json([
            'item'=>$shopInfo
        ]);
    }
    /*==========shop search API end==========*/

    /*==========comment API start==========*/

    public function addComment(Request $request)
    {
        $comment = comments::create($request->all());
        return response()->json([
            "code" => 200,
            "message" => "comment added successfully",
            "comment" => $comment
        ]);
    }
}
