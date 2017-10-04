<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index(){
        return view('service',["pageTitle"=>"Услуги","selectedIndex"=>3]);//,['locale'=>'ru']);
    }
}
