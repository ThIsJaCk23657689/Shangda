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
        $category->update([
            'name' => $request->name,
            'intro' => $request->intro,
        ]);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->getOne($id);
        $category->delete();
    }
}
