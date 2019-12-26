<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PurchaseOrder as PurchaseOrderEloquent;

class PurchaseOrderDetailController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'material_id.*' => 'required|integer',
            'purchaseOrder_id' => 'required|integer',
            'totalPrice.*' => 'min:0|numeric',
            'price.*' => 'min:0|numeric',
            'quantity.*' => 'integer',
            'comment.*' => 'max:255|string',
            'discount.*' => 'min:0|max:1|numeric',
        ]);

        $p = PurchaseOrderEloquent::find($request->purchaseOrder_id);
        
        foreach($this->request->get('material_id') as $key => $val){
            $p->materials()->attach($key, [
                'price' => $request->price[$val],
                'quantity' => $request->quantity[$val],
                'totalPrice' => $request->totalPrice[$val],
                'comment' => $request->comment[$val],
                'discount' => $request->discount[$val],
            ]);
        }

        return response()->json([
            'status'=>'OK'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
