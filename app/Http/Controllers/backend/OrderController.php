<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\models\{customer, order, attr};
use Illuminate\Http\Request;


class OrderController extends Controller
{
    function GetOrder(){
        $data['customer']=customer::where('state',0)->orderby('created_at','ASC')->paginate(10);
        return view('backend.order.order',$data);
    }
    function GetDetailOrder($id){
        $data['customer']=customer::find($id);
        return view('backend.order.detailorder',$data);
    }
    function GetProcessedOrder(){
        $data['customer']=customer::where('state',1)->orderby('created_at','ASC')->paginate(10);
        return view('backend.order.orderprocessed',$data);
    }
    function ActiveOrder(request $r, $id){
        $customer=customer::find($id);
        $customer->state=1;
        $customer->save();
        
        return redirect('/admin/order')->with('thongbao','Đã xử lí đơn hàng thành công');
        
    }
    
    
}
