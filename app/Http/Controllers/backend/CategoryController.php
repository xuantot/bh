<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use Illuminate\Http\Request;
use App\models\category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function GetCategory(){
        $data['category']=category::all();
        return view('backend.category.category',$data);
    }
    function PostCategory(AddCategoryRequest $r){
        $cate=new category();
        $cate->name=$r->name;
        $cate->slug=Str::slug($r->name,'-');
        $cate->parent=$r->parent;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã thêm thành công');
    }
    function GetEditCategory($id){
        $data['cate']=category::find($id);
        $data['category']=category::all();
        return view('backend.category.editcategory',$data);
    }
    function PostEditCategory(EditCategoryRequest $r, $id){
        $cate=category::find($id);
        $cate->name=$r->name;
        $cate->slug=Str::slug($r->name,'-');
        $cate->parent=$r->parent;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }

    function GetDelCategory($id){
        $cate=category::find($id);
        $cate->delete();
        return redirect('/admin/category')->with('thongbao','Đã xóa thành công');
    }
    
}
