<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier as SupplierEloquent;
use App\User as UserEloquent;
use App\PurchaseOrderDetail as PurchaseOrderDetailEloquent;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class PurchaseOrder extends Model
{
    // use SoftDeletes;

    protected $fillable = [
        'supplier_id', 'user_id', 'paid_at', 'received_at', 'expectReceived_at', 'last_user_id',
        'totalPrice', 'comment', 'taxType', 'invoiceType', 'address', 'shown_id'
    ];

    protected $dates = ['paid_at', 'received_at', 'expectReceived_at'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format($this->dataFormat? : 'Y-m-d');
    }

    public function supplier(){
        return $this->belongsTo(SupplierEloquent::class);
    }

    // 顯示創建者
    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }

    public function details(){
        return $this->hasMany(PurchaseOrderDetailEloquent::class, 'purchaseOrder_id');
    }

    public function showTaxType(){
        return (config('shangda.tax.' . $this->taxType)) ?? '未知編號：'. $this->taxType;
    }

    public function showInvoiceType(){
        return (config('shangda.invoice.' . $this->invoiceType)) ?? '未知編號：'. $this->invoiceType;
    }

    public function showBeforePrice(){
        if($this->taxType == 1){
            return round($this->totalPrice * 0.95, 4);
        }else{
            return $this->totalPrice;
        }
    }

    public function showTaxPrice(){
        if($this->taxType == 1){
            return round($this->totalPrice * 0.05, 4);
        }else{
            return 0;
        }
    }

    public function showExpectReceivedAtDate(){
        return is_null($this->expectReceived_at) ? '無' : $this->expectReceived_at->isoformat('Y-MM-DD');
    }

    public function showReceivedAtDate(){
        return is_null($this->received_at) ? '無' : $this->received_at->isoformat('Y-MM-DD');
    }

    public function showPaidAtDate(){
        return is_null($this->paid_at) ? '無' : $this->paid_at->isoformat('Y-MM-DD');
    }

    //顯示進貨單付款狀態
    public function showPaidStatus(){
        if($this->paid_at){
            return "已付清";
        }else{
            return "未付款";
        }
    }

    //顯示進貨單交貨狀態
    public function showReceivedStatus(){
        if($this->received_at){
            return "已到貨";
        }else{
            $date_now = Carbon::now();
            if($this->expectReceived_at->lt($date_now)){
                //代表預期到貨時間 比 現在時間來得早，所以已經過期了。
                return "逾期未到貨";
            }else{
                return "等待到貨中";
            }
        }
    }

    // 顯示最後更新者
    public function showLastUpdater(){
        $user = UserEloquent::find($this->last_user_id);
        if($user){
            return $user->name;
        }
        return '無';
    }

    // public function materials(){
    //     return $this->belongsToMany(MaterialEloquent::class)
    //     ->withPivot('price', 'quantity', 'subTotal', 'comment', 'discount');
    // }
}
