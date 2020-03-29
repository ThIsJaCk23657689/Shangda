<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Orders\CartDetailService;
use App\Http\Requests\CartDetailRequest;

class CartDetailController extends Controller
{
    public $CartDetailService;

    public function __construct()
    {
        $this->middleware('consumer');
        $this->CartDetailService = new CartDetailService();
    }

    public function getCartDetail($id){
        $detail = $this->CartDetailService->getOne($id);
        return response()->json($detail, 200);
    }

    public function getCartDetailsByCartId($cart_id){
        $details = $this->CartDetailService->getListbyCartId($cart_id);
        return response()->json($details, 200);
    }

    public function getCartDetailsByConsumerId($consumer_id){
        $details = $this->CartDetailService->getListByConsumerId($consumer_id);
        return response()->json($details, 200);
    }

    public function add(CartDetailRequest $request){
        $detail = $this->CartDetailService->add($request);
        return response()->json($detail, 200);
    }

    public function update(CartDetailRequest $request){
        $detail = $this->CartDetailService->update($request, $request->id, $request->count);
        return response()->json($detail, 200);
    }

    public function destroy($cart_id, $count)
    {
        $detail = $this->CartDetailService->delete($cart_id, $count);
        return response()->json($detail, 200);
    }

}
