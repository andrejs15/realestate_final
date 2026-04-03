
<div class="image-box-wrapper flex">
    @foreach($houses as $house)
    <div class="main-image-box">
        <img src="{{ asset('img/house1.png') }}" alt="" width="376" height="auto">
        <p>${{number_format($house->price,0, null, ',')}}</p>
        <span>{{$house->title}}, {{$house->location}}</span>
        <div class="rooms">
            <i class="fa-solid fa-bath"></i> <span>{{$house->baths}}</span>
            <i class="fa-solid fa-bed"></i> <span>{{$house->rooms}}</span>
            <i class="fa-solid fa-arrows-alt"></i> <span>{{$house->size}}.ft²</span>
        </div>
    </div>
    @endforeach
</div>

