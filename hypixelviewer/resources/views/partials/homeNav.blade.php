<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index') }}">HypixelViewer</a>
            </li>
        </ul>
        <ul class="navbar-nav position-absolute end-0 pe-4">
            @auth
                <li class="nav-item">
                    <a href="{{ route('friendList') }}" class="nav-link">Friends</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('showProfile') }}">{{ Auth::user()->username }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('signup') }}">Sign up</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>
