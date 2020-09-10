<?php

use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            ['id'=>1,'email'=>'admin@gmail.com','password'=>bcrypt('123456'),'full'=>'Admin','address'=>'Hà nội','phone'=>'147258369','level'=>1],
            ['id'=>2,'email'=>'nguyenvana@gmail.com','password'=>bcrypt('123456'),'full'=>'Nguyễn Văn A','address'=>'Hà nội','phone'=>'147258369','level'=>2],
            ['id'=>3,'email'=>'nguyenvanb@gmail.com','password'=>bcrypt('123456'),'full'=>'Nguyễn Văn B','address'=>'Hà nội','phone'=>'0941683922','level'=>2],
            ['id'=>4,'email'=>'nguyenvanc@gmail.com','password'=>bcrypt('123456'),'full'=>'Nguyễn Văn C','address'=>'Hà nội','phone'=>'2354885482','level'=>2],
            ['id'=>5,'email'=>'nguyenvand@gmail.com','password'=>bcrypt('123456'),'full'=>'Nguyễn Văn D','address'=>'Hà nội','phone'=>'01657445835','level'=>2],
        ]);
    }
}
