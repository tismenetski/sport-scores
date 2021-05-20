@include('partials.header')
@include('partials.navbar')
<body>
@section('sidebar')
    <div class="sidenav">
        <a href="#">Home</a>
        <a href="#">Product</a>
        <a href="#">Service</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </div>
@show

<div class="container">
    @yield('content')
</div>
@include('partials.footer')
