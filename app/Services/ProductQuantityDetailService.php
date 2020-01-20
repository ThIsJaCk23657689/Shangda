<?php

namespace App\Services;
use App\ProductQuantityDetail as ProductQuantityDetailEloquent;
use App\Material as MaterialEloquent;
use App\Material_log as Material_logEloquent;
use Auth;

class ProductQuantityDetailService extends BaseService
{
    public function add($requests)
    {
        foreach($requests as $request){
            $material = MaterialEloquent::find($request->material_id);
            if($material){
                $productQuentityDetail = ProductQuantityDetailEloquent::create([
                    'product_quantity_id' => $request->product_quantity_id,
                    'material_id' => $request->material_id,
                    'quantity ' => $request->quantity
                ]);
                if($productQuentityDetail){
                    //更改原料存量
                    $material->quantity = $material->quantity - $request->quantity;
                    $material->save();

                    //新增原物料log
                    $material_log = Material_logEloquent::create([
                        'user_id' => Auth::id(),
                        'material_id' => $request->material_id,
                        'act' => 4,
                        'amount' => $request->quantity,
                    ]);

                    return $productQuentityDetail;
                }else{
                    return 'Failed';
                }
            }else{
                return 'Material Not Found';
            }
        }



        return $productQuentityDetail;
    }

    public function getList()
    {
        $productQuentityDetails = ProductQuantityDetailEloquent::get();
        return $productQuentityDetails;
    }

    public function getOne($id)
    {
        $productQuentityDetail = ProductQuantityDetailEloquent::find($id);
        return $productQuentityDetail;
    }

    public function update($request, $id)
    {
        $productQuentityDetail = $this->getOne($id);
        $material = MaterialEloquent::find($request->material_id);
        if($material){
            if($productQuentityDetail){
                $orig_quantity = $productQuentityDetail->quantity;
                $new_quantity = $material->quantity + $orig_quantity - $request->quantity;
                if($new_quantity > 0){
                    $productQuentityDetail->update([
                        'product_quantity_id' => $request->product_quantity_id,
                        'quantity ' => $request->quantity
                    ]);

                    //更改原料存量
                    $material->quantity = $new_quantity;
                    $material->save();

                    //新增原料log
                    $material_log = Material_logEloquent::create([
                        'user_id' => Auth::id(),
                        'material_id' => $request->material_id,
                        'act' => 5,
                        'amount' => $orig_quantity - $request->quantity,
                    ]);

                }else{
                    return 'Material Quantity Not Enough';
                }


            }else{
                return 'ProductQuentityDetail Not Found';
            }

        }else{
            return 'Material Not Found';
        }


        return $productQuentityDetail;
    }

    public function delete($id)
    {
        $productQuentityDetail = $this->getOne($id);
        if($productQuentityDetail){
            $material = MaterialEloquent::find($productQuentityDetail->material_id);
            if($material){
                $orig_quantity = $productQuentityDetail->quantity;
                $new_quantity = $material->quantity + $orig_quantity;
                $productQuentityDetail->delete();

                //更改原料存量
                $material->quantity = $new_quantity;
                $material->save();

                //新增原料log
                $material_log = Material_logEloquent::create([
                    'user_id' => Auth::id(),
                    'material_id' => $productQuentityDetail->material_id,
                    'act' => 6,
                    'amount' => $orig_quantity,
                ]);

            }else{
                return 'Material Not Found';
            }
        }else{
            return 'ProductQuentityDetail Not Found';
        }

    }

    public function getlastupdate()
    {
        $productQuentityDetail = ProductQuantityDetailEloquent::orderBy('id', 'DESC')->first();
        if(!empty($productQuentityDetail)){
            return $productQuentityDetail->updated_at;
        }
        return null;
    }
}
