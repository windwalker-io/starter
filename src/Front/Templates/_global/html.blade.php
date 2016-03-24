{{-- Part of Windwalker project. --}}
<!doctype html>
<html lang="{{ $app->get('language.locale') ? : $app->get('language.default', 'en-GB') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">

    <title>{{ \Phoenix\Html\HtmlHeader::getPageTitle() }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ $uri['media.path'] }}images/favicon.ico" />
    <meta name="generator" content="Windwalker Framework" />
    {!! \Phoenix\Html\HtmlHeader::renderMetadata() !!}
    @yield('meta')

    {!! \Phoenix\Asset\Asset::renderStyles(true) !!}
    @yield('style')

    {!! \Phoenix\Asset\Asset::renderScripts(true) !!}
    @yield('script')
    {!! \Phoenix\Html\HtmlHeader::renderCustomTags() !!}
</head>
<body class="package-{{ $package->name }} {{ $helper->page->getClass($view) }}" style="padding-top: 50px">
    @section('navbar')
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ $router->html('home') }}">Windwalker</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    @section('nav')
                        <li class="active"><a href="{{ $router->html('home') }}">Home</a></li>
                    @show

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Category
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($categories as $category)
                            <li>
                                <a href="{{ $router->html('article_category', array('path' => $category->path)) }}">
                                    {{ str_repeat('-', $category->level - 1) }}
                                    {{ $category->title }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    {{-- <li class="pull-right"><a href="{{ $uri['base.path'] }}admin">Admin</a></li> --}}
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
    @show

    @section('message')
        {!! \Windwalker\Core\Widget\WidgetHelper::render('windwalker.message.default', array('flashes' => $flashes)) !!}
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
{!! \Phoenix\Asset\Asset::getTemplate()->renderTemplates() !!}
</body>
</html>
