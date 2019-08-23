<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Spot;

use App\Shop;

use App\Article;

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

    //show list of all spots for search
    public function spotIndex()
    {
        $spot = Spot::orderBy("id", "desc")
                    ->select([
                        'id',
                        'name',
                        'county',
                        'img1'
                        ])
                    ->paginate(15); //Add pagination
        $spotTotal = $spot->count(); //count the number of spot
        return response()->json([
            'item' => $spot,
            'spotTotal' =>$spotTotal
        ]);
    }

    //show list of spots with location and level for search
    public function spotSearch(Request $request)
    {
        if ($request->location && $request->level) {
            $location = $request->location;
            $level = $request->level;
            $spotResult = Spot::where("location", $location)
                                ->where("level", $level)
                                ->paginate(15); //Add pagination
            $spotResult -> appends(["location"=>$location,"level"=>$level]); // get the url of pagination with search parameters
            $spotTotal = $spotResult->count(); //count the number of spot searching results
            return response()->json([
                'item' => $spotResult,
                'spotTotal' => $spotTotal
            ]);
        }
        else {
            if ($request->location) {
                $parm = $request->location;
                $spotLocation = Spot::where("location", $parm)->paginate(15); //Add pagination
                $spotLocation -> appends(["location"=>$parm]); // get the url of pagination with search parameters
                $spotTotal = $spotLocation->count(); //count the number of spot searching results
                return response()->json([
                    'item' => $spotLocation,
                    'spotTotal' => $spotTotal
                ]);
            }
            if ($request->level) {
                $parm = $request->level;
                $spotLevel = Spot::where("level", $parm)->paginate(15); //Add pagination
                $spotLevel -> appends(["level"=>$parm]); // get the url of pagination with search parameters
                $spotTotal = $spotLevel->count(); //count the number of spot searching results
                return response()->json([
                    'item' => $spotLevel,
                    'spotTotal' => $spotTotal
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
                 'code' => 404,
                 'message' => 'this spot does not exist'
             ]);
         } else {
             $spotComment = Spot::find($spotId)->Comments()->latest()->get();
             $spotLocation = $spotInfo->pluck('location')->first();
             $shopNearby = Shop::where('location', $spotLocation)
                                ->inRandomOrder()
                                ->take(5)
                                ->select([
                                    'id',
                                    'name',
                                    'county',
                                    'img1'
                                    ])
                                // ->first()
                                ->get();
            $commentTotal = $spotComment->count();
             return response()->json([
                 'item' => $spotInfo,
                 'comment' => $spotComment,
                //  'location' => $spotLocation,
                 'Nearby' => $shopNearby,
                 'commentTotal' => $commentTotal
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
                        'img1'
                        ])
                    ->paginate(15); //Add pagination
        $shopTotal = $shop->count(); //count the number of spot
        return response()->json([
            'item' => $shop,
            'shopTotal' => $shopTotal
        ]);
    }

    //show list of shops with location and service for search
    public function shopSearch(Request $request)
    {
        if ($request->location && $request->service){
            $location = $request->location;
            $service = $request->service;
            $shopResult = Shop::where("location", $location)
                                ->where("service","LIKE", "%".$service."%")
                                ->paginate(15); //Add pagination
            $shopResult -> appends(["location"=>$location,"service"=>$service]); // get the url of pagination with search parameters
            $shopTotal = $shopResult->count(); //count the number of shop searching results
            return response()->json([
                'item' => $shopResult,
                'shopTotal' => $shopTotal
            ]);
        }
        else {
            if ($request->location) {
                $parm = $request->location;
                $shopLocation = Shop::where("location", $parm)->paginate(15); //Add pagination
                $shopLocation -> appends(["location"=>$parm]); // get the url of pagination with search parameters
                $shopTotal = $shopLocation->count(); //count the number of shop searching results
                return response()->json([
                    'item' => $shopLocation,
                    'shopTotal' => $shopTotal
                ]);
            }
            if ($request->service) {
                $parm = $request->service;
                $shopService = Shop::where("service","LIKE", "%".$parm."%")->paginate(15); //Add pagination
                $shopService -> appends(["service"=>$parm]); // get the url of pagination with search parameters
                $shopTotal = $shopService->count(); //count the number of shop searching results
                return response()->json([
                    'item' => $shopService,
                    'shopTotal' => $shopTotal
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
                'code' => 404,
                'message' => 'this shop does not exist'
            ]);
        } else {
            $shopComment = Shop::find($shopId)->Comments()->latest()->get();
            // $shopLocation = $shopInfo->pluck('location')->first();
            // $spotNearBy = Shop::where('location', $shopLocation)->first()->get();
            $commentTotal = $shopComment->count();
            return response()->json([
                'item' => $shopInfo,
                'comment' => $shopComment,
                // 'location' => $shopLocation,
                // 'shopNearBy' => $spotNearBy
                'commentTotal' => $commentTotal
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
                            ->select(['id','name'])
                            ->paginate(15);
        $shopResult = Shop::where("name","LIKE","%".$decodeKeyword."%")
                            ->orWhere("description","LIKE","%".$decodeKeyword."%")
                            ->select(['id','name'])
                            ->paginate(15);
        $articleResult = Article::where("title","LIKE","%".$decodeKeyword."%")
                            ->orWhere("content","LIKE","%".$decodeKeyword."%")
                            ->select(['id','title'])
                            ->paginate(15);

        //count the number of search results
        $spotTotal = $spotResult->count();
        $shopTotal = $shopResult->count();
        $articleTotal = $articleResult->count();

        return response()->json([
            'spot' => $spotResult,
            'shop' => $shopResult,
            'article' => $articleResult,
            'spotTotal' => $spotTotal,
            'shopTotal' => $shopTotal,
            'articleTotal' => $articleTotal
        ]);
    }
    /*==========keyword search API end==========*/

    /*==========article API==========*/
    //show list of all articles
    public function articleIndex(){
        $articleList = Article::orderBy("id", "desc")->paginate(15); //Add pagination
        $articleTotal = $articleList->count(); //count the number of articles
        return response()->json([
            'item' => $articleList,
            'articleTotal' => $articleTotal
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
            $categoryResult = Article::where("category", $category)->paginate(15); //Add pagination
            $categoryTotal = $categoryResult->count(); //count the number of article category results
            return response()->json([
                'item' => $categoryResult,
                'categoryTotal' => $categoryTotal
            ]);
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
