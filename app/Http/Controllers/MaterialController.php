<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MaterialRequest;
use App\Services\MaterialService;

class MaterialController extends Controller
{

    public $materialService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->materialService = new MaterialService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = $this->materialService->getList();
        $lastUpdate = $this->materialService->getlastupdate();
        return view('materials.index', compact('materials', 'lastUpdate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialRequest $request)
    {
        $material = $this->materialService->add($request);
        return redirect()->route('materials.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = $this->materialService->getOne($id);
        return view('materials.show',compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = $this->materialService->getOne($id);
        return view('materials.edit',compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialRequest $request, $id)
    {
        $material = $this->materialService->update($request, $id);
        return redirect()->route('materials.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->materialService->delete($id);
        return redirect()->route('materials.index');
    }

    // ========== Response JSON ==========
    public function showName(){
        $materials = $this->materialService->getNamesList();
        return response()->json($materials, 200);
    }

    public function getInfo(Request $request){
        $material_info = $this->materialService->getInfoList($request->id);
        return response()->json($material_info, 200);
    }
}
