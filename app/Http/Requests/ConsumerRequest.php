<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsumerRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){   

        $account_type = $this->request->get('account_type');

        if($account_type == 'individual'){
            $rules = [
                'account_type' => 'bail|required|string|in:individual',
    
                'individual_account' => 'required|string|min:6|max:30|unique:consumers,account',
                'individual_password' => 'required|string|min:6|max:30|confirmed',
    
                'individual_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'individual_idNumber' => 'required|string|size:10|tw_id',
                'individual_name' => 'required|string|min:2|max:255',
                'individual_shortName' => 'nullable|string|min:1|max:255',
                'individual_gender' => 'required|integer|min:0|max:2',
                'individual_birthday' => 'nullable|date',
                'individual_monthlyCheckDate' => 'nullable|integer|min:0|max:31',
                'individual_uncheckedAmount' => 'required|numeric',
                'individual_totalConsumption' => 'required|numeric',
                'individual_comment' => 'nullable|string|max:255',
    
                'individual_phone' => 'required_without:individual_tel|nullable|string|size:10',
                'individual_tel' => 'required_without:individual_phone|nullable|string|max:10',
                'individual_email' => 'required|string|email|max:255|unique:consumers,email',
                'individual_lineID' => 'nullable|string|max:255',
                'individual_address_zipcode' => 'required|string|size:3',
                'individual_address_county' => 'required|string|max:10',
                'individual_address_district' => 'required|string|max:10',
                'individual_address_others' => 'required|string|max:255',
            
            ];
        }else if($account_type == 'company'){
            $rules = [
                'account_type' => 'bail|required|string|in:company',

                'company_account' => 'required|string|min:6|max:30|unique:consumers,account',
                'company_password' => 'required|string|min:6|max:30|confirmed',

                'company_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'company_name' => 'required|string|min:2|max:255',
                'company_branch' => 'nullable|string|max:10',
                'company_shortName' => 'nullable|string|min:1|max:255',
                'company_taxID' => 'required|max:8|string|unique:consumers,taxID',
                'company_principal' => 'required|string|min:2|max:255',
                'company_idNumber' => 'nullable|string|size:10|tw_id',
                'company_monthlyCheckDate' => 'nullable|integer|min:0|max:31',
                'company_uncheckedAmount' => 'required|numeric',
                'company_totalConsumption' => 'required|numeric',
                'company_comment' => 'nullable|string|max:255',

                'company_tel' => 'nullable|string|max:10',
                'company_tax' => 'nullable|string|max:10',
                'company_email' => 'nullable|string|email|max:255',
                'company_lineID' => 'nullable|string|max:255',

                'company_operator_name' => 'required|string|min:2|max:255',
                'company_operator_tel' => 'required_without:company_operator_phone|nullable|string|max:10',
                'company_operator_phone' => 'required_without:company_operator_tel|nullable|string|size:10',
                'company_operator_email' => 'nullable|string|email|max:255',
                'company_operator_gender' => 'required|integer|min:0|max:2',

                'company_address_zipcode' => 'required|string|size:3',
                'company_address_county' => 'required|string|max:10',
                'company_address_district' => 'required|string|max:10',
                'company_address_others' => 'required|string|max:255',

                'company_deliveryAddress_zipcode' => 'required|string|size:3',
                'company_deliveryAddress_county' => 'required|string|max:10',
                'company_deliveryAddress_district' => 'required|string|max:10',
                'company_deliveryAddress_others' => 'required|string|max:255',
            ];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'account_type' => '帳號類型',
            'individual_account' => '帳號',
            'individual_password' => '密碼',
            'individual_picture' => '大頭貼',
            'individual_idNumber' => '身分證',
            'individual_name' => '姓名',
            'individual_shortName' => '簡稱',
            'individual_gender' => '性別',
            'individual_birthday' => '生日',
            'individual_monthlyCheckDate' => '月結日',
            'individual_uncheckedAmount' => '未沖帳帳款',
            'individual_totalConsumption' => '總消費額',
            'individual_comment' => '備註',
            'individual_phone' => '手機',
            'individual_tel' => '電話',
            'individual_email' => '信箱',
            'individual_lineID' => 'Line ID',
            'individual_address_zipcode' => '郵遞區號',
            'individual_address_county' => '縣市',
            'individual_address_district' => '鄉鎮市區',
            'individual_address_others' => '巷弄路段',
        ];
    }

    public function messages(){
        return [
            'individual_phone.required_without' => '手機與電話必須擇一必填。',
            'individual_tel.required_without'  => '手機與電話必須擇一必填。',
            'individual_idNumber.tw_id' => '身分證驗證錯誤。',
        ];
    }
}
