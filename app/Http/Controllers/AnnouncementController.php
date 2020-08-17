<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnnouncementService;
use App\Http\Requests\AnnouncementRequest;

class AnnouncementController extends Controller
{
    public $AnnouncementService;

    public function __construct(){
        $this->middleware('auth');
        $this->AnnouncementService = new AnnouncementService();
    }

    public function index(){
        $announcements = $this->AnnouncementService->getList();
        $lastUpdate = $this->AnnouncementService->getlastupdate();
        return view('announcements.index', compact('announcements', 'lastUpdate'));
    }

    public function create(){
        return view('announcements.create');
    }

    public function store(AnnouncementRequest $request){
        $result = $this->AnnouncementService->add($request);
        return response()->json($result, $result['status']);
    }

    public function show($id){
        $announcement = $this->AnnouncementService->getOne($id);
        return view('announcements.show', compact('announcement'));
    }

    public function edit($id){
        $announcement = $this->AnnouncementService->getOne($id);
        return view('announcements.edit', compact('announcement'));
    }

    public function update(AnnouncementRequest $request, $id){
        $result = $this->AnnouncementService->update($request, $id);
        return response()->json($result, $result['status']);
    }

    public function destroy($id){

        $this->AnnouncementService->delete($id);
        return redirect()->route('announcements.index');
    }

    // API
    public function getList(){
        $announcements = $this->AnnouncementService->getList();
        return response()->json([
            'status' => 'OK',
            'announcements' => $announcements
        ]);
    }

    public function getOne($id){
        $announcement = $this->AnnouncementService->getOne($id);
        $announcement->showCoverImage = $announcement->showCoverImage();
        return response()->json([
            'status' => 'OK',
            'announcement' => $announcement
        ]);
    }

}
