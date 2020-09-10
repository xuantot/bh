<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\InfoRequest;
use Carbon\Carbon;
use App\models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class IndexController extends Controller
{
    function GetIndex(){
        
        $year_n=Carbon::now()->format('Y');
        $month_n=Carbon::now()->format('m');
        for($i=1;$i<=$month_n;$i++)
        {
            $monthjs[$i]='Tháng '.$i;
            $numberjs[$i]=customer::where('state',1)->whereMonth('updated_at',$i)->whereYear('updated_at', $year_n)->sum('total');
        }
        $data['monthjs']=$monthjs;
        $data['numberjs']=$numberjs;
        $data['order']=customer::where('state',0)->count();
        return view('backend.index.index',$data);
        
    }
    function GetInfo(){ 
        return view('backend.users.info');
    }
    function PostInfo(InfoRequest $r){
        $user=Auth::user();
        $user->password=bcrypt($r->password);
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->save();
        return redirect()->back()->with('thongbao','Cập nhập thông tin thành công');
    }
    
}
