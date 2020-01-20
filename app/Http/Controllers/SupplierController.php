<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;
use App\Services\SupplierService;
use App\Supplier as SupplierEloquent;

class SupplierController extends Controller
{
    public $SupplierService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->SupplierService = new SupplierService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = $this->SupplierService->getList();
        $lastUpdate = $this->SupplierService->getlastupdate();
        return view('suppliers.index', compact('suppliers', 'lastUpdate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $supplier = $this->SupplierService->add($request);
        return redirect()->route('suppliers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = $this->SupplierService->getOne($id);
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = $this->SupplierService->getOne($id);
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SupplierRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $id)
    {
        $supplier = $this->SupplierService->update($request, $id);
        return redirect()->route('suppliers.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->SupplierService->delete($id);
        return redirect()->route('suppliers.index');
    }

    // ========== Response JSON ==========
    public function showName(){
        $supplier = $this->SupplierService->getNamesList();
        return response()->json($supplier, 200);
    }


    public function getInfo(Request $request){
        $supplier_info = $this->SupplierService->getInfoList($request->id);
        return response()->json($supplier_info, 200);
    }
}
