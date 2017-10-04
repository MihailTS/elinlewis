@extends('layouts.site')

@section('content')
    @isset($message)
        <div style="margin-bottom:30px; color: greenyellow">
            {{$message}}
        </div>
    @endisset
    <h2>Добавление изображения в галерею</h2>
    <style>
        input{
            color:black;
            margin-bottom:20px;
        }
        input[type="file"]{
            color:white;
        }
    </style>
    <form enctype="multipart/form-data" method="post">
        <div><input required type="text" name="name" placeholder="Имя"/></div>
        <div><input required type="text" name="description" placeholder="Описание"/></div>
        <div><label>Изображение<input required type="file" name="image"/></label></div>
        <div><input style="height:50px;color:black" type="submit" name="subm" value="Добавить картинку"/></div>
         {!! csrf_field() !!}
    </form>
@endsection