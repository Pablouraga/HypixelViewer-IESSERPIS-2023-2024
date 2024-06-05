<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index') }}">HypixelViewer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('serverStats', session('username')) }}">Server Stats</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('auctionHistory', session('username')) }}">Auction History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('skyblockStats', session('username')) }}">Skyblock Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guildDetails', session('username')) }}">Guild Details</a>
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-0" action="{{ route('playerFind') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="username"></label>
                <input type="text" name="username" placeholder="Enter player name" class="form-control">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </form>

        <ul class="nav">
            @auth
                {{-- if user is admin, dashboard link --}}
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('messageList') }}" class="nav-link">Messages</a>
                </li>
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
