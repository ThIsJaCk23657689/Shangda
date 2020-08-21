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

        if($request->firstPage == 1){
            // 強制從第一頁開始。
            $skip = 0;
        }else{
            // 看從第幾頁開始。
            $skip = $request->skip ?? 0 ;
        }

        $take = 6;

        // 看是什麼條件，預設就是沒有限制條件。
        $type = $request->type ?? 0;
        // 看排序的方法。
        $orderBy = $request->orderBy;
        // 看關鍵字，會切割成陣列。
        $keywords = ($request->keywords != "") ? explode(" ", $request->keywords) : [];

        $type_arr = ['', 'title', 'content'];

        $announcements = new AnnouncementEloquent();

        if(!is_null($keywords) && $keywords != []){
            // $keywords 不是空陣列才需要進行搜尋
            if($type == 0){
                $announcements = $this->keywordSearch($announcements, $type_arr, $keywords, 'all');
            }else{
                $announcements = $this->keywordSearch($announcements, $type_arr, $keywords, $type);
            }
        }

        // 1.最新 -> 最舊 2.最舊 -> 最新
        if($orderBy == 2){
            $announcements = $announcements->orderBy('created_at', 'asc');
        }else{
            $announcements = $announcements->orderBy('created_at', 'desc');
        }

        $count = $announcements->count();
        $announcements = $announcements->skip($skip)->take($take)->get();

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
}
