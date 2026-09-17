@extends('layouts.main')
@section('content')
    <div class="fixed inset-0 z-10 flex items-center justify-center bg-gray-900/40 backdrop-blur-xs">

        <div class="max-h-[95vh] overflow-auto relative w-full max-w-[50vw] rounded-2xl bg-white p-4 pt-0 shadow-2xl">
            <a href="{{route('home')}}"
               class="absolute no-underline top-0 right-2 text-3xl hover:!text-black !text-gray-500 ">×</a>
            <div class="mb-6 ">
                <h1 class="text-2xl font-bold text-center mb-6">
                    Pridať novú nehnuteľnosť
                </h1>
                <p class="mt-2 text-sm text-gray-600">Vyplňte základné informácie o nehnuteľnosti</p>
                <div class="border-b border-gray-500 "></div>
            </div>

            <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="title" class="mb-2 block font-medium text-black">
                        Názov
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        maxlength="255"
                        class="w-full box-border rounded-md border border-gray-300 px-4 py-2 focus:outline-none
                        focus:ring-1 focus:ring-gray-500 transition duration-300"
                    >

                    @error('title')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    <div>
                        <label for="price" class="mb-2 block text-black">
                            Cena
                        </label>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="{{ old('price') }}"
                            required
                            min="0"
                            step="1"
                            class="w-full box-border rounded-md border border-gray-300 px-4 py-2 focus:outline-none
                            focus:ring-1 focus:ring-gray-500 transition duration-300"
                        >
                    </div>

                    <div>
                        <label for="location" class="mb-2 block text-black">
                            Lokalita
                        </label>

                        <input
                            type="text"
                            id="location"
                            name="location"
                            value="{{ old('location') }}"
                            required
                            maxlength="255"
                            class="w-full box-border rounded-md border border-gray-300 px-4 py-2 focus:outline-none
                            focus:ring-1 focus:ring-gray-500 transition duration-300"
                        >
                    </div>

                </div>

                <div class="mt-5">
                    <label for="description" class="block mb-2">Popis</label>

                    <textarea id="description" name="description" rows="5" required
                              maxlength="2000"
                              class="w-full resize-none box-border rounded-md border border-gray-300 px-4 py-2
                              focus:outline-none focus:ring-1 focus:ring-gray-500 transition
                              duration-300">{{old('description')}}</textarea>

                    <div class="-mt-1 text-right text-sm text-gray-400 opacity-70">
                        <span id="description-counter">2000</span> znakov zostáva
                    </div>

                    @error('description')
                    <p class="text-red-600 text-sm ">
                        {{$message}}
                    </p>
                    @enderror

                </div>

                <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2">

                    <div>
                        <label for="property_type_id" class="mb-2 block font-medium text-gray-700">
                            Typ nehnuteľnosti
                        </label>

                        <select
                            id="property_type_id"
                            name="property_type_id"
                            required
                            class="!w-full !max-w-none !rounded-md !border !border-gray-300 !px-4 !py-2
                   transition duration-300 ease-out
                   focus:border-black focus:outline-none focus:ring-1 focus:ring-black"
                        >
                            <option value="">Vyberte typ</option>

                            @foreach($propertyTypes as $propertyType)
                                <option
                                    value="{{ $propertyType->id }}"
                                    @selected(old('property_type_id') == $propertyType->id)
                                >
                                    {{ $propertyType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="style_of_home_id" class="mb-2 block font-medium text-gray-700">
                            Štýl nehnuteľnosti
                        </label>

                        <select
                            id="style_of_home_id"
                            name="style_of_home_id"
                            required
                            class="!w-full !max-w-none !rounded-md !border !border-gray-300 !px-4 !py-2 transition
                            duration-300 ease-out focus:border-black focus:outline-none focus:ring-1
                            focus:ring-black">
                            <option value="">Vyberte štýl</option>

                            @foreach($styleOfHomes as $styleOfHome)
                                <option
                                    value="{{ $styleOfHome->id }}"
                                    @selected(old('style_of_home_id') == $styleOfHome->id)
                                >
                                    {{ $styleOfHome->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div>
                        <label for="rooms" class="mb-2 block font-medium text-gray-700">
                            Počet izieb
                        </label>

                        <input
                            type="number"
                            id="rooms"
                            name="rooms"
                            value="{{ old('rooms') }}"
                            required
                            min="1"
                            step="1"
                            class="w-full box-border rounded-md border border-gray-300 px-4 py-2 focus:outline-none
                            focus:ring-1 focus:ring-gray-500 transition duration-300">

                        @error('rooms')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div>
                        <label for="baths" class="mb-2 block font-medium text-gray-700">
                            Počet kúpeľní
                        </label>

                        <input
                            type="number"
                            id="baths"
                            name="baths"
                            value="{{ old('baths') }}"
                            required
                            min="0"
                            step="1"
                            class="w-full box-border rounded-md border border-gray-300 px-4 py-2 focus:outline-none
                            focus:ring-1 focus:ring-gray-500 transition duration-300">

                        @error('baths')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="size" class="mb-2 block font-medium text-gray-700">
                            Rozloha m²
                        </label>

                        <input
                            type="number"
                            id="size"
                            name="size"
                            value="{{ old('size') }}"
                            required
                            min="1"
                            step="1"
                            class="w-full box-border rounded-md border border-gray-300 px-4 py-2 focus:outline-none
                            focus:ring-1 focus:ring-gray-500 transition duration-300">

                        @error('size')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="mt-5">
                    <p class="mb-2 font-medium text-gray-700">Accessibility features</p>
                    <div class="flex flex-wrap gap-2">

                        @foreach($accessibilityFeatures as $feature)

                            <label class="cursor-pointer">

                                <input type="checkbox" name="accessibility_features[]" value="{{ $feature->id }}"
                                       class="peer sr-only"
                                    @checked(in_array($feature->id, old('accessibility_features', [])))>

                                <span class="inline-flex rounded-full border border-gray-300 px-4 py-2
                                text-sm text-gray-600 transition duration-200 hover:border-gray-500
                                peer-checked:border-black peer-checked:bg-black peer-checked:text-white">
                                    {{ $feature->name }} </span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="mt-8 flex justify-end border-t border-gray-200 pt-5">

                    <button type="submit" class="rounded-md bg-blue-600 px-5 py-2 text-base font-semibold text-white
                    transition duration-200 hover:bg-blue-700 border-gray-300 border-1 cursor-pointer"
                    >Uložiť
                    </button>
                </div>

                <div class="mt-5">

                    <label class="mb-2 block font-medium text-gray-700">
                        Fotografie nehnuteľnosti
                    </label>

                    <label
                        for="images" class="flex cursor-pointer flex-col items-center justify-center rounded-lg border-2
                        border-dashed border-gray-300 px-4 py-6 text-center transition duration-200
                       hover:border-gray-500 hover:bg-gray-100">
                        <span class="text-sm font-medium text-gray-700">Kliknite pre výber fotografií</span>

                        <input
                            type="file" id="images" name="images[]" accept="image/*" multiple class="sr-only">
                    </label>

                </div>
            </form>
        </div>
    </div>
@endsection
