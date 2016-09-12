<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
            background-color: transparent !important; 
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
	<div class="col-md-5">
		{!! Helpers::render_destinations(array($destination) , 'col-md-9')  !!}
	</div>
        <!-- JavaScripts -->
<script src="{{ elixir('js/app.js') }}"></script>

@yield('app-js')
</body>
</html>
