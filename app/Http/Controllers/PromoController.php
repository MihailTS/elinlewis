<?php

namespace App\Http\Controllers;

use App\ActionMember;
use App\Promocode;
use Illuminate\Http\Request;
use \Illuminate\Support\Str;
use Illuminate\Cookie\CookieJar;

class PromoController extends Controller
{
    public function index(Request $request){
        $val = $request->cookie('promo');
        $alreadyMember=false;
        if($val=='Y'){
            $alreadyMember=true;
        }
        return view('promo',["pageTitle"=>"Акция ТерриCON!","alreadyMember"=>$alreadyMember]);
    }

    public function save(CookieJar $cookieJar, Request $request, array $rules, array $messages = [], array $customAttributes = []){
        $this->validate($request, [
            'vk' => 'required',
        ],[
            'vk.required' => 'Необходимо указать vk или ФИО',
        ]);
        $member=new ActionMember();
        $member->vk=$request->vk;
        $member->ip=$_SERVER["REMOTE_ADDR"];
        $promoValue=Str::lower($request->promo);
        $promo = Promocode::select(['id','value'])->where('value',$promoValue)->first();
        if($promo){
            $member->promo_id=($promo->id);
        }
        $member->save();

        $cookieJar->queue(cookie('promo', 'Y', 3600000));
        return redirect("/promo");
    }
}
