<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use app\Task;

class TaskController extends Controller
{
    /*==========spot search API==========*/
    public function spotIndex()
    {
        $site = DB::table('spots')->orderBy("id", "desc")->get([
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
        if ($request->location) {
            $parm = $request->location;
            $siteLocation = DB::table('spots')->where("location", $parm)->get();
            return response()->json([
                'item'=>$siteLocation
            ]);
        }
        if ($request->level) {
            $parm = $request->level;
            $siteLevel = DB::table('spots')->where("level", $parm)->get();
            return response()->json([
                'item'=>$siteLevel
            ]);
        }
    }

    public function spotInfo($spotId)
    {
        $spotInfo = DB::table('spots')->where("id", $spotId)->get();
        return response()->json([
            'item'=>$spotInfo
        ]);
    }
    /*==========spot search API end==========*/

    /*==========shop search API==========*/
    public function shopIndex()
    {
        $shop = DB::table('shops')->orderBy("id", "desc")->get([
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
        if ($request->location) {
            $parm = $request->location;
            $shopLocation = DB::table('shops')->where("location", $parm)->get();
            return response()->json([
                'item'=>$shopLocation
            ]);
        }
        if ($request->service) {
            $parm = $request->service;
            $shopService = DB::table('shops')->where("service","LIKE", "%".$parm."%")->get();
            return response()->json([
                'item'=>$shopService
            ]);
        }
    }

    public function shopInfo($shopId)
    {
        $shopInfo = DB::table('shops')->where("id", $shopId)->get();
        return response()->json([
            'item'=>$shopInfo
        ]);
    }
    /*==========shop search API end==========*/
}
