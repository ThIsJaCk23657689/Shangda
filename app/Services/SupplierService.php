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
            'comment' => $request->comment,

            'operator_name_1' => $request->operator_name_1,
            'operator_tel_1' => $request->operator_tel_1,
            'operator_email_1' => $request->operator_email_1,
            'operator_name_2' => $request->operator_name_2,
            'operator_tel_2' => $request->operator_tel_2,
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
            'monthlyCheckDate' => $request->monthlyCheckDate ?? 0,
        ]);
        
        if(!$supplier){
            return [
                'status' => 422,
                'message' => '新增供應商時發生錯誤！'
            ];
        }
        
        return [
            'status' => 200,
            'message' => '新增供應商成功！'
        ];
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
        $supplier = SupplierEloquent::findOrFail($id);
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
            'comment' => $request->comment,

            'operator_name_1' => $request->operator_name_1,
            'operator_tel_1' => $request->operator_tel_1,
            'operator_email_1' => $request->operator_email_1,
            'operator_name_2' => $request->operator_name_2,
            'operator_tel_2' => $request->operator_tel_2,
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
            'monthlyCheckDate' => $request->monthlyCheckDate ?? 0,
        ]);
        
        if(!$supplier){
            return [
                'status' => 422,
                'message' => '編輯供應商資料時發生錯誤！'
            ];
        }

        return [
            'status' => 200,
            'message' => '編輯供應商資料成功！'
        ];
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
