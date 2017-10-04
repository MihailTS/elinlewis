@extends('layouts.site')

@section('content')
    <style>
        .promo-button{
            background: url(/storage/wood.PNG) no-repeat;
            color:white;
            outline:none;
            border:none;
            height: 50px;
            border-bottom: 2px solid #777;
            -webkit-box-shadow: -4px 4px 5px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: -4px 4px 5px 0px rgba(0,0,0,0.75);
            box-shadow: -4px 4px 5px 0px rgba(0,0,0,0.75);
            background-position: -241px 0;
        }
        .promo-input{
            padding-left:5px;
        }
        .promo-thanks{
            background: #2b542c;
            padding:20px;
        }
        .promo-thanks-text{
            font-size:1.1em;
            color:white;
            text-shadow:none;
        }
    </style>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Внимание, АКЦИЯ!</h1>
    <p>В честь фестиваля ТерриCON мы проводим акцию в которой Вы сможете получить постеры, скидки на услуги, наклейки, календари за счет заведения!</p>
    <p>Для участия необходимо выполнить 3 простых действия:</p>
    <ul>
        <li>Состоять в моей группе vk - <a style="color:wheat" href="https://vk.com/elventavern">Elven Tavern</a></li>
        <li>Заполнить форму ниже.</li>
        <li>Если у вас нет промокода - репостните <a style="color:wheat" href="https://vk.com/elventavern?w=wall-123633124_494">ЗАПИСЬ ОБ АКЦИИ</a> в моей <a style="color:wheat" href="https://vk.com/elventavern">таверне</a>!</li>
        <li>Дождаться результата!</li>
    </ul>
    <p>Более подробная информация о призах <a style="color:wheat" href="https://vk.com/elventavern?w=wall-123633124_494">здесь</a>! Возможны небольшие изменения, так что заходите к нам почаще!:)</p>
    <br>
    @if(!$alreadyMember)
        <form method="post">
            <div><label><input class="promo-input" required type="text" name="vk" placeholder="Ссылка на VK"/> - Укажите ссылку на vk или ваше ФИО, чтоб нам было известно - кто из подписчиков победитель!</label></div>
            <div><label><input class="promo-input "type="text" name="promo" placeholder="Промокод"/> - Позволит поучаствовать в розыгрыше особых призов</label></div><br>
            <div><input class="promo-button" type="submit" name="subm" value="Принять участие"/></div>
             {!! csrf_field() !!}
        </form>
    @else
        <div class="promo-thanks">
            <p class="promo-thanks-text">Спасибо за участие в акции! Результаты будут скоро, нужно лишь немножко подождать!</p>
        </div>
    @endif
@endsection