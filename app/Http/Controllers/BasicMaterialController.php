<?php

namespace App\Http\Controllers;

use App\Services\BasicMaterialService;
use App\Http\Requests\BasicMaterialRequest;
use Illuminate\Http\Request;

class BasicMaterialController extends Controller
{
    public $basic_material_service;
    
    public function __construct(){
        $this->middleware('auth');
        $this->basic_material_service = new BasicMaterialService();
    }

    public function index(){
        return view('materials.basic.index');
    }

    public function update(BasicMaterialRequest $request, $id){
        $basicMaterials = $this->basic_material_service->update($request, $id);
        return response()->json($basicMaterials, 200);
    }

    // ========== Response JSON ==========
    public function getList(){
        $basicMaterials = $this->basic_material_service->getList();
        return response()->json($basicMaterials, 200);
    }
}
