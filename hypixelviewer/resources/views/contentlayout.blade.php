<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .skill-icon {
            width: 24px;
            height: 24px;
        }
    </style>
</head>

<body>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('index') }}">HypixelViewer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Server Stats</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Auction History</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Skyblock Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Guild Details</a>
        </li>
    </ul>
    @yield('content')
</body>

</html>
