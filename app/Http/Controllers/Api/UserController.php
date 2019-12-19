<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Auth;
use App\User;

class UserController extends BaseController
{
    public function my_profile(){
        $user = Auth::user();
        return $this->response(["status"=>200,"message"=>"Success!","data"=>$user]);
    }

    public function update_profile(Request $request){
        $input = $request->all();
        $field  = ['first_name','last_name','email'];

        if($this->required($input,$field)){
            return $this->response(["status"=>400,"message"=>"Fields Required: ".$this->required($input,$field)]);
        }
        $user = Auth::user();

        if(User::where('email',$user->email)->where('id','!=',$user->id)->count()>0){
            return $this->response(["status"=>409,"message"=>"Email already registed."]);
        }

        $user->update($input);
        
        return $this->response(["status"=>200,"message"=>"Success!","data"=>$user]);
    }
}
