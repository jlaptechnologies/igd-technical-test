<!DOCTYPE html>
<html lang="en-gb">
    <head>
        <title>@yield('title')</title>
        <style>
            @section('css')
            #main .navigation {
                width: 99vw;
            }
            #main .navigation > ul {
                display:flex;
                list-style:none;
            }
            #main .navigation > ul > li {
                margin: 0 10pt;
            }
            .marginTop20px {
                margin-top: 20px;
            }
            @show
        </style>
    </head>
    <body>
        <div id="main">
            <div class="navigation">
                <ul>
                    @foreach([
                        'mainScoreBoard' => 'Main Score Board',
                        'member.list' => 'Member List',
                        'game.list' => 'Game List',
                        'game.create' => 'Add Game Data',
                    ] as $route => $description)
                    <li><a href="{{ \route($route) }}">{{ $description }}</a></li>
                    @endforeach
                </ul>
            </div>
            @isset($errors)
                @if($errors->count() > 0)
                    @include('partials.errors.errorList', ['errors' => $errors])
                @endif
            @endisset
            @yield('content')
        </div>
        @yield('inlineJs')
    </body>
</html>
