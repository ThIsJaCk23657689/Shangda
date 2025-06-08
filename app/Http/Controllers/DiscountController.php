<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\ConsumerService;

class DiscountController extends Controller
{

    public $ProductService;
    public $ConsumerService;

    public function __construct()
    {
        $this->middleware(['auth', 'job.title:4,3']);
        $this->ProductService = new ProductService();
        $this->ConsumerService = new ConsumerService();
    }

    public function index(){
        $products = $this->ProductService->getList();
        $consumers = $this->ConsumerService->getListNoFilter();
        return view('discounts.index', compact('products', 'consumers'));
    }
}
