<!DOCTYPE html>
<html lang="{{ $app->config('language.locale') ? : $app->config('language.default', 'en-GB') }}">
<head>
    <base href="{{ $uri::normalize($uri->path .  '/') }}" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>@yield('page_title', 'Windwalker')</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ $asset->path('images/favicon.ico') }}"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta name="generator" content="Windwalker Framework"/>
@yield('meta')

{!! $asset->renderCSS(true) !!}
@yield('style')
@stack('style')
</head>
<body class="@yield('body_class')" style="">
@section('header')

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="https://cloud.githubusercontent.com/assets/1639206/2870854/176b987a-d2e4-11e3-8be6-9f70304a8499.png"
                        alt="Windwalker LOGO"
                        style="max-height: 35px; filter: invert(100)"
                    />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
@show

{{--@section('message')--}}
{{--    @messages()--}}
{{--@show--}}

@yield('content', 'Content')

@section('copyright')
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <hr />

                    <footer>
                        &copy; Windwalker {{ $chronos->localNow('Y') }}
                    </footer>
                </div>
            </div>
        </div>
    </div>
@show

{{-- Bottom Scripts --}}
{!! $asset->getTeleport()->render() !!}
{!! $asset->getImportMap()->render() !!}
{!! $asset->renderJS(true) !!}
@yield('script')
@stack('script')

</body>
</html>
