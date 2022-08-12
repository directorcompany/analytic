@extends('layouts.app')
@section('content')
 <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h3>Просматривать список проверенных url-ов</h3>
            </div>
           
        </div>
    </div>
@if($message= Session::get('success'))
<div class="alert alert-success">
    <p>{{$message}}</p>
</div>
@endif


<a href="{{route('manager')}}" class="btn btn-primary my-2">Список добавленных</a>

<table class="table  table-hover table-bordered">
    <thead class="table-light text-center">
        <th scope="col">#</th>
        <th scope="col">Дата проверки</th>
        <th scope="col">Url</th>
        <th scope="col">http-код</th>
        <th scope="col">номер попытки</th>
    </thead>
    <tbody>
        @foreach($urls as $url)
        <tr>
            <th scope="row">{{++$i}}</th>
            <td>{{$url->created_at}}</td>
            <td>{{$url->url}}</td>
            <td>{{$url->http}}</td>
            <td>{{$url->number}}</td>
            </tr>
        @endforeach
    </tbody>

</table>


{!! $urls->links('vendor.pagination.bootstrap-4') !!}
@endsection