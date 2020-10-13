<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;

class Controller extends BaseController
{
    public static function authUser($header) {
        if ($header) {
            $key = explode(' ',$header);
            
            $user = User::where('api_key', $key[1])->first();
            
                if(!empty($user)){
                    return true;
                }else {
                    return false;   
                }
        }
    }
}
