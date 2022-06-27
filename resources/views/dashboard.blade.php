@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-center mt-2">
    <div class="card-group">

        <div class="m-2">
            <div class="card" style="background-color: coral">
                <div class="card-body">
                    Biggest donation:
                    <br>
                    <h3>{{ $biggestDonation->amount }} карбованцiв</h3>
                    <h3>by: {{ $biggestDonation->donator_name }}</h3>
                </div>
                {{-- <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div> --}}
            </div>
        </div>

        <div class="m-2">
            <div class="card" style="background-color: coral">
                <div class="card-body">
                    Total donations for last month:
                    <br>
                    <h3>{{ $lastMonth }} карбованцiв</h3>
                </div>
                {{-- <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div> --}}
            </div>
        </div>

        <div class="m-2">
            <div class="card" style="background-color: coral">
                <div class="card-body">
                    Total donations for all time:<br>
                    <h3>{{ $summ}} карбованцiв</h3>
                </div>
                {{-- <div class="card-footer">
                    <small class="text-muted">Result</small>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center">
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
</div>

<div class="d-flex justify-content-center mt-2">
    <div class="card col-6">
        <table class="table" style="background-color: rgb(191, 238, 252)">
            <thead>
                <tr>
                    <th class="px-4 py-2">{{ __('Donator_name') }}</th>
                    <th class="px-4 py-2">{{ __('Email') }}</th>
                    <th class="px-4 py-2">{{ __('Amount') }}</th>
                    <th class="px-4 py-2">{{ __('Message') }}</th>
                    <th class="px-4 py-2">{{ __('Date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donations as $donation)
                <tr>
                    <td class="border px-4 py-2">{{ $donation->donator_name }}</td>
                    <td class="border px-4 py-2">{{ $donation->email }}</td>
                    <td class="border px-4 py-2">{{ $donation->amount }}</td>
                    <td class="border px-4 py-2">{{ $donation->message }}</td>
                    <td class="border px-4 py-2">{{ $donation->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $donations->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var tests ={{ Js::from($chart) }};

        var kek = [
            ['Date', 'Amount'],
            ...tests
        ];

        var data = google.visualization.arrayToDataTable(kek);


        var options = {
            title: 'Donation Statistics',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
</script>
@endsection
