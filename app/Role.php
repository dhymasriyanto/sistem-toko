<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public static function isRole($check_role)
    {
        $user_roles = User::where(['id'=> \Auth::user()->id,'level_akses'=>$check_role])->first();
        return $user_roles ? true : false;
    }
}
