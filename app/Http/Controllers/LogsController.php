<?php

namespace App\Http\Controllers;

use App\Services\ProductLogService;
use App\Services\MaterialLogService;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public $ProductLogService;
    public $MaterialLogService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->ProductLogService = new ProductLogService();
        $this->MaterialLogService = new MaterialLogService();
    }

    public function index()
    {
        $product_log = $this->ProductLogService->getList();
        $material_log = $this->MaterialLogService->getList();
        return view('logs.index', compact('product_log', 'material_log'));
    }
}
