<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function GetComment(){
        return view('backend.comment.comment');
    }
    function GetEditComment(){
        return view('backend.comment.editcomment');
    }
}
