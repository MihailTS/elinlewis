@extends('layouts.site')

@section('content')
    <div class="art-container">
        <div class="art-image">
            <a class="art-image__zoom" href="{{$art->file}}" data-lightbox="image-1" data-title="{{$art->name}}"><img class="art-image__img" src="{{$art->file}}"></a>
        </div>
        <div class="art-info">
            <h1>{{$art->name}}</h1>
            <p>{{$art->description}}</p>
        </div>
    </div>
@endsection