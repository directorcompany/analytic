@extends('layouts.app')
@section('content')
<h1 class="text-center">Создание ссылку на проверку</h1>
@if($message= Session::get('success'))
<div class="alert alert-success">
    <p>{{$message}}</p>
</div>
@endif
@auth



    <a href="{{route('manager')}}" class="btn btn-primary mx-4">Список добавленных</a>
    <a href="{{route('url')}}" class="btn btn-primary">Список проверок</a>
@endauth
<form method="POST" enctype = "multipart/form-data"  action="{{route('store')}}">
    @csrf
<div class="row container my-2">
        <div class=" my-2">
            <input type="text" class="form-control" name="url" placeholder="Введите url" aria-label="URL">
        </div>
        <div class="">
            <select class="form-select" name="freq" aria-label="Default select example">
                <option selected>Частота проверка</option>
                <option value="1">1 минут</option>
                <option value="5">5 минут</option>
                <option value="10">10 минут</option>
            </select>
        </div>
  <div class=" my-2">
    <input type="number"  class="form-control" name="count"  min="0" max="10"  placeholder="Количество попыток">
  </div>
  <div class="">
    <input type="submit" class="btn btn-primary" value="Отправить">
</div>
</div>
</form>
@endsection