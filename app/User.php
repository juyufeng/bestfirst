<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function findOne(Request $request)
    {
        //id 或 主键
        if($request->has('id'))
        {
            $obj = User::find(request('id'));
        }
        if($request->has('phone'))
        {
            $obj = User::where('phone', $request->phone)
                ->first();
        }
        return $obj;
    }

    public function filelists(){
        return $this->hasMany('App\Filelist');
    }

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function shworknos(){
        return $this->hasMany('App\ShWorkNo');
    }
}
