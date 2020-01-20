<?php

namespace App\Http\Controllers;
use App\Services\Product_logService;
use App\Services\Material_logService;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public $Product_logService;
    public $Material_logService;
    

    public function __construct()
    {
        $this->middleware('auth');
        $this->Product_logService = new Product_logService();
        $this->Material_logService = new Material_logService();
    }

    public function index()
    {
        $product_log = $this->Product_logService->getList();
        $material_log = $this->Material_logService->getList();
        return view('logs.index', compact('product_log', 'material_log'));
    }
}
