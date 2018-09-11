<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    public function getRouteKeyName()
    {
        return 'hash';
    }
}
