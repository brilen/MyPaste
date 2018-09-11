<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App;

class PastesController extends Controller
{
    public function show(App\Paste $paste){
        if ($paste->life_time > date("Y-m-d H:i:s") || $paste->access_all == 1){
            return view('view', compact('paste'));
        } else{
           return redirect('/');
        }
        
    }

    public function showLast(){
        $pastes = DB::table('pastes')
            ->latest()
            ->where(function($query){
                $query->where('access_all', '=', true)
                ->orWhere('life_time', '>', date("Y-m-d H:i:s"));
            })
            ->where('private', '=', 'false')
            ->limit(10)
            ->get();
        return view('welcome', compact('pastes'));
    }

    public function insert(Request $request){
        
        $access =  1;
        $now = date("Y-m-d H:i:s");
        
        if ($request->paste_expire_time == 'Never') {
            $access = 0;
        }
        else {
            $now = $this->getLifeTime($request->paste_expire_time, $now);
            
        }
        
        $paste = new App\Paste;
        $paste->code = $request->paste_code;
        $paste->private = $request->paste_private;
        $paste->name = $request->paste_name;
        $paste->access_all = $access;
        $paste->life_time = $now;
        $hash = $this->getHash();
        $paste->hash = $hash;
        $paste->save();
        
        return view('view', compact('paste'));
    }
    
    private function getHash(){
        $hash = '';
        $length = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for ($i = 0; $i < $length; $i++) {
            $hash .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        
        return $hash;       
    }
    
    private function getLifeTime($expire_time, $date){
        $lifetime = 0;
        $timestamp = strtotime($date);
        switch ($expire_time) {
            case '10M':
                $lifetime= $timestamp + 10*60;
                break;
            case '1H':
                $lifetime= $timestamp + 60*60;
                break;
            case '3H':
                $lifetime= $timestamp + 3*60*60;
                break;
            case 'D':
                $lifetime= $timestamp + 24*60*60;
                break;
            case 'W':
                $lifetime= $timestamp + 7*24*60*60;
                break;
            case 'M':
                $lifetime = mktime(date("H",$timestamp), date("i",$timestamp), date("s",$timestamp), date("m",$timestamp)+1, date("d",$timestamp),   date("Y",$timestamp));
                break;
        }
        return date("Y-m-d H:i:s", $lifetime);
    }
}