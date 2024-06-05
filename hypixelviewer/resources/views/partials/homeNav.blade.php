<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index') }}">HypixelViewer</a>
            </li>
        </ul>
        <ul class="nav">
            @auth
                {{-- if user is admin, dashboard link --}}
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    </li>
                @endif
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
