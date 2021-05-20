<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{

    public function about(){
        return view('test.about');
    }

    public function sidebar(){
        return view('sidebar');
    }

}
