<?php

namespace App\Services;
use App\ProduceDetail as ProduceDetailEloquent;
use App\Material as MaterialEloquent;
use App\MaterialLog as MaterialLogEloquent;
use Auth;

class ProduceDetailService extends BaseService
{
    public function add($requests)
    {
        foreach($requests as $request){
            $material = MaterialEloquent::find($request->material_id);
            if($material){
                $produceDetail = ProduceDetailEloquent::create([
                    'produce_id' => $request->produce_id,
                    'material_id' => $request->material_id,
                    'quantity ' => $request->quantity
                ]);
                if($produceDetail){
                    //更改原料存量
                    $material->quantity = $material->quantity - $request->quantity;
                    $material->save();

                    //新增原物料log
                    $materialLog = MaterialLogEloquent::create([
                        'user_id' => Auth::id(),
                        'material_id' => $request->material_id,
                        'act' => 4,
                        'amount' => $request->quantity,
                    ]);

                    return $produceDetail;
                }else{
                    return 'Failed';
                }
            }else{
                return 'Material Not Found';
            }
        }
        return $produceDetail;
    }

    public function getList()
    {
        $produceDetails = ProduceDetailEloquent::get();
        return $produceDetails;
    }

    public function getOne($id)
    {
        $produceDetail = ProduceDetailEloquent::find($id);
        return $produceDetail;
    }

    public function update($request, $id)
    {
        $produceDetail = $this->getOne($id);
        $material = MaterialEloquent::find($request->material_id);
        if($material){
            if($produceDetail){
                $orig_quantity = $produceDetail->quantity;
                $new_quantity = $material->quantity + $orig_quantity - $request->quantity;
                if($new_quantity > 0){
                    $produceDetail->update([
                        'produce_id' => $request->produce_id,
                        'quantity ' => $request->quantity
                    ]);

                    //更改原料存量
                    $material->quantity = $new_quantity;
                    $material->save();

                    //新增原料log
                    $materialLog = MaterialLogEloquent::create([
                        'user_id' => Auth::id(),
                        'material_id' => $request->material_id,
                        'act' => 5,
                        'amount' => $orig_quantity - $request->quantity,
                    ]);
                }else{
                    return 'Material Quantity Not Enough';
                }
            }else{
                return 'produceDetail Not Found';
            }
        }else{
            return 'Material Not Found';
        }
        return $produceDetail;
    }

    public function delete($id)
    {
        $produceDetail = $this->getOne($id);
        if($produceDetail){
            $material = MaterialEloquent::find($produceDetail->material_id);
            if($material){
                $orig_quantity = $produceDetail->quantity;
                $new_quantity = $material->quantity + $orig_quantity;
                $produceDetail->delete();

                //更改原料存量
                $material->quantity = $new_quantity;
                $material->save();

                //新增原料log
                $materialLog = MaterialLogEloquent::create([
                    'user_id' => Auth::id(),
                    'material_id' => $produceDetail->material_id,
                    'act' => 6,
                    'amount' => $orig_quantity,
                ]);
            }else{
                return 'Material Not Found';
            }
        }else{
            return 'produceDetail Not Found';
        }
    }

    public function getlastupdate()
    {
        $produceDetail = ProduceDetailEloquent::orderBy('id', 'DESC')->first();
        if(!empty($produceDetail)){
            return $produceDetail->updated_at;
        }
        return null;
    }
}
