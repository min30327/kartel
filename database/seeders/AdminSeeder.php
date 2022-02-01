<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            [
                'name'=>'administrator',
                'password'=>bcrypt('passwd'),
                'email'=>'info@not4h.jp',

            ],
        ];
        foreach($admin as $k => $v){
        	\App\Models\Admin::insert([
                'name' => $v['name'],
                'password' => $v['password'],
                'email' => $v['email'],
                
	        ]);
        }
    }
}
