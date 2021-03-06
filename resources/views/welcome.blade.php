<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url("{{asset('images/main.jpg')}}");
                -moz-background-size: 100% 100%;
                -webkit-background-size: 100% 100%;
                -o-background-size: 100% 100%;
                background-size: 100% 100%;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > strong a {
                color: white;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-transform: uppercase;
                text-decoration: none;
                cursor: pointer;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    @if(Auth::user()->isDisabled())
                        <strong><a href="{{url('/')}}">Home</a></strong>
                    @elseif(Auth::user()->isUser())
                        <strong><a href="{{url('/user/index')}}">User Account</a></strong>
                    @elseif(Auth::user()->isGuest())
                        <strong><a href="{{url('/')}}">Home</a></strong>
                    @elseif(Auth::user()->isAdmin())
                        <strong><a href="{{url('/admin/index')}}">Admin Account</a></strong>
                        <strong><a href="{{url('/')}}">Home</a></strong>
                    @endif
                    <strong>
                        <a class="dropdown-item" href="{{route('logout')}}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit()"> Logout
                        </a>
                    </strong>
                    <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none">
                        @csrf
                    </form>
                    @else
                        <strong><a href="{{ route('login') }}">Login</a></strong>
                        @if (Route::has('register'))
                        <strong><a href="{{ route('register') }}">Register</a></strong>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>
