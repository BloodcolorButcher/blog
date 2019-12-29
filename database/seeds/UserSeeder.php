<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class,100)->create();
        $user=\App\User::find(1);
        $user->name='yangyue';
        $user->email='1079725446@qq.com';
        $user->password=bcrypt('12345');
        $user->is_admin=true;
        $user->save();
        $user=\App\User::find(2);
        $user->name='杨月';
        $user->email='123456@qq.com';
        $user->password=bcrypt('12345');
        $user->save();


    }
}

