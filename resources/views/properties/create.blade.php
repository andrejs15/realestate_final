@extends('layouts.main')

@section('content')
    <section class="main-section">
        <h1>Pridať novú nehnuteľnosť</h1>

        <form action="{{route('properties.store')}}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="title">Názov</label><br>
                <input type="text" id="title" name="title">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="price">Cena</label><br>
                <input type="number" id="price" name="price">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="location">Lokalita</label><br>
                <input type="text" id="location" name="location">
            </div>

            <button type="submit">Uložiť</button>
        </form>
    </section>
@endsection
