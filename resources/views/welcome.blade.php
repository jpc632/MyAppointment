<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MyAppointment</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <!-- Fonts -->
       
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 

        <!-- Styles -->
        <link href="{{asset('css/welcome.css')}}" rel="stylesheet" />

        
    </head>
    <body class="antialiased d-flex bg-gradient-secondary">
        <nav class="navbar navbar-light fixed-top">
            <a class="navbar-brand mx-auto" href="#"><img src="images/applogo.png" alt=""></a>
            {{-- @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endif
                </div>
            @endif --}}
        </nav>
        <div class="container-fluid d-flex flex-column justify-content-center align-self-center text-light">
            <div class="p-4 text-center">
                <h1>MyAppointment</h1>
                <p>Book your next doctor's appointment, fast and easy.</p>
            </div>
            <div class="d-flex align-self-center p-2 justify-content-center">
                <div class="m-2">
                    <a href="{{ url('/home') }}" class="text-decoration-none">
                        <button type="button" class="btn btn-outline-light ">Login</button>
                    </a>
                </div>
                <div class="m-2">
                    <a href="{{ route('register') }}" class="text-decoration-none">
                        <button type="button" class="btn btn-outline-light ">Register</button>
                    </a>
                </div>
                
            </div>
            
        </div>
        <!--   Core JS Files   -->
        <script src="{{asset('UI/assets/js/core/jquery.min.js')}}"></script>
        <script src="{{asset('UI/assets/js/core/popper.min.js')}}"></script>
        <script src="{{asset('UI/assets/js/core/bootstrap-material-design.min.js')}}"></script>
        <script src="{{asset('UI/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>

    </body>
</html>
