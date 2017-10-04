@extends('layouts.site')

@section('content')
    <div class="quote row col-md-8">
        <div class="quote-left col-md-3 col-xs-3 col-md-offset-0 col-xs-offset-0">
            <div class="quote-image"></div>
            {{--<div class="quote-info">
                <div class="quote-note">
                    <a href="https://vk.com/elinlewis">https://vk.com/elinlewis</a>
                </div>
            </div>--}}
        </div>
        <div class="quote-text col-md-9 col-xs-9">
            - Что я больше всего ценю в творчестве?<br>Самобытность, оригинальность и стремление к саморазвитию!<br>
        </div>
    </div>
    <div class="art-slider row col-md-12">
        @foreach($sliderArts as $art)
            <a href="/art/{{$art->id}}" style="/*background:url() no-repeat;background-size:contain;*/" class="art-slider__item">
                <div class="art-slider__item-overlay"></div>
                <img height=300px width={{($art->ratio>0)?round(300/$art->ratio):"auto"}} src="{{$art->thumbnail}}">
                <div class="art-slider__item-overlay-name">{{$art->name}}</div>
            </a>
        @endforeach
    </div>
@endsection