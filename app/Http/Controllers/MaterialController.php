<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material as MaterialEloquent;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('materials.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('material.create');
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
            'name' => 'required|max:255|string',
            'shortName' => 'max:100|string',
            'internationalNum' => 'max:25|string',
            'unit' => 'required|max:25|string',
            'unitPrice' => 'required|min:0',
            'comment' => 'max:255|string',
            'picture' => 'max:255|string',
            'stock' => 'required|min:0',
        ]);
        MaterialEloquent::create($request);

        return redirect()->route('material.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = MaterialEloquent::find($id);

        return view('material.show',compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('material.edit');
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
            'name' => 'required|max:255|string',
            'shortName' => 'max:100|string',
            'internationalNum' => 'max:25|string',
            'unit' => 'required|max:25|string',
            'unitPrice' => 'required|min:0|numeric',
            'comment' => 'max:255|string',
            'picture' => 'max:255|string',
            'stock' => 'required|min:0|numeric',
        ]);

        $material = MaterialEloquent::find($id);
        $material->update($request);
        return redirect()->route('material.edit',[$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = MaterialEloquent::find($id);
        $material->delete();

        return redirect()->route('material.index');
    }
}
