@extends('layouts.general')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    <h1 class="text-center">{{ session('username') }}</h1>
    <div class="container mt-3">
        <div class="section-buttons row">
            <button class="btn btn-primary col mx-3 auction-history-btn"
                onclick="showContent('auction-history')">Auctions</button>
            <button class="btn btn-outline-primary col mx-3 bid-history-btn"
                onclick="showContent('bid-history')">Bids</button>
        </div>

        @if (isset($auctionsData))
            <div class="card mt-3 d-block" id="auction-history">
                <div class="card-body">
                    <h5 class="card-title">Auction History</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($auctionsData as $item)
                                <tr>
                                    <td>{{ $item['itemName'] }}</td>
                                    <td>
                                        @if ($item['highestBid'] == 0)
                                            Not sold
                                        @else
                                            {{ number_format(round((float) $item['highestBid'], 2), 2, '.', ',') }}
                                        @endif
                                    </td>
                                    {{-- Cambio de formato de YYYY-mm-ddTH:i:s a dd-mm-YYYY --}}
                                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $item['end'])->format('d-m-Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-danger mt-3 d-block" role="alert" id="auction-history">
                <h4 class="alert-heading">Error!</h4>
                <p>Player has no sold items!</p>
            </div>
        @endif

        @if (isset($bidsData))
            <div class="card mt-3 d-none" id="bid-history">
                <div class="card-body">
                    <h5 class="card-title">Bid History</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bidsData as $item)
                                <tr>
                                    <td>{{ $item['itemName'] }}</td>
                                    <td>
                                        @if ($item['highestOwnBid'] != $item['highestBid'])
                                            Not obtained -
                                            {{ number_format(round((float) $item['highestBid'], 2), 2, '.', ',') }}
                                        @else
                                            {{ number_format(round((float) $item['highestBid'], 2), 2, '.', ',') }}
                                        @endif
                                    </td>
                                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $item['end'])->format('d-m-Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-danger mt-3 d-none" role="alert" id="bid-history">
                <h4 class="alert-heading">Error!</h4>
                <p>Player has no bought items!</p>
            </div>
        @endif
    </div>
@endsection

<script>
    function showContent(section) {
        console.log(section)
        // Oculta todos los contenidos
        document.getElementById('auction-history').classList.add('d-none');
        document.getElementById('bid-history').classList.add('d-none');

        //get element by class name
        var auctionHistoryBtn = document.getElementsByClassName('auction-history-btn');
        var bidHistoryBtn = document.getElementsByClassName('bid-history-btn');

        if (section == 'auction-history') {
            // Muestra solo el contenido de la sección seleccionada
            auctionHistoryBtn[0].classList.remove('btn-outline-primary');
            auctionHistoryBtn[0].classList.add('btn-primary');
            bidHistoryBtn[0].classList.remove('btn-primary');
            bidHistoryBtn[0].classList.add('btn-outline-primary');
        } else {
            // Muestra solo el contenido de la sección seleccionada
            bidHistoryBtn[0].classList.remove('btn-outline-primary');
            bidHistoryBtn[0].classList.add('btn-primary');
            auctionHistoryBtn[0].classList.remove('btn-primary');
            auctionHistoryBtn[0].classList.add('btn-outline-primary');
        }

        // Muestra solo el contenido de la sección seleccionada
        document.getElementById(section).classList.remove('d-none');
        document.getElementById(section).classList.add('d-block');
    }
</script>
