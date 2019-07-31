<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\spot;

use App\shop;

use App\comment;

use App\article;


class TaskController extends Controller
{
    /*==========spot search API==========*/
    //random five spots for home page
    public function spotRandom()
    {
        $spotRandom= spot::inRandomOrder()->take(5)->get();
        return response()->json([
            'item'=>$spotRandom
        ]);
    }

    //show list of all spots for search
    public function spotIndex()
    {
        $spot = spot::orderBy("id", "desc")->get([
            'id',
            'name',
            'county',
            'district',
            'img1'
        ]);
        return response()->json([
            'item' => $spot
        ]);
    }

    //show list of spots with location and level for search
    public function spotSearch(Request $request)
    {
        if ($request->location && $request->level) {
            $location = $request->location;
            $level = $request->level;
            $spotResult = spot::where("location", $location)->where("level", $level)->get();
            return response()->json([
                'item' => $spotResult
            ]);
        }
        else {
            if ($request->location) {
                $parm = $request->location;
                $spotLocation = spot::where("location", $parm)->get();
                return response()->json([
                    'item' => $spotLocation
                ]);
            }
            if ($request->level) {
                $parm = $request->level;
                $spotLevel = spot::where("level", $parm)->get();
                return response()->json([
                    'item' => $spotLevel
                ]);
            }
        }
    }

    //show certain information of a spot
    public function spotInfo($spotId)
    {
        $spotInfo = spot::where("id", $spotId)->get();
        // add comment search
        // $comment = comment::where("spot_id", $spotId)->with("User")->get();
        return response()->json([
            'item' => $spotInfo,
            // 'comment' => $comment,
        ]);
    }
    /*==========spot search API end==========*/

    /*==========shop search API==========*/
    //random five shops for home page
    public function shopRandom()
    {
        $shopRandom = shop::inRandomOrder()->take(5)->get();
        return response()->json([
            'item' => $shopRandom
        ]);
    }

    //show list of all shops for search
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
            'item' => $shop
        ]);
    }

    //show list of shops with location and service for search
    public function shopSearch(Request $request)
    {
        if ($request->location && $request->service){
            $location = $request->location;
            $service = $request->service;
            $shopResult = shop::where("location", $location)->where("service","LIKE", "%".$service."%")->get();
            return response()->json([
                'item' => $shopResult
            ]);
        }
        else {
            if ($request->location) {
                $parm = $request->location;
                $shopLocation =shop::where("location", $parm)->get();
                return response()->json([
                    'item' => $shopLocation
                ]);
            }
            if ($request->service) {
                $parm = $request->service;
                $shopService = shop::where("service","LIKE", "%".$parm."%")->get();
                return response()->json([
                    'item' => $shopService
                ]);
            }
        }
    }

    //show certain information of a shop
    public function shopInfo($shopId)
    {
        $shopInfo = shop::where("id", $shopId)->get();
        // $comment = comment::where("shop_id", $shopId)->with("User")->get();
        return response()->json([
            'item' => $shopInfo,
            // 'comment' => $comment,
        ]);
    }
    /*==========shop search API end==========*/

    /*==========keyword search API==========*/
    public function keywordSearch($keyword)
    {
        $decodeKeyword = urldecode($keyword);//decode keyword from frontend
        $spotResult = spot::where("name","LIKE","%".$decodeKeyword."%")
                            ->orWhere("description","LIKE","%".$decodeKeyword."%")
                            ->get(['id','name']);
        $shopResult = shop::where("name","LIKE","%".$decodeKeyword."%")
                            ->orWhere("description","LIKE","%".$decodeKeyword."%")
                            ->get(['id','name']);
        $articleResult = article::where("title","LIKE","%".$decodeKeyword."%")
                            ->orWhere("content","LIKE","%".$decodeKeyword."%")
                            ->get(['id','title']);

        return response()->json([
            'spot' => $spotResult,
            'shop' => $shopResult,
            'article' => $articleResult,
        ]);
    }
    /*==========keyword search API end==========*/

    /*==========article API==========*/
    //show list of all articles
    public function articleIndex(){
        $articleList = article::orderBy("id", "desc")->get();
        return response()->json([
            'item'=>$articleList
        ]);
    }

    //random five articles for home page
    public function articleRandom()
    {
        $random = article::inRandomOrder()->take(5)->get();
        return response()->json([
            'item' => $random
        ]);
    }

    //display articles by category
    public function articleCategory($category)
    {
            $categoryResult = article::where("category", $category)->get();
            return response()->json([
                'item' => $categoryResult
            ]);
    }

    //show certain information of an article
    public function articleInfo($articleId)
    {
        $articleInfo = article::where("id", $articleId)->get();
        return response()->json([
            'item' => $articleInfo,
        ]);
    }
    /*==========article API end==========*/

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
