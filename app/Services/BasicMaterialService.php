<?php

namespace App\Services;
use App\BasicMaterial as BasicMaterialEloquent;


class BasicMaterialService extends BaseService
{

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

}
