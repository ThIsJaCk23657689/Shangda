<?php

namespace App\Services;
use App\Supplier as SupplierEloquent;

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

            'CompanyAddress_zipcode' => $request->CompanyAddress_zipcode,
            'CompanyAddress_county' => $request->CompanyAddress_county,
            'CompanyAddress_district' => $request->CompanyAddress_district,
            'CompanyAddress_others' => $request->CompanyAddress_others,

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

    public function getInfoList($id){
        $supplier_info = SupplierEloquent::select('shortName','taxId','tel','tax','inCharge1','tel1','companyAddress')->find($id);
        return $supplier_info;
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

            'CompanyAddress_zipcode' => $request->CompanyAddress_zipcode,
            'CompanyAddress_county' => $request->CompanyAddress_county,
            'CompanyAddress_district' => $request->CompanyAddress_district,
            'CompanyAddress_others' => $request->CompanyAddress_others,

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
