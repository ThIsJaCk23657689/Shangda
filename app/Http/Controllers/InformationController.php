<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InformationService;

class InformationController extends Controller
{
    public $InformationService;

    public function __construct(){
        $this->middleware('auth');
        $this->InformationService = new InformationService();
    }

    public function edit($id){
        $information = $this->InformationService->getOne($id);
        return view('information.edit', compact('information'));
    }

    public function update(Request $request, $id=1){
        $result = $this->InformationService->update($request, $id);
        return response()->json($result, $result['status']);
    }

    public function getOne($id){
        $information = $this->InformationService->getOne($id);
        $information->showCoverImage = $information->showCoverImage();
        return response()->json([
            'status' => 'OK',
            'information' => $information
        ]);
    }

}
