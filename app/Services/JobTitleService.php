<?php

namespace App\Services;
use App\JobTitle as JobTitleEloquent;
use Carbon\Carbon;

class JobTitleService extends BaseService
{
    public function add($request)
    {
        $jobTitle = JobTitleEloquent::create([
            'name' => $request->name,
        ]);
        return $jobTitle;
    }

    public function getList()
    {
        $jobTitles = JobTitleEloquent::get();
        return $jobTitles;
    }

    public function getOne($id)
    {
        $jobTitle = JobTitleEloquent::find($id);
        return $jobTitle;
    }

    public function update($request, $id)
    {
        $jobTitle = $this->getOne($id);
        $jobTitle->update([
            'name' => $request->name,
        ]);
        return $jobTitle;
    }

    public function delete($id)
    {
        $jobTitle = $this->getOne($id);
        $jobTitle->delete();
    }

    public function getlastupdate()
    {
        $jobTitle = JobTitleEloquent::orderBy('id', 'DESC')->first();
        return $jobTitle->updated_at;
    }
}