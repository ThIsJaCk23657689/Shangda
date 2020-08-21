<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'about', 'contact');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('index');
    }

    public function old(){
        return view('old');
    }

    public function backend(){
        return view('backend');
    }

    // 關於尚達頁面
    public function about(){
        return view('frontend.about');
    }

    // 聯絡我們頁面
    public function contact(){
        return view('frontend.contact');
    }
}
