
<section class="main-section">
    <div class="main-header flex">
        <h3>Showing {{$properties->count()}} search results</h3>
        <div class="sort-container flex">
            <span class="sort-label">Sort by:</span>
            <select id="sort-select">
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
                <option value="popular">Popular</option>

            </select>
        </div>
    </div>
@foreach($properties->chunk(2) as $propertyGroup)
    <div class="main-image-section flex">
        <x-main-image-box :houses="$propertyGroup"/>
    </div>
    @endforeach
</section>

