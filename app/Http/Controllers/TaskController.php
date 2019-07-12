<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        $sites = DB::table('test004')->where("avgRate", 3)->orderBy("id", "desc")->get();
        return response()->json([
            'site'=>$sites
        ]);
    }
    
    public function search($location)
    {
        $site = DB::table('test004')->where("location", $location)->orderBy("id", "desc")->get();
        return response()->json([
            'site'=>$site
        ]);
    }

    public function multiSearch($location, $level)
    {
        $site = DB::table('test004')->where("location", $location)->where("level", $level)->orderBy("id", "desc")->get();
        return response()->json([
            'site'=>$site
        ]);
    }
        //
}