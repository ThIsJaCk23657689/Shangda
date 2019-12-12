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
            'internationalNum' => $request->internationalNum,
            'unit' => $request->unit,
            'unitPrice' => $request->unitPrice,
            'comment' => $request->comment,
            'stock' => $request->stock,
            'picture' => $request->picture,
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
            'internationalNum' => $request->internationalNum,
            'unit' => $request->unit,
            'unitPrice' => $request->unitPrice,
            'comment' => $request->comment,
            'stock' => $request->stock,
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
