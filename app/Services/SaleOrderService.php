<?php

namespace App\Services;
use App\SaleOrder as SaleOrderEloquent;
use Carbon\Carbon;

class SaleOrderService extends BaseService
{
    public function add($request)
    {
        $saleOrder = SaleOrderEloquent::create([
            'consumers_id' => $request->consumers_id,
            'user_id' => $request->user_id,

            'expectPay_at' => $request->expectPay_at,
            'paid_at' => $request->paid_at,
            'expectDeliver_at' => $request->expectDeliver_at,
            'delivered_at' => $request->delivered_at,
            'makeInvoice_at' => $request->makeInvoice_at,

            'piadAmount' => $request->piadAmount,
            'unpiadAmount' => $request->unpiadAmount,
            'totalPrice' => $request->totalPrice,
            'taxPrice' => $request->taxPrice,
            'totalTaxPrice' => $request->totalTaxPrice,

            'comment' => $request->comment,
            'taxType' => $request->taxType,
            'invoiceType' => $request->invoiceType,
            'address' => $request->address,
        ]);
        return $saleOrder;
    }

    public function getList()
    {
        $saleOrders = SaleOrderEloquent::get();
        return $saleOrders;
    }

    public function getOne($id)
    {
        $saleOrder = SaleOrderEloquent::find($id);
        return $saleOrder;
    }

    public function update($request, $id)
    {
        $saleOrder = $this->getOne($id);
        $saleOrder->update([
            'consumers_id' => $request->consumers_id,
            'user_id' => $request->user_id,

            'expectPay_at' => $request->expectPay_at,
            'paid_at' => $request->paid_at,
            'expectDeliver_at' => $request->expectDeliver_at,
            'delivered_at' => $request->delivered_at,
            'makeInvoice_at' => $request->makeInvoice_at,

            'piadAmount' => $request->piadAmount,
            'unpiadAmount' => $request->unpiadAmount,
            'totalPrice' => $request->totalPrice,
            'taxPrice' => $request->taxPrice,
            'totalTaxPrice' => $request->totalTaxPrice,

            'comment' => $request->comment,
            'taxType' => $request->taxType,
            'invoiceType' => $request->invoiceType,
            'address' => $request->address,
        ]);
        return $saleOrder;
    }

    public function delete($id)
    {
        $saleOrder = $this->getOne($id);
        $saleOrder->delete();
    }

    public function getlastupdate()
    {
        $saleOrder = SaleOrderEloquent::orderBy('id', 'DESC')->first();
        if(!empty($saleOrder)){
            return $saleOrder->updated_at;
        }

        return null;
    }
}