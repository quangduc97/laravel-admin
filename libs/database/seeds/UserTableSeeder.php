<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // thêm dữ liệu vào bảng users
        $data = [
            [
                'email'=>'duc@gmail.com',
                'password'=>bcrypt('123456'),
                'level'=>1
            ],
            [
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('123456'),
                'level'=>1
            ],
        ];
        DB::table('users')->insert($data);
    }
}
