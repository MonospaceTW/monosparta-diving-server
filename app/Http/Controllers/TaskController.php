<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $site = DB::table('spot_list')->orderBy("spot_id", "desc")->get();
        return response()->json([
            'item'=>$site
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

    public function spotInfo($spot_id)
    {
        $spotInfo = DB::table('spot_info')->where("spot_id", $spot_id)->get();
        return response()->json([
            'item'=>$spotInfo
        ]);
    }
        //
}
