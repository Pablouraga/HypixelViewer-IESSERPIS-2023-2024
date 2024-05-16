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
        <form class="form-inline" action="{{ route('generalView') }}" method="GET">
            @csrf
            <div class="input-group">
                <label for="username"></label>
                <input type="text" name="username" placeholder="Enter player name" class="form-control">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </form>
    </li>
</ul>
