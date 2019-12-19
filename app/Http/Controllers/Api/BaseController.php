<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lcobucci\JWT\Parser;

class BaseController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except(['register','login','forgot_password','reset_password']);
    }

    public function response($arr){
        return response()->json($arr, $arr['status']);
    }

    public function required($input,$fields){
        $requried = "";
        foreach($fields as $value) {
            if (@$input[$value]==''){
                $requried .= $value.',';
            }
        }
        if($requried!=""){
            return rtrim($requried,',');
        }else{
            return false;
        }
    }

    public function getTokenId($token){
        $value = $token;
        $id= (new Parser())->parse($value)->getClaims()['jti']->getValue();
        return $id;
    }
}
