@extends('layouts.app')
@section('content')
 <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h3>Просматривать список добавленных url-ов</h3>
            </div>
           
        </div>
    </div>
@if($message= Session::get('success'))
<div class="alert alert-success">
    <p>{{$message}}</p>
</div>
@endif



<a href="{{route('urlstore')}}" class="btn btn-info">Проверять все URL </a>
<a class="btn btn-primary my-2" href="{{route('url')}}">Список проверок</a>
<table class="table table-hover table-bordered">
    <thead class="table-light text-center">
        <th scope="col">#</th>
        <th scope="col">Дата создания</th>
        <th scope="col">Url</th>
        <th scope="col">частота проверки</th>
        <th scope="col">Количество повторов</th>
        <th scope="col">Проверять URL</th>
    </thead>
    <tbody>
        @foreach($urls as $url)
        <tr>
            <th scope="row">{{++$i}}</th>
            <td>{{$url->created_at}}</td>
            <td>{{$url->url}}</td>
            <td>{{$url->freq}} минут</td>
            <td>{{$url->count}}</td>
            <td class="text-center"><a href="{{route('urlstore',$url->id)}}" class="btn btn-primary">Проверять</a></td>

        
        </tr>
        @endforeach
    </tbody>

</table>

{{$urls->links('vendor.pagination.bootstrap-4')}}

@endsection