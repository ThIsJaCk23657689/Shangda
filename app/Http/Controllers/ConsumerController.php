<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consumer as ConsumerEloquent;

class ConsumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumers = ConsumerEloquent::all();
        return view('consumers.index', compact('consumers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consumers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'discount_id' => 'required',
            'name' => 'required|max:100|string',
            'shortName' => 'max:100|string',
            'act' => 'required|max:30|unique:consumers|string',
            'pwd' => 'required|string|min:8|confirmed',
            'taxId' => 'max:8|string',
            'idNumber' => 'max:10|string',
            
            'inCharge1' => 'required|max:50|string',
            'tel1' => 'required|max:25|string',
            'email1' => 'max:100|string',
            'inCharge2' => 'max:50|string',
            'tel2' => 'max:25|string',
            'email2' => 'max:100|string',
            'tax' => 'max:25|string',

            'monthlyCheckDate' => 'min:1|max:31|integer',
            'uncheckedAmount' => 'min:0|numeric',
            'totalConsumption' => 'min:0|numeric',
            'comment' => 'string',
            'companyAddress' => 'required|max:255|string',
            'deliveryAddress' => 'required|max:255|string',
            'invoiceAddress' => 'required|max:255|string',
        ]);

        ConsumerEloquent::create($request);
        return redirect()->route('consumers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consumers = ConsumerEloquent::find($id);

        return view('consumers.show', compact('consumers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consumers = ConsumerEloquent::find($id);

        return view('consumers.edit', compact('consumers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'discount_id' => 'required',
            'name' => 'required|max:100|string',
            'shortName' => 'max:100|string',
            'act' => 'required|max:30|unique:consumers|string',
            'pwd' => 'required|string|min:8|confirmed',
            'taxId' => 'max:8|string',
            'idNumber' => 'max:10|string',
            
            'inCharge1' => 'required|max:50|string',
            'tel1' => 'required|max:25|string',
            'email1' => 'max:100|string',
            'inCharge2' => 'max:50|string',
            'tel2' => 'max:25|string',
            'email2' => 'max:100|string',
            'tax' => 'max:25|string',

            'monthlyCheckDate' => 'min:1|max:31|integer',
            'uncheckedAmount' => 'min:0|numeric',
            'totalConsumption' => 'min:0|numeric',
            'comment' => 'string',
            'companyAddress' => 'required|max:255|string',
            'deliveryAddress' => 'required|max:255|string',
            'invoiceAddress' => 'required|max:255|string',
        ]);
        $consumers = ConsumerEloquent::find($id);

        $consumers->update($consumers);

        return redirect()->route('consumers.show',[$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consumers = ConsumerEloquent::find($id);
        $consumers->delete();

        return redirect()->route('consumers.index');
    }
}
