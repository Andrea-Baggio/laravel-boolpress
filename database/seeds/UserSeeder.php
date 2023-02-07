<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'      => 'qwer',
                'email'     => 'qwer@qwer.qwer',
                'password'  =>  Hash::make('qwer'),
            ],
            [
                'name'      => 'asdf',
                'email'     => 'asdf@asdf.asdf',
                'password'  =>  Hash::make('asdf'),
            ],
            [
                'name'      => 'zxcv',
                'email'     => 'zxcv@zxcv.zxcv',
                'password'  =>  Hash::make('zxcv'),
            ],
        ];

        foreach ($users as $user) {
            // Metodo 1
            // $objUser = new User;
            // $objUser->name      = $user['name'];
            // $objUser->email     = $user['email'];
            // $objUser->password  = $user['password'];
            // $objUser->save();

            // Metodo 2
            // $objUser = new User;
            // $objUser->fill($user);
            // $objUser->save();

            // Metodo 3
            User::create($user);
        }
    }
}
