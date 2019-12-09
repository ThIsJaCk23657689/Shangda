<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier as SupplierEloquent;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = SupplierEloquent::all();
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
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
            'name' => 'required|max:100|string',
            'tel' => 'max:25|string',
            'taxId' => 'max:8|string',
            'shortName' => 'max:100|string',
            'inCharge1' => 'required|max:50|string',
            'tel1' => 'required|max:25|string',
            'email1' => 'max:100|email',
            'inCharge2' => 'max:50|string',
            'tel2' => 'max:25|string',
            'email2' => 'max:100|email',
            'tax' => 'max:25|string',
            'comment' => 'string',
            'companyAddress' => 'required|max:255|string',
            'deliveryAddress' => 'required|max:255|string',
            'invoiceAddress' => 'required|max:255|string',
        ]);
        SupplierEloquent::create($request);
        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = SupplierEloquent::find($id);

        return view('supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = SupplierEloquent::find($id);

        return view('supplier.edit', compact('supplier'));
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
            'name' => 'required|max:100|string',
            'tel' => 'max:25|string',
            'taxId' => 'max:8|string',
            'shortName' => 'max:100|string',
            'inCharge1' => 'required|max:50|string',
            'tel1' => 'required|max:25|string',
            'email1' => 'max:100|email',
            'inCharge2' => 'max:50|string',
            'tel2' => 'max:25|string',
            'email2' => 'max:100|email',
            'tax' => 'max:25|string',
            'comment' => 'max:255|string',
        ]);
        $supplier = SupplierEloquent::find($id);

        $supplier->update($supplier);

        return redirect()->route('supplier.show',[$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = SupplierEloquent::find($id);
        $supplier->delete();

        return redirect()->route('supplier.index');
    }
}
