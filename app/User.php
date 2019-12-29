<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function blogs(){
        return $this->hasMany(Blog::class,'user_id');
    }

    public function follower(){
        return $this->belongsToMany(User::class,'follows','user_id','follower');
    }
    public function following(){
       return  $this->belongsToMany(User::class,'follows','follower','user_id');

    }
    /*
     * 判定该用户是否为粉丝
     */
    public function isFollow($uid){
        return $this->follower()->wherePivot('follower',$uid)->first();
    }
    //关注或取关
    public function followerToggle($ids){
        $ids =is_array($ids)?:[$ids];
        return $this->follower()->withTimestamps()->toggle($ids);
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
