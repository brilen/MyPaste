<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    public function getRouteKeyName()
    {
        return 'hash';
    }
    
    /*public function getLastPastes()
    {
        $pastes = DB::table('pastes')
            ->latest()
            ->where(['private', false], ['access_all', true])
            ->get();
        return $pastes;
    }*/
}
