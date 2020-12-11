<?php

namespace App\Services;

use App\Consumer as ConsumerEloquent;
use App\SalesOrder as SalesOrderEloquent;
use App\Services\CartService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConsumerService extends BaseService
{
    public $CartService;

    public function __construct(){
        $this->CartService = new CartService();
    }

    public function add($request)
    {
        if(!is_null($request->image_data) && !is_null($_FILES['image_file'])){
            // 圖片路徑生成與裁切
            $crop = new CropImageService($request->image_data, $_FILES['image_file'], 'consumers', 'avatars');
            $result = $crop->getResult();
            if($result['status'] == 'ERROR'){
                return [
                    'status' => '422',
                    'message' => $result['message']
                ];
            }else{
                $url = $result['url'];
            }
        }else{
            // 沒有要存圖片
            $url = null;
        }

        $data = [];
        if($request->account_type == 'individual'){
            $data = [
                'account_type' => 0,
                'who_created' => 1,

                'account' => $request->individual_account,
                'password' => bcrypt($request->individual_password),

                // 'idNumber' => strtoupper($request->individual_idNumber),
                'name' => $request->individual_name,
                'shortName' => $request->individual_shortName,
                'gender' => $request->individual_gender,
                'birthday' => $request->individual_birthday,
                'monthlyCheckDate' => $request->individual_monthlyCheckDate ?? 0,
                'uncheckedAmount' => $request->individual_uncheckedAmount,
                'totalConsumption' => $request->individual_totalConsumption,
                'policy_agreement' => '1',
                'comment' => $request->individual_comment,

                'phone' => $request->individual_phone,
                'tel' => $request->individual_tel,
                'email' => $request->individual_email,
                'lineID' => $request->individual_lineID,
                'address_zipcode' => $request->individual_address_zipcode,
                'address_county' => $request->individual_address_county,
                'address_district' => $request->individual_address_district,
                'address_others' => $request->individual_address_others,
            ];
        }else if($request->account_type == 'company'){
            $data = [
                'account_type' => 1,
                'who_created' => 1,

                'account' => $request->company_account,
                'password' => bcrypt($request->company_password),

                'name' => $request->company_name,
                'branch' => $request->company_branch,
                'shortName' => $request->company_shortName,
                'taxID' => $request->company_taxID,
                'principal' => $request->company_principal,
                // 'idNumber' => strtoupper($request->company_idNumber),
                'monthlyCheckDate' => $request->company_monthlyCheckDate ?? 0,
                'uncheckedAmount' => $request->company_uncheckedAmount,
                'totalConsumption' => $request->company_totalConsumption,
                'policy_agreement' => '1',
                'comment' => $request->company_comment,

                'tel' => $request->company_tel,
                'tax' => $request->company_tax,
                'email' => $request->company_email,
                'lineID' => $request->company_lineID,

                'operator_name_1' => $request->company_operator_name_1,
                'operator_tel_1' => $request->company_operator_tel_1,
                'operator_phone_1' => $request->company_operator_phone_1,
                'operator_email_1' => $request->company_operator_email_1,

                'operator_name_2' => $request->company_operator_name_2,
                'operator_tel_2' => $request->company_operator_tel_2,
                'operator_phone_2' => $request->company_operator_phone_2,
                'operator_email_2' => $request->company_operator_email_2,

                'gender' => null,

                'address_zipcode' => $request->company_address_zipcode,
                'address_county' => $request->company_address_county,
                'address_district' => $request->company_address_district,
                'address_others' => $request->company_address_others,

                'deliveryAddress_zipcode' => $request->company_deliveryAddress_zipcode,
                'deliveryAddress_county' => $request->company_deliveryAddress_county,
                'deliveryAddress_district' => $request->company_deliveryAddress_district,
                'deliveryAddress_others' => $request->company_deliveryAddress_others,
            ];
        }

        $consumer = ConsumerEloquent::create($data);

        if(!$consumer){
            return [
                'status' => 422,
                'message' => '新增顧客時發生錯誤！'
            ];
        }

        // 建立客戶購物車
        $this->CartService->add($consumer->id);

        // 圖片儲存
        if(!is_null($url)){
            $consumer->picture()->create([
                'url' => $url,
                'index' => 1
            ]);
        }

        return [
            'status' => 200,
            'message' => '新增顧客成功！'
        ];
    }

    public function getList()
    {
        $consumers = ConsumerEloquent::withTrashed()->get();
        return $consumers;
    }

    public function getOne($id)
    {
        $consumer = ConsumerEloquent::withTrashed()->findOrFail($id);
        return $consumer;
    }

    public function getSaleOrdersFrontend($request)
    {
        if($request->firstPage == 1){
            // 強制從第一頁開始。
            $skip = 0;
        }else{
            // 看從第幾頁開始。
            $skip = $request->skip ?? 0 ;
        }

        $take = 5;
        $status = $request->status ?? 0;

        $sale_orders = $this->getOne($request->consumer_id)->saleOrder()->ofStatus($status);
        $count = $sale_orders->count();
        $sale_orders = $sale_orders->skip($skip)->take($take)->get();

        foreach($sale_orders as $sale_order){
            $sale_order->showSaleOrderStatus = $sale_order->showSaleOrderStatus();
            $sale_order->showDeliverAtDate = $sale_order->showDeliverAtDate();
            $sale_order->showPaidAtDate = $sale_order->showPaidAtDate();
            $sale_order->showURL = route('consumer.showSaleOrderDetails', ['consumer_id' => $sale_order->consumer_id, 'sale_orders_id' => $sale_order->id]);
        }

        return [
            'sale_orders' => $sale_orders,
            'count' => $count
        ];
    }

    public function getSaleOrderDetails($sale_orders_id)
    {
        $details = SalesOrderEloquent::findOrFail($sale_orders_id)->details;
        return $details;
    }

    public function update($request, $id)
    {
        $consumer = $this->getOne($id);

        if(!is_null($request->image_data) && !is_null($_FILES['image_file'])){
            // 圖片路徑生成與裁切
            $crop = new CropImageService($request->image_data, $_FILES['image_file'], 'consumers', 'avatars');
            $result = $crop->getResult();
            if($result['status'] == 'ERROR'){
                return [
                    'status' => '422',
                    'message' => $result['message']
                ];
            }else{
                $url = $result['url'];
            }
        }else{
            // 沒有要存圖片
            $url = null;
        }

        $data = [];
        if($request->account_type == 'individual'){
            $data = [
                'name' => $request->individual_name,
                'shortName' => $request->individual_shortName,
                'gender' => $request->individual_gender,
                'birthday' => $request->individual_birthday,
                'monthlyCheckDate' => $request->individual_monthlyCheckDate ?? 0,
                'uncheckedAmount' => $request->individual_uncheckedAmount,
                'totalConsumption' => $request->individual_totalConsumption,
                'policy_agreement' => '1',
                'comment' => $request->individual_comment,

                'phone' => $request->individual_phone,
                'tel' => $request->individual_tel,
                'lineID' => $request->individual_lineID,
                'address_zipcode' => $request->individual_address_zipcode,
                'address_county' => $request->individual_address_county,
                'address_district' => $request->individual_address_district,
                'address_others' => $request->individual_address_others,
            ];
        }else if($request->account_type == 'company'){
            $data = [
                'name' => $request->company_name,
                'branch' => $request->company_branch,
                'shortName' => $request->company_shortName,
                'taxID' => $request->company_taxID,
                'principal' => $request->company_principal,
                'monthlyCheckDate' => $request->company_monthlyCheckDate ?? 0,
                'uncheckedAmount' => $request->company_uncheckedAmount,
                'totalConsumption' => $request->company_totalConsumption,
                'policy_agreement' => '1',
                'comment' => $request->company_comment,

                'tel' => $request->company_tel,
                'tax' => $request->company_tax,
                'lineID' => $request->company_lineID,

                'operator_name_1' => $request->company_operator_name_1,
                'operator_tel_1' => $request->company_operator_tel_1,
                'operator_phone_1' => $request->company_operator_phone_1,
                'operator_email_1' => $request->company_operator_email_1,

                'operator_name_2' => $request->company_operator_name_2,
                'operator_tel_2' => $request->company_operator_tel_2,
                'operator_phone_2' => $request->company_operator_phone_2,
                'operator_email_2' => $request->company_operator_email_2,

                'gender' => null,

                'address_zipcode' => $request->company_address_zipcode,
                'address_county' => $request->company_address_county,
                'address_district' => $request->company_address_district,
                'address_others' => $request->company_address_others,

                'deliveryAddress_zipcode' => $request->company_deliveryAddress_zipcode,
                'deliveryAddress_county' => $request->company_deliveryAddress_county,
                'deliveryAddress_district' => $request->company_deliveryAddress_district,
                'deliveryAddress_others' => $request->company_deliveryAddress_others,
            ];
        }

        $consumer->update($data);

        // 圖片更新
        if(!is_null($url)){
            $consumer->picture()->delete();
            $consumer->picture()->create([
                'url' => $url,
                'index' => 1
            ]);
        }

        return [
            'status' => 200,
            'message' => '編輯顧客資料成功！',
        ];
    }

    public function delete($id)
    {
        $consumer = $this->getOne($id);
        if($consumer->trashed()){
            $consumer->restore();
        }else{
            $consumer->delete();
        }
    }

    public function getlastupdate()
    {
        $consumer = ConsumerEloquent::withTrashed()->orderBy('id', 'DESC')->first();
        return $consumer->updated_at;
    }

    public function getNamesList(){
        $consumer_names = ConsumerEloquent::select('id', 'name')->get();
        return $consumer_names;
    }

    public function getInfoList($id){
        $consumer_info = ConsumerEloquent::find($id);
        return $consumer_info;
    }
}
