<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Intervention\Image;
use App\Art;
use App\ArtCategory;
class GalleryController extends Controller
{
    private $galleryIndex = 1;
    private $galleryLink = "/gallery/";
    private $galleryTitle = "Галерея";
    public function index(Request $request){
        $title=$this->galleryTitle;
        $artCategories = ArtCategory::select(['id','name','friendly_url'])->get();
        $arts = Art::select(['id','name','thumbnail','ratio'])->inRandomOrder()->get();
        return view('gallery',['items'=>$arts,'pageTitle'=>$title,"selectedIndex"=>$this->galleryIndex,"artCategories"=>$artCategories,"galleryLink"=>$this->galleryLink]);
    }
    public function category($categoryURL){
        $title=$this->galleryTitle;
        $artCategories = ArtCategory::select(['id','name','friendly_url'])->get();
        $currentCategory=ArtCategory::select(['id','name','friendly_url'])->where('friendly_url',$categoryURL)->first();
        if(isset($currentCategory)){
            $currentCategoryID=$currentCategory->id;
            $arts = Art::select(['id','name','thumbnail','ratio'])->whereHas("categories",function($query) use ($currentCategoryID){
                $query->where('category_id',$currentCategoryID);
            })->inRandomOrder()->get();
            $currentCategoryName=$currentCategory->name;
            $title.=": ".$currentCategoryName;
        }
        else{
            return redirect($this->galleryLink);
        }
        return view('gallery',['items'=>$arts,'pageTitle'=>$title,"selectedIndex"=>$this->galleryIndex,"currentCategoryID"=>$currentCategoryID,"artCategories"=>$artCategories,"galleryLink"=>$this->galleryLink]);
    }
    public function setAdminCookie(Request $request){
        $response = new \Illuminate\Http\Response(view('addArt'));
        $response->withCookie(cookie('admin_elf', "vMEbpymf2508!avatarKAWAII!", 45000));
        return $response;
    }
    public function add(Request $request){

        $val = $request->cookie('admin_elf');

        if(false && $val!="temporarypassword"){
            return redirect('/');
        }
        else{
            return view('addArt',["selectedIndex"=>$this->galleryIndex]);
        }
    }

    public function save(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $thumbWidth=600;
        $mainWidth=1280;
        $image = $request->file('image');
        $image->store("original_images");
        $originalImageSize=getimagesize($image->getRealPath());
        if($originalImageSize[0]!=0){
            $ratio=$originalImageSize[1]/$originalImageSize[0];
            $uploadingArt=new Art();
            $uploadingArt->name=$request->get('name');
            $uploadingArt->description=$request->get('description');
            $uploadingArt->ratio=$ratio;
            $heightWithSaveRatioThumb=intval($thumbWidth*$ratio);
            $heightWithSaveRatioMain=intval($mainWidth*$ratio);
            \Image::make($image->getRealPath())->fit($thumbWidth,$heightWithSaveRatioThumb)->save( storage_path("app/public/thumbnails").'/'.$image->hashName());//Thumbnail
            \Image::make($image->getRealPath())->fit($mainWidth,$heightWithSaveRatioMain)->save( storage_path("app/public/images").'/'.$image->hashName());//Main
            $uploadingArt->thumbnail="/storage/thumbnails/".$image->hashName();
            $uploadingArt->file="/storage/images/".$image->hashName();
            $uploadingArt->save();
            $message="Изображение добавлено!";
        }
        else{
            $message="Ошибка. Ширина изображения равна нулю";
        }
        $val = $request->cookie('admin_elf');
        if($val!="temporarypassword"){
            return redirect('/');
        }
        else{
            return view('addArt',['message'=>$message,"selectedIndex"=>$this->galleryIndex]);
        }
    }

    public function interlaceAllThumblains(){
        //interlace
        $arts = Art::select(['id','thumbnail'])->get();
        foreach($arts as $art){
            $thumbnailPath=storage_path("app/public/thumbnails").'/'.substr($art->thumbnail,20);
            \Image::make($thumbnailPath)->interlace()->save($thumbnailPath);
        }
        return "Готово";
    }
    public function addRatioToAll(){
        $arts = Art::select(['id','thumbnail'])->get();
        foreach($arts as $art){
            $thumbnailPath=storage_path("app/public/thumbnails").'/'.substr($art->thumbnail,20);
            $thumbImageSize=getimagesize($thumbnailPath);
            $ratio=$thumbImageSize[1]/$thumbImageSize[0];
            $art->ratio=$ratio;
            $art->save();
        }
        return "Готово";
    }
}
