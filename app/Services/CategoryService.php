<?php

namespace App\Services;
use App\Category as CategoryEloquent;
use Carbon\Carbon;

class CategoryService extends BaseService
{
    public function add($request)
    {
        $category = CategoryEloquent::create([
            'name' => $request->name,
            'intro' => $request->intro,
        ]);

        return $category;
    }

    public function getList()
    {
        $categories = CategoryEloquent::get();
        return $categories;
    }

    public function getOne($id)
    {
        $category = CategoryEloquent::find($id);
        return $category;
    }

    public function update($request, $id)
    {
        $category = $this->getOne($id);
        if($id != 1){
            $category->name = $request->name;
        }
        $category->intro = $request->intro;
        $category->save();
        return $category;
    }

    public function delete($id)
    {
        $category = $this->getOne($id);
        $category->delete();
    }

    public function getNamesList(){
        $category_names = MaterialEloquent::select('id','name')->get();
        return $category_names;
    }
}
