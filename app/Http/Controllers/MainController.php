<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Art;

class MainController extends Controller
{
    public $mainIndex=0;
    public function index(){
        $sliderArts=Art::select(['id','name','thumbnail','ratio'])->limit(20)->inRandomOrder()->get();
        return view('main',["selectedIndex"=>$this->mainIndex,"sliderArts"=>$sliderArts]);
    }
}
