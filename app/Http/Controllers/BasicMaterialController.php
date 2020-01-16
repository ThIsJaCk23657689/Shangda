<?php

namespace App\Http\Controllers;
use App\Services\BasicMaterialService;
use App\Request\BasicMaterialRequest;
use Illuminate\Http\Request;

class BasicMaterialController extends Controller
{
    public $BasicMaterialService;
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->BasicMaterialService = new BasicMaterialService();
    }


    public function show($id)
    {
        $basicMaterials = $this->BasicMaterialService->getList($id);
        return response()->json($basicMaterials, 200);
    }

    public function update(BasicMaterialRequest $request, $id)
    {
        $basicMaterials = $this->BasicMaterialsService->update($request, $id);
        return response()->json($basicMaterials, 200);
    }
}
