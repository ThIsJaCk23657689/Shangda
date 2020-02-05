<?php

namespace App\Services;
use App\Material as MaterialEloquent;

class MaterialService extends BaseService
{
    public function add($request)
    {
        if($request->unit==1){
            $stock = $request->stock;
        }elseif($request->unit==2){
            $stock = $request->stock * 1000;
        }

        $material = MaterialEloquent::create([
            'name' => $request->name,
            'shortName' => $request->shortName,
            'internationalNum' => $request->internationalNum,
            'unit' => $request->unit,
            'unitPrice' => $request->unitPrice,
            'comment' => $request->comment,
            'stock' => $stock,
            'safeQuantity' => $request->safeQuantity,
            'picture' => $request->picture,
        ]);
        return $material;
    }

    public function getList()
    {
        $materials = MaterialEloquent::get();
        return $materials;
    }

    public function getNamesList(){
        $material_names = MaterialEloquent::select('id','name')->get();
        return $material_names;
    }

    public function getInfoList($id){
        $meterial_info = MaterialEloquent::select('id', 'name', 'internationalNum', 'unitPrice', 'unit', 'stock')->find($id);
        $meterial_info['showUnit'] = $meterial_info->showUnit();
        $meterial_info['showStock'] = $meterial_info->showStock();
        return $meterial_info;
    }

    public function getOne($id)
    {
        $material = MaterialEloquent::find($id);
        return $material;
    }

    public function update($request, $id)
    {
        $material = $this->getOne($id);

        if($request->unit==1){
            $stock = $request->stock;
        }elseif($request->unit==2){
            $stock = $request->stock * 1000;
        }

        $material->update([
            'name' => $request->name,
            'shortName' => $request->shortName,
            'internationalNum' => $request->internationalNum,
            'unit' => $request->unit,
            'unitPrice' => $request->unitPrice,
            'comment' => $request->comment,
            'stock' => $stock,
            'safeQuantity' => $request->safeQuantity,
            'picture' => $request->picture,
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
