<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use Mail;
use App\Models\OauthAccessToken;

class AuthController extends BaseController
{
    public function register(Request $request){
        $input  = $request->all();
        $field  = ['first_name','last_name','email','password','device_type','device_token'];
        
        if($this->required($input,$field)){
            return $this->response(["status"=>400,"message"=>"Fields Required: ".$this->required($input,$field)]);
        }
        
        if(User::where('email',$input['email'])->count()>0){
            return $this->response(["status"=>409,"message"=>"Email already registed."]);
        }

        $input['password'] = Hash::make($input['password']);
        $user   = User::create($input);
        $token  = $user->createToken('user')->accessToken;
        $device = $this->getTokenId($token);
        OauthAccessToken::where('id',$device)->update(['device_type'=>$input['device_type'],'device_token'=>$input['device_token']]);

        return $this->response(["status"=>200,"message"=>"Success!","data"=>$user,"token"=>$token]);
    }

    public function login(Request $request){
        $input  = $request->all();
        $field  = ['email','password','device_type','device_token'];
        
        if($this->required($input,$field)){
            return $this->response(["status"=>400,"message"=>"Fields Required: ".$this->required($input,$field)]);
        }
        
        if(Auth::attempt(['email'=>$input['email'],'password'=>$input['password']])){
            $user   = Auth::user();
            $token  = $user->createToken('user')->accessToken;
            $device = $this->getTokenId($token);
            OauthAccessToken::where('id',$device)->update(['device_type'=>$input['device_type'],'device_token'=>$input['device_token']]);

            return $this->response(["status"=>200,"message"=>"Success!","data"=>$user,"token"=>$token]);
        }

        return $this->response(["status"=>401,"message"=>"Email or password is not correct."]);
    }

    public function logout(Request $request){
        $user = Auth::user()->token();
        $user->revoke();

        return $this->response(["status"=>200,"message"=>"Success!"]);
    }

    public function change_password(Request $request){
        $input  = $request->all();
        $field  = ['old_password','new_password'];
        
        if($this->required($input,$field)){
            return $this->response(["status"=>400,"message"=>"Fields Required: ".$this->required($input,$field)]);
        }

        $user = Auth::user();
        if(Hash::check($input['old_password'],$user->password)){
            $user->update(['password'=>Hash::make($input['new_password'])]);  
            return $this->response(["status"=>200,"message"=>"Success!"]);
        }

        return $this->response(["status"=>406,"message"=>"Old password wrong."]);
    }

    public function forgot_password(Request $request){
        $input  = $request->all();
        $field  = ['email'];
        
        if($this->required($input,$field)){
            return $this->response(["status"=>400,"message"=>"Fields Required: ".$this->required($input,$field)]);
        }

        if(User::where(['email'=>$input['email']])->count()>0){
            $user = User::where(['email'=>$input['email']]);
            $otp = rand(123456,999999);
            $user->update(['otp'=>$otp]);  
            $user = $user->get()->first();

            $data = [
                'username'  => $user->first_name.' '.$user->last_name,
                'mesage'    => 'Please use this otp to verify your account.',
                'otp'       => $otp,
            ];

            Mail::send('email/forgot_password', $data,function($message)  use ($user){
                $message->to($user->email, 'Forgot Password')->subject('Forgot Password');
            });

            return $this->response(["status"=>200,"message"=>"Please check your inbox.","otp"=>$otp]);
        }

        return $this->response(["status"=>404,"message"=>"Email not registed."]);
    }

    public function reset_password(Request $request){
        $input  = $request->all();
        $field  = ['email','password','device_type','device_token'];
        
        if($this->required($input,$field)){
            return $this->response(["status"=>400,"message"=>"Fields Required: ".$this->required($input,$field)]);
        }

        $user = User::where(['email'=>$input['email']]);
        
        if($user->count()>0){
            $user->update(['otp'=>null,'password'=>Hash::make($input['password'])]);
            OauthAccessToken::where('user_id',$user->get()->first()->id)->delete();
            Auth::loginUsingId($user->get()->first()->id, true);
            $token  = Auth::user()->createToken('user')->accessToken;
            $device = $this->getTokenId($token);
            OauthAccessToken::where('id',$device)->update(['device_type'=>$input['device_type'],'device_token'=>$input['device_token']]);

            return $this->response(["status"=>200,"message"=>"Success!","data"=>Auth::user(),"token"=>$token]);
        }

        return $this->response(["status"=>404,"message"=>"Email not registed."]);
    }
}
