<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>PasteBin</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style>
            .container {
                max-width: 960px;
              }

              .border-top { border-top: 1px solid #e5e5e5; }
              .border-bottom { border-bottom: 1px solid #e5e5e5; }
              .border-top-gray { border-top-color: #adb5bd; }

              .box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }

              .lh-condensed { line-height: 1.25; }
        </style>
    </head>
    <body class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Последние пасты</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach ($pastes as $paste)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <a href="{{$paste->hash}}">
                                {{$paste->name}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>
