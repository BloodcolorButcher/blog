<?php

namespace App\Http\Controllers;

use App\Notifications\FindPasswordNotify;
use App\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    //
    public function email(){
        return view('password.email');
    }

    public function send(Request $request){

        $user=User::where('email',$request->email)->first();
        \Notification::send($user,new FindPasswordNotify($user->email_token));
        return view('password.send');
    }

    public function edit($token){
        $user=User::where('email_token',$token)->first();
        return view('password.edit',compact('user'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'password' => 'required|min:5|confirmed'
        ]);
        $user=User::where('email_token',$request['token'])->first();
        $user->password = bcrypt($request->password);
        $user->save();
        session()->flash('success','修改密码成功');
        return redirect()->route('login');
    }
}
