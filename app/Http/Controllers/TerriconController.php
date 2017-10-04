<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TerriconController extends Controller
{

    public function index(){
        return view('terricon', ["pageTitle"=>'ТерриCON',"selectedIndex" => 2]);
    }
}
