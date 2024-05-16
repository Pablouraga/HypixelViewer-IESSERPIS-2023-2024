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
</ul>
