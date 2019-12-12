<?php

namespace App\Services;
use App\Material as MaterialEloquent;

class MaterialService extends BaseService
{
    public function add($request)
    {
        $material = MaterialEloquent::create([
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
        return $material;
    }

    public function getList()
    {
        $materials = MaterialEloquent::get();
        return $materials;
    }

    public function getOne($id)
    {
        $material = MaterialEloquent::find($id);
        return $material;
    }

    public function update($request, $id)
    {
        $material = $this->getOne($id);
        $material->update([
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
        return $material;
    }

    public function delete($id)
    {
        $material = $this->getOne($id);
        $material->delete();
    }

    public function getlastupdate()
    {
        $material = MaterialEloquent::orderBy('id', 'DESC')->first();
        if(!empty($material)){
            return $material->updated_at;
        }

        return null;
    }
}