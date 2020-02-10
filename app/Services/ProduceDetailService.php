<?php

namespace App\Services;
use App\ProduceDetail as ProduceDetailEloquent;
use App\Material as MaterialEloquent;
use App\MaterialLog as MaterialLogEloquent;
use App\Services\NotificationService;
use Auth;

class ProduceDetailService extends BaseService
{
    public $NotificationService;

    public function __construct(){
        $this->NotificationService = new NotificationService();
    }

    public function add($request)
    {
        $produce_id = $request->produce_id;
        $data = $request->details;
        $count = 0;

        foreach($data as $obj){
            $count++;
            $material_id = $obj['material_id'];
            $quantity = $obj['quantity'];

            $material = MaterialEloquent::findOrFail($material_id);
            $produce_detail = ProduceDetailEloquent::create([
                'produce_id' => $produce_id,
                'material_id' => $material_id,
                'quantity' => $quantity
            ]);
            if($produce_detail){
                //更改原料存量
                if($material->unit == 2){
                    // 此原物料慣用單位是公噸，quantity也會是公噸
                    $material->stock = $material->stock - ($quantity * 1000);
                }else{
                    $material->stock = $material->stock - $quantity;
                }
                // 原物料低於安全庫存量
                if($material->stock< $material->safeQuantity){
                    $this->NotificationService->materialUnderSafe($material_id);
                }
                $material->save();

                //新增原物料log
                $MaterialLog = MaterialLogEloquent::create([
                    'user_id' => Auth::id(),
                    'material_id' => $material_id,
                    'act' => 4,
                    'amount' => $quantity,
                ]);
            }else{
                throw new Exception('Create Produce Detail Failed');
            }
        }
        if($produce_detail){
            $msg = [
                'massenge' => "總共有" . $count . "筆原料新增成功。",
                'redirect' => route('produces.index'),
                'status' => 'OK'
            ];
        }else{
            $msg = [
                'massenge'=>"無資料新增。",
                'status'=>'Failed'
            ];
        }
        return $msg;
    }

    public function getList()
    {
        $produce_detail = ProduceDetailEloquent::get();
        return $produce_detail;
    }

    public function getOne($id)
    {
        $produce_detail = ProduceDetailEloquent::find($id);
        return $produce_detail;
    }

    public function update($request, $id)
    {
        $produce_detail = $this->getOne($id);
        $material = MaterialEloquent::find($request->material_id);
        if($material){
            if($produce_detail){
                $orig_quantity = $produce_detail->quantity;
                $new_quantity = $material->stock + $orig_quantity - $request->quantity;
                if($new_quantity > 0){
                    $produce_detail->update([
                        'produce_id' => $request->produce_id,
                        'quantity ' => $request->quantity
                    ]);

                    //更改原料存量
                    $material->stock = $new_quantity;
                    // 原物料低於安全庫存量
                    if($material->stock< $material->safeQuantity){
                        $this->NotificationService->materialUnderSafe($material->id);
                    }
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
        return $produce_detail;
    }

    public function delete($id)
    {
        $produce_detail = $this->getOne($id);
        if($produce_detail){
            $material = MaterialEloquent::find($produce_detail->material_id);
            if($material){
                $orig_quantity = $produce_detail->quantity;
                $new_quantity = $material->stock + $orig_quantity;
                $produce_detail->delete();

                //更改原料存量
                $material->stock = $new_quantity;
                // 原物料低於安全庫存量
                if($material->stock< $material->safeQuantity){
                    $this->NotificationService->materialUnderSafe($$material->id);
                }
                $material->save();

                //新增原料log
                $materialLog = MaterialLogEloquent::create([
                    'user_id' => Auth::id(),
                    'material_id' => $produce_detail->material_id,
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
        $produce_detail = ProduceDetailEloquent::orderBy('id', 'DESC')->first();
        if(!empty($produce_detail)){
            return $produce_detail->updated_at;
        }
        return null;
    }
}
