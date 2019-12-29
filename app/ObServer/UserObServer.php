<?php


namespace App\ObServer;


use App\User;
use Illuminate\Support\Str;

class UserObServer
{
    public function  creating(User $user){
        $user->email_token=Str::random(10);
        $user->email_active=false;
    }
}
