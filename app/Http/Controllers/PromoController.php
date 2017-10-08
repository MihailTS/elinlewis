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

    public function winners(){
        $promo=Promocode::select("id","value","terricon_action_place")->orderBy('terricon_action_place','asc')->take(10)->get();
        $promo=$promo->shuffle();
        $vk_members=[["value"=>"Амира Яхья","terricon_action_place"=>5],
            ["value"=>"Максим Егоров","terricon_action_place"=>1],
            ["value"=>"Александр Собка","terricon_action_place"=>8],
            ["value"=>"Александр Михайлович","terricon_action_place"=>2],
            ["value"=>"Влад Приходько","terricon_action_place"=>6],
            ["value"=>"Егор Говоруха","terricon_action_place"=>3],
            ["value"=>"Михаил Целуйко","terricon_action_place"=>1001],
            ["value"=>"Элина Ардерихина","terricon_action_place"=>1000],
            ];
        shuffle($vk_members);
        $vk_members=json_encode($vk_members);
        return view('winners',["pageTitle"=>"Победители акции ТерриCON!","promoJson"=>$promo->toJson(),"vkJson"=>$vk_members]);
    }

    public function randomFillUnusedPromo(){
        $promocodes = Promocode::select(['id','terricon_action_place'])->get();
        $prize_count = 4;
        foreach($promocodes as $promo){
            $promo->terricon_action_place=rand($prize_count,$promocodes->count()+$prize_count);
            $promo->save();
        }
        return "Готово";
    }
}
