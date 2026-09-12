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

            <div style="margin-bottom: 15px">
                <label for="description">Popis</label><br>
                <textarea id="description" name="description" rows="7"></textarea>
            </div>

            <div style="margin-bottom: 15px">
                <label for="property_type_id">Typ nehnuteľnosti</label><br>
                <select id="property_type_id" name="property_type_id">
                    <option value="">Vyberte typ</option>
                    @foreach($propertyTypes as $propertyType)
                        <option value="{{$propertyType->id}}">{{$propertyType->name}}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px">
                <label for="style_of_home_id>">Štýl nehnuteľnosti</label><br>
                <select id="style_of_home_id" name="style_of_home_id">
                    <option value="">Vyberte štýl</option>
                    @foreach($styleOfHomes as $styleOfHome)
                        <option value="{{$styleOfHome->id}}">{{$styleOfHome->name}}</option>
                    @endforeach
                </select>
            </div>

            <x-form-section-check
                title="Accessibility features" name="accesibility_features[]"
                :options="$accessibilityFeatures->pluck('name', 'id')->toArray()"
                :checked="[]">
            </x-form-section-check>

            <div style=margin-bottom:15px>
                <label for="rooms">Počet izieb</label><br>
                <input type="number" id="rooms" name="rooms">
            </div>

            <div style=margin-bottom:15px>
                <label for="baths">Počet kúpeľní</label><br>
                <input type="number" id="baths" name="baths">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="size">Rozloha m²</label><br>
                <input type="number" id="size" name="size">
            </div>

            <button type="submit">Uložiť</button>
        </form>
    </section>
@endsection
