<div class="image-box-wrapper flex">
    @foreach($houses as $house)
        <a href="{{route('properties.show',$house)}}" class=" group block !text-black no-underline">
            <div class="main-image-box group transition-all cursor-pointer duration-300 ease-out group-hover:scale-[1.03]
    group-hover:-translate-y-1 group-hover:shadow-2xl group-hover:ring-2 group-hover:ring-offset-slate-500">
                <div class="h-60 overflow-hidden">

                    @if($house->mainImage)
                        <img src="{{ asset('storage/' . $house->mainImage->imagePath) }}" alt="{{$house->title}}"
                             class="h-full w-full object-cover transition-transform duration-300 ease-out group-hover:scale-105">

                    @else
                        <img src="{{ asset('img/house1.png')}}" alt="{{$house->title}}"
                             class="h-full w-full object-cover transition-transform duration-300 ease-out group-hover:scale-105">
                    @endif
                </div>
                <p>${{number_format($house->price,0, null, ',')}}</p>
                <span>{{$house->title}}, {{$house->location}}</span>
                <div class="rooms">
                    <i class="fa-solid fa-bath"></i> <span>{{$house->baths}}</span>
                    <i class="fa-solid fa-bed"></i> <span>{{$house->rooms}}</span>
                    <i class="fa-solid fa-arrows-alt"></i> <span>{{$house->size}}.ft²</span>
                </div>


            </div>
        </a>
    @endforeach

</div>

