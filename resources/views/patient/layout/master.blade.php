<!DOCTYPE html>
<html lang="en" style="height:100vh">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('UI/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('UI/assets/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- CSS Files -->
    <link href="{{ asset('UI/assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
</head>

<body style="d-flex align-items-center height:100vh" >
    @include('patient.layout.navbar')
    
    @yield('content')
    @include('patient.layout.footer')
</body>

</html>
