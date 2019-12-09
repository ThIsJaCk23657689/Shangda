<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseOrder as PurchaseOrderEloquent;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrder = PurchaseOrderEloquent::all();
        return view('purchaseOrder.index', compact('purchaseOrder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchaseOrder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|integer',
            'user_id' => 'required|integer',
            'paid_at' => 'date',
            'received_at' => 'date',
            'expectReceived_at' => 'required|date',
            'totalPrice' => 'min:0',
            'comment' => 'max:255|string',
            'taxType' => 'min:1|max:6',
            'invoiceType' => 'min:1|max:5',
            'address' => 'max:255|string',
        ]);

        $p = PurchaseOrderEloquent::create($request);
        
        return response()->json([
            'id'=> $p->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseOrder = PurchaseOrderEloquent::find($id);

        return view('purchaseOrder.show', compact('purchaseOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('purchaseOrder.edit');
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
        $request->validate([
            'supplier_id' => 'required|integer',
            'user_id' => 'required|integer',
            'paid_at' => 'date',
            'received_at' => 'date',
            'expectReceived_at' => 'required|date',
            'totalPrice' => 'min:0',
            'comment' => 'max:255|string',
            'taxType' => 'min:1|max:6',
            'invoiceType' => 'min:1|max:5',
            'address' => 'max:255|string',
        ]);
        $purchaseOrder = PurchaseOrderEloquent::find($id);
        $purchaseOrder->update();
        return redirect()->route('purchaseOrder.show',[$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchaseOrder = PurchaseOrderEloquent::find($id);
        $purchaseOrder->delete();
        
        return redirect()->route('purchaseOrder.index');
    }
}
