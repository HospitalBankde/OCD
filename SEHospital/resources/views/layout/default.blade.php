<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Inculde javascript and css library -->
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::script('js/jquery-2.1.1.min.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::style('css/custom.css') !!}
    {!! Html::style('font-awesome/css/font-awesome.min.css') !!}
    <!-- Include custom script file for each page -->
    @yield('script')

    <!-- Title for each page -->
    @yield('title')

</head>
<body class="custom" style="background-color: #fefefe">

    <!-- Content for each page -->
    @yield('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</body>
</html>