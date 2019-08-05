<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Spot;

use App\Shop;

use App\Article;

use App\Comment;

class TaskController extends Controller
{
    /*==========spot search API==========*/
    //random five spots for home page
    public function spotRandom()
    {
        $spotRandom= Spot::inRandomOrder()->take(5)->get();
        return response()->json([
            'item'=>$spotRandom
        ]);
    }

<<<<<<< HEAD
    public function search(Request $request)
    {

        if ($request->location && $request->level) {
            $level = $request->level;
            $location = $request->location;
            $site = DB::table('spot_list')->where("location", $location)->where("level", $level)->get();
            return response()->json([
                'item'=>$site
                ]);
            }
            else if ($request->location) {
                    $parm = $request->location;
                    $site = DB::table('spot_list')->where("location", $parm)->get();
                    return response()->json([
                        'item'=>$site
                    ]);
                }
                if ($request->level) {
                    $parm = $request->level;
                    $site = DB::table('spot_list')->where("level", $parm)->get();
                    return response()->json([
                        'item'=>$site
                        ]);
                    }
=======
    //show list of all spots for search
    public function spotIndex()
    {
        $spot = Spot::orderBy("id", "desc")
                    ->select([
                        'id',
                        'name',
                        'county',
                        'district',
                        'img1'
                        ])
                    ->get();
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
            $spotResult = Spot::where("location", $location)->where("level", $level)->get();
            return response()->json([
                'item' => $spotResult
            ]);
        }
        else {
            if ($request->location) {
                $parm = $request->location;
                $spotLocation = Spot::where("location", $parm)->get();
                return response()->json([
                    'item' => $spotLocation
                ]);
            }
            if ($request->level) {
                $parm = $request->level;
                $spotLevel = Spot::where("level", $parm)->get();
                return response()->json([
                    'item' => $spotLevel
                ]);
            }
        }
    }

    //show certain information of a spot
    public function spotInfo($spotId)
    {
         // return with info and comments
         $spotInfo = Spot::where('id', $spotId)->get();
         if ($spotInfo->isEmpty()) {
             return response()->json([
                 'code' => 200,
                 'message' => 'this spot does not exist'
             ]);
         } else {
             $spotComment = Spot::where('id', $spotId)->with('Comments')->get();
             $comment = $spotComment->pluck('comments');
             $spotLocation = $spotInfo->pluck('location');
             $shopNearby = Shop::where('location', $spotLocation)
                                ->select([
                                    'id',
                                    'name',
                                    'county',
                                    'district',
                                    'img1'
                                    ])
                                ->get();
             return response()->json([
                 'item' => $spotInfo,
                 'comment' => $comment,
                //  'location' => $spotLocation,
                 'Nearby' => $shopNearby
             ]);
        }
    }

    /*==========spot search API end==========*/

    /*==========shop search API==========*/

    //random five shops for home page
    public function shopRandom()
    {
        $shopRandom = Shop::inRandomOrder()->take(5)->get();
        return response()->json([
            'item' => $shopRandom
        ]);
    }

    //show list of all shops for search
    public function shopIndex()
    {
        $shop = Shop::orderBy("id", "desc")
                    ->select([
                        'id',
                        'name',
                        'county',
                        'district',
                        'img1'
                        ])
                    ->get();
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
            $shopResult = Shop::where("location", $location)->where("service","LIKE", "%".$service."%")->get();
            return response()->json([
                'item' => $shopResult
            ]);
        }
        else {
            if ($request->location) {
                $parm = $request->location;
                $shopLocation = Shop::where("location", $parm)->get();
                return response()->json([
                    'item' => $shopLocation
                ]);
            }
            if ($request->service) {
                $parm = $request->service;
                $shopService = Shop::where("service","LIKE", "%".$parm."%")->get();
                return response()->json([
                    'item' => $shopService
                ]);
            }
        }
    }

    //show certain information of a shop
    public function shopInfo($shopId)
    {
        // returns with shop info and comments
        $shopInfo = Shop::where('id', $shopId)->get();
        if ($shopInfo->isEmpty()) {
            return response()->json([
                'code' => 200,
                'message' => 'this shop does not exist'
            ]);
        } else {
            $shopComment = Shop::where('id', $shopId)->with('Comments')->get();
            $comment = $shopComment->pluck('comments');
            // $shopLocation = $shopInfo->pluck('location');
            // $spotNearBy = Shop::where('location', $shopLocation)->get();
            return response()->json([
                'item' => $shopInfo,
                'comment' => $comment,
                // 'location' => $shopLocation,
                // 'shopNearBy' => $spotNearBy
            ]);
        }
    }
    /*==========shop search API end==========*/

    /*==========keyword search API==========*/
    public function keywordSearch($keyword)
    {
        $decodeKeyword = urldecode($keyword);//decode keyword from frontend
        $spotResult = Spot::where("name","LIKE","%".$decodeKeyword."%")
                            ->orWhere("description","LIKE","%".$decodeKeyword."%")
                            ->get(['id','name']);
        $shopResult = Shop::where("name","LIKE","%".$decodeKeyword."%")
                            ->orWhere("description","LIKE","%".$decodeKeyword."%")
                            ->get(['id','name']);
        $articleResult = Article::where("title","LIKE","%".$decodeKeyword."%")
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
        $articleList = Article::orderBy("id", "desc")->get();
        return response()->json([
            'item'=>$articleList
        ]);
    }

    //random five articles for home page
    public function articleRandom()
    {
        $random = Article::inRandomOrder()->take(5)->get();
        return response()->json([
            'item' => $random
        ]);
    }

    //display articles by category
    public function articleCategory($category)
    {
            $categoryResult = Article::where("category", $category)->get();
            return response()->json([
                'item' => $categoryResult
            ]);
>>>>>>> d3b0e86a78cd7cd53d8caed92ee715df994beff3
    }

    //show certain information of an article
    public function articleInfo($articleId)
    {
        $articleInfo = Article::where("id", $articleId)->get();
        return response()->json([
            'item' => $articleInfo,
        ]);
    }
    /*==========article API end==========*/
}
