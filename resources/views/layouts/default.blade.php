<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.head')
</head>

<body>

<header>
    @include('includes.header')
</header>

<div class="container">

    <div id="main" class="row">
        @yield('content')
    </div>

    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        @include('includes.footer')
    </footer>
</div>


</body>

</html>
