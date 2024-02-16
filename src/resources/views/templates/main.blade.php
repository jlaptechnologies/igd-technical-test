<!DOCTYPE html>
<html lang="en-gb">
    <head>
        <title>@yield('title')</title>
        <style>
            @section('css')
            #main .navigation {
                width: 100vw;
            }
            #main .navigation > ul {
                display:flex;
                list-style:none;
            }
            #main .navigation > ul > li {
                margin: 0 10pt;
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
                        'member.list' => 'Member List'
                    ] as $route => $description)
                    <li><a href="{{ \route($route) }}">{{ $description }}</a></li>
                    @endforeach
                </ul>
            </div>
            @yield('content')
        </div>
    </body>
</html>
