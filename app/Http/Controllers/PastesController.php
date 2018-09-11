<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App;

class PastesController extends Controller
{
    public function show(App\Paste $paste){
        //$paste = App\Paste::where('hash', $hash);
        //$paste = App\Paste::find($id);
        //$paste = App\Paste::find($hash);
        return view('view', compact('paste'));
    }

    public function showLast(){
        $pastes = DB::table('pastes')
            ->latest()
            ->where([['private', '=', false], ['access_all', '=', true]])
            ->get();
        return view('welcome', compact('pastes'));
    }

    public function insert(Request $request){
        
        $paste = new App\Paste;
        $paste->code = $request->paste_code;
        $paste->expire_time = $request->paste_expire_time;
        $paste->private = $request->paste_private;
        $paste->name = $request->paste_name;
        $paste->access_all = true;
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
}
