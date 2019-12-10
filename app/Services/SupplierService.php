<?php

namespace App\Services;
use App\Supplier as SupplierEloquent;
use Carbon\Carbon;

class SupplierService extends BaseService
{
    public function addSupplier($request)
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

    public function getSuppliersList()
    {
        $suppliers = SupplierEloquent::get();
        return $suppliers;
    }

    public function getSupplier($id)
    {
        $supplier = SupplierEloquent::find($id);
        return $supplier;
    }

    public function updateSupplier($request, $id)
    {
        $supplier = $this->getSupplier($id);
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

    public function deleteSupplier($id)
    {
        $supplier = $this->getSupplier($id);
        $supplier->delete();
    }

    public function getlastupdate()
    {
        $supplier = SupplierEloquent::orderBy('id', 'DESC')->first();
        return $supplier->updated_at;
    }
}