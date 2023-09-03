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

        $account = $request->company_account ?? '';
        $password = $request->company_password ?? '';
        $email = $request->company_email ?? '';

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
                'uncheckedAmount' => $request->individual_uncheckedAmount ?? 0,
                'totalConsumption' => $request->individual_totalConsumption ?? 0,
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

                'account' => $account,
                'password' => bcrypt($password),

                'name' => $request->company_name,
                'branch' => $request->company_branch,
                'shortName' => $request->company_shortName,
                'taxID' => $request->company_taxID,
                'principal' => $request->company_principal,
                // 'idNumber' => strtoupper($request->company_idNumber),
                'monthlyCheckDate' => $request->company_monthlyCheckDate ?? 0,
                'uncheckedAmount' => $request->company_uncheckedAmount ?? 0,
                'totalConsumption' => $request->company_totalConsumption ?? 0,
                'policy_agreement' => '1',
                'comment' => $request->company_comment,

                'tel' => $request->company_tel,
                'tax' => $request->company_tax,
                'email' => $email,
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
            'message' => '新增顧客成功！',
            'consumer' => $consumer
        ];
    }

     public function getListNoFilter()
     {
         $consumers = ConsumerEloquent::withTrashed()->get();
         return $consumers;
     }

    // category: 0全部、1個人帳號、2公司帳號、3管理者創建、4顧客創建
    // status: 0全部、1已封鎖、2未封鎖
    // type: 0全部 1帳號 2名稱 3統編 4聯絡人名稱 5聯絡人電話
    // orderby: 1.建立日期(舊->新) 2.建立日期(新->舊) 3.更新日期(舊->新) 4.更新日期(新->舊)
    public function getList($request){
        if($request->first_page){
            $skip = 0;
        }else{
            $skip = $request->skip ?? 0 ;
        }

        $take = $request->take ?? 10;

        $category = $request->category ?? 0; // default 0
        $status = $request->status ?? 0; // default 0
        $type = $request->type ?? 0; // default 0
        $keywords = ($request->keywords != "") ? explode(" ", $request->keywords) : [];
        $orderby = $request->orderby ?? 4; // default 4
        $type_arr = [
            '', 'account', 'name', 'taxID', 'operator_name_1', 'operator_tel_1',
        ];

        if($keywords == [] && $status== 0 && $category == 0 && $type== 0 && $orderby == 4){
            // all default
            $consumers_tmp = new ConsumerEloquent();
            $count = $consumers_tmp->count();
            $consumers = $consumers_tmp->orderBy('updated_at', 'desc')->withTrashed()->skip($skip)->take($take)->get();
        }else{

            $consumers_tmp = ConsumerEloquent::query()->where(function ($query) use ($keywords, $status, $category, $type, $type_arr) {
                $c = 0;
                if($type != 0 && $keywords != []){
                    foreach ($keywords as $keyword) {
                        $keyword = '%'.$keyword.'%';
                        if($c == 0){
                            $query->where($type_arr[$type], 'like', $keyword);
                            $c++;
                        }else{
                            $query->orWhere($type_arr[$type], 'like', $keyword);
                        }
                    }
                }else if($keywords != []){
                    foreach ($keywords as $keyword) {
                        $keyword = '%'.$keyword.'%';
                        for($i = 1; $i <= 4; $i++){
                            if($c == 0){
                                $query->where($type_arr[$i], 'like', $keyword);
                                $c++;
                            }else{
                                $query->orWhere($type_arr[$i], 'like', $keyword);
                            }
                        }
                    }
                }
            });

            if($status == 0){
                $consumers_tmp->withTrashed();
            }else if($status == 1){
                $consumers_tmp->onlyTrashed();
            }else if($status == 2){
                $consumers_tmp->where('deleted_at', NULL);
            }

            if($category == 1){
                $consumers_tmp->where('account_type', 0);
            }else if($category == 2){
                $consumers_tmp->where('account_type', 1);
            }else if($category == 3){
                $consumers_tmp->where('who_created', 1);
            }else if($category == 4){
                $consumers_tmp->where('who_created', 0);
            }

            $count = $consumers_tmp->count();
            if($orderby == 1){
                // 建立時間 舊到新
                $consumers = $consumers_tmp->orderBy('created_at', 'asc')->skip($skip)->take($take)->get();
            }else if($orderby == 2){
                // 建立時間 新到舊
                $consumers = $consumers_tmp->orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
            }else if($orderby == 3){
                // 建立時間 舊到新
                $consumers = $consumers_tmp->orderBy('updated_at', 'asc')->skip($skip)->take($take)->get();
            }else if($orderby == 4){
                // 建立時間 新到舊
                $consumers = $consumers_tmp->orderBy('updated_at', 'desc')->skip($skip)->take($take)->get();
            }
        }

        // '', 'account', 'name', 'taxID', 'operator_name_1', 'operator_tel_1', 'uncheckedAmount'
        $c = 1;
        foreach($consumers as $consumer){
            $consumer['index'] = $skip + $c;
            $consumer['taxID'] = $consumer->taxID ?? '無';
            $consumer['operator_name_1'] = $consumer->operator_name_1 ?? '無';
            $consumer['operator_tel_1'] = $consumer->operator_tel_1 ?? '無';

            if($consumer->trashed()){
                // 已被封鎖
                $consumer['action'] =
                    '<a href="' . route('consumers.show', [$consumer->id]) . '" class="btn btn-md btn-info"><i class="fas fa-info-circle"></i></a>
                    <button type="button" class="btn btn-md btn-warning unlock-btn"><i class="fas fa-unlock"></i></button type="button">
                    <span class="d-none">' . route('consumers.destroy', [$consumer->id]) . '</span>';
            }else{
                $consumer['action'] =
                    '<a href="' . route('consumers.show', [$consumer->id]) . '" class="btn btn-md btn-info"><i class="fas fa-info-circle"></i></a>
                    <a href="' . route('consumers.edit', [$consumer->id]) . '" class="btn btn-md btn-success"><i class="fas fa-pencil-alt"></i></a>
                    <button type="button" class="btn btn-md btn-danger delete-btn"><i class="fas fa-user-slash"></i></button type="button">
                    <span class="d-none">' . route('consumers.destroy', [$consumer->id]) . '</span>';
            }

            $c++;
        }

        $result = [
            'consumers' => $consumers,
            'count' => $count
        ];

        return $result;
    }

    public function getOne($id)
    {
        $consumer = ConsumerEloquent::withTrashed()->findOrFail($id);
        return $consumer;
    }

    public function count()
    {
        return ConsumerEloquent::count();
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
        $consumer_info['address'] = $consumer_info->showAddress();
        $consumer_info['deliveryAddress'] = $consumer_info->showDeliveryAddress();
        return $consumer_info;
    }
}
