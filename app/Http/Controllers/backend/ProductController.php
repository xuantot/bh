<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Http\Requests\AddAttrRequest;
use App\Http\Requests\AddValueRequest;
use App\Http\Requests\EditAttrRequest;
use App\Http\Requests\EditValueRequest;
use App\models\product;
use App\models\attribute;
use App\models\values;
use App\models\category;
use App\models\variant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //product
    function GetProduct(){
        $data['products']=Product::paginate(3);
        return view('backend.product.listproduct',$data);
    }
    function GetAddProduct(){
        $data['category']=category::all();
        $data['attrs']=attribute::all();
        return view('backend.product.addproduct',$data);
    }
    function PostAddProduct(AddProductRequest $r){
        $product= new product;
        $product->product_code=$r->product_code;
        $product->name=$r->product_name;
        $product->price=$r->product_price;
        $product->featured=$r->producr_featured;
        $product->state=$r->product_state;
        $product->info=$r->info;
        $product->describe=$r->description;
        if($r->hasFile('product_img')){
            $file = $r->product_img;
            $filename=Str::slug($r->name, '-').'.'.$file->getClientOriginalExtension();
            $file->move('backend/img',$filename);
            $product->img= $filename;
        }
        else {
            $product->img='no-img.jpg';
        }
        $product->category_id=$r->category;
        $product->save();

        $mang=array();
        foreach($r->attr as $value){
            foreach($value as $item){
                $mang[]=$item;
            }
        }
        $product->values()->attach($mang);

        $variant=get_combinations($r->attr);

        foreach($variant as $row)
        {
            $vari=new variant;
            $vari->product_id=$product->id;
            $vari->save();
            $vari->values()->Attach($row);
        }
        return redirect('/admin/product/add-variant/'.$product->id);

    }
    function GetEditProduct($id){
        $data['product']=product::find($id);
        $data['category']=category::all();
        $data['attrs']=attribute::all();
        return view('backend.product.editproduct',$data);
    }
    function PostEditProduct(EditProductRequest $r, $id){
        $product= product::find($id);
        $product->product_code=$r->product_code;
        $product->name=$r->product_name;
        $product->price=$r->product_price;
        $product->featured=$r->featured;
        $product->state=$r->product_state;
        $product->info=$r->info;
        $product->describe=$r->description;
        if($r->hasFile('product_img')){
            if($product->img!='no-img.jpg'){
                unlink('backend/img/'.$product->img);
            }
            $file = $r->product_img;
            $filename=Str::slug($r->name, '-').'.'.$file->getClientOriginalExtension();
            $file->move('backend/img',$filename);
            $product->img= $filename;
        }
        $product->category_id=$r->category;
        $product->save();

        //add values
        $mang=array();
        foreach($r->attr as $value){
            foreach($value as $item){
                $mang[]=$item;
            }
        }
        $product->values()->Sync($mang);

        //add variant
        $variant=get_combinations($r->attr);

        foreach($variant as $row)
        {
            if(check_variant($product,$row)){
                $vari=new variant;
                $vari->product_id=$product->id;
                $vari->save();
                $vari->values()->Attach($row);
            }
            
        }


        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }
    function DelProduct($id){
        product::destroy($id);
        return redirect()->back()->with('thongbao','Đã xóa thành công');
    }

    //attr
    function GetDetailAttr(){
        $data['attrs']=attribute::all();
        return view('backend.attr.attr',$data);
    }
    function GetEditAttr($id){
        $data['attr']=attribute::find($id);
        return view('backend.attr.editattr',$data);
    }
    function AddAttr(AddAttrRequest $r){
        $attr= new attribute;
        $attr->name=$r->pro_name;
        $attr->save();
        return redirect()->back()->with('thongbao','Đã thêm thành công thuộc tính: '.$r->pro_name);
    }    
    function PostEditAttr(EditAttrRequest $r, $id){
        $attr= attribute::find($id);
        $attr->name=$r->attr_name;
        $attr->save();
        return redirect()->back()->with('thongbao','Đã sửa thuộc tính thành công ');
    }
    function DelAttr($id){
        $attr= attribute::find($id);
        $attr->delete();
        return redirect()->back()->with('thongbao','Đã xóa thuộc tính thành công ');
    }
    

    //value
    function GetEditValue($id){
        $data['value']=values::find($id);
        return view('backend.attr.editvalue',$data);
    }
    function PostEditValue(EditValueRequest $r, $id){
        $value=values::find($id);
        $value->value=$r->edit_value_name;
        $value->save();
        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }
    function DelValue($id){
        values::destroy($id);
        return redirect()->back()->with('thongbao','Đã xóa giá trị thành công');

    }
    function AddValue(AddValueRequest $r){
        $value=new values;
        $value->value=$r->var_name;
        $value->attr_id=$r->attr_id;
        $value->save();
        return redirect()->back()->with('thongbao','Đã thêm thành công giá trị: '.$r->var_name);
    }

    //variant
    function GetAddVariant($id){
        $data['product']= product::find($id);
        return view('backend.variant.addvariant',$data);
    }
    function PostAddVariant(request $r, $id){
        foreach($r->variant as $key => $value){
            $vari=variant::find($key);
            $vari->price=$value;
            $vari->save();
        }
        return redirect('/admin/product')->with('thongbao','Đã thêm biến thể thành công');
    }
    function GetEditVariant($id){
        $data['product']=product::find($id);
        return view('backend.variant.editvariant',$data);
    }
    function PostEditVariant(request $r, $id){
        foreach($r->variant as $key => $value){
            $vari=variant::find($key);
            $vari->price=$value;
            $vari->save();
        }
        return redirect('/admin/product')->with('thongbao','Đã sửa biến thể thành công');
    }
    function DelVariant($id){
       variant::destroy($id);
       return redirect()->back()->with('thongbao','Đã xóa biến thể thành công');
   }
}
