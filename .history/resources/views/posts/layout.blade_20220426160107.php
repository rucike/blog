<!DOCTYPE html>
<html>
<head>
    <title>Laravel projektas </title>
        <!--Template based on URL below-->
        <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Place your stylesheet here-->
        <link href="/css/stylesheet.css" rel="stylesheet" type="text/css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    @include('layouts.navigation')  
    <div class="container shadow-lg " style="padding:1em;">
        <div class="panel-heading bg-secondary" style="height:50px;">
            <h5 class="text-white text-center">@yield('title')</h5>
            @yield('title-meta')
        </div>
        @yield('content')
        <div class="col-md-10 col-md-offset-1">
        <p>Copyright © 2022 | Rūta</p>
        </div>
    </div>
    
</body>
</html>
