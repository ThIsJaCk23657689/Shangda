<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AnnouncementService;

class AnnouncementController extends Controller
{
    public $AnnouncementService;

    public function __construct()
    {
        $this->AnnouncementService = new AnnouncementService();
    }

    public function index(){
        return view('frontend.announcements.index');
    }

    public function list(Request $request){
        $this->validate($request, [
            'skip' => 'nullable| integer|',
        ]);

        $res = $this->AnnouncementService->getListFrontend($request);

        return response()->json([
            'status' => 'OK',
            'DataTotalCount' => $res['count'],
            'announcements' => $res['announcements'],
        ]);
    }

    public function show($id){
        $product = $this->AnnouncementService->getOne($id);
        return view('frontend.announcements.show', compact('product'));
    }
}
