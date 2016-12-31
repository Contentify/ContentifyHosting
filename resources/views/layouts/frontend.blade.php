<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @section('styles')
        <!-- stylesheets -->
        <link rel="stylesheet" href="{{ elixir('assets/frontend/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/semantic/semantic.min.css') }}">

        <!-- Flash Message -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/vendor/messenger/messenger.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/vendor/messenger/messenger-theme-flat.css') }}">
    @show

    @section('scripts')
        <!-- javascript -->
        <script src="{{ asset('http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/vendor/semantic/semantic.min.js') }}"></script>

        <!-- Flash Message -->
        <script src="{{ asset('assets/frontend/js/vendor/messenger/messenger.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/vendor/messenger/messenger-theme-flat.js') }}"></script>
        <script type="text/javascript">
            Messenger.options = {
                extraClasses: 'messenger-fixed messenger-on-bottom messenger-on-right',
                theme: 'flat'
            }
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    @show
    
</head>
<body>
    <div id="app">
        <div class="ui menu">
            <div class="ui container">
                <div class="header item borderless">Laravel</div>
            
                <div class="right menu">
                @if(Auth::guest())
                    <a href="{{ url('/login') }}" class="item borderless">Login</a>
                    <a href="{{ url('/register') }}" class="item borderless">Register</a>
                @else
                    <div class="ui dropdown item borderless" tabindex="0">
                        {{ Auth::user()->name }}
                        <i class="dropdown icon"></i>
                        <div class="menu transition hidden" tabindex="-1">
                            <a href="{{ url('/user/'.Auth::user()->email.'/edit') }}" class="item">Edit Profile</a>                    
                            @if (Auth::User()->isAdmin())
                                <a href="{{ url('/backend') }}" class="item">Admin Backend</a>
                                <div class="divider"></div>
                            @else
                                <div class="divider"></div>
                            @endif
                            <a href="{{ url('/logout') }}" class="item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>

        @include('alert')

        @yield('content')
    </div>
    <script type="text/javascript">
        // initialize dropdown
        $('.ui.dropdown')
            .dropdown()
        ;
    </script>
</body>
</html>
