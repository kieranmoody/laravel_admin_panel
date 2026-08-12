<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">

                <!-- Brand -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Company-Name Placeholder
                </a>

                <!-- Navigation -->
                <div class="navbar-collapse">
                    
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-end">

                        <!-- Authentication Links -->
                        @guest

                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        {{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        {{ __('Register') }}
                                    </a>
                                </li>
                            @endif

                        @else


                            <!-- Theme Toggle -->
                            <li class="nav-item ms-2">
                                <button id="theme-toggle"
                                        class="theme-toggle"
                                        type="button"
                                        aria-label="Toggle theme">

                                    <svg
                                        class="theme-icon"
                                        viewBox="0 0 100 100"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <!-- Sun -->
                                        <circle
                                            class="sun-core"
                                            cx="50"
                                            cy="50"
                                            r="20"
                                        />

                                        <!-- Sun Rays -->
                                        <g class="sun-rays">
                                            <line x1="50" y1="8" x2="50" y2="20"/>
                                            <line x1="50" y1="80" x2="50" y2="92"/>
                                            <line x1="8" y1="50" x2="20" y2="50"/>
                                            <line x1="80" y1="50" x2="92" y2="50"/>

                                            <line x1="21" y1="21" x2="30" y2="30"/>
                                            <line x1="70" y1="70" x2="79" y2="79"/>
                                            <line x1="21" y1="79" x2="30" y2="70"/>
                                            <line x1="70" y1="30" x2="79" y2="21"/>
                                        </g>

                                        <!-- Moon -->
                                        <path
                                            class="moon"
                                            d="M65 50a20 20 0 1 1-20-20a16 16 0 1 0 20 20z"
                                        />
                                    </svg>

                                </button>
                            </li>
                            <!-- User / Logout Dropdown -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"
                                   class="nav-link dropdown-toggle"
                                   href="#"
                                   role="button"
                                   data-bs-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false"
                                   v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end"
                                     aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form"
                                          action="{{ route('logout') }}"
                                          method="POST"
                                          class="d-none">
                                        @csrf
                                    </form>

                                </div>
                            </li>

                        @endguest

                    </ul>
                </div>

            </div>
        </nav>

        @yield('content')

    </div>
</body>
</html>