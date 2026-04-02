@extends('layouts.main')
@section('content')
    <h1>{{$title}}</h1>
    @foreach($properties as $property)
        <div>
            <h2>{{$property['title']}}</h2>
            <p>Cena {{$property['price']}}</p>

        </div>
    @endforeach

    @endsection
