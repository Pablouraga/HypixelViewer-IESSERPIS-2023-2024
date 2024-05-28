<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse">
        <ul class="nav">
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
            <li class="nav-item ml-auto">
                <form class="form-inline" action="{{ route('playerFind') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label for="username"></label>
                        <input type="text" name="username" placeholder="Enter player name" class="form-control">
                        <button type="submit" class="btn btn-outline-secondary">Search</button>
                    </div>
                </form>
            </li>
        </ul>
        <ul class="navbar-nav position-absolute end-0 pe-4">
            @auth
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
