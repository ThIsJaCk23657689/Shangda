<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
// use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $CategoryService;

    public function __construct()
    {
        $this->middleware(['auth', 'job.title:4,3']);
        $this->CategoryService = new CategoryService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->CategoryService->getList();
        return view('categories.index', compact('categories'));
    }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('categories.create');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(CategoryRequest $request)
     {
         $category = $this->CategoryService->add($request);
         return redirect()->route('categories.index');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->CategoryService->getOne($id);
        return view('categories.show', compact('category'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $category = $this->CategoryService->getOne($id);
    //     return view('categories.edit', compact('category'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(CategoryRequest $request, $id)
    // {
    //     $category = $this->CategoryService->update($request, $id);
    //     return redirect()->route('categories.show', [$id]);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     if($id != 1){
    //         $category = $this->CategoryService->getOne($id);
    //         $products = $category->products;
    //         foreach($products as $product){
    //             $product->category_id = 1;
    //             $product->save();
    //         }
    //         $this->CategoryService->delete($id);
    //         return redirect()->route('categories.index');
    //     }
    //     return response()->json([
    //         'msg' => '此類別禁止刪除。(This category can not be deleted.)'
    //     ]);
    // }

    // ========== Response JSON ==========
    public function showName(){
        $categories = $this->CategoryService->getNamesList();
        return response()->json($categories, 200);
    }
}
