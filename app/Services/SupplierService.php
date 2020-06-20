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
            'phone_day' => $request->phone_day,
            'phone_night' => $request->phone_night,
            'tax' => $request->tax,
            'comment' => $request->comment,

            'operator_name_1' => $request->operator_name_1,
            'operator_tel_1' => $request->operator_tel_1,
            'operator_phone_1' => $request->operator_phone_1,
            'operator_email_1' => $request->operator_email_1,
            'operator_name_2' => $request->operator_name_2,
            'operator_tel_2' => $request->operator_tel_2,
            'operator_phone_1' => $request->operator_phone_1,
            'operator_email_2' => $request->operator_email_2,

            'companyAddress_zipcode' => $request->companyAddress_zipcode,
            'companyAddress_county' => $request->companyAddress_county,
            'companyAddress_district' => $request->companyAddress_district,
            'companyAddress_others' => $request->companyAddress_others,

            'bank_name' => $request->bank_name,
            'bank_branch_name' => $request->bank_branch_name,
            'bank_code' => $request->bank_code,
            'bank_account' => $request->bank_account,
            'bank_account_name' => $request->bank_account_name,
            'payment_method' => $request->payment_method,
            'monthlyCheckDate' => $request->monthlyCheckDate ?? 0,
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
        $supplier_info = SupplierEloquent::select('shortName','taxId','tel','tax','operator_name_1','operator_tel_1')->find($id);
        $supplier_info['companyAddress'] = $supplier_info->showAddress();
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
            'phone_day' => $request->phone_day,
            'phone_night' => $request->phone_night,

            'inCharge1' => $request->inCharge1,
            'tel1' => $request->tel1,
            'email1' => $request->email1,
            'inCharge2' => $request->inCharge2,
            'tel2' => $request->tel2,
            'email2' => $request->email2,

            'companyAddress_zipcode' => $request->companyAddress_zipcode,
            'companyAddress_county' => $request->companyAddress_county,
            'companyAddress_district' => $request->companyAddress_district,
            'companyAddress_others' => $request->companyAddress_others,

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
