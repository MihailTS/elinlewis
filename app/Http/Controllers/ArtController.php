<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Art;
class ArtController extends Controller
{
    private $galleryIndex = 1;
    private $galleryLink = "/gallery/";
    private $galleryTitle = "Галерея";
    public function index($id){
        //$title=$this->galleryTitle;
        $art = Art::select(['id','description','name','file','views_count'])->where('id',$id)->first();
        if(!$art){
            return redirect($this->galleryLink);
        }
        else{
            if($_SERVER['REMOTE_ADDR']!='46.150.108.117') {
                $art->views_count += 1;
                $art->save();
            }
            $this->galleryTitle.=" - ".$art->name;
            return view('art',['pageTitle'=>$this->galleryTitle,'art'=>$art,"selectedIndex"=>$this->galleryIndex,"galleryLink"=>$this->galleryLink]);
        }
    }
}
