<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
       // return 'selamat datang dihalaman utama via controller';
       return view("pages.home"); 
    }
}
