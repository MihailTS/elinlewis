@extends('layouts.site')

@section('content')
    <div class="gallery">
        <div class="gallery-categories">
            <?
            $categoryOffsetY=-150;
            ?>
            @foreach($artCategories as $category)
                    <?$isCurrentCategory=(!empty($currentCategoryID) && $category->id==$currentCategoryID);?>
                    <a class="gallery-categories__item-container" href="{{$galleryLink}}{{($isCurrentCategory || empty($category->friendly_url))?"":$category->friendly_url}}">
                        <div class="gallery-categories__item{{$isCurrentCategory?" gallery-categories__item_current":""}}" style="background-position: <?echo $categoryOffsetY;$categoryOffsetY-=112?>px 0">
                            {{$category->name}}
                        </div>
                    </a>
            @endforeach
        </div>
        <div class="gallery-item-container">
            @foreach($items as $item)
                <div class="{{--col-md-3 col-sm-6 col-xs-6 --}}gallery-item">
                    <a class="gallery-item__link" href="/art/{{$item->id}}">
                        <img class="gallery-item__img" width=100% height=auto src="{{!empty($item->thumbnail)?$item->thumbnail:$item->file}}" alt="{{$item->name}}">
                        <div class="gallery-item__name">
                            {{$item->name}}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection