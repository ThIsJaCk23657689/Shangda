<?php

namespace App\Services;
use App\Supplier as SupplierEloquent;
use Carbon\Carbon;

class SupplierService extends BaseService
{
    public function add($request)
    {
        $supplier = SupplierEloquent::create([
            'name' => $request->name,
            'shortName' => $request->shortName,
            'taxId' => $request->taxId,
            'tel' => $request->tel,
            'tax' => $request->tax,
            'inCharge1' => $request->inCharge1,
            'tel1' => $request->tel1,
            'email1' => $request->email1,
            'inCharge2' => $request->inCharge2,
            'tel2' => $request->tel2,
            'email2' => $request->email2,
            'companyAddress' => $request->companyAddress,
            'deliveryAddress' => $request->deliveryAddress,
            'invoiceAddress' => $request->invoiceAddress,
            'comment' => $request->comment,
        ]);
        return $supplier;
    }

    public function getList()
    {
        $suppliers = SupplierEloquent::get();
        return $suppliers;
    }

    public function getNamesList(){
        $supplier_names = SupplierEloquent::select('id','name')->get();
        return $supplier_names;
    }

    public function getOne($id)
    {
        $supplier = SupplierEloquent::find($id);
        return $supplier;
    }



    public function update($request, $id)
    {
        $supplier = $this->getOne($id);
        $supplier->update([
            'name' => $request->name,
            'shortName' => $request->shortName,
            'taxId' => $request->taxId,
            'tel' => $request->tel,
            'tax' => $request->tax,
            'inCharge1' => $request->inCharge1,
            'tel1' => $request->tel1,
            'email1' => $request->email1,
            'inCharge2' => $request->inCharge2,
            'tel2' => $request->tel2,
            'email2' => $request->email2,
            'companyAddress' => $request->companyAddress,
            'deliveryAddress' => $request->deliveryAddress,
            'invoiceAddress' => $request->invoiceAddress,
            'comment' => $request->comment,
        ]);
        return $supplier;
    }

    public function delete($id)
    {
        $supplier = $this->getOne($id);
        $supplier->delete();
    }

    public function getlastupdate()
    {
        $supplier = SupplierEloquent::orderBy('id', 'DESC')->first();
        if(!empty($supplier)){
            return $supplier->updated_at;
        }

        return null;
    }
}
