<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
    public static function getActiveRewards()
    {
        return self::where('can_use',1)->get()->toArray();
    }

}
