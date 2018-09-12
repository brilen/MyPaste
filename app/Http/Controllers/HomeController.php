<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\PastesController;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastPastes = $pastes = DB::table('pastes')
            ->latest()
            ->where(function($query){
                $query->where('access_all', '=', true)
                ->orWhere('life_time', '>', date("Y-m-d H:i:s"));
            })
            ->where('private', '=', '0')
            ->limit(10)
            ->get();
            
        $userPastes = DB::table('pastes')
            ->latest()
            ->where('user_id', '=', Auth::user()->id)
            ->where(function($query){
                $query->where('access_all', '=', true)
                ->orWhere('life_time', '>', date("Y-m-d H:i:s"));
            })
            ->limit(10)
            ->get();
            
        $userPastesTable = DB::table('pastes')
            ->where('user_id', '=', Auth::user()->id)
            ->where(function($query){
                $query->where('access_all', '=', true)
                ->orWhere('life_time', '>', date("Y-m-d H:i:s"));
            })
            ->paginate(3);

        return view('home')->with([
                            'userPastes' => $userPastes,
                            'userPastesTable' => $userPastesTable,
                            'lastPastes' => $lastPastes
                          ]);
    }
}
