<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Product;

class TagController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('job.title:4,3')->except([
            'index',
            'show'
        ]);
    }

    /**
     * 取得所有標籤列表
     */
    public function index(Request $request)
    {
        $tags = Tag::withCount('products')->orderBy('name')->get();
        
        return response()->json([
            'status' => 'OK',
            'tags' => $tags
        ], 200);
    }

    /**
     * 建立新標籤
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name'
        ]);

        $tag = Tag::create([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'OK',
            'message' => '標籤建立成功',
            'tag' => $tag
        ], 201);
    }

    /**
     * 取得單一標籤資訊
     */
    public function show($id)
    {
        $tag = Tag::with('products')->findOrFail($id);
        
        return response()->json([
            'status' => 'OK',
            'tag' => $tag
        ], 200);
    }

    /**
     * 更新標籤
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $id
        ]);

        $tag->update([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'OK',
            'message' => '標籤更新成功',
            'tag' => $tag
        ], 200);
    }

    /**
     * 刪除標籤
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        
        // 刪除與商品的關聯
        $tag->products()->detach();
        
        // 刪除標籤
        $tag->delete();

        return response()->json([
            'status' => 'OK',
            'message' => '標籤刪除成功'
        ], 200);
    }

    /**
     * 取得標籤名稱列表（用於下拉選單）
     */
    public function showName()
    {
        $tags = Tag::select('id', 'name')->orderBy('name')->get();
        return response()->json($tags, 200);
    }
}
