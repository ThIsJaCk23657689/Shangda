<?php

namespace App\Services;
use App\Announcement as AnnouncementEloquent;
use Auth;

class AnnouncementService extends BaseService
{
    public function add($request)
    {
        if(!is_null($request->image_data) && !is_null($_FILES['image_file'])){
            // 圖片路徑生成與裁切
            $crop = new CropImageService($request->image_data, $_FILES['image_file'], 'announcements');
            $result = $crop->getResult();
            if($result['status'] == 'ERROR'){
                return [
                    'status' => '422',
                    'message' => $result['message']
                ];
            }else{
                $url = $result['url'];
            }
        }else{
            $url = null;
        }

        $announcement = AnnouncementEloquent::create([
            'cover_image' => $url,
            'last_update_user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return [
            'status' => 200,
            'id' => $announcement->id,
            'url' => route('announcements.show', [$announcement->id])
        ];
    }

    public function getList()
    {
        $announcements = AnnouncementEloquent::get();
        return $announcements;
    }

    public function count()
    {
        $total = AnnouncementEloquent::count();
        return $total;
    }

    public function getOne($id)
    {
        $announcement = AnnouncementEloquent::findOrFail($id);
        return $announcement;
    }

    public function update($request, $id)
    {
        $announcement = $this->getOne($id);

        if(!is_null($request->image_data) && !is_null($_FILES['image_file'])){
            // 圖片路徑生成與裁切
            $crop = new CropImageService($request->image_data, $_FILES['image_file'], 'announcements');
            $result = $crop->getResult();
            if($result['status'] == 'ERROR'){
                return [
                    'status' => '422',
                    'message' => $result['message']
                ];
            }else{
                $url = $result['url'];
                // 刪除舊圖
                if(file_exists(public_path($announcement->cover_image))){
                    unlink(public_path($announcement->cover_image));   
                }
            }
        }else{
            $url = $announcement->cover_image;
        }

        $announcement->update([
            'cover_image' => $url,
            'last_update_user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return [
            'status' => 200,
            'id' => $announcement->id,
            'url' => route('announcements.show', [$announcement->id])
        ];
    }

    public function delete($id)
    {
        $announcement = $this->getOne($id);
        if(file_exists(public_path($announcement->cover_image))){
            unlink(public_path($announcement->cover_image));   
        }
        $announcement->delete();
    }

    public function getlastupdate(){
        $announcement = AnnouncementEloquent::orderBy('id', 'DESC')->first();
        if(!empty($announcement)){
            return $announcement->updated_at;
        }
        return null;
    }

    public function getListFrontend($request){
        $take = 6;
        $skip = $request->skip ?? 0;
        $announcements = AnnouncementEloquent::orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
        foreach ($announcements as $announcement) {
            $announcement->showTitle = $announcement->showTitle();
            $announcement->showCoverImage = $announcement->showCoverImage();
            $announcement->showDay = $announcement->showDay();
            $announcement->showYear = $announcement->showYear();
            $announcement->showMonth = $announcement->showMonth();
            $announcement->detailURL = route('front.announcements.show', [$announcement->id]);
        }

        return [
            'announcements' => $announcements,
            'count' => count($announcements)
        ];
    }
}
