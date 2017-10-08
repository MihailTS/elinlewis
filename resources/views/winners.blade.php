@extends('layouts.site')

@section('content')
    <style>
        .moving-item {
            transition: all 1s ease;
            -webkit-transition: all 1s ease;
        }
        .winner-list__item_gold{
            box-shadow: 0px 0px 15px 7px #ffd700;
        }
        .winner-list__item_silver{
            box-shadow: 0px 0px 15px 7px #c0c0c0;
        }
        .winner-list__item_bronze{
            box-shadow: 0px 0px 15px 7px #cd7f32;
        }
        .winner-description{
            font-size:1.4em;
        }
        .winner-list__item{
            -moz-filter: blur(2px);
            -webkit-filter: blur(2px);
            -o-filter: blur(2px);
            -ms-filter: blur(2px);
        }
        .winner-list__item.winner-list__item_prize{
            font-size:1.6em;
            width:300px;
            height:50px;
            text-align:center;
            cursor: pointer;

            -moz-filter: none;
            -webkit-filter: none;
            -o-filter: none;
            -ms-filter:none;
        }
        .winner-button{
            transition:0.5s;
            display:inline-block;
            margin-bottom:10px;
            background: #ff0000;
            width:50%;
            padding:10px;
            border-radius:10px;
            color:white;
            outline:black;
            border:1px solid black;
            border-bottom:3px solid black;
            font-size:1.5em;
        }
        .winner-button:active,.winner-button.focus{
            border-bottom:none;
            border-top:4px solid black;
        }
        .winner-list {
            list-style-type: none;
            padding: 0;
            height:600px;
            position: relative;
        }
        .winner-list__item {
            position: absolute;
            border: 1px solid #122b40;
            height: 40px;
            width: 200px;
            background: url(/storage/wood.PNG) no-repeat;
            padding: 10px;
            margin-bottom: 10px;
            color: white;
        }
        .winner-subtitle{
            font-size:1.5em;
            margin-bottom:15px;
            text-decoration: underline;
        }
        .vk-winner__item{
            position:static;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.4/vue.js"></script>
    <h1>Результаты лотереи в честь фестиваля ТерриCON</h1>
    <div class="winner-description">
        <p>Итак, лотерея подошла к концу! И победители уже известны! Вы можете их увидеть вот <a href="https://vk.com/elventavern?w=wall-123633124_511">по этой ссылке</a> или на <a href="https://vk.com/elventavern?z=video-123633124_456239020">этом видео</a>.</p>
        <p>Ну или прямо на этой странице, нажав на кнопку ниже.</p>
    </div>
    <div  id="app" class="row">
        <div style="text-align:center;" class="col-md-12">
                <button class="winner-button" v-if="!winner" @click="changeOrder">Узнать кто же победил!!!</button>
                <div  style="margin:20px" class="winner-description" v-if="winner">
                    Поздравляю победителей!:) Прошу <a href="/contacts">написать мне</a> и получить свой приз!
                </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="winner-subtitle" v-if="winner">Победителями становятся обладатели промокодов:</div>
            <ul class="winner-list">
                <li class="winner-list__item moving-item" v-for="item in items" :class="((item.prize))"  :style="{ top: (item.position * 60) + 'px','background-position':(item.position * -85) + 'px -10px'}">@{{ item.value }}</li>
            </ul>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="winner-subtitle" v-if="winner" >А также поделившиеся записью о конкурсе:</div>
            <ul class="winner-list">
                <li class="winner-list__item moving-item" v-for="item in vkItems" :class="((item.prize))"  :style="{ top: (item.position * 60) + 'px','background-position':(item.position * -85) + 'px -10px'}">@{{ item.value }}</li>
            </ul>
        </div>
    </div>
    <script>
        var promoJson={!!$promoJson or "[]"!!};
        promoJson.forEach(function (item, index) {
            item.position = index;
            item.prize=false;
        });
        var vkJson={!!$vkJson or "[]"!!};
        vkJson.forEach(function (item, index) {
            item.position = index;
            item.prize=false;
        });

        var setPosition=function (item, index) {
            item.position = index;
            switch(index){
                case 0:
                    item.prize="winner-list__item_prize winner-list__item_gold";
                    break;
                case 1:
                    item.prize="winner-list__item_prize winner-list__item_silver";
                    break;
                case 2:
                    item.prize="winner-list__item_prize winner-list__item_bronze";
                    break;
                default:
                    item.prize="winner-list__item_no-prize";
            }
        };
        var sortByPlace=function (a, b) {
            if (a.terricon_action_place > b.terricon_action_place) return 1;
            else if (a.terricon_action_place < b.terricon_action_place) return -1;
            else return 0;
        };
        new Vue({
            el: '#app',
            data: {
                winner: false,
                items:promoJson,
                vkItems:vkJson
            },
            methods: {
                changeOrder: function (event) {
                    var self = this;
                    self.winner = true;
                    var newItems = self.items.slice().sort(sortByPlace);
                    var newVkItems = self.vkItems.slice().sort(sortByPlace);
                    newItems.forEach(setPosition);
                    newVkItems.forEach(setPosition);
                }
            }
        });

    </script>
@endsection