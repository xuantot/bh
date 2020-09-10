<?php

use Illuminate\Database\Seeder;

class product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->delete();
        DB::table('product')->insert([
            ['id'=>1,'product_code'=>'SP01','name'=>'Áo nam đẹp','price'=>500000,'featured'=>1,'state'=>1,'img'=>'ao-khoac.jpg','category_id'=>2],
            ['id'=>2,'product_code'=>'SP02','name'=>'Quần nam 2018','price'=>500000,'featured'=>0,'state'=>0,'img'=>'item-1.jpg','category_id'=>3],
            ['id'=>3,'product_code'=>'SP03','name'=>'Áo nam  2019','price'=>500000,'featured'=>1,'state'=>0,'img'=>'person2.jpg','category_id'=>4],
            ['id'=>4,'product_code'=>'SP04','name'=>'Áo nữ pro','price'=>500000,'featured'=>1,'state'=>1,'img'=>'person3.jpg','category_id'=>6],
            ['id'=>5,'product_code'=>'SP05','name'=>'Quần nữ vip','price'=>500000,'featured'=>0,'state'=>1,'img'=>'item-15.jpg','category_id'=>7],
        ]);
    }
}
