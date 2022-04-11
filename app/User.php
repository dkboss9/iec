<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status', 'timezone', 'otp', 'access_token', 'device_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Rules($act = 'add'){
        $rules = [
            'name' => ['bail','required', 'string', 'max:255'],
            'email' => 'required|unique:users,email|regex:/(.*)\.com/i',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => 'required|in:admin,editor,operator,user',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'detail' => 'nullable|string',
        ];
        if($act != 'add'){
            $rules['email'] = 'nullable|email|max:255|regex:/(.*)\.com/i'; 
            $rules['password'] = "nullable|string|min:8|confirmed";
            $rules['citizenship'] = "nullable|string";
            $rules['country'] = "nullable|string";
            $rules['city'] = "nullable|string";
        }
        return $rules;
    }

    public function user_info(){
        return $this->hasOne('App\Models\Userinfo','user_id','id');
    }
    public function editor_info(){
        return $this->hasOne('App\Models\Editor','user_id','id');
    }
    public function operator_info(){
        return $this->hasOne('App\Models\Operator','user_id','id');
    }

    public function token_info(){
        return $this->hasMany('App\Models\Token','user_id','id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

}
