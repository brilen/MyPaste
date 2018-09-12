<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App;
use Auth;

class PastesController extends Controller
{
    public function showPaste(App\Paste $paste){
        
        if ($paste->private < 2){
            if ($paste->life_time > date("Y-m-d H:i:s") || $paste->access_all == 1){
                return $this->getView($paste);
            }
        } else {
            //чтобы сам автор мог видеть private пасты
            if (!Auth::guest() && $paste->user_id === Auth::user()->id){
                   return $this->getView($paste);
                }
        }
        return redirect('/');
    }

    public function showLast(){
        $userPastes = NULL;
        $lastPastes = $this->getLastPastes();
        if (! Auth::guest()){
            $userPastes = $this->getLastUserPastes();
        }
        return view('welcome')->with([
                            'userPastes' => $userPastes,
                            'lastPastes' => $lastPastes
                          ]);
    }

    public function insert(Request $request){
        
        $currentUser = '';
        if (! Auth::guest()) $currentUser = Auth::user()->id;
        
        $access =  0;
        $now = date("Y-m-d H:i:s");
        
        if ($request->paste_expire_time == 'Never') {
            $access = 1;
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
        $paste->user_id = $currentUser;
        $paste->save();
        
        return $this->getView($paste);
    }
    
    private function getView($paste){
        $userPastes = NULL;
        $lastPastes = $this->getLastPastes();
        if (! Auth::guest()){
            $userPastes = $this->getLastUserPastes(Auth::user()->id);     
        }
        return view('view')->with([
                    'paste' => $paste,
                    'userPastes' => $userPastes,
                    'lastPastes' => $lastPastes
                  ]);
    }
    
    private function getLastPastes(){
        $pastes = DB::table('pastes')
            ->latest()
            ->where(function($query){
                $query->where('access_all', '=', true)
                ->orWhere('life_time', '>', date("Y-m-d H:i:s"));
            })
            ->where('private', '=', '0')
            ->limit(10)
            ->get();
            return $pastes;
    }
    
    private function getLastUserPastes(){
        $userPastes = DB::table('pastes')
            ->latest()
            ->where('user_id', '=', Auth::user()->id)
            ->where(function($query){
                $query->where('access_all', '=', true)
                ->orWhere('life_time', '>', date("Y-m-d H:i:s"));
            })
            ->limit(10)
            ->get();
            return $userPastes;
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