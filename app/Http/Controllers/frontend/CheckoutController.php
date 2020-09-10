<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\models\{customer,order,attr};
use Cart;
use Illuminate\Http\Request;
Use Mail;
use App\Mail\SendMail;


class CheckoutController extends Controller
{
    function GetCheckout(){
        $data['cart']=Cart::Content();
        $data['total']=Cart::total(0,'','.');
        return view('frontend.checkout.checkout',$data);
    }
    function GetComplete($id){
        $data['customer']=customer::find($id);
        return view('frontend.checkout.complete',$data);
    }
    function PostCheckout(request $r){
        
        $customer= new customer;
        $customer->full_name=$r->name;
        $customer->address=$r->address;
        $customer->email=$r->email;
        $customer->phone=$r->phone;
        $customer->total=Cart::total(0,'','');
        $customer->state=0;
        $customer->save();
        foreach(Cart::content() as $product){
            $order=new order;
            $order->name=$product->name;
            $order->price=$product->price;
            $order->quantity=$product->qty;
            $order->img=$product->options->img;
            $order->customer_id=$customer->id;
            $order->save();
            foreach($product->options->attr as $key => $value){
                $attr=new attr;
                $attr->name=$key;
                $attr->value=$value;
                $attr->order_id=$order->id;
                $attr->save();
            }
            
        }
        Cart::destroy();

        
        
        // $data['email']=$r->email;
        $data = array(
            'email'      =>  $r->email,
            'name'      =>  $r->name,
            'phone'      =>  $r->phone,
            'address'      =>  $r->address,
            'total'      =>  number_format($customer->total,0,'','.'),
            'show-order' =>$customer,
        );

        Mail::to($data['email'])->send(new SendMail($data));
        
        
        

        return redirect('/checkout/complete/'.$customer->id);
    }
}
