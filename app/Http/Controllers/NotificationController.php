<?php

namespace App\Http\Controllers;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public $NotificationService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->NotificationService = new NotificationService();
    }

    // 通知已讀
    public function read(Request $request){
        $msg = $this->NotificationService->read($request);
        return response()->json($msg, 200);
    }
}
