<!DOCTYPE html>
<html lang="sk">
<head>
    @include('partials.header')
</head>
<body>
<div class="content flex">
    <div class="content-box ">
        <header class="flex">
            @include('partials.menu')
        </header>
        <main class="flex">
            @include('partials.left-bar')
            @yield('content')

        </main>
    </div>
    <button id="toggle-map" class="fa fa-map-marker"></button>
    <div class="sidebar" id="sidebar-section">
        <img src="{{asset('img/map.png')}}" alt="" width="463">
    </div>


</div>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
