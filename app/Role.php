<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function adminRole()
    {
        return self::where('name', 'admin')->first();
    }

    public static function userRole()
    {
        return self::where('name', 'user')->first();
    }

}
