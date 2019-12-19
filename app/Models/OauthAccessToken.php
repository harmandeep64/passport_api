<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthAccessToken extends Model
{
    protected $fillable = [
        'user_id','client_id','device_type','device_id', 'device_token', 'name', 'scopes', 'revoked'
    ];

    public function getDeviceTypeAttribute($val){
        if($val==1){
            return 'iOS';
        }else{
            return 'Andiroid';
        }
    }
}
