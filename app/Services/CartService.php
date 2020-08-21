<?php

namespace App\Services;
use App\Services\BaseService;
use App\Cart as CartEloquent;
use App\Product as ProductEloquent;
use App\Services\NotificationService;
use App\Services\Logs\ProductLogService;
use Auth;
use Carbon\Carbon;

class CartService extends BaseService
{

    public function __construct()
    {

    }

    public function add($consumer_id)
    {
        $cart = CartEloquent::create([
            'consumer_id' => $consumer_id,
        ]);

        return $cart;
    }

    // public function getList()
    // {
    //     $saleOrders = CartEloquent::where('status', 1)->get();
    //     return $saleOrders;
    // }

    public function getOne($id)
    {
        $cart = CartEloquent::find($id);
        return $cart;
    }

    public function getlastupdate($id)
    {
        $cart = CartEloquent::find($id);
        if(!empty($cart)){
            return $cart->updated_at;
        }

        return null;
    }

    public function clearDetails($consumer_id){
        $cart = CartEloquent::find($consumer_id);
        $details = $cart->details;
        foreach($details as $detail){
            $detail->quantity = 0;
            $detail->subTotal = 0;
            $detail->save();
        }
        $cart->totalTaxPrice = 0;
        $cart->save();

        return null;
    }
}
