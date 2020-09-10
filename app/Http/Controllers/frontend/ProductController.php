<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\models\product;
use App\models\category;
use App\models\attribute;
use App\models\values;
use Cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function GetShop(request $r){
        if($r->category){
            $data['products']=category::find($r->category)->product()->where('img','<>','no-img.jpg')->paginate(12);
        }
        elseif($r->start){
            $data['products']=product::whereBetween('price',[$r->start,$r->end])->where('img','<>','no-img.jpg')->paginate(12);
        }
        elseif($r->value){
            $data['products']=values::find($r->value)->product()->where('img','<>','no-img.jpg')->where('img','<>','no-img.jpg')->paginate(12);
        }
        else{
            $data['products']=product::where('img','<>','no-img.jpg')->paginate(12);
        }

        $data['category']=category::all();
        $data['attribute']=attribute::all();
        return view('frontend.product.shop',$data);
    }
    function GetDetail($id){
        $data['product']=product::find($id);
        $data['product_new']=product::orderby('created_at','DESC')->Where('img','<>','no-img.jpg') ->take(4)->get();
        return view('frontend.product.detail',$data);
    }
    function GetCart(){
        $data['cart']=Cart::Content();
        $data['total']=Cart::total(0,'','.');

        return view('frontend.product.cart',$data);
    }
    function AddCart(request $r){
        $product=product::find($r->id_product);
        $state=$product->state;
        
        
        if ($state==0) {
            return redirect()->back()->with('thongbao','Sản phẩm hiện tại hết hàng');
        } else {
            Cart::add([
                'id' => $product->product_code, 
                'name' => $product->name, 
                'qty' => $r->quantity, 
                'price' => get_price($product,$r->attr), 
                'weight' => 0,
                'options' => ['img' => $product->img,'attr'=>$r->attr]
            ]);
            return redirect('/product/cart');
        }
        
        
    }
    function DelCart($id){
        Cart::remove($id);
        return redirect('/product/cart');

    }
    function UpdateCart($rowId,$qty){
            Cart::update($rowId, $qty);
        
        
    }
}
