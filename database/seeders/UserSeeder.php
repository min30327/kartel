<?php

namespace Database\Seeders;

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
        $users = [
            [
                'name'=>'user',
                'email'=>'fake@example.com',
                'password'=>bcrypt('passwd'),
                'ovice_email'=>'fake@example.com',
            ],
        ];
        foreach($users as $k => $v){
        	\App\Models\User::insert([
                'name' => $v['name'],
                'email' => $v['email'],
                'password' => $v['password'],
                'ovice_email' => $v['ovice_email'],
                
	        ]);
        }
    }
}
