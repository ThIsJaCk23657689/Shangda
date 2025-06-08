<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseOrderRequest;
use App\Services\Orders\PurchaseOrderService;

class PurchaseOrderController extends Controller
{

    public $PurchaseOrderService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('job.title:4,3')->except([
            'index', 'show',
            'create', 'store',
            'edit', 'update'
        ]);
        $this->PurchaseOrderService = new PurchaseOrderService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrders = $this->PurchaseOrderService->getList();
        $lastUpdate = $this->PurchaseOrderService->getlastupdate();
        return view('purchaseOrders.index', compact('purchaseOrders', 'lastUpdate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchaseOrders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseOrderRequest $request)
    {
        $purchaseOrder = $this->PurchaseOrderService->add($request);

        if($purchaseOrder){
            return response()->json([
                'purchaseOrder_id' => $purchaseOrder->id,
                'message' => '單號' . $purchaseOrder->shownID . '建立成功。',
            ], 200);
        }

        return response()->json([
            'message' => '進貨單新增失敗！請稍後再試。',
        ], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseOrder = $this->PurchaseOrderService->getOne($id);
        return view('purchaseOrders.show', compact('purchaseOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchaseID = $id;
        return view('purchaseOrders.edit', compact('purchaseID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseOrderRequest $request, $id)
    {
        $result = $this->PurchaseOrderService->update($request, $id);
        return response()->json($result, $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->PurchaseOrderService->delete($id);
        return redirect()->route('purchase.index');
    }

    public function received(Request $request){
        $result = $this->PurchaseOrderService->received($request);
        return response()->json([
            'message' => $result['message'],
            'url' => route('purchase.index')
        ], $result['status']);
    }

    public function paid(Request $request){
        $result = $this->PurchaseOrderService->paid($request);
        return response()->json([
            'message' => $result['message'],
            'url' => route('purchase.index')
        ], $result['status']);
    }

    public function getOne($id){
        $purchase = $this->PurchaseOrderService->getOne($id);
        $details = $purchase->details;

        foreach($details as $detail){
            $detail['material'] = $detail->material;
        }

        return response()->json([
            'purchase' => $purchase,
            'details' => $details
        ], 200);
    }
}
