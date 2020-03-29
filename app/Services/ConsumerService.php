<?php

namespace App\Services;

use App\Consumer as ConsumerEloquent;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConsumerService extends BaseService
{
    public function add(Request $request)
    {
        $data = [];
        if($request->account_type == 'individual'){
            $data = [
                'account_type' => 0,
                'who_created' => 1,

                'account' => $request->individual_account,
                'password' => bcrypt($request->individual_password),

                'idNumber' => strtoupper($request->individual_idNumber),
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

                'operator_name' => $request->company_operator_name,
                'operator_tel' => $request->company_operator_tel,
                'phone' => $request->company_operator_phone,
                'operator_email' => $request->company_operator_email,
                'gender' => $request->company_operator_gender,
                
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

        // 圖片儲存
        if($request->has('company_picture')){
            $this->savePicture($request->company_picture, $consumer);
        }
        
        return $consumer;
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

    public function update($request, $id)
    {
        $consumer = $this->getOne($id);
        $consumer->update([
            'name' => $request->name,
            'shortName' => $request->shortName,
            'taxID' => $request->taxID,
            'idNumber' => $request->idNumber,
            'inCharge1' => $request->inCharge1,
            'tel1' => $request->tel1,
            'email1' => $request->email1,
            'inCharge2' => $request->inCharge2,
            'tel2' => $request->tel2,
            'email2' => $request->email2,
            'tax' => $request->tax,
            'monthlyCheckDate' => $request->monthlyCheckDate,
            'uncheckedAmount' => $request->uncheckedAmount,
            'totalConsumption' => $request->totalConsumption,
            'comment' => $request->comment,
            'companyAddress' => $request->companyAddress,
            'deliveryAddress' => $request->deliveryAddress,
            'invoiceAddress' => $request->invoiceAddress,
        ]);

        return $consumer;
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

    // 儲存顧客頭貼
    private function savePicture($picture, $consumer){
        if(!empty($picture)){
            $ext = strtolower($picture->getClientOriginalExtension());
            switch($ext){
                case 'jpg':
                    $origin_picture = imagecreatefromjpeg($picture);
                    break;
                case 'png':
                    $origin_picture = imagecreatefrompng($picture);
                    break;
                case 'bmp':
                    $origin_picture = imagecreatefrombmp($picture);
                    break;
                default:
                    $origin_picture = imagecreatefromjpeg($picture);
                    break;
            }

            $picture_name = $consumer->id;
            $picture_full_name = $picture_name . '.' . $ext;

            $save_path = public_path('images/consumers/');
            switch($ext){
                case 'jpg':
                    imagejpeg($origin_picture, $save_path . $picture_full_name);
                    break;
                case 'png':
                    $background = imagecolorallocate($origin_picture, 0, 0, 0);
                    imagecolortransparent($origin_picture, $background);
                    imagealphablending($origin_picture, false);
                    imagesavealpha($origin_picture, true);
                    imagepng($origin_picture, $save_path . $picture_full_name);
                    break;
                case 'bmp':
                    imagebmp($origin_picture, $save_path . $picture_full_name);
                    break;
                default:
                    imagejpeg($origin_picture, $save_path . $picture_full_name);
                    break;
            }
            $image_path = 'images/consumers/' . $picture_full_name;

            $consumer->picture()->create([
                'url' => $image_path,
                'index' => 1
            ]);
        }
    }
}
