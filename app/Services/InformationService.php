<?php

namespace App\Services;
use App\Information as InformationEloquent;
use Auth;

class InformationService extends BaseService
{

    public function getOne($id)
    {
        $information = InformationEloquent::findOrFail($id);
        return $information;
    }

    public function update($request, $id=1)
    {
        $information = $this->getOne($id);

        if(!is_null($request->image_data) && !is_null($_FILES['image_file'])){
            // 圖片路徑生成與裁切
            $crop = new CropImageService($request->image_data, $_FILES['image_file'], 'information');
            $result = $crop->getResult();
            if($result['status'] == 'ERROR'){
                return [
                    'status' => '422',
                    'message' => $result['message']
                ];
            }else{
                $url = $result['url'];
                // 刪除舊圖
                // if(file_exists(public_path($information->cover_image))){
                //     unlink(public_path($information->cover_image));
                // }
            }
        }else{
            $url = $information->cover_image;
        }

        $information->update([
            'cover_image' => $url,
        ]);

        return [
            'status' => 200,
            'id' => $information->id,
            'url' => route('information.edit', [$information->id])
        ];
    }

}
