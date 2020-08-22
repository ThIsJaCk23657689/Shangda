<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact as ContactEloquent;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = ContactEloquent::get();
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|integer|exists:products,id', 
            'name' => 'required|string|max:255', 
            'phone' => 'required|string|max:20', 
            'gender' => 'required|boolean',
            'email' => 'nullable|email', 
            'lineID' => 'nullable|string|max:255', 
            'comment' => 'nullable|string|max:255',
        ]);

        $contact = ContactEloquent::create([
            'product_id' => $request->product_id, 
            'name' => $request->name, 
            'phone' => $request->phone, 
            'gender' => $request->gender,
            'email' => $request->email, 
            'lineID' => $request->lineID, 
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => '感謝您留下聯絡資訊，我們將盡速跟您聯繫！'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
