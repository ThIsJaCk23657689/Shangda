<?php

namespace App\Http\Controllers;
use App\Services\FavoriteService;
use Illuminate\Http\Request;
use JWTAuth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $FavoriteService;

    public function __construct()
    {

        $this->middleware('consumer');
        $this->FavoriteService = new FavoriteService();
    }

    public function index()
    {
        $token = JWTAuth::getToken();
        $consumer = JWTAuth::toUser($token);
        $favorites = $this->FavoriteService->getList($consumer->id);
        return view('favorites.index', compact('favorites'));
    }


    public function store($pid)
    {
        $token = JWTAuth::getToken();
        $consumer = JWTAuth::toUser($token);
        $this->FavoriteService->add($pid, $consumer->id);
        return response()->json("added",200);
    }

    public function destroy($pid)
    {
        $token = JWTAuth::getToken();
        $consumer = JWTAuth::toUser($token);
        $this->FavoriteService->delete($pid,$consumer->id);
        return response()->json("deleted",200);
    }
}
