<?php

namespace App\Services;
use App\Favorite as FavoriteEloquent;
use Carbon\Carbon;

class FavoriteService extends BaseService
{
    public function add($pid, $cid)
    {
        $favorites = FavoriteEloquent::create([
            'product_id' => $pid,
            'consumer_id' => $cid,
        ]);

        return $favorites;
    }

    public function getList($cid)
    {
        $favorites = FavoriteEloquent::where('consumer_id', $cid)->get();
        return $favorites;
    }

    public function delete($pid, $cid)
    {
        $favorite = FavoriteEloquent::where('consumer_id', $cid)->where('product_id', $pid)->get();
        $favorite->delete();
        return null;
    }

}
