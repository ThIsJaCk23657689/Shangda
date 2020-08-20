<?php

namespace App\Http\Controllers\Auth\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Services\ConsumerService;
use App\Events\ConsumerRegisteredEvent;
use Illuminate\Http\Request;
use Validator;
use Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';
    public $ConsumerService;

    public function __construct(){
        $this->middleware('guest:api');
        $this->ConsumerService = new ConsumerService();
    }

    public function showRegistrationForm(){
        return view('frontend.consumers.auth.register');
    }

    public function register(Request $request){

        // 驗證資料
        $validator = Validator::make($request->all(), $this->generateRules($request));
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        // 新增顧客資料
        $consumer = $this->ConsumerService->add($request);

        // 發送事件
        event(new ConsumerRegisteredEvent($consumer));

        // 登入
        $token = $this->guard()->login($consumer);
        $cookie_token = 'Bearer ' . $token;

        return response()->json([
            'status' => 1,
            'msg' => 'Login Successfully',
            'token' => $token
        ])->cookie('authorization', $cookie_token, 200);
    }

    protected function generateRules(Request $request){
        $rules = [];
        $account_type = $request->account_type;

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
                'company_email' => 'required|string|email|max:255|unique:consumers,email',
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

    protected function guard(){
        return Auth::guard('api');
    }
}
