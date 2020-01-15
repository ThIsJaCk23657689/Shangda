<?php

namespace App\Services;
use App\Consumer as ConsumerEloquent;
use Carbon\Carbon;

class ConsumerService extends BaseService
{
    public function add($request)
    {
        $consumer = ConsumerEloquent::create([
            'discount_id' => $request->discount_id,
            'name' => $request->name,
            'shortName' => $request->shortName,
            'act' => $request->act,
            'pwd' => bcrypt($request->pwd),
            'taxId' => $request->taxId,
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
            'deliveryAddress' => $request->name,
        ]);
        
        return $consumer;
    }

    public function getList()
    {
        $consumers = ConsumerEloquent::get();
        return $consumers;
    }

    public function getOne($id)
    {
        $consumer = ConsumerEloquent::find($id);
        return $consumer;
    }

    public function update($request, $id)
    {
        $consumer = $this->getOne($id);
        $consumer->update([
            'name' => $request->name,
            'shortName' => $request->shortName,
            'act' => $request->act,
            'pwd' => bcrypt($request->pwd),
            'taxId' => $request->taxId,
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
            'deliveryAddress' => $request->name,
        ]);
        
        return $consumer;
    }

    public function delete($id)
    {
        $consumer = $this->getOne($id);
        $consumer->delete();
    }

    public function getlastupdate()
    {
        $consumer = ConsumerEloquent::orderBy('id', 'DESC')->first();
        return $consumer->updated_at;
    }
}