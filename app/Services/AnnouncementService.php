<?php

namespace App\Services;
use App\Announcement as AnnouncementEloquent;
use URL;
use Auth;

class AnnouncementService extends BaseService
{
    public function add($request)
    {
        // if(!is_null($request->image_data) && !is_null($_FILES['image_file'])){
        //     // 圖片路徑生成與裁切
        //     $crop = new CropImageService($request->image_data, $_FILES['image_file'], 'announcements');
        //     $result = $crop->getResult();
        //     if($result['status'] == 'ERROR'){
        //         return [
        //             'status' => '422',
        //             'message' => $result['message']
        //         ];
        //     }else{
        //         $url = $result['url'];
        //     }
        // }else{
        //     $url = URL::asset('images/books/default.png');
        // }

        // $user = auth('api')->user();


        $announcement = AnnouncementEloquent::create([
            // 'cover_image' => $url,
            'last_update_user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);


        return $announcement->id;
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

        // if(!is_null($request->image_data) && !is_null($_FILES['image_file'])){
        //     // 圖片路徑生成與裁切
        //     $crop = new CropImageService($request->image_data, $_FILES['image_file'], 'announcements');
        //     $result = $crop->getResult();
        //     if($result['status'] == 'ERROR'){
        //         return [
        //             'status' => '422',
        //             'message' => $result['message']
        //         ];
        //     }else{
        //         $url = $result['url'];
        //     }
        // }else{
        //     $url = $announcement->cover_image;
        // }

        $user = auth('api')->user();

        $announcement->update([
            // 'cover_image' => $url,
            'last_update_user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            ]);

        return $announcement->id;
    }

    public function delete($id)
    {
        $announcement = $this->getOne($id);
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
            $announcement->showDate = $announcement->showDate();
            $announcement->showCoverImage = $announcement->showCoverImage();
            $announcement->detailURL = route('front.announcements.show', [$announcement->id]);
        }
    }
}
