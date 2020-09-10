<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\models\product;
use Illuminate\Http\Request;
use Mail;

class HomeController extends Controller
{
    function GetIndex(){
        $data['product_featured']=product::Where('featured',1)->Where('img','<>','no-img.jpg')->take(4)->get();
        $data['product_new']=product::orderby('created_at','DESC')->Where('img','<>','no-img.jpg') ->take(8)->get();
        return view('frontend.index',$data);
    }
    function GetAbout(){
        
        return view('frontend.about');
    }
    function GetContact(){
        return view('frontend.contact');
    }
    
}
