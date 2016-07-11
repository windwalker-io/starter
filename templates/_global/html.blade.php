{{-- Part of Windwalker project. --}}
<!DOCTYPE html>
<html lang="{{ $app->get('language.locale') ? : $app->get('language.default', 'en-GB') }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('page_title')</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ $uri->path }}/asset/images/favicon.ico" />
    <meta name="generator" content="Windwalker Framework" />
    @yield('meta')

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $uri->path }}/asset/css/main.css" />
    {!! $asset->renderStyles(true) !!}
    @yield('style')

    <script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    @yield('script')
    {!! $asset->renderScripts(true) !!}
</head>
<body>
    @section('navbar')
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="@route('home')">
                    <img src="https://cloud.githubusercontent.com/assets/1639206/2870854/176b987a-d2e4-11e3-8be6-9f70304a8499.png" alt="Windwalker LOGO" />
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                     @section('nav')
                        <li class="active"><a href="@route('home')">Home</a></li>
                     @show
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    {{-- <li class="pull-right"><a href="{{ $uri->path }}/admin">Admin</a></li> --}}
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
    @show

    @section('message')
        @messages()
    @show

    @yield('content', 'Content')

    @section('copyright')
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <hr />

                    <footer>
                        &copy; Windwalker {{ $datetime->format('Y') }}
                    </footer>
                </div>
            </div>
        </div>
    </div>
    @show

{!! $asset->getTemplate()->renderTemplates() !!}
</body>
</html>
