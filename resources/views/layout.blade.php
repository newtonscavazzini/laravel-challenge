<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    @yield('css')

    <link href="{{ URL::asset('css/layout.css') }}" rel="stylesheet" media="screen">

    <title>@yield('title', 'OW Calendar')</title>

</head>
<body>

    <div class="container">

        <nav  class="navbar header-navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/"><i class="fa fa-calendar"></i> OW Calendar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                @if (Auth::check())

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item  {{ (request()->is('/')) ? 'active' : '' }}">
                            <a class="nav-link" href="/">Dashboard</a>
                        </li>
                        <li class="nav-item {{ (request()->is('events/import-export')) ? 'active' : '' }}">
                            <a class="nav-link" href="/events/import-export">Import & Export events</a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center">

                        <a href="/profile" title="Edit your profile" class="btn">
                            <small><i class="fa fa-user-circle"></i> {{Auth::user()->name}}</small>
                        </a>

                        <form action="/logout" method="post">
                            {{ csrf_field() }}
                            <button title="Logout" class="btn btn-sm btn-danger"
                                    style="border-radius: 5px;" type="submit">
                                <i class="fa fa-sign-out"></i>
                            </button>
                        </form>

                    </div>

                @endif

            </div>
        </nav>

        <ol class="breadcrumb header-breadcrumb">
            @yield('breadcrumb')
        </ol>

        <div class="mb-3">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @yield('content')
        </div>

        <div class="text-right text-muted mb-2">
            v.0.0.1
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    @yield('scripts')

</body>
</html>
