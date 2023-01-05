<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite(['resources/css/app.scss', 'resources/js/app.ts'])
    @yield('import')
</head>
<body>

    {{-- CSRF Field --}}
    <input type="hidden" name="" id="csrf" value="{{ csrf_token() }}">

    <div class="modal" tabindex="100" id="loading-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Loading</h5>
                </div>
                <div class="modal-body">
                    <p>Please Wait</p>
                </div>
            </div>
        </div>
    </div>

    @yield('alerts')

    <nav class="navbar navbar-expand-sm navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/"><b>Todolist</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="bi bi-list"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0 pt-3 pb-1">
                    @auth
                    <li class="nav-item ps-3 pe-3 pt-1 pb-1">
                        <a class="nav-link" href="#">{{ Auth::user()->username }}</a>
                    </li>
                    <li class="nav-item ps-3 pe-3 pt-1 pb-1">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                    @else
                    <li class="nav-item ps-3 pe-3 pt-1 pb-1">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                    <li class="nav-item ps-3 pe-3 pt-1 pb-1">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container custom-container">
        @yield('content')
    </div>

</body>
</html>
