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
<!--#D4B996FF fonas
#FBEEC1 irasai
background-color:#cbab80;  
-->
<body class="bg-white">
    @include('layouts.navigation')  
    <div class="container shadow-lg" style="padding:1em; background-color:#36527c;">
        <div class="panel-heading sm:rounded-lg mb-1" style="background-color:#BBADA0;">
            <h2 class="text-black ml-4" style="font-size:2.5em;">@yield('title')</h2>
            @yield('title-meta')
        </div>

        @yield('content')
        
        <div class="col-md-10 col-md-offset-1 mt-5">
            <p class="text-white">Copyright © 2022 | Rūta</p>
        </div>
    </div>
    
</body>
</html>
