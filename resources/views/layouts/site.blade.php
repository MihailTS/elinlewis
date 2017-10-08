<!DOCTYPE "html">
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $pageTitle or 'Elin Lewis' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/header.css')}}" rel="stylesheet">
    <link href="{{asset('css/site.css')}}" rel="stylesheet">
    <link href="{{asset('slick/slick.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('slick/slick-theme.css')}}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="{{asset('lightbox/css/lightbox.css')}}" type="text/css" >
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
</head>
<body class="container border-container">
<div class="body-overlay container"></div>

<header>
    <div class="head-logo">
        <p class="head-logo__title"><span class="head-logo__title_painter">художница</span> Elin Lewis</p>
    </div>
    <nav role="navigation" class="head-menu navbar navbar-default ">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand visible-xs" href="#">Меню</a>
            </div>
            <?php $menuItems=[['Главная','/',false],['Галерея','/gallery',false],['ТерриCON!!!','/terricon',true],['Услуги','/service',false],['О художнице','/about',false],['Контакты','/contacts',false]];?>
            <div class="collapse navbar-collapse" id="navbar-main">
                <ul class="head-menu__list nav navbar-nav">
                    <?$menuOffsetY=-100?>
                    @foreach($menuItems as $menuIndex=>$menuItem)
                        <li style="background-position: <?echo $menuOffsetY;$menuOffsetY-=141?>px 0" class="head-menu__list-item{{($menuItem[2])?" head-menu__list-item_special":""}}{{(isset($selectedIndex) && $menuIndex==$selectedIndex)?" head-menu__list-item_selected":""}}"><a href="{{$menuItem[1]}}">{{$menuItem[0]}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="b-content">
@yield('content')
</div>

<footer>
    <a href="/winners"><div class="terricon_alert">
        <p style="font-size:1.3em">РЕЗУЛЬТАТЫ ЛОТЕРЕИ!</p>
        <p>В честь фестиваля ТерриCON</p>
    </div></a>

    <div class="copyright">
        © 2017 ElinLewis. Копирование материалов без разрешения автора запрещено. Все права защищены
    </div>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('slick/slick.min.js')}}"></script>
    <script src="{{asset('js/header.js')}}"></script>
    <script src="{{asset('lightbox/js/lightbox.js')}}"></script>
    <script src="{{asset('js/masonry.pkgd.min.js')}}"></script>
</footer>
</body>
</html>