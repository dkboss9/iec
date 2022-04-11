<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_list = array(
            array(
                'name'=>'admin',
                'email' => 'admin@news.com',
                'password' => Hash::make('admin123'),
                'role' =>'admin'
            ),
            array(
                'name'=>'user',
                'email' => 'user@news.com',
                'password' => Hash::make('user123'),
                'role' =>'user'
            )
        );

        foreach ($user_list as $user_info){
            $user = new User();
            if ($user -> where('email', $user_info['email'])->count() > 0){
                $user = $user->where('email', $user_info['email'])->first();
            }
            $user->fill($user_info);
            $user->save();
        }
    }
}
