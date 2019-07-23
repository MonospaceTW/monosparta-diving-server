<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /*==========spot search API==========*/
    public function spotIndex()
    {
        $site = DB::table('spot_list')->orderBy("spot_id", "desc")->get();
        return response()->json([
            'item'=>$site
        ]);
    }

    public function search(Request $request)
    {
        if ($request->location) {
            $parm = $request->location;
            $siteLocation = DB::table('spot_list')->where("location", $parm)->get();
            return response()->json([
                'item'=>$siteLocation
            ]);
        }
        if ($request->level) {
            $parm = $request->level;
            $siteLevel = DB::table('spot_list')->where("level", $parm)->get();
            return response()->json([
                'item'=>$siteLevel
            ]);
        }
    }

    public function spotInfo($spot_id)
    {
        $spotInfo = DB::table('spot_info')->where("spot_id", $spot_id)->get();
        return response()->json([
            'item'=>$spotInfo
        ]);
    }
    /*==========spot search API end==========*/

    /*==========shop search API==========*/
    public function shopIndex()
    {
        $shop = DB::table('shops')->orderBy("shop_id", "desc")->get(['shop_id','shop_name','shop_address','shop_imgs']);
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
            $shopService = DB::table('shops')->where("shop_service","LIKE", "%".$parm."%")->get();
            return response()->json([
                'item'=>$shopService
            ]);
        }
    }

    public function shopInfo($shop_id)
    {
        $shopInfo = DB::table('shops')->where("shop_id", $shop_id)->get();
        return response()->json([
            'item'=>$shopInfo
        ]);
    }
    /*==========shop search API end==========*/
}
