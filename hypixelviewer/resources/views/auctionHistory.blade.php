@extends('layouts.general')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    <div class="container mt-3">
        <div class="section-buttons row">
            {{-- Dos botones, uno para mostrar auctions y otro para mostrar bids, que ocupen los dos todo el espacio de la clase padre y que sean del mismo tamaño --}}
            <button class="btn btn-primary col mx-3" onclick="showAuctions()">Auctions</button>
            <button class="btn btn-primary col mx-3" onclick="showBids()">Bids</button>
        </div>

        <div class="card auction-history mt-3">
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

        <div class="card bid-history mt-3">
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
    </div>
    {{-- @dd($bidsData) --}}
@endsection
