@extends('_global.html')

@section('style')
<link rel="stylesheet" href="{{ $asset->path }}/css/acme/cover.css" />
@stop

@section('page_title')
    Acme Cover
@stop()

@section('navbar')
@stop

@section('content')
    <style>
        body {
            padding: 0;
        }
    </style>
    <div class="site-wrapper">

        <div class="site-wrapper-inner">

            <div class="cover-container">

                <div class="masthead clearfix">
                    <div class="inner">
                        <h3 class="masthead-brand">Windwalker Cover Theme</h3>
                        <ul class="nav masthead-nav">
                            <li><a href="{{ $router->route('home') }}">Home</a></li>
                            <li class="active"><a href="#">Cover</a></li>
                        </ul>
                    </div>
                </div>

                <div class="inner cover">
                    @if (!$content->title)

                        <h2>{{ $content->title }}</h2>
                        <p>
                            {!! $content->text !!}
                        </p>
                        <p>
                            Congrats, you imported schema success. You can run this command to rollback:

                            <pre class="text-left"><code class="bash">$ php windwlaker migration migrate 0</code></pre>
                        </p>
                    @else
                        <h1>You havn't import DB content</h1>
                        <p>
                            Please run this command:

                            <pre class="text-left"><code class="bash">$ php windwlaker migration migrate --seed</code></pre>
                        </p>
                    @endif
                </div>

                <div class="mastfoot">
                    <div class="inner">
                        <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
                    </div>
                </div>

            </div>

        </div>

    </div>
@stop

@section('copyright')
@stop
