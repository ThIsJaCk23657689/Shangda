<?php

namespace App\Services;
use App\Consumer as ConsumerEloquent;
use Carbon\Carbon;

class ConsumerService extends BaseService
{
    public function add($request)
    {
        $consumer = ConsumerEloquent::create([
            // 'discount_id' => $request->discount_id,
            'name' => $request->name,
            'shortName' => $request->shortName,
            'act' => $request->act,
            'pwd' => bcrypt($request->pwd),
            'taxID' => $request->taxID,
            'idNumber' => strtoupper($request->idNumber),
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
}
