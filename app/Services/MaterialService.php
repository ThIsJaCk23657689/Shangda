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
            'picture' => $request->picture,
        ]);
        return $material;
    }

    public function getList()
    {
        $materials = MaterialEloquent::get();
        foreach($materials as $m){
            if($m->unit==2){
                $m->unit = "公噸";
                $m->stock = $m->stock/1000;
            }elseif($m->unit==1){
                $m->unit = "公斤";
            }
        }
        return $materials;
    }

    public function getOne($id)
    {
        $material = MaterialEloquent::find($id);
        if($material->unit==2){
            $material->unit = "公噸";
            $material->stock = $material->stock/1000;
        }elseif($material->unit==1){
            $material->unit = "公斤";
        }
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
