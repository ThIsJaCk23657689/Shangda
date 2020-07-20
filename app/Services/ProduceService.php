<?php

namespace App\Services;

use App\Produce as ProduceEloquent;
use App\ProduceDetail as ProduceDetailEloquent;
use App\ProduceProduct as ProduceProductEloquent;
use App\Services\ProduceDetailService;
use Auth;

class ProduceService extends BaseService
{
    public $ProduceDetailService;

    public function __construct(){
        $this->ProduceDetailService = new ProduceDetailService();
    }

    public function add($request)
    {
        $produce = ProduceEloquent::create([
            'user_id' => Auth::id(),
            'last_user_id' => Auth::id()
        ]);

        if($produce){
            return [
                'produce_id' => $produce->id,
                'massenge' => '編號' . $produce->id . '建立成功。',
                'status' => 200
            ];
        }else{
            return [
                'massenge' => '商品庫存新增失敗，請稍後再試。',
                'status' => 422
            ];
        }
    }

    public function getList()
    {
        $produces = ProduceEloquent::get();
        return $produces;
    }

    public function getOne($id)
    {
        $produce = ProduceEloquent::find($id);
        return $produce;
    }

    public function update($request, $id)
    {
        $produce = $this->getOne($id);
        if($produce){
            $produce->update([
                'last_user_id' => Auth::id()
            ]);
            return [
                'status' => 200, 
                'produce_id' => $id,
                'message' => '修改成功', 
            ];
        }else{
            return [
                'status'=> 422, 
                'produce_id' => $id,
                'message'=> "查無此資料，無法修改！",
            ];
        }
    }

    public function delete($id)
    {
        $produce = $this->getOne($id);
        $result = $this->ProduceDetailService->delete($id);
        if(!$result){
            return [
                'status' => 422, 
                'produce_id' => $id,
                'message'=> '商品庫存細項刪除失敗！',
            ];
        }
        $produce->delete();
        return [
            'status' => 200, 
            'message' => '商品庫存刪除成功！', 
        ];
    }

    public function getlastupdate()
    {
        $produce = ProduceEloquent::orderBy('id', 'DESC')->first();
        if(!empty($produce)){
            return $produce->updated_at;
        }
        return null;
    }
}
