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
        $products = ProductEloquent::withTrashed()->with(['category:id,name'])->get();
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
        $product = ProductEloquent::withTrashed()->findOrFail($id);
        $product_pictures = $product->pictures;
        if(count($product_pictures)!=0){
            $product_images = [];
            $c = 1;
            foreach($product_pictures as $product_picture){
                $product_images[] = $product->showPicture($c);
                $c ++;
            }
        }else{
            $product_images = [];
            $product_images[0] = $product->showPicture();
        }

        $product->imgs = $product_images;

        return $product;
    }

    public function getOnePictures($id){
        $product = ProductEloquent::withTrashed()->find($id);
        $product_pictures = $product->pictures;
        if($product_pictures){
            $product_images = [];
            $c = 1;
            foreach($product_pictures as $product_picture){
                $product_image = [];
                $product_image['id'] = $c;
                $product_image['url'] = $product->showPicture($c);
                $product_images[$c-1] = $product_image;
                $c ++;
            }


            return ['images' => $product_images, 'status' => 200];
        }else{
            return ['message' => 'Something wrong', 'status' => 400];
        }

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


    //  orderby 1.價格(高->低) 2.價格(低->高)
    // type:(default) 0.全部 1.依商品名稱 2.依商品規格 3.依商品花色
    public function getListFrontend($request){
        if($request->firstPage == 1){
            // 強制從第一頁開始。
            $skip = 0;
        }else{
            // 看從第幾頁開始。
            $skip = $request->skip ?? 0 ;
        }

        $take = 21;

        // 看是什麼條件，預設就是沒有限制條件。
        $type = $request->type ?? 0;
        // 看排序的方法。
        $orderBy = $request->orderBy;
        // 看關鍵字，會切割成陣列。
        $keywords = ($request->keywords != "") ? explode(" ", $request->keywords) : [];

        $type_arr = ['', 'name', 'specification', 'color'];

        $products = new ProductEloquent();

        if(!is_null($keywords) && $keywords != []){
            // $keywords 不是空陣列才需要進行搜尋
            if($type == 0){
                $products = $this->keywordSearch($products, $type_arr, $keywords, 'all');
            }else{
                $products = $this->keywordSearch($products, $type_arr, $keywords, $type);
            }
        }
        $products = $products->orderBy('showPrice', 'desc');
        // 1.最新 -> 最舊 2.最舊 -> 最新 3.價格(高->低) 4.價格(低->高)
        if($orderBy == 2){
            $products = $products->orderBy('created_at', 'asc');
        }else if($orderBy == 3){
            $products = $products->orderBy('retailPrice', 'desc');
        }else if($orderBy == 4){
            $products = $products->orderBy('retailPrice', 'asc');
        }else{
            $products = $products->orderBy('created_at', 'desc');
        }



        // 1. 在前台中顯示 2.在前台不顯示
        $products = $products->where('isPublic', 1);

        $count = $products->count();
        $products = $products->skip($skip)->take($take)->get([
            'id', 'category_id', 'name', 'specification', 'color', 'isPublic', 'showPrice', 'quantity', 'retailPrice', 'created_at'
        ]);

        foreach($products as $product){
            $product->showUnit = $product->showUnit();
            $product->showURL = route('front.products.show', $product->id);
            $product->pictures = $product->pictures;
            $product->category = $product->category;
            $product->coverImage = $product->showPicture(1);
        }

        return [
            'products' => $products,
            'count' => $count
        ];
    }

    private function keywordSearch($model, $column, $keywords, $searchType){
        if($searchType == 'all'){
            $result = $model->where(function ($query) use ($column, $keywords){
                $c = 0;
                $count = count($column);
                for($i = 1; $i <= ($count - 1); $i++){
                    foreach ($keywords as $keyword) {
                        $keyword = '%'.$keyword.'%';
                        if($c == 0){
                            $query->where($column[$i], 'like', $keyword);
                            $c++;
                        }else{
                            $query->orWhere($column[$i], 'like', $keyword);
                        }
                    }
                }
            });
        }else{
            $result = $model->where(function ($query) use ($column, $keywords, $searchType){
                $c = 0;
                foreach ($keywords as $keyword) {
                    $keyword = '%'.$keyword.'%';
                    if($c == 0){
                        $query->where($column[$searchType], 'like', $keyword);
                        $c++;
                    }else{
                        $query->orWhere($column[$searchType], 'like', $keyword);
                    }
                }
            });
        }
        return $result;
    }

    private function savePicture($pictures, $product){
        foreach($pictures as $picture){

            // 生成原圖
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

                // 生成檔名以及儲存路徑設定
                $index = $product->pictures()->count() + 1;
                $picture_name = str_pad($product->id, 4, '0', STR_PAD_LEFT) . '-' . str_pad($index, 2, '0', STR_PAD_LEFT);
                $picture_full_name = $picture_name . '.' . $ext;
                $save_path = public_path('images/products/');

                // 裁切圖片

                // 先取得圖片的長與寬
                $data = getimagesize($picture);
                $width = $data[0];
                $height = $data[1];

                $top = 0;
                $left = 0;
                $new_width = 0;
                $new_height = 0;
                if($width > $height){
                    // 寬比高長，代表是橫長方形
                    $left = ($width - $height) / 2;
                    $new_width = $height;
                    $new_height = $height;
                }else if($width < $height){
                    // 寬比高短，代表是直長方形
                    $top = ($height - $width) / 2;
                    $new_width = $width;
                    $new_height = $width;
                }else{
                    // 代表是正方形圖，Do Nothing
                    $new_width = $width;
                    $new_height = $height;
                }

                // 裁切圖片
                $new_picture = imagecreatetruecolor($new_width, $new_height);
                imagecopy(
                    $new_picture, $origin_picture,
                    0, 0,
                    $left, $top,
                    $new_width, $new_height
                );
                $final_picture = imagecreatetruecolor(500, 500);
                imagecopyresampled ($final_picture, $new_picture, 0, 0, 0, 0, 500, 500, $new_width, $new_height);

                switch($ext){
                    case 'jpg':
                        imagejpeg($final_picture, $save_path . $picture_full_name);
                        break;
                    case 'png':
                        $background = imagecolorallocate($final_picture, 0, 0, 0);
                        imagecolortransparent($final_picture, $background);
                        imagealphablending($final_picture, false);
                        imagesavealpha($final_picture, true);
                        imagepng($final_picture, $save_path . $picture_full_name);
                        break;
                    case 'bmp':
                        imagebmp($final_picture, $save_path . $picture_full_name);
                        break;
                    default:
                        imagejpeg($final_picture, $save_path . $picture_full_name);
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
