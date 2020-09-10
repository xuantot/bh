<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\User;
use App\http\Requests\AddUserRequest;
use App\http\Requests\EditUserRequest;
use App\Http\Requests\EditUserRequest as RequestsEditUserRequest;
use Illuminate\Http\Request;
use users;

class UsersController extends Controller
{
    function GetUser(){
        $data['users']=User::paginate(5);
        return view('backend.users.listuser',$data);
    }
    function GetAddUser(){

        return view('backend.users.adduser');
    }
    function PostAddUser(AddUserRequest $r){
        $user=new User;
        $user->email=$r->email;
        $user->password=bcrypt($r->password);
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();
        return redirect('/admin/user')->with('thongbao','Đã thêm thành viên thành công');

        
    }
    
    function GetEditUser($id){
        $data['user']=User::find($id);
        return view('backend.users.edituser',$data);
    }
    function PostEditUser(EditUserRequest $r, $id){
        $user=User::find($id);
        $user->email=$r->email;
        $user->password=bcrypt($r->password);
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();
        return redirect('/admin/user')->with('thongbao','Đã sửa thành công');
    }

    function DelUser($id){
        User::destroy($id);
        return redirect('/admin/user')->with('thongbao','Đã xóa thành viên thành công');
    }
}
