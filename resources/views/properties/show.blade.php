@extends('layouts.main')
@section('content')
    <section class="main-section">
        <h1>{{$property->title}}</h1>

        <p><strong>Cena</strong> {{$property->price}}</p>
    </section>

@endsection
