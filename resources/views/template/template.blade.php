<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title') | Zoo</title>

    <!-- Bootstrap -->
    {{Html::style('assets/css/bootstrap.min.css')}}
    {{Html::style('assets/css/custom-style.css')}}

</head>
<body>

    @include('template.partial.navigation')
    <div class="container">
        @include('template.partial.alerts')
        @yield('content')
    </div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{Html::script('assets/js/bootstrap.min.js')}}

</body>
</html>
