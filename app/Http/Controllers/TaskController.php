<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $sites = DB::table('spot_list')->orderBy("spot_id", "desc")->get();
        return response()->json([
            'item'=>$sites
        ]);
    }
    
    public function search($parm)
    {
        $site = DB::table('spot_list')->where("location", $parm)->orWhere("level", $parm)->get();
        return response()->json([
            'item'=>$site
        ]);
    }

    public function multiSearch($location, $level)
    {
        $site = DB::table('spot_list')->where("location", $location)->where("level", $level)->orderBy("spot_id", "desc")->get();
        return response()->json([
            'item'=>$site
        ]);
    }
<<<<<<< HEAD
=======

    public function spotInfo($spot_id)
    {
        $spotInfo = DB::table('spot_info')->where("spot_id", $spot_id)->get();
        return response()->json([
            'item'=>$spotInfo
        ]);
    }
        //
>>>>>>> 471f0addcfb76d88bc6ac421d471d11444f87f5e
}
