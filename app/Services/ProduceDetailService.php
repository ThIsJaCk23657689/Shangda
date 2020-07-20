<?php

namespace App\Services;

use App\ProduceDetail as ProduceDetailEloquent;
use App\ProduceProduct as ProduceProductEloquent;
use App\Material as MaterialEloquent;
use App\Product as ProductEloquent;
use App\Produce as ProduceEloquent;
use App\Services\Logs\MaterialLogService;
use App\Services\Logs\ProductLogService;
use App\Services\NotificationService;
use Auth;

class ProduceDetailService extends BaseService
{
    public $NotificationService;
    public $MaterialLogService;
    public $ProductLogService;

    public function __construct()
    {
        $this->NotificationService = new NotificationService();
        $this->MaterialLogService = new MaterialLogService();
        $this->ProductLogService = new ProductLogService();
    }

    public function add($request)
    {
        $produce_id = $request->produce_id;
        $material_details = $request->material_details;
        $product_details = $request->product_details;

        $result = $this->addDetail($material_details, $product_details, $produce_id);

        if ($result) {
            $msg = [
                'message' => "總共有" . count($product_details) . '筆商品 / ' . count($material_details) . "筆原料新增成功。",
                'url' => route('produces.index'),
                'status' => 200
            ];
        } else {
            $msg = [
                'message' => "發生錯誤！",
                'status' => 422
            ];
        }
        return $msg;
    }

    public function update($request)
    {
        $produce_id = $request->produce_id;
        $material_details = $request->material_details;
        $product_details = $request->product_details;

        $result = $this->removeDetails($produce_id);
        if (!$result) {
            // 刪除失敗
            return [
                'message' => '更新商品庫存細項（原物料與商品）時發生錯誤，請稍後再試。',
                'status' => 422
            ];
        }

        $result = $this->addDetails($material_details, $product_details, $produce_id);
        if (!$result) {
            // 新增失敗
            return [
                'message' => '更新商品庫存細項（原物料與商品）時發生錯誤，請稍後再試。',
                'status' => 422
            ];
        }

        return [
            'message' => '商品庫存與細項已更新成功！',
            'url' => route('produces.show', $produce_id),
            'status' => 200
        ];
    }

    public function delete($produce_id)
    {
        $result = $this->removeDetails($produce_id);
        return $result;
    }

    private function addDetails($material_details, $product_details, $produce_id)
    {
        // 新增原物料到細項
        $m_result = $this->addMaterialsToDetail($material_details, $produce_id);

        // 新增商品到細項
        $p_result = $this->addProductsToDetail($product_details, $produce_id);

        if($m_result && $p_result){
            return true;
        }else{
            return false;
        }
    }

    private function removeDetails($produce_id){
        $produce = ProduceEloquent::findOrFail($produce_id);
        $old_m_details = $produce->produceDetails;
        $old_p_details = $produce->produceProducts;

        // 刪除原物料到細項
        $m_result = $this->removeMaterialsToDetail($old_m_details);

        // 刪除商品到細項
        $p_result = $this->removeProductsToDetail($old_p_details);

        if($m_result && $p_result){
            return true;
        }else{
            return false;
        }
    }

    private function addMaterialsToDetail($material_details, $produce_id)
    {
        foreach ($material_details as $material_detail) {
            $material_id = $material_detail['material']['id'];
            $quantity = $material_detail['quantity'];

            $material = MaterialEloquent::findOrFail($material_id);
            $produce_detail = ProduceDetailEloquent::create([
                'produce_id' => $produce_id,
                'material_id' => $material_id,
                'quantity' => $quantity
            ]);

            if ($produce_detail) {
                // 更改原料存量
                if ($material->unit == 2) {
                    // 此原物料慣用單位是公噸，quantity也會是公噸
                    $material->stock = $material->stock - ($quantity * 1000);
                } else {
                    // 不然就是公斤。
                    $material->stock = $material->stock - $quantity;
                }
                $material->save();

                // 原物料低於安全庫存量
                if ($material->stock < $material->safeQuantity) {
                    $this->NotificationService->materialUnderSafe($material_id);
                }

                // 新增原物料log
                $this->MaterialLogService->add(Auth::id(), $material_id, 4, $quantity);
            }else{
                return false;
            }
        }
        return true;
    }

    private function addProductsToDetail($product_details, $produce_id)
    {
        foreach ($product_details as $product_detail) {
            $product_id = $product_detail['product']['id'];
            $quantity = $product_detail['quantity'];

            $product = ProductEloquent::findOrFail($product_id);
            $produce_product = ProduceProductEloquent::create([
                'produce_id' => $produce_id,
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);

            if ($produce_product) {
                // 更改商品存貨量
                $product->quantity = $product->quantity + $quantity;
                if ($product->quantity < 0) {
                    throw new Exception('商品庫存不足低於0。');
                }
                $product->save();

                //新增商品存貨Log
                $ProductLog = $this->ProductLogService->add(Auth::id(), $product_id, 4, $quantity);
            }else{
                return false;
            }
        }
        return true;
    }

    private function removeMaterialsToDetail($old_m_details){
        $userID = Auth::id();
        $count = 0;
        foreach($old_m_details as $detail){
            $count++;

            $material_id = $detail['material_id'];
            $material = MaterialEloquent::findOrFail($material_id);
            $quantity = $detail['quantity'];
            if ($material->unit == 2) {
                // 此原物料慣用單位是公噸，quantity也會是公噸
                $material->stock = $material->stock + ($quantity * 1000);
            } else {
                // 不然就是公斤。
                $material->stock = $material->stock + $quantity;
            }
            $material->save();

            $this->MaterialLogService->add($userID, $material_id, 6, $quantity);
            $detail->delete();
        }
        
        if ($count == count($old_m_details)) {
            return true;
        } else {
            return false;
        }
    }

    private function removeProductsToDetail($old_p_details){
        $userID = Auth::id();
        $count = 0;
        foreach($old_p_details as $detail){
            $count++;

            $product_id = $detail['product_id'];
            $product = ProductEloquent::findOrFail($product_id);
            $quantity = $detail['quantity'];
            $product->quantity = $product->quantity - $quantity;
            $product->save();

            $this->ProductLogService->add($userID, $product_id, 6, $quantity);
            $detail->delete();
        }
        
        if ($count == count($old_p_details)) {
            return true;
        } else {
            return false;
        }
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

    public function materialUpdate($request, $id)
    {
        $produce_detail = $this->getOne($id);
        $material = MaterialEloquent::find($request->material_id);
        if ($material) {
            if ($produce_detail) {
                $orig_quantity = $produce_detail->quantity;
                $new_quantity = $material->stock + $orig_quantity - $request->quantity;
                if ($new_quantity > 0) {
                    $produce_detail->update([
                        'produce_id' => $request->produce_id,
                        'quantity ' => $request->quantity
                    ]);

                    //更改原料存量
                    $material->stock = $new_quantity;
                    // 原物料低於安全庫存量
                    if ($material->stock < $material->safeQuantity) {
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
                } else {
                    return 'Material Quantity Not Enough';
                }
            } else {
                return 'produceDetail Not Found';
            }
        } else {
            return 'Material Not Found';
        }
        return $produce_detail;
    }

    public function productUpdate($request, $id)
    {
        $produce_product = ProduceProductEloquent::find($id);
        $product = ProductEloquent::find($produce_product->product_id);
        if ($product) {
            $orig_quantity = $produce_product->quantity;
            $produce_product->quantity = $request->quantity;
            $produce_product->save();
        } else {
            return "Product Not Found";
        }
        $product->quantity = $product->quantity - $orig_quantity + $request->quantity;
        $product->save();

        //新增商品存貨Log
        $ProductLog = ProductLogEloquent::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'act' => 5,
            'amount' => $orig_quantity - $request->quantity
        ]);
        return $produce_product;
    }

    public function materialDelete($id)
    {
        $produce_detail = $this->getOne($id);
        if ($produce_detail) {
            $material = MaterialEloquent::find($produce_detail->material_id);
            if ($material) {
                $orig_quantity = $produce_detail->quantity;
                $new_quantity = $material->stock + $orig_quantity;
                $produce_detail->delete();

                //更改原料存量
                $material->stock = $new_quantity;
                // 原物料低於安全庫存量
                if ($material->stock < $material->safeQuantity) {
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
            } else {
                return 'Material Not Found';
            }
        } else {
            return 'produceDetail Not Found';
        }
    }

    public function productDelete($id)
    {
        $produce_product = ProduceProductEloquent::find($id);

        if ($produce_product) {
            $orig_quantity = $produce_product->quantity;
            $product = ProductEloquent::find($produce_product->product_id);
            if ($product) {
                // 更改商品存貨量
                $product->quantity = $product->quantity - $produce_product->quantity;
                $product->save();
            } else {
                return "Product Not Found";
            }
        } else {
            return "Produce Not Found";
        }

        if ($produce_product && $product) {
            //新增商品存貨Log
            $ProductLog = ProductLogEloquent::create([
                'user_id' => Auth::id(),
                'product_id' => $produce_product->product_id,
                'act' => 6,
                'amount' => (-1) * $orig_quantity
            ]);
            $produce_product->delete();
        } else {
            return "Failed";
        }
    }
}
