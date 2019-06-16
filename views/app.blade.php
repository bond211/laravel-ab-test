<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>A/B Tests: @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

    <style>
        body {
            margin-top: 2rem;
            margin-bottom: 4rem;
            background: #f5f2f0;
            color: #564b43;
        }

        .table {
            color: #231b15;
        }

        .num-info {
            opacity: 0.65;
            font-size: 0.65em
        }
    </style>
</head>
<body class="container">

<h1>@yield('title')</h1>

@yield('content')

</body>
</html>
