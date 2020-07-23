<?php

namespace App\Services;
use App\Product as ProductEloquent;
use App\Material as MaterialEloquent;
use App\Category as CategoryEloquent;

class ProductService extends BaseService
{
    public function add($request){
        // 新增資料
        $product = ProductEloquent::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'isManualNamed' => $request->isManualNamed ?? '0',
            'shownID' => $request->shownID,
            'isManualID' => $request->isManualID ?? '0',
            'internationalNum' => $request->internationalNum,
            'specification' => $request->specification,
            'color' => $request->color,

            'isCustomize' => $request->isCustomize ?? '0',
            'isPublic' => $request->isPublic ?? '0',
            'showPrice' => $request->showPrice ?? '0',

            'length' => $request->length,
            'width' => $request->width,
            'chamfer' => $request->chamfer,
            'weight' => $request->weight,
            'qty_per_pack' => $request->qty_per_pack,
            'comment' => $request->comment,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'safeQuantity' => $request->safeQuantity,
            'intro' => $request->intro,
        ]);

        // 圖片儲存
        $this->savePicture($request->pictures, $product);

        // 計算成本價格
        $costprice = 0;
        foreach($request->recipes as $recipe){
            $material_id = $recipe['material_id'];
            $material = MaterialEloquent::find($material_id);
            $price = $material->unitPrice;
            $subcost = round($price * $recipe['raito'], 4);
            $costprice += $subcost;

            if($recipe['raito'] != 0){
                $product->materials()->attach($material_id, [
                    'ratio' => $recipe['raito'],
                    'subcost' => $subcost
                ]);
            }
        }

        // 更新商品價格
        $product->update([
            'costprice' => $costprice,
            'profit' => $request->profit,
            'retailPrice' => ($request->profit + $costprice),
        ]);

        return $product;
    }

    public function getList(){
        $products = ProductEloquent::withTrashed()->get();
        return $products;
    }

    public function getNamesList(){
        $product_names = ProductEloquent::select('id', 'name')->get();
        return $product_names;
    }

    public function getInfoList($id){
        $product_info = ProductEloquent::find($id);
        $product_info['showUnit'] = $product_info->showUnit();
        return $product_info;
    }

    public function getOne($id){
        $product = ProductEloquent::withTrashed()->find($id);
        return $product;
    }

    public function update($request, $id){
        $product = $this->getOne($id);

        // 圖片儲存
        $this->savePicture($request->picture, $product);

        $realName = $request->name."(".$request->specification."+".$request->size."+".$request->weight."+".")";

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'isManualNamed' => $request->isManualNamed ?? '0',
            'shownID' => $request->shownID,
            'isManualID' => $request->isManualID ?? '0',
            'internationalNum' => $request->internationalNum,

            'specification' => $request->specification,
            'color' => $request->color,

            'isCustomize' => $request->isCustomize ?? '0',
            'isPublic' => $request->isPublic ?? '0',
            'showPrice' => $request->showPrice ?? '0',

            'length' => $request->length,
            'width' => $request->width,
            'chamfer' => $request->chamfer,
            'weight' => $request->weight,
            'qty_per_pack' => $request->qty_per_pack,
            'comment' => $request->comment,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'safeQuantity' => $request->safeQuantity,
            'intro' => $request->intro,
        ]);
        return $product;
    }

    public function delete($id){
        $product = $this->getOne($id);
        if($product->trashed()){
            $product->restore();
        }else{
            $product->delete();
        }
    }

    public function getlastupdate(){
        $product = ProductEloquent::withTrashed()->orderBy('id', 'DESC')->first();
        if(!empty($product)){
            return $product->updated_at;
        }
        return null;
    }

    public function getProductByCategory($category_id){
        $products = CategoryEloquent::where('id', $category_id)->get()->products;
        if($products){
           return $products;
        }else{
            return "此類別查無資料";
        }
    }

    private function savePicture($pictures, $product){
        foreach($pictures as $picture){
            if(!empty($picture)){
                $ext = strtolower($picture->getClientOriginalExtension());
                switch($ext){
                    case 'jpg':
                        $origin_picture = imagecreatefromjpeg($picture);
                        break;
                    case 'png':
                        $origin_picture = imagecreatefrompng($picture);
                        break;
                    case 'bmp':
                        $origin_picture = imagecreatefrombmp($picture);
                        break;
                    default:
                        $origin_picture = imagecreatefromjpeg($picture);
                        break;
                }
                $start_index = $product->pictures()->count();
                $index = $start_index + 1;
                $picture_name = str_pad($product->id, 4, '0', STR_PAD_LEFT) . '-' . str_pad($index, 2, '0', STR_PAD_LEFT);
                $picture_full_name = $picture_name . '.' . $ext;
    
                $save_path = public_path('images/products/');
                switch($ext){
                    case 'jpg':
                        imagejpeg($origin_picture, $save_path . $picture_full_name);
                        break;
                    case 'png':
                        $background = imagecolorallocate($origin_picture, 0, 0, 0);
                        imagecolortransparent($origin_picture, $background);
                        imagealphablending($origin_picture, false);
                        imagesavealpha($origin_picture, true);
                        imagepng($origin_picture, $save_path . $picture_full_name);
                        break;
                    case 'bmp':
                        imagebmp($origin_picture, $save_path . $picture_full_name);
                        break;
                    default:
                        imagejpeg($origin_picture, $save_path . $picture_full_name);
                        break;
                }
                $image_path = 'images/products/' . $picture_full_name;
    
                $product->pictures()->create([
                    'url' => $image_path,
                    'index' => $index,
                ]);
            }
        }
    }
}
