<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Services\Orders\ReturnOrderService;
use App\Http\Requests\SalesOrderRequest;
use Illuminate\Http\Request;

class ReturnOrderController extends Controller
{

    public $ReturnOrderService;

    public function __construct()
    {
        $this->middleware(['auth', 'job.title:4,3']);
        $this->ReturnOrderService = new ReturnOrderService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $returnOrders = $this->ReturnOrderService->getList();
        $lastUpdate = $this->ReturnOrderService->getlastupdate();
        return view('returnOrders.index', compact('returnOrders', 'lastUpdate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_shownID = $this->ReturnOrderService->generateShownID();
        return view('returnOrders.create', compact('new_shownID'));
    }
    //大便大不停
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $returnOrder = $this->ReturnOrderService->add($request);
            return response()->json([
                'salesOrder_id' => $returnOrder->id,
                'massenge' => '單號' . $returnOrder->shown_id . '建立成功。',
                'status' => 'OK'
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
        $returnOrder = $this->ReturnOrderService->getOne($id);
        return view('returnOrders.show', compact('returnOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $returnOrder = $this->ReturnOrderService->getOne($id);
        $returnID = $id;
        return view('returnOrders.edit', compact('returnID'));
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
        $status = $request->status;
        $returnOrder = $this->ReturnOrderService->update($request, $id);

        // return redirect()->route('return.show', [$id]);
        return response()->json($returnOrder, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->ReturnOrderService->delete($id);
        return redirect()->route('return.index');
    }

    // 確認退款
    public function refundConfirm($id){
        $msg = $this->ReturnOrderService->refundConfirm($id);
        return redirect()->route('return.index');
    }

    public function getOne($id){
        $returnOrder = $this->ReturnOrderService->getOne($id);
        $details = $returnOrder->details;
        $returnOrder->creator = $returnOrder->user->name;
        foreach($details as $detail){
            $detail['pieces'] = $detail->quantity / $detail->product->qty_per_pack;
            $detail['products'] = $detail->product;
        }

        return response()->json([
            'returnOrder' => $returnOrder,
            'details' => $details
        ], 200);
    }
}
